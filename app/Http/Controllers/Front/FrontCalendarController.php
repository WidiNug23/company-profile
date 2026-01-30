<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentCalendar;

class FrontCalendarController extends Controller
{
    /**
     * Tampilkan halaman kalender
     */
    public function show()
    {
        // Ambil semua kalender, urut dari tanggal terbaru
        $calendars = ContentCalendar::orderBy('scheduled_date', 'desc')->get();

        return view('front.calendar.show', compact('calendars'));
    }
}
