<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certification;
use Illuminate\Support\Facades\Storage;

class CertificationController extends Controller
{
    public function index()
    {
        $certifications = Certification::latest()->get();
        return view('admin.certification.index', compact('certifications'));
    }

    public function create()
    {
        return view('admin.certification.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'certification_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120'
        ]);

        $data = $request->only('certification_name', 'description');

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('certifications', 'public');
        }

        Certification::create($data);

        return redirect()->route('certifications.index')->with('success', 'Certification berhasil ditambahkan.');
    }

    public function edit(Certification $certification)
    {
        return view('admin.certification.edit', compact('certification'));
    }

    public function update(Request $request, Certification $certification)
    {
        $request->validate([
            'certification_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120'
        ]);

        $data = $request->only('certification_name', 'description');

        if ($request->hasFile('file')) {
            // hapus file lama jika ada
            if ($certification->file && Storage::disk('public')->exists($certification->file)) {
                Storage::disk('public')->delete($certification->file);
            }
            $data['file'] = $request->file('file')->store('certifications', 'public');
        }

        $certification->update($data);

        return redirect()->route('certifications.index')->with('success', 'Certification berhasil diperbarui.');
    }

    public function destroy(Certification $certification)
    {
        if ($certification->file && Storage::disk('public')->exists($certification->file)) {
            Storage::disk('public')->delete($certification->file);
        }

        $certification->delete();
        return redirect()->route('certifications.index')->with('success', 'Certification berhasil dihapus.');
    }
}
