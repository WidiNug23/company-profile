<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partner;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::latest()->get();
        return view('admin.partner.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'partner_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);

        $data = $request->only('partner_name');

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('partners', 'public');
        }

        Partner::create($data);

        return redirect()->route('partners.index')->with('success', 'Partner berhasil ditambahkan.');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partner.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'partner_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);

        $data = $request->only('partner_name');

        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
                Storage::disk('public')->delete($partner->logo);
            }
            $data['logo'] = $request->file('logo')->store('partners', 'public');
        }

        $partner->update($data);

        return redirect()->route('partners.index')->with('success', 'Partner berhasil diperbarui.');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
            Storage::disk('public')->delete($partner->logo);
        }

        $partner->delete();

        return redirect()->route('partners.index')->with('success', 'Partner berhasil dihapus.');
    }
}
