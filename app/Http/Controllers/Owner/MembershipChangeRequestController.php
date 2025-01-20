<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\MembershipChangeRequest;
use App\Models\ModelOutlet;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MembershipChangeRequestController extends Controller
{
    public function index()
    {
        $requests = MembershipChangeRequest::with([
            'outlet',
            'currentMembership',
            'requestedMembership'
        ])
        ->orderBy('requested_at', 'desc')
        ->get();

        return view('membership.change-requests', compact('requests'));
    }

    public function approveRequest($id)
    {
        try {
            DB::beginTransaction();

            $membershipRequest = MembershipChangeRequest::findOrFail($id);
            
            // Update outlet membership
            $outlet = ModelOutlet::findOrFail($membershipRequest->outlet_id);
            $outlet->membership_id = $membershipRequest->requested_membership_id;
            $outlet->save();

            // Update request status
            $membershipRequest->status = 'approved';
            $membershipRequest->payment_status = 'unpaid';
            $membershipRequest->processed_at = now();
            $membershipRequest->processed_by = auth()->id();
            $membershipRequest->save();

            DB::commit();
            return redirect()->back()->with('success', 'Permintaan telah disetujui dan menunggu pembayaran');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memproses perubahan: ' . $e->getMessage());
        }
    }

    public function rejectRequest(Request $request, $id)
    {
        $membershipRequest = MembershipChangeRequest::findOrFail($id);
        
        // Validate the reason
        $request->validate([
            'reason' => 'required|string|max:255'
        ]);

        $membershipRequest->status = 'rejected';
        $membershipRequest->reason = $request->reason;
        $membershipRequest->save();

        return redirect()->back()->with('success', 'Permintaan telah ditolak');
    }

    public function verifyPayment($id)
    {
        $request = MembershipChangeRequest::findOrFail($id);
        $request->payment_status = 'verified';
        $request->save();

        return redirect()->back()->with('success', 'Pembayaran telah diverifikasi');
    }

    public function processRequest($id)
    {
        $request = MembershipChangeRequest::findOrFail($id);
        
        // Only process if payment is verified
        if ($request->payment_status !== 'verified') {
            return redirect()->back()->with('error', 'Pembayaran harus diverifikasi terlebih dahulu');
        }

        // Proses perubahan membership outlet di sini
        // ...

        $request->processed_at = now();
        $request->processed_by = auth()->id();
        $request->save();

        return redirect()->back()->with('success', 'Perubahan membership berhasil diproses');
    }

    public function deleteRequest($id)
    {
        $request = MembershipChangeRequest::findOrFail($id);
        $request->delete();

        return redirect()->back()->with('success', 'Permintaan telah dihapus');
    }
}
