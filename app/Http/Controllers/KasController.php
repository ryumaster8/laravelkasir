<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ModelUser;
use App\Models\ModelOutlet;
use App\Models\ModelAkurasi;
use App\Models\ModelKasAwal;
use Illuminate\Http\Request;
use App\Models\ModelKasAkhir;
use App\Models\ModelActivityLog;
use App\Models\ModelCashRegister;
use App\Models\ModelPenarikanKas;
use App\Models\ModelCashRegisters;
use App\Models\ModelKasAdjustment;
use App\Models\ModelPenambahanKas;
use Illuminate\Support\Facades\Auth;
use App\Models\ModelTransaction; // Add this import
use Illuminate\Support\Facades\DB; // Add this import

class KasController extends Controller
{
    public function kasAwal()
    {
        if (!session('outlet_id') || !session('user_id')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $outletName = ModelOutlet::where('outlet_id', session('outlet_id'))->value('outlet_name');
        $operatorName = ModelUser::where('user_id', session('user_id'))->value('username');

        // Get kas_awal records instead of cash_registers
        $kasAwalRecords = ModelKasAwal::with(['creator', 'outlet'])
            ->where('outlet_id', session('outlet_id'))
            ->orderBy('date', 'desc')
            ->get();

        return view('admin.kas.kas_awal', compact('outletName', 'operatorName', 'kasAwalRecords'));
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
            'nominal' => 'required|numeric|min:1',
            'keterangan' => 'nullable|string|max:255'
        ]);

