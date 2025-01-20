<?php

namespace App\Http\Controllers;

use App\Models\ModelTeknisi;
use App\Models\ModelUser;
use App\Models\ModelOutlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class TeknisiController extends Controller
{
    public function index()
    {
        /**
         * @var \App\Models\ModelUser|null
         */
        $authUser = Auth::user();
        if ($authUser instanceof \App\Models\ModelUser) {
            $teknisi = ModelTeknisi::where('teknisi_outlet_id', $authUser->outlet->outlet_id)->get();
        } else {
            $teknisi = collect([]);
        }
        return view('admin.teknisi.index', compact('teknisi'));
    }
    public function semua()
    {
        /**
         * @var \App\Models\ModelUser|null
         */
        $authUser = Auth::user();
        if ($authUser instanceof \App\Models\ModelUser) {
            $teknisi = ModelTeknisi::whereHas('outlet', function ($q) use ($authUser) {
                $q->where('outlet_group_id', $authUser->outlet->outlet_group_id);
            })->get();
        } else {
            $teknisi = collect([]);
        }
        return view('admin.teknisi.index', compact('teknisi'));
    }

    public function create()
    {
        $operatorName = Session::get('username');
        $outletName = Session::get('outlet_name');

        return view('admin.teknisi.create', compact('operatorName', 'outletName'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'operator_id' => 'required',
            'teknisi_outlet_id' => 'required',
            'nama_teknisi' => 'required',
            'kontak' => 'nullable',
        ]);

        ModelTeknisi::create($request->all());

        return redirect()->route('teknisi.index')->with('success', 'Teknisi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $teknisi = ModelTeknisi::findOrFail($id);
        $operatorName = Session::get('username');
        $outletName = Session::get('outlet_name');
        return view('admin.teknisi.edit', compact('teknisi', 'operatorName', 'outletName'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_teknisi' => 'required',
            'kontak' => 'nullable',
        ]);

        $teknisi = ModelTeknisi::findOrFail($id);
        $teknisi->update($request->all());
        $pesan = "Teknisi dengan id " . $teknisi->teknisi_id . " dan nama teknisi " . $teknisi->nama_teknisi . " berhasil di update";
        return redirect()->route('teknisi.index')->with('success', $pesan);
    }

    public function destroy($id)
    {
        $teknisi = ModelTeknisi::findOrFail($id);
        $pesan = "Teknisi dengan id " . $teknisi->teknisi_id . " dan nama teknisi " . $teknisi->nama_teknisi . " berhasil di hapus";
        $teknisi->delete();
        return redirect()->route('teknisi.index')->with('success', $pesan);
    }

    public function pindahCabang($id)
    {
        $teknisi = ModelTeknisi::findOrFail($id);
        $currentOutlet = $teknisi->outlet;
        /**
         * @var \App\Models\ModelUser|null
         */
        $authUser = Auth::user();
        if ($authUser instanceof \App\Models\ModelUser) {
            $outlets = ModelOutlet::where('outlet_group_id', $authUser->outlet->outlet_group_id)
                ->where('outlet_id', '!=', $currentOutlet->outlet_id)
                ->get();
        } else {
            $outlets = collect([]);
        }
        return view('admin.teknisi.pindahcabang', compact('teknisi', 'outlets'));
    }

    public function prosesPindahCabang(Request $request, $id)
    {
        $request->validate([
            'outlet_tujuan' => 'required',
        ]);
        $teknisi = ModelTeknisi::findOrFail($id);
        $outletTujuan = ModelOutlet::findOrFail($request->outlet_tujuan);
        $teknisi->teknisi_outlet_id = $request->outlet_tujuan;
        $teknisi->save();
        $pesan = "Teknisi dengan id " . $teknisi->teknisi_id . " dan nama teknisi " . $teknisi->nama_teknisi . " berhasil di pindahkan ke outlet " . $outletTujuan->outlet_name;
        return redirect()->route('teknisi.index')->with('success', $pesan);
    }
}
