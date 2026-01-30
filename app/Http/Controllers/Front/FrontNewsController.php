<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\News;

class FrontNewsController extends Controller
{
    public function index()
    {
        return view('front.news.index', [
            'news' => News::orderBy('tanggal_publikasi', 'desc')->paginate(6)
        ]);
    }

    public function show($id)
    {
        // Ambil berita utama
        $news = News::findOrFail($id);

        // Ambil 5 berita lainnya (ganti 'id' menjadi 'id_berita')
        $otherNews = News::where('id_berita', '!=', $id)
                         ->orderBy('tanggal_publikasi', 'desc')
                         ->take(5)
                         ->get();

        return view('front.news.show', compact('news', 'otherNews'));
    }
}
