<?php

namespace App\Http\Controllers;

use App\Models\ModelActivityLog;
use App\Models\ModelUser;
use App\Models\ModelOutlet;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = ModelActivityLog::with(['operator', 'outlet'])
            ->orderBy('timestamp', 'desc')
            ->get()
            ->map(function ($log) {
                return [
                    'id' => $log->activity_log_id,
                    'timestamp' => Carbon::parse($log->timestamp)->format('d-m-Y H:i:s'),
                    'operator' => $log->operator ? [
                        'username' => $log->operator->username,
                        'id' => $log->operator->user_id
                    ] : null,
                    'outlet' => $log->outlet ? [
                        'name' => $log->outlet->outlet_name,
                        'id' => $log->outlet->outlet_id
                    ] : null,
                    'action' => $log->action,
                    'description' => $log->description
                ];
            });

        return view('admin.activity-logs.index', compact('logs'));
    }

    public function destroy($id)
    {
        try {
            $log = ModelActivityLog::findOrFail($id);
            
            // Log penghapusan aktivitas
            ModelActivityLog::create([
                'activity_log_operator_id' => session('user_id'),
                'activity_log_outlet_id' => session('outlet_id'),
                'action' => 'DELETE',
                'description' => sprintf(
                    "Operator %s di outlet %s menghapus log aktivitas ID #%s",
                    session('username'),
                    session('outlet_name'),
                    $id
                ),
                'timestamp' => now()
            ]);

            $log->delete();
            
            return redirect()
                ->route('activity-logs.index')
                ->with('success', 'Log aktivitas berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()
                ->route('activity-logs.index')
                ->with('error', 'Gagal menghapus log aktivitas: ' . $e->getMessage());
        }
    }

    /**
     * Log specific activities with detailed information
     */
    public static function logKasActivity($type, $userId, $outletId, $amount, $keterangan = null)
    {
        $actions = [
            'kas_awal' => 'BUKA KAS',
            'penambahan' => 'TAMBAH KAS',
            'penarikan' => 'TARIK KAS'
        ];

        $details = sprintf(
            "Melakukan %s sejumlah %s | Keterangan: %s",
            strtolower($actions[$type]),
            ModelActivityLog::formatCurrency($amount),
            $keterangan ?: '-'
        );

        return ModelActivityLog::createLog(
            $userId,
            $outletId,
            $actions[$type],
            $details
        );
    }
}
