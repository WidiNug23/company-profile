<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->get();
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255|unique:news,judul',
            'isi' => 'required|string',
            'jenis_berita' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news', 'public');
        }

        News::create([
            'judul' => $request->judul,
            'isi' => $request->isi, // karakter unik & simbol AMAN
            'image' => $imagePath,
            'author' => Auth::user()->name,
            'jenis_berita' => $request->jenis_berita,
            'tanggal_publikasi' => now(),
        ]);

        return redirect()
            ->route('news.index')
            ->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

public function update(Request $request, $id)
{
    $news = News::findOrFail($id);

    $request->validate([
        'judul' => 'required|string|max:255|unique:news,judul,' . $news->id_berita . ',id_berita',
        'isi' => 'required|string',
        'jenis_berita' => 'required|string|max:100',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    if ($request->hasFile('image')) {
        // hapus gambar lama
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        // simpan gambar baru
        $news->image = $request->file('image')->store('news', 'public');
    }

    $news->update([
        'judul' => $request->judul,
        'isi' => $request->isi,
        'jenis_berita' => $request->jenis_berita,
        'author' => $request->author,
    ]);

    return redirect()
        ->route('news.index')
        ->with('success', 'Berita berhasil diperbarui');
}



    public function destroy($id)
    {
        $news = News::findOrFail($id);

        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return back()->with('success', 'Berita berhasil dihapus');
    }
}
