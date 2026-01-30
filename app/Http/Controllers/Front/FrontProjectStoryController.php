<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectStory;

class FrontProjectStoryController extends Controller
{
    public function index()
    {
        // Ambil semua project dengan stories terkait
        $projects = Project::with('stories')->orderBy('year', 'desc')->get();

        return view('front.proyek.show', compact('projects'));
    }

    public function show($id)
    {
        $project = Project::with('stories')->findOrFail($id);
        return view('front.proyek.show', compact('project'));
    }
}
