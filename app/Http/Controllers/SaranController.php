<?php

namespace App\Http\Controllers;

use App\Models\ModelSaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaranController extends Controller
{
    public function create()
    {
        return view('saran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'saran' => 'required|string|max:255',
        ]);

        ModelSaran::create([
            'outlet_id' => Auth::user()->outlet_id,
            'created_by' => Auth::id(),
            'saran' => $request->saran,
        ]);

        return redirect()->route('saran.create')
            ->with('success', 'Terima kasih! Saran Anda telah berhasil dikirim.');
    }
}
