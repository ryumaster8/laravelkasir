<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelContact;

class ContactController extends Controller
{
    public function show()
    {
        return view('front.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'pesan' => 'required|string',
        ]);

        ModelContact::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'pesan' => $request->pesan,
        ]);

        return redirect()->route('contact')->with('success', 'Pesan Anda Berhasil Terkirim!');
    }
}