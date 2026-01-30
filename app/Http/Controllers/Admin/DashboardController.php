<?php
// app/Http/Controllers/Admin/DashboardController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Models\News;
use App\Models\TrustBooster;
use App\Models\Project;
use App\Models\ProjectStory;
use App\Models\Client;
use App\Models\Partner;
use App\Models\Certification;
use App\Models\ContentCalendar;
use App\Models\VisitorLog;

class DashboardController extends Controller
{
    public function index()
    {
        // === COUNTS ===
        $serviceCount       = Service::count();
        $newsCount          = News::count();
        $trustCount         = TrustBooster::count();
        $projectCount       = Project::count();
        $projectStoryCount  = ProjectStory::count();
        $clientCount        = Client::count();
        $partnerCount       = Partner::count();
        $certificateCount   = Certification::count();
        $calendarCount      = ContentCalendar::count();

        // === VISITOR DATA ===
        $totalVisits        = VisitorLog::count();
        $uniqueVisitors     = VisitorLog::distinct('ip_address')->count('ip_address');

        $topPages = VisitorLog::select('url', DB::raw('COUNT(*) as visits'))
            ->groupBy('url')
            ->orderByDesc('visits')
            ->limit(5)
            ->get();

        // === RETURN VIEW ===
        return view('admin.dashboard', compact(
            'serviceCount',
            'newsCount',
            'trustCount',
            'projectCount',
            'projectStoryCount',
            'clientCount',
            'partnerCount',
            'certificateCount',
            'calendarCount',
            'totalVisits',
            'uniqueVisitors',
            'topPages'
        ));
    }
}
