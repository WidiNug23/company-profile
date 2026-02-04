@extends('layouts.front')

@section('title', 'Berita & Artikel')

@section('content')
<style>
    :root {
        --primary: var(--accent-color, #2563eb);
    }

    /* Background Fixed dengan Overlay Adaptif */
    .news-bg-fixed {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background-image: url('{{ asset("storage/news-bg.jpg") }}');
        background-size: cover;
        background-position: center;
        z-index: -1;
    }

    /* Overlay yang berubah berdasarkan tema */
    .news-bg-fixed::after {
        content: '';
        position: absolute;
        inset: 0;
        transition: background 0.4s ease;
    }
    [data-theme="dark"] .news-bg-fixed::after { background: rgba(10, 15, 28, 0.92); }
    [data-theme="light"] .news-bg-fixed::after { background: rgba(255, 255, 255, 0.88); }

    .news-wrapper {
        padding: 80px 0;
        min-height: 100vh;
        position: relative;
    }

    .header-section {
        text-align: center;
        margin-bottom: 60px;
    }

    .header-section h1 {
        font-size: clamp(32px, 5vw, 48px);
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 15px;
    }

    .header-section p {
        color: var(--text-muted);
        font-size: 18px;
    }

    .news-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Card Adaptif */
    .news-card {
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid var(--nav-border);
        border-radius: 24px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .news-card:hover {
        transform: translateY(-10px);
        border-color: var(--primary);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    .image-container {
        position: relative;
        height: 220px;
        overflow: hidden;
    }

    .image-container img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .category-badge {
        position: absolute;
        top: 15px; left: 15px;
        background: var(--primary);
        color: #ffffff;
        padding: 5px 15px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        z-index: 2;
    }

    .card-body {
        padding: 25px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .card-body h3 {
        color: var(--text-main);
        font-size: 20px;
        line-height: 1.4;
        margin-bottom: 15px;
        font-weight: 700;
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
    }

    @media (max-width: 768px) {
        .news-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="news-wrapper">
    <div class="news-bg-fixed"></div>
    
    <div class="header-section">
        <h1>Warta & Insight</h1>
        <p>Update terbaru mengenai inovasi, proyek, dan berita industri kami.</p>
    </div>

    <div class="news-grid">
        @forelse ($news as $item)
            <a href="{{ route('news.front.show', $item->id_berita) }}" style="text-decoration: none;">
                <article class="news-card">
                    <div class="image-container">
                        <span class="category-badge">{{ $item->jenis_berita ?? 'Umum' }}</span>
                        @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->judul }}">
                        @else
                            <div style="height:100%; background:var(--glass-bg); display:flex; align-items:center; justify-content:center; color:var(--text-muted);">No Image</div>
                        @endif
                    </div>

                    <div class="card-body">
                        <h3>{{ Str::limit($item->judul, 65) }}</h3>
                        
                        <div class="card-meta">
                            <span style="display:flex; align-items:center; gap:5px;">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                {{ $item->author }}
                            </span>
                            <span>•</span>
                            <span>{{ $item->tanggal_publikasi->format('d M Y') }}</span>
                        </div>
                    </div>
                </article>
            </a>
        @empty
            <div style="grid-column: 1/-1; text-align: center; color: var(--text-muted); padding: 100px 0;">
                <p>Belum ada berita yang diterbitkan.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection