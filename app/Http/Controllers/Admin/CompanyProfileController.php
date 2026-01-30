<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    public function index()
    {
        $profiles = CompanyProfile::orderBy('profile_id', 'desc')->get();
        return view('admin.companyprofile.index', compact('profiles'));
    }

    public function create()
    {
        return view('admin.companyprofile.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        CompanyProfile::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('company-profile.index')
            ->with('success', 'Company Profile berhasil ditambahkan');
    }

    public function edit($id)
    {
        $profile = CompanyProfile::findOrFail($id);
        return view('admin.companyprofile.edit', compact('profile'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $profile = CompanyProfile::findOrFail($id);
        $profile->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('company-profile.index')
            ->with('success', 'Company Profile berhasil diperbarui');
    }

    public function destroy($id)
    {
        $profile = CompanyProfile::findOrFail($id);
        $profile->delete();

        return redirect()
            ->route('company-profile.index')
            ->with('success', 'Company Profile berhasil dihapus');
    }
}
