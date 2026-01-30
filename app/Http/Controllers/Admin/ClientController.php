<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('client_name')->get();
        return view('admin.client.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.client.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string'
        ]);

        $data = $request->only(['client_name', 'description']);

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('clients', 'public');
        }

        Client::create($data);

        return redirect()->route('clients.index')->with('success', 'Client berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.client.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $request->validate([
            'client_name' => 'required|string|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string'
        ]);

        $data = $request->only(['client_name', 'description']);

        if ($request->hasFile('picture')) {
            // Hapus file lama jika ada
            if ($client->picture && Storage::disk('public')->exists($client->picture)) {
                Storage::disk('public')->delete($client->picture);
            }
            $data['picture'] = $request->file('picture')->store('clients', 'public');
        }

        $client->update($data);

        return redirect()->route('clients.index')->with('success', 'Client berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);

        if ($client->picture && Storage::disk('public')->exists($client->picture)) {
            Storage::disk('public')->delete($client->picture);
        }

        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client berhasil dihapus.');
    }
}
