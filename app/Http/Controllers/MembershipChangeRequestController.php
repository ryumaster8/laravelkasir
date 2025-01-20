<?php

namespace App\Http\Controllers;

use App\Models\MembershipChangeRequest;
use App\Models\ModelOutlet;
use App\Models\ModelRekeningOwner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\MembershipRequestApproved;
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

            $request = MembershipChangeRequest::with(['outlet', 'requestedMembership'])->findOrFail($id);
            
            // Update outlet membership
            ModelOutlet::where('outlet_id', $request->outlet_id)
                ->update(['membership_id' => $request->requested_membership_id]);

            // Update request status and processing details
            $request->update([
                'status' => 'approved',
                'processed_at' => now(),
                'processed_by' => auth()->id()
            ]);

            // Send email notifications
            try {
                // Send to outlet
                Mail::to($request->outlet->email)->send(new MembershipRequestApproved($request));
                
                // Get owner's email from ModelRekeningOwner
                $ownerAccount = ModelRekeningOwner::getActiveAccount();
                if ($ownerAccount && $ownerAccount->email) {
                    Mail::to($ownerAccount->email)->send(new MembershipRequestApproved($request, true));
                }
            } catch (\Exception $e) {
                // Log email sending error but continue with the process
                \Log::error('Failed to send membership approval email: ' . $e->getMessage());
            }

            DB::commit();
            return redirect()->back()->with('success', 'Permintaan telah disetujui dan email notifikasi telah dikirim');

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
        try {
            DB::beginTransaction();
            
            $request = MembershipChangeRequest::findOrFail($id);
            $outlet = ModelOutlet::findOrFail($request->outlet_id);
            
            // Update outlet membership
            $outlet->membership_id = $request->requested_membership_id;
            
            // Set subscription dates
            $outlet->membership_started_at = now();
            $outlet->membership_expires_at = now()->addMonth(); // Berlaku 1 bulan
            $outlet->subscription_status = 'active';
            $outlet->auto_renewal = false; // Default tidak auto renewal
            
            $outlet->save();
            
            // Update request status
            $request->status = 'completed';
            $request->processed_at = now();
            $request->processed_by = auth()->id();
            $request->save();
            
            DB::commit();
            
            return redirect()->back()->with('success', 'Perubahan membership berhasil diproses');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function deleteRequest($id)
    {
        $request = MembershipChangeRequest::findOrFail($id);
        $request->delete();

        return redirect()->back()->with('success', 'Permintaan telah dihapus');
    }
}
