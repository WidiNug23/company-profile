<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;

class AboutController extends Controller
{
    public function index()
    {
        return view('front.about',[
            'company' => CompanyProfile::first()
        ]);
    }
}
