<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Service;

class FrontServiceController extends Controller
{
    // LIST SERVICES
    public function index()
    {
        $services = Service::orderBy('service_id', 'desc')->get();

        // PENTING: arahkan ke show.blade.php
        return view('front.services.show', compact('services'));
    }

    // DETAIL SERVICE
    public function show($id)
    {
        $service = Service::findOrFail($id);
        return view('front.services.show', compact('service'));
    }
}
