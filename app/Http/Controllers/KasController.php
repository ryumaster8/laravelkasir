<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ModelUser;
use App\Models\ModelOutlet;
use Illuminate\Http\Request;
use App\Models\ModelActivityLog;
use App\Models\ModelCashRegister;
use App\Models\ModelCashRegisters;
use Illuminate\Support\Facades\Auth;

class KasController extends Controller
{
    public function bukaKasir()
    {
        if (!session('outlet_id') || !session('user_id')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil nama outlet dan operator
        $outletName = ModelOutlet::where('outlet_id', session('outlet_id'))->value('outlet_name');
        $operatorName = ModelUser::where('user_id', session('user_id'))->value('username');

        // Ambil data cash register berdasarkan outlet
        $cashRegisters = ModelCashRegisters::where('outlet_id', session('outlet_id'))->get();

        return view('admin.kas.buka_kasir', compact('outletName', 'operatorName', 'cashRegisters'));
    }
    public function edit($id)
    {
        $register = ModelCashRegisters::where('cash_register_id', $id)->firstOrFail();

        return view('admin.kas.edit_register', compact('register'));
    }


    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'opening_balance' => 'required|numeric|min:0',
        ]);

        // Ambil data cash register berdasarkan ID
        $register = ModelCashRegisters::where('cash_register_id', $id)->firstOrFail();

        // Perbarui kolom opening_balance
        $register->update([
            'opening_balance' => $request->opening_balance,
        ]);

        return redirect()->route('bukakasir')->with('success', 'Saldo awal berhasil diperbarui!');
    }




    public function destroy($id)
    {
        $register = ModelCashRegisters::findOrFail($id);
        $register->delete();

        return redirect()->route('bukakasir')->with('success', 'Cash register berhasil dihapus!');
    }

    public function storePenambahan(Request $request)
    {
        $request->validate([
            'outlet_id' => 'required|integer',
            'total_received' => 'required|numeric|min:1',
            'keterangan' => 'nullable|string|max:255'
        ]);

        $dataTambah = [
            'outlet_id' => session('outlet_id'),
            'user_id' => session('user_id'),
            'total_received' => $request->total_received,
            'description' => $request->keterangan,
            'opening_balance' => 0,
            'date' => now(),
        ];

        $penambahan = ModelCashRegisters::create($dataTambah);

        // Log aktivitas dengan detail outlet dan operator
        ModelActivityLog::create([
            'activity_log_operator_id' => session('user_id'),
            'activity_log_outlet_id' => session('outlet_id'),
            'action' => 'CREATE',
            'description' => sprintf(
                "Operator %s di outlet %s menambahkan kas sebesar Rp %s",
                session('username'),
                session('outlet_name'),
                number_format($request->total_received, 0, ',', '.')
            ),
            'timestamp' => now()
        ]);

        return redirect()->route('penambahan')->with('success', 'Penambahan berhasil disimpan!');
    }
    public function editPenambahan($id)
    {
        $penambahan = ModelCashRegisters::findOrFail($id);
        $outletName = ModelOutlet::where('outlet_id', $penambahan->outlet_id)->value('outlet_name');
        $operatorName = ModelUser::where('user_id', $penambahan->user_id)->value('username');

        return view('admin.kas.edit_penambahan', compact('penambahan', 'outletName', 'operatorName'));
    }

    public function updatePenambahan(Request $request, $id)
    {
        $request->validate([
            'total_received' => 'required|numeric|min:1',
            'keterangan' => 'nullable|string|max:255'
        ]);

        $penambahan = ModelCashRegisters::findOrFail($id);
        $oldAmount = $penambahan->total_received;
        
        $penambahan->update([
            'total_received' => $request->total_received,
            'description' => $request->keterangan
        ]);

        ModelActivityLog::create([
            'activity_log_operator_id' => session('user_id'),
            'activity_log_outlet_id' => session('outlet_id'),
            'action' => 'UPDATE',
            'description' => sprintf(
                "Operator %s di outlet %s mengubah kas dari Rp %s menjadi Rp %s",
                session('username'),
                session('outlet_name'),
                number_format($oldAmount, 0, ',', '.'),
                number_format($request->total_received, 0, ',', '.')
            ),
            'timestamp' => now()
        ]);

        return redirect()->route('penambahan')->with('success', 'Penambahan berhasil diperbarui!');
    }


    public function penambahan()
    {
        $outletId = session('outlet_id');
        $today = now()->format('Y-m-d');

        // Ambil data penambahan hari ini berdasarkan outlet dan tanggal
        $penambahan = ModelCashRegisters::where('outlet_id', $outletId)
            ->whereDate('date', $today)
            ->with(['user', 'outlet'])
            ->get();

        return view('admin.kas.penambahan', compact('penambahan'));
    }




    public function destroyPenambahan($id)
    {
        try {
            $penambahan = ModelCashRegisters::findOrFail($id);
            $amount = $penambahan->total_received;
            
            $penambahan->delete();
            
            ModelActivityLog::create([
                'activity_log_operator_id' => session('user_id'),
                'activity_log_outlet_id' => session('outlet_id'),
                'action' => 'DELETE',
                'description' => sprintf(
                    "Operator %s di outlet %s menghapus penambahan kas sebesar Rp %s",
                    session('username'),
                    session('outlet_name'),
                    number_format($amount, 0, ',', '.')
                ),
                'timestamp' => now()
            ]);
            
            return redirect()->route('penambahan')->with('success', 'Data penambahan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('penambahan')->with('error', 'Gagal menghapus data penambahan!');
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            'outlet_id' => 'required|integer',
            'user_id' => 'required|integer',
            'opening_balance' => 'required|numeric|min:0',
        ]);

        // Simpan data ke database
        ModelCashRegisters::create([
            'outlet_id' => $request->outlet_id,
            'user_id' => $request->user_id,
            'opening_balance' => $request->opening_balance,
            'date' => now(),
        ]);

        return redirect()->route('bukakasir')->with('success', 'Kas berhasil disimpan!');
    }

    public function penarikan()
    {
        $outletId = session('outlet_id');
        $today = now()->format('Y-m-d');

        // Fetch today's withdrawals based on outlet and date
        $penarikan = ModelCashRegisters::where('outlet_id', $outletId)
            ->whereDate('date', $today)
            ->where('total_paid_out', '>', 0)
            ->with(['user', 'outlet'])
            ->get();

        return view('admin.kas.penarikan', compact('penarikan'));
    }

    public function storePenarikan(Request $request)
    {
        $request->validate([
            'total_paid_out' => 'required|numeric|min:1',
            'keterangan' => 'nullable|string|max:255'
        ]);

        $penarikan = ModelCashRegisters::create([
            'outlet_id' => session('outlet_id'),
            'user_id' => session('user_id'),
            'total_paid_out' => $request->total_paid_out,
            'opening_balance' => 0,
            'description' => $request->keterangan,
            'date' => now(),
        ]);

        ModelActivityLog::create([
            'activity_log_operator_id' => session('user_id'),
            'activity_log_outlet_id' => session('outlet_id'),
            'action' => 'CREATE',
            'description' => sprintf(
                "Operator %s di outlet %s melakukan penarikan kas sebesar Rp %s",
                session('username'),
                session('outlet_name'),
                number_format($request->total_paid_out, 0, ',', '.')
            ),
            'timestamp' => now()
        ]);

        return redirect()->route('penarikan')->with('success', 'Penarikan kas berhasil disimpan!');
    }

    public function editPenarikan($id)
    {
        $penarikan = ModelCashRegisters::findOrFail($id);
        $outletName = ModelOutlet::where('outlet_id', $penarikan->outlet_id)->value('outlet_name');
        $operatorName = ModelUser::where('user_id', $penarikan->user_id)->value('username');

        return view('admin.kas.edit_penarikan', compact('penarikan', 'outletName', 'operatorName'));
    }

    public function updatePenarikan(Request $request, $id)
    {
        $request->validate([
            'total_paid_out' => 'required|numeric|min:1',
            'keterangan' => 'nullable|string|max:255'
        ]);

        $penarikan = ModelCashRegisters::findOrFail($id);
        $oldAmount = $penarikan->total_paid_out;

        $penarikan->update([
            'total_paid_out' => $request->total_paid_out,
            'description' => $request->keterangan
        ]);

        ModelActivityLog::create([
            'activity_log_operator_id' => session('user_id'),
            'activity_log_outlet_id' => session('outlet_id'),
            'action' => 'UPDATE',
            'description' => sprintf(
                "Operator %s di outlet %s mengubah penarikan kas dari Rp %s menjadi Rp %s",
                session('username'),
                session('outlet_name'),
                number_format($oldAmount, 0, ',', '.'),
                number_format($request->total_paid_out, 0, ',', '.')
            ),
            'timestamp' => now()
        ]);

        return redirect()->route('penarikan')->with('success', 'Penarikan berhasil diperbarui!');
    }

    public function destroyPenarikan($id)
    {
        $penarikan = ModelCashRegisters::where('cash_register_id', $id)
            ->where('total_paid_out', '>', 0)
            ->firstOrFail();
            
        $amount = $penarikan->total_paid_out;
        $penarikan->delete();

        ModelActivityLog::create([
            'activity_log_operator_id' => session('user_id'),
            'activity_log_outlet_id' => session('outlet_id'),
            'action' => 'DELETE',
            'description' => sprintf(
                "Operator %s di outlet %s menghapus penarikan kas sebesar Rp %s",
                session('username'),
                session('outlet_name'),
                number_format($amount, 0, ',', '.')
            ),
            'timestamp' => now()
        ]);

        return redirect()->route('penarikan')->with('success', 'Penarikan berhasil dihapus!');
    }

    public function dashboard()
    {
        $today = Carbon::today();
        $outletId = session('outlet_id');

        // Get kas awal for today using opening_balance
        $kasAwal = ModelCashRegisters::where('outlet_id', $outletId)
            ->whereDate('date', $today)
            ->where('opening_balance', '>', 0)
            ->first();

        // Get cash additions for today using total_received
        $penambahan = ModelCashRegisters::where('outlet_id', $outletId)
            ->whereDate('date', $today)
            ->where('total_received', '>', 0)
            ->get();
        
        $totalPenambahan = $penambahan->sum('total_received');
        $jumlahPenambahan = $penambahan->count();

        // Get cash withdrawals for today
        $penarikan = ModelCashRegisters::where('outlet_id', $outletId)
            ->whereDate('date', $today)
            ->where('total_paid_out', '>', 0)
            ->get();
        
        $totalPenarikan = $penarikan->sum('total_paid_out');
        $jumlahPenarikan = $penarikan->count();

        return view('admin.kas.dashboard', compact(
            'kasAwal',
            'totalPenambahan',
            'jumlahPenambahan',
            'totalPenarikan',
            'jumlahPenarikan'
        ));
    }
}
