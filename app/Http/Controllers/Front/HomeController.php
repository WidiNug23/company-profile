<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Service;
use App\Models\News;
use App\Models\CompanyProfile;
use App\Models\TrustBooster;

// **Tambahkan ini agar model Client, Partner, Certification dikenali**
use App\Models\Client;
use App\Models\Partner;
use App\Models\Certification;

class HomeController extends Controller
{
    public function index()
    {
        $profiles = CompanyProfile::all();
        $projects = Project::with('stories')->get();
        $services = Service::all();
        $news = News::orderBy('tanggal_publikasi', 'desc')->limit(3)->get();
        $trustBoosters = TrustBooster::all();

        // Ambil data dari tabel clients, partners, certifications
        $clients = Client::all();
        $partners = Partner::all();
        $certifications = Certification::all();

        return view('front.home', compact(
            'profiles', 'projects', 'services', 'news',
            'trustBoosters', 'clients', 'partners', 'certifications'
        ));
    }
}
