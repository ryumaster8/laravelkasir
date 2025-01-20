<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Logika untuk mengambil data atau melakukan persiapan tampilan (jika perlu)
        // Contoh:
        // $data = ['user' => auth()->user(), 'notifications' => ... ];

        // return view('layouts.app');
        // return view('layouts.dashboard');
        return view('auth.dashboard');
    }

    public function ownerDashboard()
    {
        return view('owner.dashboard');
    }
}
