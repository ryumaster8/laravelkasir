<?php

namespace App\Http\Controllers;

use App\Models\ModelMembership;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $memberships = ModelMembership::active()
            ->orderBy('rank', 'asc')
            ->get();

        return view('front.home', compact('memberships'));
    }
}
