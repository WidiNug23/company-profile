<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    public function index()
    {
        $totalVisitors = VisitorLog::count();
        $uniqueVisitors = VisitorLog::distinct('ip_address')->count('ip_address');

        $topPages = VisitorLog::select('url', DB::raw('count(*) as hits'))
            ->groupBy('url')
            ->orderByDesc('hits')
            ->limit(10)
            ->get();

        return view('admin.visitors', compact('totalVisitors', 'uniqueVisitors', 'topPages'));
    }
}
