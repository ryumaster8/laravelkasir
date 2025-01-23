<?php

namespace App\Http\Controllers;

use App\Models\ModelMembership;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function features()
    {
        return view('front.features');
    }

    public function membershipDetails()
    {
        $memberships = ModelMembership::all();
        return view('front.membership-details', ['memberships' => $memberships]); // Tambahkan prefix `front.`
    }

    public function testimonials()
    {
        return view('front.testimonials');
    }

    public function contact()
    {
        return view('front.contact');
    }
}
