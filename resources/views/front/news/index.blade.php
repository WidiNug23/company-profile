@extends('layouts.front')

@section('title', 'Berita & Artikel')

@section('content')
<style>
    :root {
        /* Color Palette yang diselaraskan dengan Brand */
        --brand-blue: #293c91;
        --brand-red: #e92426;
        --brand-blue-rgb: 41, 60, 145;
        --primary: var(--brand-blue);
    }

    /* Background Fixed dengan Overlay yang lebih dalam */
    .news-bg-fixed {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background-image: url('{{ asset("storage/news-bg.jpg") }}');
        background-size: cover;
        background-position: center;
        z-index: -1;
    }

    /* Overlay Adaptif */
    .news-bg-fixed::after {
        content: '';
        position: absolute;
        inset: 0;
        transition: background 0.4s ease;
    }
    
    /* Dark Mode Overlay: Navy-Deep */
    [data-theme="dark"] .news-bg-fixed::after { 
        background: radial-gradient(circle at bottom left, rgba(15, 23, 42, 0.95), rgba(41, 60, 145, 0.85)); 
    }
    
    /* Light Mode Overlay: Clean White-Blue */
    [data-theme="light"] .news-bg-fixed::after { 
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.94) 0%, rgba(240, 244, 255, 0.88) 100%); 
    }

    .news-wrapper {
        padding: 120px 0 80px; /* Padding atas disesuaikan untuk navbar */
        min-height: 100vh;
        position: relative;
        font-family: 'Inter', sans-serif;
    }

    .header-section {
        text-align: center;
        max-width: 800px;
        margin: 0 auto 60px;
        padding: 0 20px;
    }

    .header-section h1 {
        font-size: clamp(34px, 5vw, 52px);
        font-weight: 900;
        letter-spacing: -1.5px;
        color: var(--brand-blue);
        margin-bottom: 20px;
    }

    [data-theme="dark"] .header-section h1 {
        background: linear-gradient(to bottom, #ffffff 60%, #a1a1a1 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .header-section p {
        color: var(--text-muted);
        font-size: 18px;
        line-height: 1.6;
    }

    .news-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
        gap: 35px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 25px;
    }

    /* Card Design */
    .news-card {
        background: var(--card-bg);
        border: 1px solid var(--nav-border);
        border-radius: 28px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
        position: relative;
    }

    /* Red Accent Line on Hover (Same as Trust Card) */
    .news-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 5px; height: 0;
        background: var(--brand-red);
        transition: height 0.4s ease;
        z-index: 5;
    }

    .news-card:hover {
        transform: translateY(-12px);
        border-color: var(--brand-blue);
        box-shadow: 0 20px 40px rgba(0,0,0,0.12);
    }

    .news-card:hover::before {
        height: 100%;
    }

    .image-container {
        position: relative;
        height: 240px;
        overflow: hidden;
    }

    .image-container img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .news-card:hover .image-container img {
        transform: scale(1.08);
    }

    .category-badge {
        position: absolute;
        top: 20px; left: 20px;
        background: var(--brand-red);
        color: #ffffff;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        z-index: 2;
        box-shadow: 0 4px 12px rgba(233, 36, 38, 0.3);
    }

    .card-body {
        padding: 30px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .card-body h3 {
        color: var(--text-main);
        font-size: 22px;
        line-height: 1.4;
        margin-bottom: 20px;
        font-weight: 800;
        transition: color 0.3s ease;
    }

    .news-card:hover .card-body h3 {
        color: var(--brand-blue);
    }

    [data-theme="dark"] .news-card:hover .card-body h3 {
        color: #fff;
    }

    .card-meta {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-top: auto;
        padding-top: 20px;
        border-top: 1px solid var(--nav-border);
        color: var(--text-muted);
        font-size: 13px;
        font-weight: 500;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .meta-icon {
        color: var(--brand-red);
    }

    @media (max-width: 768px) {
        .news-grid { grid-template-columns: 1fr; }
        .news-wrapper { padding-top: 100px; }
        .header-section { margin-bottom: 40px; }
    }
</style>

<div class="news-wrapper">
    <div class="news-bg-fixed"></div>
    
    <div class="header-section">
        <h1>Warta & Insight</h1>
        <p>Eksplorasi pemikiran terbaru, inovasi strategis, dan kabar terkini dari ekosistem kami.</p>
    </div>

    <div class="news-grid">
        @forelse ($news as $item)
            <a href="{{ route('news.front.show', $item->id_berita) }}" style="text-decoration: none;">
                <article class="news-card">
                    <div class="image-container">
                        <span class="category-badge">{{ $item->jenis_berita ?? 'Insight' }}</span>
                        @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->judul }}">
                        @else
                            <div style="height:100%; background:rgba(var(--brand-blue-rgb), 0.1); display:flex; align-items:center; justify-content:center; color:var(--brand-blue);">
                                <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        <h3>{{ Str::limit($item->judul, 65) }}</h3>
                        
                        <div class="card-meta">
                            <div class="meta-item">
                                <svg class="meta-icon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                {{ $item->author }}
                            </div>
                            <span>•</span>
                            <div class="meta-item">
                                {{ $item->tanggal_publikasi->format('d M Y') }}
                            </div>
                        </div>
                    </div>
                </article>
            </a>
        @empty
            <div style="grid-column: 1/-1; text-align: center; color: var(--text-muted); padding: 100px 0; background: var(--card-bg); border-radius: 28px; border: 1px dashed var(--nav-border);">
                <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-bottom: 15px; opacity: 0.5;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l5 5v11a2 2 0 01-2 2z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 3v5h5"/></svg>
                <p>Belum ada warta yang diterbitkan saat ini.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection