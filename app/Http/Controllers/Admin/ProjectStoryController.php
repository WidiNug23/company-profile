<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectStory;
use App\Models\Project;

class ProjectStoryController extends Controller
{
    public function index()
    {
        $stories = ProjectStory::with('project')->get();
        return view('admin.projectstories.index', compact('stories'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('admin.projectstories.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,project_id',
            'challenge' => 'required|string',
            'solution' => 'required|string',
            'result' => 'required|string',
        ]);

        ProjectStory::create($request->all());

        return redirect()->route('project-stories.index')->with('success', 'Story berhasil ditambahkan.');
    }

    public function edit(ProjectStory $project_story)
    {
        $projects = Project::all();
        return view('admin.projectstories.edit', compact('project_story', 'projects'));
    }

    public function update(Request $request, ProjectStory $project_story)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,project_id',
            'challenge' => 'required|string',
            'solution' => 'required|string',
            'result' => 'required|string',
        ]);

        $project_story->update($request->all());

        return redirect()->route('project-stories.index')->with('success', 'Story berhasil diperbarui.');
    }

    public function destroy(ProjectStory $project_story)
    {
        $project_story->delete();

        return redirect()->route('project-stories.index')->with('success', 'Story berhasil dihapus.');
    }
}
