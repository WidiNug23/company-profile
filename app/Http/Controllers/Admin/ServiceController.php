<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // ✅ WAJIB

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('service_id', 'desc')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:150',
            'description'  => 'required|string',
            'icon'         => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        $iconPath = null;

        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('services', 'public');
        }

        Service::create([
            'service_name' => $request->service_name,
            'description'  => $request->description,
            'icon'         => $iconPath,
        ]);

        return redirect()
            ->route('services.index')
            ->with('success', 'Service berhasil ditambahkan');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'service_name' => 'required|string|max:150',
            'description'  => 'required|string',
            'icon'         => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        $service = Service::findOrFail($id);

        // ✅ Jika upload icon baru
        if ($request->hasFile('icon')) {

            // hapus icon lama
            if ($service->icon && Storage::disk('public')->exists($service->icon)) {
                Storage::disk('public')->delete($service->icon);
            }

            // simpan icon baru
            $service->icon = $request->file('icon')->store('services', 'public');
        }

        // update data
        $service->update([
            'service_name' => $request->service_name,
            'description'  => $request->description,
        ]);

        return redirect()
            ->route('services.index')
            ->with('success', 'Service berhasil diperbarui');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        // hapus icon jika ada
        if ($service->icon && Storage::disk('public')->exists($service->icon)) {
            Storage::disk('public')->delete($service->icon);
        }

        $service->delete();

        return back()->with('success', 'Service berhasil dihapus');
    }
}