        try {
            // Perbaikan: menggunakan created_by bukan user_id
            $penambahan = ModelPenambahanKas::create([
                'outlet_id' => session('outlet_id'),
                'created_by' => session('user_id'),
                'nominal' => $request->nominal,
                'date' => now()->toDateString(), // Tambah toDateString()
                'waktu' => now(), // Tambah waktu
                'keterangan' => $request->keterangan
            ]);

            // Log aktivitas dengan format baru
            ActivityLogController::logKasActivity(
                'penambahan',
                session('user_id'),
                session('outlet_id'),
                $request->nominal,
                $request->keterangan
            );

            return redirect()->route('penambahan')->with('success', 'Penambahan kas berhasil disimpan!');
        } catch (\Exception $e) {
            \Log::error('Error in storePenambahan: ' . $e->getMessage()); // Tambah logging
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan penambahan: ' . $e->getMessage());
        }
    }

    public function editPenambahan($id)
    {
        $penambahan = ModelPenambahanKas::findOrFail($id);
        $outletName = ModelOutlet::where('outlet_id', $penambahan->outlet_id)->value('outlet_name');
        $operatorName = ModelUser::where('user_id', $penambahan->created_by)->value('username');

        return view('admin.kas.edit_penambahan', compact('penambahan', 'outletName', 'operatorName'));
    }

    public function updatePenambahan(Request $request, $id)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:1',
            'keterangan' => 'nullable|string|max:255'
        ]);

        $penambahan = ModelPenambahanKas::findOrFail($id);
        $oldAmount = $penambahan->nominal;
        
        $penambahan->update([
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan
        ]);

        // Log activity
        ModelActivityLog::create([
            'activity_log_operator_id' => session('user_id'),
            'activity_log_outlet_id' => session('outlet_id'),
            'action' => 'UPDATE',
            'description' => sprintf(
                "Operator %s di outlet %s mengubah kas dari Rp %s menjadi Rp %s",
                session('username'),
                session('outlet_name'),
                number_format($oldAmount, 0, ',', '.'),
                number_format($request->nominal, 0, ',', '.')
            ),
            'timestamp' => now()
        ]);

        return redirect()->route('penambahan')->with('success', 'Penambahan berhasil diperbarui!');
    }


    public function penambahan()
    {
        $outletId = session('outlet_id');
        $today = now()->format('Y-m-d');

        $penambahan = ModelPenambahanKas::with(['creator', 'outlet'])
            ->where('outlet_id', $outletId)
            ->whereDate('date', $today)
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
            'outlet_id' => 'required',
            'created_by' => 'required',
            'nominal' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string'
        ]);

        try {
            $kasAwal = ModelKasAwal::create([
                'outlet_id' => $request->outlet_id,
                'created_by' => $request->created_by,
                'nominal' => $request->nominal,
                'date' => now()->toDateString(),
                'waktu' => now(),  // Add this line
                'keterangan' => $request->keterangan
            ]);

            // Log aktivitas dengan format baru
            ActivityLogController::logKasActivity(
                'kas_awal',
                session('user_id'),
                session('outlet_id'),
                $request->nominal,
                $request->keterangan
            );

            return redirect()->route('kas-awal')
                ->with('success', 'Kas awal berhasil dibuka dengan nominal Rp. ' . number_format($request->nominal, 2));
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal membuka kas: ' . $e->getMessage());
        }
    }

    public function penarikan()
    {
        $outletId = session('outlet_id');
        $today = now()->format('Y-m-d');

        $penarikan = ModelPenarikanKas::with(['user', 'outlet'])  // Changed from 'creator' to 'user'
            ->where('outlet_id', $outletId)
            ->whereDate('date', $today)
            ->orderBy('waktu', 'desc') // Sort by waktu descending
            ->get();

        return view('admin.kas.penarikan', compact('penarikan'));
    }

    public function storePenarikan(Request $request)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:1',
            'keterangan' => 'nullable|string|max:255'
        ]);

        try {
            $penarikan = ModelPenarikanKas::create([
                'outlet_id' => session('outlet_id'),
                'created_by' => session('user_id'),
                'nominal' => $request->nominal,
                'date' => now()->toDateString(),
                'waktu' => now(), // Add current datetime
                'keterangan' => $request->keterangan
            ]);

            // Log aktivitas dengan format baru
            ActivityLogController::logKasActivity(
                'penarikan',
                session('user_id'),
                session('outlet_id'),
                $request->nominal,
                $request->keterangan
            );

            return redirect()->route('penarikan')->with('success', 'Penarikan kas berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan penarikan: ' . $e->getMessage());
        }
    }

    public function editPenarikan($id)
    {
        $penarikan = ModelPenarikanKas::findOrFail($id);
        $outletName = ModelOutlet::where('outlet_id', $penarikan->outlet_id)->value('outlet_name');
        $operatorName = ModelUser::where('user_id', $penarikan->created_by)->value('username');

        return view('admin.kas.edit_penarikan', compact('penarikan', 'outletName', 'operatorName'));
    }

    public function updatePenarikan(Request $request, $id)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:1',
            'keterangan' => 'nullable|string|max:255'
        ]);

        $penarikan = ModelPenarikanKas::findOrFail($id);
        $oldAmount = $penarikan->nominal;

        $penarikan->update([
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
            'waktu' => now() // Update waktu when modified
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
                number_format($request->nominal, 0, ',', '.')
            ),
            'timestamp' => now()
        ]);

        return redirect()->route('penarikan')->with('success', 'Penarikan berhasil diperbarui!');
    }

    public function destroyPenarikan($id)
    {
        $penarikan = ModelPenarikanKas::findOrFail($id);
        $amount = $penarikan->nominal;
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

        // Get kas awal for today
        $kasAwal = ModelKasAwal::where('outlet_id', $outletId)
            ->whereDate('date', $today)
            ->first();

        // Get penambahan kas for today
        $penambahan = ModelPenambahanKas::where('outlet_id', $outletId)
            ->whereDate('date', $today)
            ->get();
        
        $totalPenambahan = $penambahan->sum('nominal');
        $jumlahPenambahan = $penambahan->count();

        // Get penarikan kas for today from penarikan_kas table
        $penarikan = ModelPenarikanKas::where('outlet_id', $outletId)
            ->whereDate('date', $today)
            ->get();
        
        $totalPenarikan = $penarikan->sum('nominal');
        $jumlahPenarikan = $penarikan->count();

        // Get retail sales data
        $penjualanEcer = ModelTransaction::where('outlet_id', $outletId)
            ->where('sale_type', 'ecer') // Use string directly since we're using ModelTransaction
            ->whereDate('created_at', $today)
            ->get();
        
        $totalPenjualanEcer = $penjualanEcer->sum('total_amount');
        $jumlahTransaksiEcer = $penjualanEcer->count();

        // Get wholesale sales data
        $penjualanGrosir = ModelTransaction::where('outlet_id', $outletId)
            ->where('sale_type', 'grosir') // Use string directly since we're using ModelTransaction
            ->whereDate('created_at', $today)
            ->get();
        
        $totalPenjualanGrosir = $penjualanGrosir->sum('total_amount');
        $jumlahTransaksiGrosir = $penjualanGrosir->count();

        return view('admin.kas.dashboard', compact(
            'kasAwal',
            'totalPenambahan',
            'jumlahPenambahan',
            'totalPenarikan',
            'jumlahPenarikan',
            'totalPenjualanEcer',
            'jumlahTransaksiEcer',
            'totalPenjualanGrosir',
            'jumlahTransaksiGrosir'
        ));
    }

    public function editKasAwal($id)
    {
        $kasAwal = ModelKasAwal::findOrFail($id);
        $outletName = ModelOutlet::where('outlet_id', $kasAwal->outlet_id)->value('outlet_name');
        $operatorName = ModelUser::where('user_id', $kasAwal->created_by)->value('username');

        return view('admin.kas.edit_kas_awal', compact('kasAwal', 'outletName', 'operatorName'));
    }

    public function updateKasAwal(Request $request, $id)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string'
        ]);

        $kasAwal = ModelKasAwal::findOrFail($id);
        $kasAwal->update([
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('kas-awal')->with('success', 'Kas awal berhasil diperbarui!');
    }

    public function destroyKasAwal($id)
    {
        $kasAwal = ModelKasAwal::findOrFail($id);
        $kasAwal->delete();

        return redirect()->route('kas-awal')->with('success', 'Kas awal berhasil dihapus!');
    }

    public function kasAkhir()
    {
        $user = Auth::user();
        $outletId = session('outlet_id');
        $outletName = ModelOutlet::where('outlet_id', $outletId)->value('outlet_name');
        $operatorName = $user->username;
        
        $kasAkhirRecords = ModelKasAkhir::with('creator')
            ->where('outlet_id', $outletId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.kas.kas_akhir', compact('outletName', 'operatorName', 'kasAkhirRecords'));
    }

    public function storeKasAkhir(Request $request)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $outletId = $request->outlet_id;
        $today = today();

        // Get all required data for akurasi
        $kasAwal = ModelKasAwal::where('outlet_id', $outletId)
            ->whereDate('date', $today)
            ->first()->nominal ?? 0;

        $penjualanEcer = ModelTransaction::where('outlet_id', $outletId)
            ->where('sale_type', 'ecer')
            ->whereDate('created_at', $today)
            ->sum('total_amount');

        $penjualanGrosir = ModelTransaction::where('outlet_id', $outletId)
            ->where('sale_type', 'grosir')
            ->whereDate('created_at', $today)
            ->sum('total_amount');

        $penarikanKas = ModelPenarikanKas::where('outlet_id', $outletId)
            ->whereDate('date', $today)
            ->sum('nominal');

        $penambahanKas = ModelPenambahanKas::where('outlet_id', $outletId)
            ->whereDate('date', $today)
            ->sum('nominal');

        // Calculate total seharusnya
        $totalSeharusnya = $kasAwal + $penjualanEcer + $penjualanGrosir + $penambahanKas - $penarikanKas;
        $selisih = $request->nominal - $totalSeharusnya;

        DB::transaction(function() use ($request, $kasAwal, $penjualanEcer, $penjualanGrosir, 
            $penarikanKas, $penambahanKas, $selisih) {
            // Create kas akhir record
            ModelKasAkhir::create([
                'outlet_id' => $request->outlet_id,
                'created_by' => $request->created_by,
                'nominal' => $request->nominal,
                'date' => today(),
                'waktu' => now(),
                'keterangan' => $request->keterangan,
            ]);

            // Create akurasi record
            ModelAkurasi::create([
                'created_by' => $request->created_by,
                'outlet_id' => $request->outlet_id,
                'date' => today(),
                'waktu' => now(),
                'kas_awal' => $kasAwal,
                'penjualan_ecer' => $penjualanEcer,
                'penjualan_grosir' => $penjualanGrosir,
                'penarikan_kas' => $penarikanKas,
                'penambahan_kas' => $penambahanKas,
                'kas_akhir' => $request->nominal,
                'selisih' => $selisih,
                'keterangan' => $request->keterangan
            ]);
        });

        // Modified success message with simpler selisih format
        $message = sprintf(
            'Data kas akhir berhasil disimpan. Selisih: %sRp %s',
            $selisih < 0 ? '-' : '',
            number_format(abs($selisih), 0, ',', '.')
        );

        return redirect()->route('kas-akhir')->with('success', $message)->with('selisih', $selisih);
    }

    public function editKasAkhir($id)
    {
        $kasAkhir = ModelKasAkhir::findOrFail($id);
        return view('admin.kas.edit_kas_akhir', compact('kasAkhir'));
    }

    public function updateKasAkhir(Request $request, $id)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $kasAkhir = ModelKasAkhir::findOrFail($id);
        $kasAkhir->update([
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('kas-akhir')->with('success', 'Data kas akhir berhasil diupdate');
    }

    public function destroyKasAkhir($id)
    {
        $kasAkhir = ModelKasAkhir::findOrFail($id);
        $kasAkhir->delete();

        return redirect()->route('kas-akhir')->with('success', 'Data kas akhir berhasil dihapus');
    }

    public function hitungAkurasi($id) {
        // Hitung total uang yang seharusnya ada
        $kasAwal = ModelKasAwal::where('outlet_id', $id)
            ->whereDate('date', today())
            ->first()->nominal ?? 0;
            
        $penambahan = ModelPenambahanKas::where('outlet_id', $id)
            ->whereDate('date', today())
            ->sum('nominal');
            
        $penarikan = ModelPenarikanKas::where('outlet_id', $id)
            ->whereDate('date', today())
            ->sum('nominal');
            
        $penjualan = ModelTransaction::where('outlet_id', $id)
            ->whereDate('created_at', today())
            ->sum('total_amount');

        // Total yang seharusnya
        $seharusnya = $kasAwal + $penambahan + $penjualan - $penarikan;
        
        // Bandingkan dengan kas akhir real
        $kasAkhir = ModelKasAkhir::where('outlet_id', $id)
            ->whereDate('date', today())
            ->first()->nominal ?? 0;
            
        // Hitung selisih
        $selisih = $kasAkhir - $seharusnya;
        
        return [
            'seharusnya' => $seharusnya,
            'aktual' => $kasAkhir,
            'selisih' => $selisih,
            'status' => $selisih == 0 ? 'Akurat' : ($selisih > 0 ? 'Lebih' : 'Kurang'),
            'persentase_akurasi' => $seharusnya > 0 ? (($kasAkhir / $seharusnya) * 100) : 0,
            'komponen' => [
                'kas_awal' => $kasAwal,
                'penambahan' => $penambahan,
                'penarikan' => $penarikan,
                'penjualan' => $penjualan
            ]
        ];
    }

    public function showAdjustments()
    {
        $outletId = session('outlet_id');
        $today = today();

        $kasAwal = ModelKasAwal::where('outlet_id', $outletId)
            ->whereDate('date', $today)
            ->first()->nominal ?? 0;

        $totalPenjualan = ModelTransaction::where('outlet_id', $outletId)
            ->whereDate('created_at', $today)
            ->sum('total_amount');

        $totalPenambahan = ModelPenambahanKas::where('outlet_id', $outletId)
            ->whereDate('date', $today)
            ->sum('nominal');

        $totalPenarikan = ModelPenarikanKas::where('outlet_id', $outletId)
            ->whereDate('date', $today)
            ->sum('nominal');

        $totalSeharusnya = $kasAwal + $totalPenjualan + $totalPenambahan - $totalPenarikan;

        $adjustments = ModelKasAdjustment::with(['creator', 'outlet'])
            ->where('outlet_id', $outletId)
            ->whereDate('date', $today)
            ->orderBy('waktu', 'desc')
            ->get();

        return view('admin.kas.adjustments', compact(
            'kasAwal',
            'totalPenjualan',
            'totalPenambahan',
            'totalPenarikan',
            'totalSeharusnya',
            'adjustments'
        ));
    }

    public function storeAdjustment(Request $request)
    {
        $request->validate([
            'kas_aktual' => 'required|numeric|min:0',
            'keterangan' => 'required|string'
        ]);

        $outletId = session('outlet_id');
        $totalSeharusnya = $this->hitungAkurasi($outletId)['seharusnya'];
        $selisih = $request->kas_aktual - $totalSeharusnya;

        // Simpan adjustment
        $adjustment = ModelKasAdjustment::create([
            'created_by' => session('user_id'),
            'outlet_id' => $outletId,
            'date' => today(),
            'waktu' => now(),
            'selisih' => $selisih,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->back()->with('success', 'Penyesuaian kas berhasil disimpan');
    }

    public function validateEndOfDay()
    {
        $outletId = session('outlet_id');
        $today = today();

        // Cek apakah sudah ada kas akhir
        $kasAkhir = ModelKasAkhir::where('outlet_id', $outletId)
            ->whereDate('date', $today)
            ->first();

        // Cek apakah ada selisih yang belum disesuaikan
        $akurasi = $this->hitungAkurasi($outletId);
        $adjustment = ModelKasAdjustment::where('outlet_id', $outletId)
            ->whereDate('date', $today)
            ->first();

        if ($kasAkhir && $akurasi['selisih'] != 0 && !$adjustment) {
            return [
                'status' => false,
                'message' => 'Ada selisih kas yang belum disesuaikan'
            ];
        }

        return ['status' => true];
    }

    public function tutupKas()
    {
        $outletId = session('outlet_id');
        $akurasi = $this->hitungAkurasi($outletId);

        return view('admin.kas.tutup_kas', [
            'perhitungan' => $akurasi,
            'needsAdjustment' => true // Selalu minta input kas aktual untuk verifikasi
        ]);
    }

    public function storeTutupKas(Request $request)
    {
        $request->validate([
            'kas_aktual' => 'required|numeric|min:0',
            'pecahan' => 'required|array',
            'keterangan' => 'required_if:selisih,>,0'
        ]);

        $outletId = session('outlet_id');
        $akurasi = $this->hitungAkurasi($outletId);
        $selisih = $request->kas_aktual - $akurasi['seharusnya'];

        DB::transaction(function() use ($request, $akurasi, $selisih) {
            // Simpan adjustment jika ada selisih
            if ($selisih != 0) {
                ModelKasAdjustment::create([
                    'created_by' => session('user_id'),
                    'outlet_id' => session('outlet_id'),
                    'date' => today(),
                    'waktu' => now(),
                    'selisih' => $selisih,
                    'keterangan' => $request->keterangan,
                    'detail_pecahan' => json_encode($request->pecahan)
                ]);
            }

            // Simpan record tutup kas
            ModelClosingCash::create([
                'outlet_id' => session('outlet_id'),
                'created_by' => session('user_id'),
                'nominal_system' => $akurasi['seharusnya'],
                'nominal_aktual' => $request->kas_aktual,
                'selisih' => $selisih,
                'date' => today(),
                'waktu' => now()
            ]);
        });

        return redirect()->route('kas.dashboard')
            ->with('success', 'Kas berhasil ditutup');
    }

    public function showAkurasi()
    {
        $outletId = session('outlet_id');
        $today = today();

        // Get data akurasi
        $akurasi = $this->hitungAkurasi($outletId);

        // Get history akurasi
        $historyAkurasi = ModelAkurasi::with(['creator', 'outlet'])
            ->where('outlet_id', $outletId)
            ->orderBy('date', 'desc')
            ->orderBy('waktu', 'desc')
            ->get();

        return view('admin.kas.akurasi', compact('akurasi', 'historyAkurasi'));
    }
}
