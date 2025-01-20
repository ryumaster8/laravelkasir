<?php

namespace App\Http\Controllers;

use App\Models\ModelOutlet;
use App\Models\ModelMembership;
use App\Models\ModelRekeningOwner;
use App\Models\MembershipChangeRequest;
use App\Notifications\MembershipUpgradeRequestNotification;
use App\Notifications\MembershipChangeRequestOwnerNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class OutletController extends Controller
{
    public function showUpgradeMembership()
    {
        $outlet = ModelOutlet::with(['membership'])->find(session('outlet_id'));
        
        // Get existing request if any with relationships
        $pendingRequest = MembershipChangeRequest::with(['requestedMembership'])
            ->where('outlet_id', session('outlet_id'))
            ->whereIn('status', ['pending'])
            ->where('payment_status', '!=', 'verified')
            ->first();
            
        $upgradeMemberships = ModelMembership::where('rank', '>', $outlet->membership->rank)
            ->where('is_active', true)
            ->orderBy('rank')
            ->get();

        $downgradeMemberships = ModelMembership::where('rank', '<', $outlet->membership->rank)
            ->where('is_active', true)
            ->orderBy('rank', 'desc')
            ->get();

        return view('outlet.change-membership', compact('outlet', 'upgradeMemberships', 'downgradeMemberships', 'pendingRequest'));
    }

    public function requestUpgrade(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $outlet = ModelOutlet::find(session('outlet_id'));
            $membership = ModelMembership::findOrFail($request->membership_id);

            // Check for existing pending requests
            $existingRequest = MembershipChangeRequest::where('outlet_id', $outlet->outlet_id)
                ->whereIn('status', ['pending'])
                ->where('payment_status', '!=', 'verified')
                ->first();

            if ($existingRequest) {
                return redirect()->back()->with('error', 'Anda masih memiliki permintaan upgrade yang pending');
            }

            // Get active bank account
            $bankAccount = ModelRekeningOwner::getActiveAccount();
            if (!$bankAccount) {
                throw new \Exception('Tidak ada rekening bank yang aktif');
            }

            // Create new upgrade request with fees
            $membershipRequest = MembershipChangeRequest::create([
                'outlet_id' => $outlet->outlet_id,
                'current_membership_id' => $outlet->membership_id,
                'requested_membership_id' => $membership->membership_id,
                'change_type' => 'upgrade',
                'change_fee' => $membership->biaya_upgrade,
                'monthly_fee' => $membership->biaya_bulanan,
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'requested_at' => now()
            ]);

            // Enhanced email sending with retry
            try {
                if ($outlet->email) {
                    \Log::info('Attempting to send email to: ' . $outlet->email);
                    
                    // Reset mailer configuration
                    \Config::set('mail.default', 'smtp');
                    \Config::set('mail.mailers.smtp.transport', 'smtp');
                    
                    // Clear resolved mailer instance
                    app()->forgetInstance('mailer');
                    app()->forgetInstance('swift.mailer');
                    
                    // Send notification with retry
                    $maxAttempts = 3;
                    $attempt = 1;
                    
                    while ($attempt <= $maxAttempts) {
                        try {
                            Notification::route('mail', $outlet->email)
                                ->notify(new MembershipUpgradeRequestNotification($membershipRequest, $bankAccount));
                            \Log::info('Email sent successfully on attempt ' . $attempt);
                            break;
                        } catch (\Exception $e) {
                            \Log::warning("Email attempt {$attempt} failed: " . $e->getMessage());
                            if ($attempt == $maxAttempts) {
                                throw $e;
                            }
                            $attempt++;
                            sleep(2); // Wait 2 seconds before retrying
                        }
                    }
                }

                // Send email to owner
                if ($bankAccount->email) {
                    Notification::route('mail', $bankAccount->email)
                        ->notify(new MembershipChangeRequestOwnerNotification($membershipRequest, $outlet));
                }
            } catch (\Exception $emailError) {
                \Log::error('All email attempts failed: ' . $emailError->getMessage());
                \Log::error('Debug info: ' . json_encode([
                    'mailer' => config('mail.default'),
                    'host' => config('mail.mailers.smtp.host'),
                    'port' => config('mail.mailers.smtp.port'),
                    'username' => config('mail.mailers.smtp.username'),
                    'encryption' => config('mail.mailers.smtp.encryption'),
                ]));
                
                session()->flash('email_error', 'Email tidak terkirim: ' . $emailError->getMessage());
            }

            DB::commit();
            
            $successMessage = 'Permintaan upgrade berhasil diajukan. ';
            $successMessage .= 'Silakan transfer ke rekening ' . $bankAccount->getFormattedAccountAttribute();
            $successMessage .= ' sebesar Rp ' . number_format($membership->biaya_upgrade, 0, ',', '.');
            
            if (session('email_error')) {
                $successMessage .= "\n(Catatan: " . session('email_error') . ")";
            }
            
            return redirect()->back()->with('success', $successMessage);
            
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Upgrade request failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function requestDowngrade(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $outlet = ModelOutlet::find(session('outlet_id'));
            $membership = ModelMembership::findOrFail($request->membership_id);

            // Check for existing pending requests
            $existingRequest = MembershipChangeRequest::where('outlet_id', $outlet->outlet_id)
                ->whereIn('status', ['pending'])
                ->where('payment_status', '!=', 'verified')
                ->first();

            if ($existingRequest) {
                return redirect()->back()->with('error', 'Anda masih memiliki permintaan downgrade yang pending');
            }

            // Get active bank account
            $bankAccount = ModelRekeningOwner::getActiveAccount();
            if (!$bankAccount) {
                throw new \Exception('Tidak ada rekening bank yang aktif');
            }

            // Create new downgrade request with fees
            $membershipRequest = MembershipChangeRequest::create([
                'outlet_id' => $outlet->outlet_id,
                'current_membership_id' => $outlet->membership_id,
                'requested_membership_id' => $membership->membership_id,
                'change_type' => 'downgrade',
                'change_fee' => $membership->biaya_downgrade,
                'monthly_fee' => $membership->biaya_bulanan,
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'requested_at' => now()
            ]);

            // Send emails with retry mechanism
            try {
                if ($outlet->email) {
                    \Log::info('Attempting to send downgrade email to: ' . $outlet->email);
                    
                    // Reset mailer configuration
                    \Config::set('mail.default', 'smtp');
                    \Config::set('mail.mailers.smtp.transport', 'smtp');
                    
                    app()->forgetInstance('mailer');
                    app()->forgetInstance('swift.mailer');
                    
                    $maxAttempts = 3;
                    $attempt = 1;
                    
                    while ($attempt <= $maxAttempts) {
                        try {
                            Notification::route('mail', $outlet->email)
                                ->notify(new MembershipUpgradeRequestNotification($membershipRequest, $bankAccount));
                            \Log::info('Downgrade email sent successfully on attempt ' . $attempt);
                            break;
                        } catch (\Exception $e) {
                            \Log::warning("Downgrade email attempt {$attempt} failed: " . $e->getMessage());
                            if ($attempt == $maxAttempts) {
                                throw $e;
                            }
                            $attempt++;
                            sleep(2);
                        }
                    }
                }

                // Send email to owner
                if ($bankAccount->email) {
                    Notification::route('mail', $bankAccount->email)
                        ->notify(new MembershipChangeRequestOwnerNotification($membershipRequest, $outlet));
                }
            } catch (\Exception $emailError) {
                \Log::error('All downgrade email attempts failed: ' . $emailError->getMessage());
                session()->flash('email_error', 'Email tidak terkirim: ' . $emailError->getMessage());
            }

            DB::commit();
            
            $successMessage = 'Permintaan downgrade berhasil diajukan. ';
            if ($membership->biaya_downgrade > 0) {
                $successMessage .= 'Silakan transfer ke rekening ' . $bankAccount->getFormattedAccountAttribute();
                $successMessage .= ' sebesar Rp ' . number_format($membership->biaya_downgrade, 0, ',', '.');
            }
            
            if (session('email_error')) {
                $successMessage .= "\n(Catatan: " . session('email_error') . ")";
            }
            
            return redirect()->back()->with('success', $successMessage);
            
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function index()
    {
        $outlets = ModelOutlet::with(['membership', 'adminUser', 'outletGroup', 'branchOutlets'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('owner.outlets.index', compact('outlets'));
    }

    public function showBranches($outletId)
    {
        $outlet = ModelOutlet::with(['branchOutlets' => function($query) {
            $query->with(['membership', 'adminUser', 'outletGroup']);
        }])->findOrFail($outletId);

        return view('owner.outlets.branches', compact('outlet'));
    }

    public function membershipHistory($outletId)
    {
        $outlet = ModelOutlet::with(['membership'])->findOrFail($outletId);
        
        $membershipHistory = MembershipChangeRequest::with([
                'requestedMembership', 
                'currentMembership',
                'processor'
            ])
            ->where('outlet_id', $outletId)
            ->orderByDesc('requested_at')
            ->orderByDesc('created_at')  // Added as fallback
            ->get();

        return view('owner.outlets.membership-history', compact('outlet', 'membershipHistory'));
    }

    public function detail($id)
    {
        $outlet = ModelOutlet::with([
            'adminUser',
            'outletGroup',
            'membership',
            'branchOutlets',
            'categories',
            'products',
            'membershipChangeRequests.currentMembership',
            'membershipChangeRequests.requestedMembership'
        ])->findOrFail($id);

        return view('owner.outlets.detail', compact('outlet'));
    }
    
    public function editProfile()
    {
        $outlet = ModelOutlet::findOrFail(session('outlet_id'));
        return view('admin.outlets.edit-profile', compact('outlet'));
    }

    public function updateProfile(Request $request)
    {
        try {
            $outlet = ModelOutlet::findOrFail(session('outlet_id'));
            
            $validated = $request->validate([
                'outlet_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'contact_info' => 'required|string|max:20', // Changed from outlet_phone
                'address' => 'required|string',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            DB::beginTransaction();

            $data = $request->only([
                'outlet_name',
                'email',
                'contact_info', // Changed from outlet_phone
                'address'
            ]);

            if ($request->hasFile('logo')) {
                if ($outlet->logo && file_exists(public_path('storage/' . $outlet->logo))) {
                    unlink(public_path('storage/' . $outlet->logo));
                }
                $logoPath = $request->file('logo')->store('outlet-logos', 'public');
                $data['logo'] = $logoPath;
            }

            $outlet->update($data);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Profil outlet berhasil diperbarui'
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', $e->errors())
            ], 422);
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error updating outlet profile: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui profil outlet: ' . $e->getMessage()
            ], 500);
        }
    }

    public function showOutletInfo()
    {
        $outlet = ModelOutlet::with([
            'membership',  // This will load the membership relationship
            'outletGroup', 
            'adminUser'
        ])->findOrFail(session('outlet_id'));

        return view('admin.outlets.info', compact('outlet'));
    }

    public function paymentHistory($outletId = null)
    {
        $outletId = $outletId ?? session('outlet_id');
        $outlet = ModelOutlet::with(['membership'])->findOrFail($outletId);
        
        $payments = MembershipChangeRequest::with([
                'requestedMembership',
                'processor'
            ])
            ->where('outlet_id', $outletId)
            ->where('payment_status', 'verified')
            ->orderByDesc('processed_at') // Changed from updated_at to processed_at
            ->paginate(10);

        return view('outlet.payment-history', compact('outlet', 'payments'));
    }

    public function showBilling()
    {
        $outlet = ModelOutlet::with(['membership', 'membershipChangeRequests' => function($query) {
            $query->where('payment_status', 'unpaid')
                  ->where('status', 'pending')
                  ->with('requestedMembership');
        }])->findOrFail(session('outlet_id'));

        $nextBillingDate = $outlet->membership_expires_at;
        $daysUntilExpiration = $outlet->getDaysUntilExpiration();
        $unpaidRequests = $outlet->membershipChangeRequests;
        
        return view('outlet.billing', compact(
            'outlet',
            'nextBillingDate',
            'daysUntilExpiration',
            'unpaidRequests'
        ));
    }

    public function enableAutoRenewal()
    {
        try {
            $outlet = ModelOutlet::findOrFail(session('outlet_id'));
            $outlet->enableAutoRenewal();

            return redirect()->back()->with('success', 'Perpanjangan otomatis berhasil diaktifkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengaktifkan perpanjangan otomatis');
        }
    }

    public function cancelAutoRenewal()
    {
        try {
            $outlet = ModelOutlet::findOrFail(session('outlet_id'));
            $outlet->cancelAutoRenewal();

            return redirect()->back()->with('success', 'Perpanjangan otomatis berhasil dinonaktifkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menonaktifkan perpanjangan otomatis');
        }
    }
}
