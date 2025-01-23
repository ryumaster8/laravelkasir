<?php

namespace App\Http\Controllers;

use App\Models\ModelOutlet;
use App\Models\ModelMembership;
use App\Models\MembershipChangeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MembershipUpgradeApproved;
use App\Mail\MembershipUpgradeRejected;
use App\Models\ModelMembershipHistory;

class MembershipController extends Controller
{
    public function details()
    {
        $memberships = ModelMembership::orderBy('rank', 'asc')->get();
        return view('front.membership-details', compact('memberships'));
    }
    
    // ...existing code...

    public function upgradeRequests()
    {
        $requests = MembershipChangeRequest::with([
            'outlet',
            'currentMembership',
            'requestedMembership'
        ])
        ->orderBy('requested_at', 'desc')
        ->get()
        ->each(function ($request) {
            // Ensure requested_at is set if null
            if (!$request->requested_at) {
                $request->requested_at = $request->created_at ?? now();
            }
        });

        return view('membership.change-requests', compact('requests'));
    }

    public function approveRequest($outletId)
    {
        \Log::info('Starting membership upgrade approval process', ['outlet_id' => $outletId]);
        
        try {
            $outlet = ModelOutlet::with(['membership', 'requestedMembership', 'adminUser'])->findOrFail($outletId);
            
            // Validasi apakah status masih pending
            if ($outlet->status_upgrade !== 'pending') {
                return redirect()->route('membership.upgrade-requests')
                    ->with('error', 'Hanya permintaan dengan status pending yang dapat disetujui');
            }

            // Simpan data membership lama dan baru sebelum update
            $oldMembership = $outlet->membership;
            $newMembership = $outlet->requestedMembership;

            // Create history record
            ModelMembershipHistory::create([
                'outlet_id' => $outlet->outlet_id,
                'old_membership_id' => $oldMembership->membership_id,
                'new_membership_id' => $newMembership->membership_id,
                'upgrade_fee' => $outlet->upgrade_fee,
                'status' => 'approved',
                'notes' => 'Upgrade membership disetujui',
                'processed_by' => auth()->user()->user_id
            ]);

            // Update membership outlet
            $outlet->membership_id = $outlet->requested_membership_id;
            $outlet->requested_membership_id = null;
            $outlet->status_upgrade = 'approved';
            $outlet->save();

            // Kirim email ke outlet
            if ($outlet->email) {
                try {
                    \Log::info('Attempting to send approval email', ['to' => $outlet->email]);
                    
                    Mail::to($outlet->email)
                        ->send(new MembershipUpgradeApproved($outlet, $oldMembership, $newMembership));
                    
                    \Log::info('Approval email sent successfully');
                } catch (\Exception $e) {
                    \Log::error('Failed to send approval email', [
                        'error' => $e->getMessage(),
                        'outlet_email' => $outlet->email
                    ]);
                }
            }

            // Kirim email ke owner (jika ada)
            if ($outlet->adminUser && $outlet->adminUser->email) {
                try {
                    \Log::info('Attempting to send approval email to admin', ['to' => $outlet->adminUser->email]);
                    
                    Mail::to($outlet->adminUser->email)
                        ->send(new MembershipUpgradeApproved($outlet, $oldMembership, $newMembership));
                    
                    \Log::info('Approval email sent successfully to admin');
                } catch (\Exception $e) {
                    \Log::error('Failed to send approval email to admin', [
                        'error' => $e->getMessage(),
                        'admin_email' => $outlet->adminUser->email
                    ]);
                }
            }

            return redirect()->route('membership.upgrade-requests')
                ->with('success', 'Permintaan upgrade membership berhasil disetujui dan email notifikasi telah dikirim');

        } catch (\Exception $e) {
            \Log::error('Membership upgrade approval failed', [
                'error' => $e->getMessage(),
                'outlet_id' => $outletId
            ]);
            return redirect()->route('membership.upgrade-requests')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function rejectRequest($outletId)
    {
        try {
            $outlet = ModelOutlet::with(['membership', 'requestedMembership', 'adminUser'])->findOrFail($outletId);
            
            // Validasi apakah status masih pending
            if ($outlet->status_upgrade !== 'pending') {
                return redirect()->route('membership.upgrade-requests')
                    ->with('error', 'Hanya permintaan dengan status pending yang dapat ditolak');
            }

            // Simpan data membership yang diminta sebelum diupdate
            $requestedMembership = $outlet->requestedMembership;

            // Create history record
            ModelMembershipHistory::create([
                'outlet_id' => $outlet->outlet_id,
                'old_membership_id' => $outlet->membership_id,
                'new_membership_id' => $outlet->requested_membership_id,
                'upgrade_fee' => $outlet->upgrade_fee,
                'status' => 'rejected',
                'notes' => 'Upgrade membership ditolak',
                'processed_by' => auth()->user()->user_id
            ]);
            
            // Update status outlet
            $outlet->requested_membership_id = null;
            $outlet->status_upgrade = 'rejected';
            $outlet->upgrade_fee = null;
            $outlet->save();

            // Kirim email ke outlet
            if ($outlet->email) {
                Mail::to($outlet->email)
                    ->send(new MembershipUpgradeRejected($outlet, $requestedMembership));
            }

            // Kirim email ke owner
            if ($outlet->adminUser && $outlet->adminUser->email) {
                Mail::to($outlet->adminUser->email)
                    ->send(new MembershipUpgradeRejected($outlet, $requestedMembership));
            }

            return redirect()->route('membership.upgrade-requests')
                ->with('success', 'Permintaan upgrade membership berhasil ditolak dan email notifikasi telah dikirim');

        } catch (\Exception $e) {
            return redirect()->route('membership.upgrade-requests')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function deleteRequest($outletId)
    {
        $outlet = ModelOutlet::findOrFail($outletId);
        $outlet->requested_membership_id = null;
        $outlet->status_upgrade = null;
        $outlet->upgrade_fee = null;
        $outlet->save();

        return redirect()->route('membership.upgrade-requests')
            ->with('success', 'Permintaan upgrade berhasil dihapus');
    }

    public function verifyPayment($requestId)
    {
        try {
            $request = MembershipChangeRequest::findOrFail($requestId);
            
            if ($request->payment_status !== 'paid' || $request->change_status !== 'payment_uploaded') {
                throw new \Exception('Invalid request state for payment verification');
            }

            $request->payment_status = 'verified';
            $request->change_status = 'payment_verified';
            $request->save();

            return redirect()->route('membership.upgrade-requests')
                ->with('success', 'Pembayaran berhasil diverifikasi');
        } catch (\Exception $e) {
            return redirect()->route('membership.upgrade-requests')
                ->with('error', 'Gagal memverifikasi pembayaran: ' . $e->getMessage());
        }
    }

    public function processRequest($requestId)
    {
        try {
            $request = MembershipChangeRequest::with(['outlet', 'requestedMembership'])->findOrFail($requestId);
            
            if ($request->payment_status !== 'verified' || $request->change_status !== 'payment_verified') {
                throw new \Exception('Invalid request state for processing');
            }

            // Update outlet membership
            $outlet = $request->outlet;
            $outlet->membership_id = $request->requested_membership_id;
            $outlet->save();

            // Update request status
            $request->change_status = 'completed';
            $request->processed_at = now();
            $request->processed_by = auth()->id();
            $request->save();

            return redirect()->route('membership.upgrade-requests')
                ->with('success', 'Perubahan membership berhasil diproses');
        } catch (\Exception $e) {
            return redirect()->route('membership.upgrade-requests')
                ->with('error', 'Gagal memproses perubahan: ' . $e->getMessage());
        }
    }
}
