<?php

namespace App\Http\Controllers;

use App\Models\ModelActivityLog;
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
                $log->formatted_time = Carbon::parse($log->timestamp)->format('d M Y H:i:s');
                return $log;
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
}
