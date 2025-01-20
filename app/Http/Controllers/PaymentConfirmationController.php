<?php

namespace App\Http\Controllers;

use App\Models\ModelPaymentConfirmation;
use App\Models\MembershipChangeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PaymentConfirmationController extends Controller
{
    public function show($requestId)
    {
        $membershipRequest = MembershipChangeRequest::with(['outlet'])
            ->findOrFail($requestId);

        return view('payment.confirmation', compact('membershipRequest'));
    }

    public function confirm(Request $request, $requestId)
    {
        $request->validate([
            'bank_name' => 'required|string|max:100',
            'method_transfer' => 'required|string|max:50',
            'account_name' => 'required|string|max:100',
            'account_number' => 'required|string|max:50',
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            // Create directory if it doesn't exist
            Storage::disk('public')->makeDirectory('bukti_transfer');

            // Handle file upload
            if ($request->hasFile('bukti_transfer')) {
                $file = $request->file('bukti_transfer');
                $filename = time() . '_' . $requestId . '.' . $file->getClientOriginalExtension();
                
                // Store file in public disk under bukti_transfer directory
                $request->file('bukti_transfer')->storeAs(
                    'bukti_transfer',
                    $filename,
                    'public'
                );

                // Update payment request without payment_date
                $membershipRequest = MembershipChangeRequest::find($requestId);
                $membershipRequest->payment_proof = $filename;
                $membershipRequest->payment_status = 'paid';
                $membershipRequest->save();

                return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah');
            }

            return redirect()->back()->with('error', 'Gagal mengunggah file');

        } catch (\Exception $e) {
            \Log::error('Payment confirmation upload failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function confirmPayment($user_id)
    {
        return view('admin.emails.confirm-payment', ['user_id' => $user_id]);
    }

    public function processConfirmPayment(Request $request, $user_id)
    {
        $request->validate([
            'bank_name' => 'required|string',
            'method_transfer' => 'required|string',
            'account_name' => 'required|string',
            'account_number' => 'required|string',
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fileName = null;
        $filePath = null;

        try {
            if ($request->hasFile('bukti_transfer')) {
                $file = $request->file('bukti_transfer');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('public/bukti_transfer', $fileName);
            }
            ModelPaymentConfirmation::create([
                'user_id' => $user_id,
                'bank_name' => $request->input('bank_name'),
                'method_transfer' => $request->input('method_transfer'),
                'account_name' => $request->input('account_name'),
                'account_number' => $request->input('account_number'),
                'bukti_transfer' => $fileName,
            ]);

            Log::info('Konfirmasi pembayaran berhasil, User ID: ' . $user_id);

            return redirect()->route('confirm.payment.success')->with('success', 'Konfirmasi pembayaran berhasil!');
        } catch (\Exception $e) {
            Log::error('Konfirmasi pembayaran gagal: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Konfirmasi pembayaran gagal. Silakan coba lagi.');
        }
    }

    public function confirmPaymentSuccess()
    {
        return view('admin.emails.confirm-payment-success');
    }
}
