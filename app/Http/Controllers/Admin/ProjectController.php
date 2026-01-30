<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('year', 'desc')->get();
        return view('admin.project.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.project.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'year' => 'required|integer',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only('project_name', 'location', 'year');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('projects', 'public');
        }

        Project::create($data);

        return redirect()->route('projects.index')->with('success', 'Project berhasil ditambahkan.');
    }

    public function edit(Project $project)
    {
        return view('admin.project.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'year' => 'required|integer',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only('project_name', 'location', 'year');

        if ($request->hasFile('thumbnail')) {
            // hapus file lama jika ada
            if ($project->thumbnail && Storage::disk('public')->exists($project->thumbnail)) {
                Storage::disk('public')->delete($project->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('projects', 'public');
        }

        $project->update($data);

        return redirect()->route('projects.index')->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        // hapus thumbnail
        if ($project->thumbnail && Storage::disk('public')->exists($project->thumbnail)) {
            Storage::disk('public')->delete($project->thumbnail);
        }
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project berhasil dihapus.');
    }
}
