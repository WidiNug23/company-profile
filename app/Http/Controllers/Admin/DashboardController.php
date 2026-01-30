<?php
// app/Http/Controllers/Admin/DashboardController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\News;
use App\Models\TrustBooster;
use Illuminate\Support\Facades\DB;

use App\Models\VisitorLog;


class DashboardController extends Controller
{
public function index()
{
    $serviceCount = \App\Models\Service::count();
    $newsCount    = \App\Models\News::count();
    $trustCount   = \App\Models\TrustBooster::count();

    // === VISITOR DATA ===
    $totalVisits = VisitorLog::count();

    $uniqueVisitors = VisitorLog::distinct('ip_address')->count('ip_address');

    $topPages = VisitorLog::select('url', DB::raw('COUNT(*) as visits'))
        ->groupBy('url')
        ->orderByDesc('visits')
        ->limit(5)
        ->get();

    return view('admin.dashboard', compact(
        'serviceCount',
        'newsCount',
        'trustCount',
        'totalVisits',
        'uniqueVisitors',
        'topPages'
    ));
}

}
