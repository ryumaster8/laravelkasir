<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = Session::all();
        return view('session.show', ['sessions' => $sessions]);
    }

    public function show(Request $request)
    {
        $sessions = session()->all();

        // Filter sessions berdasarkan pencarian
        if ($request->has('search') && $request->search != '') {
            $search = strtolower($request->search);
            $sessions = collect($sessions)->filter(function ($value, $key) use ($search) {
                return str_contains(strtolower($key), $search);
            })->toArray();
        }

        return view('session.show', compact('sessions'));
    }
}
