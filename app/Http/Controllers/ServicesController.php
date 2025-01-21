<?php

namespace App\Http\Controllers;

use App\Models\ModelService;
use App\Models\ModelUser;
use App\Models\ModelOutlet;
use App\Models\ModelTeknisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ServicesController extends Controller
{
    public function index()
    {
        $authUser = Auth::user();
        if ($authUser instanceof \App\Models\ModelUser) {
            $services = ModelService::with(['operator', 'outlet', 'teknisi', 'operatorPengambilan'])
                ->where('service_outlet_id', $authUser->outlet->outlet_id ?? null)
                ->get();
        } else {
            $services = collect([]);
        }
        return view('admin.service.index', compact('services'));
    }
    public function edit($id)
    {
        $service = ModelService::findOrFail($id);
        $teknisi = ModelTeknisi::all(); // Asumsi Anda memiliki ModelTeknisi untuk daftar teknisi
        return view('admin.service.edit', compact('service', 'teknisi'));
    }





    public function destroy($id)
    {
        $service = ModelService::findOrFail($id);

        // Validasi jika progress_status adalah 'Selesai' atau 'Dibatalkan'
        if (in_array($service->progress_status, ['Selesai', 'Dibatalkan'])) {
            return redirect()->route('services.index')->with('error', 'Data tidak dapat dihapus karena sudah diambil atau dibatalkan.');
        }

        $service->delete();
        return redirect()->route('services.index')->with('success', 'Data berhasil dihapus.');
    }

    public function cancelView($id)
    {
        $service = ModelService::findOrFail($id);

        if ($service->progress_status === 'Selesai' || $service->progress_status === 'Dibatalkan') {
            return redirect()->route('services.index')->with('error', 'Servis ini tidak dapat dibatalkan.');
        }

        return view('admin.service.cancel', compact('service'));
    }
    public function cancel(Request $request, $id)
    {
        $request->validate([
            'alasan_pembatalan' => 'required|string|max:255',
        ]);

        $service = ModelService::findOrFail($id);

        if ($service->progress_status === 'Selesai' || $service->progress_status === 'Dibatalkan') {
            return redirect()->route('services.index')->with('error', 'Servis ini tidak dapat dibatalkan.');
        }

        $service->progress_status = 'Dibatalkan';
        $service->status_servis = 'Dibatalkan';
        $service->tanggal_batal = now();
        $service->operator_batal = Auth::id();
        $service->save();

        return redirect()->route('services.index')->with('success', 'Servis berhasil dibatalkan.');
    }
    // Menampilkan halaman tambah data service
    public function create()
    {
        $faktur = 'INV-' . mt_rand(100000000, 999999999);
        $teknisi = ModelTeknisi::all(); // Ambil data teknisi
        return view('admin.service.create', compact('faktur', 'teknisi'));
    }




    public function store(Request $request)
    {
        $request->validate([
            'faktur' => 'required|string|unique:services,faktur',
            'tanggal_masuk' => 'required|date',
            'teknisi' => 'required|integer',
            'nama_pelanggan' => 'required|string',
            'nama_perangkat' => 'required|string',
            'tipe_perangkat' => 'required|string|in:Handphone,Laptop,PC,Lainnya',
            'serial_number' => 'required|string',
            'keluhan' => 'required|string',
            'kelengkapan_perangkat' => 'required|string',
            'kerusakan' => 'nullable|string',
            'sparepart' => 'nullable|string',
            'description' => 'nullable|string',
            'estimasi_penyelesaian' => 'nullable|date',
            'tanggal_ambil' => 'nullable|date',
            'biaya' => 'required|numeric|min:0',
            'pembayaran' => 'required|string|max:50',
            'uang_muka' => 'nullable|numeric|min:0',
        ]);

        if (!in_array($request->pembayaran, ModelService::$valid_status_pembayaran)) {
            return redirect()->back()->withErrors(['pembayaran' => 'Status pembayaran tidak valid']);
        }

        $authUser = Auth::user();

        if (!$authUser || !$authUser->outlet_id) {
            return redirect()->back()->withErrors('Operator tidak memiliki outlet yang valid.');
        }

        // Calculate sisa_pembayaran based on status_pembayaran
        $sisa_pembayaran = match ($request->pembayaran) {
            ModelService::STATUS_PEMBAYARAN_BELUM_LUNAS => $request->biaya,
            ModelService::STATUS_PEMBAYARAN_LUNAS => 0,
            ModelService::STATUS_PEMBAYARAN_UANG_MUKA => $request->biaya - ($request->uang_muka ?? 0),
            default => $request->biaya
        };

        ModelService::create([
            'faktur' => $request->faktur,
            'service_operator_id' => $authUser->user_id,
            'service_outlet_id' => $authUser->outlet_id,
            'service_teknisi_id' => $request->teknisi,
            'customer_name' => $request->nama_pelanggan,
            'device_name' => $request->nama_perangkat,
            'tipe_perangkat' => $request->tipe_perangkat,
            'serial_number' => $request->serial_number,
            'keluhan' => $request->keluhan,
            'equipment_included' => $request->kelengkapan_perangkat,
            'kerusakan' => $request->kerusakan,
            'sparepart' => $request->sparepart,
            'description' => $request->description ?? '',
            'completion_estimate' => $request->estimasi_penyelesaian,
            'tanggal_ambil' => $request->tanggal_ambil,
            'biaya' => $request->biaya,
            'status_pembayaran' => $request->pembayaran,
            'uang_muka' => $request->pembayaran === ModelService::STATUS_PEMBAYARAN_UANG_MUKA ? $request->uang_muka : null,
            'sisa_pembayaran' => $sisa_pembayaran,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        return redirect()->route('services.index')->with('success', 'Data service berhasil ditambahkan.');
    }




    public function pengambilan($id)
    {
        // Ambil data service dengan relasi yang diperlukan
        $service = ModelService::with(['operator', 'outlet', 'teknisi'])->findOrFail($id);

        // Ambil data user yang sedang login
        $authUser = Auth::user();

        return view('admin.service.pengambilan', [
            'service' => $service,
            'outletName' => $authUser->outlet->outlet_name ?? null,
            'operatorName' => $authUser->username ?? null,
            'teknisiName' => $service->teknisi->nama_teknisi ?? null,
            'tanggalMasuk' => optional($service->created_at)->format('Y-m-d'),
        ]);
    }


    public function updatePengambilan(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status_servis' => 'required|string|in:Berhasil,Sedang Pengerjaan,Gagal',
            'description' => 'nullable|string',
            'sisa_pembayaran' => 'nullable|numeric|min:0',
        ]);

        // Cari data servis berdasarkan ID
        $service = ModelService::findOrFail($id);

        // Ambil operator yang sedang login
        $authUser = Auth::user();

        if (!$authUser) {
            return redirect()->back()->withErrors('Operator tidak valid.');
        }

        // Perbarui kolom status_servis
        $service->status_servis = $request->status_servis;

        // Perbarui kolom progress_status berdasarkan status_servis
        if ($request->status_servis === 'Berhasil') {
            $service->progress_status = 'Selesai';
        } elseif ($request->status_servis === 'Sedang Pengerjaan') {
            $service->progress_status = 'Sedang Proses';
        } elseif ($request->status_servis === 'Gagal') {
            $service->progress_status = 'Selesai';
        }

        // Update payment status logic
        if ($request->status_servis === 'Berhasil') {
            $biaya = $service->biaya;
            $uangMuka = $service->uang_muka ?? 0;
            $service->sisa_pembayaran = max($biaya - $uangMuka, 0);
            $service->status_pembayaran = $service->sisa_pembayaran > 0 ? 
                ModelService::STATUS_PEMBAYARAN_BELUM_LUNAS : 
                ModelService::STATUS_PEMBAYARAN_LUNAS;
        } elseif ($request->status_servis === 'Gagal' || $request->status_servis === 'Sedang Pengerjaan') {
            $service->sisa_pembayaran = 0;
            $service->status_pembayaran = $request->status_servis === 'Gagal' ? 
                ModelService::STATUS_PEMBAYARAN_DIBATALKAN : 
                $service->status_pembayaran;
        }

        // Perbarui kolom lainnya
        $service->description = $request->description ?? ''; // Gunakan string kosong jika null
        $service->tanggal_ambil = now(); // Isi tanggal_ambil dengan waktu sekarang
        $service->operator_pengambilan = $authUser->user_id; // Isi operator_pengambilan dengan ID operator yang sedang login
        $service->service_completion_date = now(); // Isi service_completion_date dengan waktu sekarang

        // Simpan perubahan
        $service->save();

        // Buat pesan flash yang rinci
        $message = sprintf(
            'Data servis berhasil diperbarui. Detail: Perangkat %s (%s), atas nama %s, dengan faktur %s.',
            $service->device_name,
            $service->tipe_perangkat,
            $service->customer_name,
            $service->faktur
        );

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('services.index')->with('success', $message);
    }
}
