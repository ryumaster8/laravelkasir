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
        $memberships = ModelMembership::where('is_active', true)
            ->orderBy('rank', 'asc')
            ->get();
        return view('front.membership-details', ['memberships' => $memberships]);
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
