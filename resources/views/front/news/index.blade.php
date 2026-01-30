@extends('layouts.front')

@section('title', 'Berita')

@section('content')

<style>
:root {
    --primary-color: #1a73e8;
    --accent-color: #0f4c81;
    --card-bg: #fff;
    --text-color: #111827;
    --text-color-secondary: #6b7280;
    --shadow: rgba(0,0,0,0.08);
}

body.dark {
    --primary-color: #93c5fd;
    --accent-color: #60a5fa;
    --card-bg: #1f2937;
    --text-color: #f3f4f6;
    --text-color-secondary: #d1d5db;
    --shadow: rgba(0,0,0,0.3);
}

/* PAGE TITLE */
.page-title {
    text-align: center;
    font-size: 36px;
    font-weight: 800;
    color: var(--primary-color);
    margin: 50px 0 40px 0;
    letter-spacing: -0.5px;
}

/* NEWS GRID */
.news-container {
    max-width: 1200px;
    margin: 0 auto 50px auto;
    padding: 0 20px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 28px;
}

/* CARD LINK */
.news-card-link {
    text-decoration: none;
    color: inherit;
    display: block;
    transition: transform 0.3s, box-shadow 0.3s;
}

/* HOVER EFFECT */
.news-card-link:hover .news-card {
    transform: translateY(-6px);
    box-shadow: 0 15px 35px var(--shadow);
}

/* NEWS CARD */
.news-card {
    background: var(--card-bg);
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 6px 18px var(--shadow);
    transition: transform 0.3s, box-shadow 0.3s, background 0.3s, color 0.3s;
    display: flex;
    flex-direction: column;
    color: var(--text-color);
}

/* IMAGE */
.news-card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    transition: filter 0.3s;
}

body.dark .news-card img {
    filter: brightness(0.85);
}

/* CARD CONTENT */
.news-card .card-content {
    padding: 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.news-card h3 {
    font-size: 20px;
    margin: 0 0 10px 0;
    color: var(--text-color);
    line-height: 1.3;
    transition: color 0.3s;
}

.news-card h3 a {
    text-decoration: none;
    color: inherit;
}

.news-card h3 a:hover {
    color: var(--accent-color);
}

.news-card p {
    font-size: 15px;
    color: var(--text-color-secondary);
    flex: 1;
    margin-bottom: 12px;
    line-height: 1.6;
}

/* SMALL TEXT */
.news-card small {
    color: var(--text-color-secondary);
    font-size: 13px;
}

/* PAGINATION */
.pagination {
    display: flex;
    justify-content: center;
    margin: 40px 0 60px 0;
    flex-wrap: wrap;
    gap: 6px;
}

.pagination a,
.pagination span {
    padding: 8px 14px;
    border-radius: 6px;
    border: 1px solid var(--primary-color);
    color: var(--primary-color);
    text-decoration: none;
    transition: all 0.3s;
}

.pagination a:hover {
    background: var(--primary-color);
    color: #fff;
}

.pagination .active span {
    background: var(--primary-color);
    color: #fff;
    border-color: var(--primary-color);
}

/* RESPONSIVE */
@media(max-width: 768px) {
    .news-container {
        grid-template-columns: 1fr;
    }

    .news-card img {
        height: 200px;
    }
}
</style>

<div class="page-title">Berita Terbaru</div>

<div class="news-container">
    @forelse ($news as $item)
        <a href="{{ route('news.front.show', $item->id_berita) }}" class="news-card-link">
            <div class="news-card">
                @if ($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->judul }}">
                @endif

                <div class="card-content">
                    <h3>{{ $item->judul }}</h3>
                    <!-- <p>{{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 120) }}</p> -->
                    <small>Dipublikasikan: {{ $item->tanggal_publikasi->format('d M Y') }}</small>
                </div>
            </div>
        </a>
    @empty
        <p style="text-align:center; color:#9ca3af;">Belum ada berita terbaru.</p>
    @endforelse
</div>

@endsection
