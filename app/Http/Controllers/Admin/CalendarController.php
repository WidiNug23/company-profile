<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentCalendar;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
    {
        $calendars = ContentCalendar::with('user')->latest()->get();
        return view('admin.calendar.index', compact('calendars'));
    }

    public function create()
    {
        return view('admin.calendar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'note' => 'nullable|string',
            'scheduled_date' => 'required|date',
        ]);

        ContentCalendar::create([
            'title' => $request->title,
            'note' => $request->note,
            'scheduled_date' => $request->scheduled_date,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('calendar.index')->with('success', 'Content Calendar berhasil ditambahkan.');
    }

    public function edit(ContentCalendar $calendar)
    {
        return view('admin.calendar.edit', compact('calendar'));
    }

    public function update(Request $request, ContentCalendar $calendar)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'note' => 'nullable|string',
            'scheduled_date' => 'required|date',
        ]);

        $calendar->update([
            'title' => $request->title,
            'note' => $request->note,
            'scheduled_date' => $request->scheduled_date,
        ]);

        return redirect()->route('calendar.index')->with('success', 'Content Calendar berhasil diperbarui.');
    }

    public function destroy(ContentCalendar $calendar)
    {
        $calendar->delete();
        return redirect()->route('calendar.index')->with('success', 'Content Calendar berhasil dihapus.');
    }
}
