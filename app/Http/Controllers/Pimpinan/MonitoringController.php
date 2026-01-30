<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VisitorLog;
use App\Models\ContentCalendar;

class MonitoringController extends Controller
{
    public function index()
    {
        // 🔢 Total visitor keseluruhan
        $totalVisitors = VisitorLog::count();

        // 📅 Visitor hari ini
        $todayVisitors = VisitorLog::whereDate('created_at', now()->toDateString())
            ->count();

        // 📊 Visitor per hari (7 hari terakhir)
        $visitorsPerDay = VisitorLog::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->limit(7)
            ->get();

        // 🗓️ Content calendar
        $calendar = ContentCalendar::orderBy('scheduled_date', 'desc')->get();

        return view('pimpinan.dashboard', compact(
            'totalVisitors',
            'todayVisitors',
            'visitorsPerDay',
            'calendar'
        ));
    }
}
