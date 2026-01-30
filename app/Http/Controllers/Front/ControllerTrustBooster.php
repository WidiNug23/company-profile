<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Partner;
use App\Models\Certification;

class ControllerTrustBooster extends Controller
{
    public function show()
    {
        // Ambil semua data dari ketiga tabel, bisa diubah sesuai kebutuhan
        $clients = Client::latest()->get();
        $partners = Partner::latest()->get();
        $certifications = Certification::latest()->get();

        return view('front.trust-booster.show', compact('clients', 'partners', 'certifications'));
    }
}
