@extends('layouts.front')

@section('title', $news->judul)

@section('content')
<style>
    :root {
        /* Color Palette Brand */
        --brand-blue: #293c91;
        --brand-red: #e92426;
        --brand-blue-rgb: 41, 60, 145;
        --primary: var(--brand-blue);
    }

    /* Background Adaptif */
    .detail-bg-fixed {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: var(--bg-body);
        z-index: -1;
        transition: background 0.4s ease;
    }

    .detail-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 120px 20px 60px; /* Padding top disesuaikan untuk navbar */
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 40px;
        color: var(--text-main);
    }

    /* Artikel Utama */
    .main-article {
        background: var(--card-bg);
        border: 1px solid var(--nav-border);
        border-radius: 32px;
        padding: 45px;
        position: relative;
        overflow: hidden;
    }

    /* Garis Aksen Merah di Sisi Kiri (Konsisten dengan Trust Card) */
    .main-article::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 6px; height: 100%;
        background: var(--brand-red);
    }

    .meta-top {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        color: var(--text-muted);
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 25px;
    }

    .category-tag {
        background: var(--brand-red);
        color: #fff;
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 4px 10px rgba(233, 36, 38, 0.2);
    }

    .article-title {
        font-size: clamp(28px, 4vw, 42px);
        font-weight: 900;
        line-height: 1.2;
        margin-bottom: 35px;
        color: var(--brand-blue);
        letter-spacing: -1px;
    }

    [data-theme="dark"] .article-title {
        color: #ffffff;
    }

    .featured-image-wrapper {
        border-radius: 24px;
        overflow: hidden;
        margin-bottom: 40px;
        border: 1px solid var(--nav-border);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }

    .featured-image {
        width: 100%;
        display: block;
        cursor: zoom-in;
        transition: transform 0.5s ease;
    }

    .featured-image:hover {
        transform: scale(1.02);
    }

    .article-content {
        font-size: 18px;
        line-height: 1.8;
        color: var(--text-main);
    }

    .article-content p {
        margin-bottom: 25px;
    }

    /* Sidebar Styles */
    .sidebar-sticky {
        position: sticky;
        top: 100px;
        height: fit-content;
    }

    .sidebar-card {
        background: var(--card-bg);
        border: 1px solid var(--nav-border);
        border-radius: 28px;
        padding: 30px;
    }

    .sidebar-card h3 {
        font-size: 20px;
        font-weight: 800;
        margin-bottom: 25px;
        color: var(--brand-blue);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    [data-theme="dark"] .sidebar-card h3 { color: #fff; }

    .sidebar-card h3::after {
        content: '';
        flex-grow: 1;
        height: 2px;
        background: linear-gradient(to right, var(--brand-red), transparent);
    }

    .related-item {
        display: flex;
        gap: 15px;
        margin-bottom: 25px;
        text-decoration: none;
        transition: 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .related-item:hover {
        transform: translateX(8px);
    }

    .related-img {
        width: 85px; height: 85px;
        border-radius: 16px;
        object-fit: cover;
        border: 1px solid var(--nav-border);
        flex-shrink: 0;
    }

    .related-info h4 {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-main);
        line-height: 1.4;
        margin-bottom: 8px;
        transition: color 0.3s;
    }

    .related-item:hover h4 {
        color: var(--brand-red);
    }

    /* Action Buttons */
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        padding: 14px 28px;
        background: var(--brand-blue);
        color: #fff !important;
        border-radius: 16px;
        font-weight: 700;
        transition: all 0.3s;
        box-shadow: 0 10px 20px rgba(41, 60, 145, 0.2);
        margin-top: 20px;
    }

    .back-btn:hover {
        background: var(--brand-red);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(233, 36, 38, 0.3);
    }

    /* Modal / Lightbox */
    #imageModal {
        display: none;
        position: fixed;
        z-index: 10000;
        inset: 0;
        background: rgba(10, 15, 28, 0.95);
        backdrop-filter: blur(10px);
        padding: 40px;
        align-items: center;
        justify-content: center;
    }

    @media (max-width: 992px) {
        .detail-container { grid-template-columns: 1fr; padding-top: 100px; }
        .sidebar-sticky { position: static; }
        .main-article { padding: 30px 25px; border-radius: 24px; }
    }
</style>

<div class="detail-bg-fixed"></div>

<div class="detail-container">
    <article class="main-article">
        <div class="meta-top">
            <span class="category-tag">
                {{ $news->jenis_berita ?? 'Insight' }}
            </span>
            <span>📅 {{ $news->tanggal_publikasi->format('d M Y') }}</span>
            <span style="display: flex; align-items: center; gap: 5px;">
                <svg width="16" height="16" fill="none" stroke="var(--brand-red)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                {{ $news->author }}
            </span>
        </div>

        <h1 class="article-title">{{ $news->judul }}</h1>

        @if ($news->image)
            <div class="featured-image-wrapper">
                <img id="mainImg" class="featured-image" src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->judul }}">
            </div>
        @endif

        <div class="article-content">
            {!! $news->isi !!}
        </div>

        <div style="margin-top: 50px; padding-top: 30px; border-top: 1px solid var(--nav-border);">
            <a href="{{ route('news.front.index') }}" class="back-btn">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Daftar Berita
            </a>
        </div>
    </article>

    <aside class="sidebar-sticky">
        <div class="sidebar-card">
            <h3>Berita Lainnya</h3>
            @forelse($otherNews as $item)
                <a href="{{ route('news.front.show', $item->id_berita) }}" class="related-item">
                    @if($item->image)
                        <img class="related-img" src="{{ asset('storage/' . $item->image) }}" alt="">
                    @else
                        <div class="related-img" style="background:rgba(var(--brand-blue-rgb), 0.1); display:flex; align-items:center; justify-content:center; font-size:10px; color:var(--brand-blue)">No Image</div>
                    @endif
                    <div class="related-info">
                        <h4>{{ Str::limit($item->judul, 45) }}</h4>
                        <span style="font-size:12px; color:var(--text-muted)">{{ $item->tanggal_publikasi->format('d M Y') }}</span>
                    </div>
                </a>
            @empty
                <p style="color:var(--text-muted); font-size:14px;">Tidak ada berita lainnya.</p>
            @endforelse
        </div>
    </aside>
</div>

<div id="imageModal">
    <span style="position:absolute; top:30px; right:30px; color:#fff; font-size:40px; cursor:pointer; font-weight:bold;" onclick="closeModal()">&times;</span>
    <img id="modalImg" style="max-width:95%; max-height:85vh; border-radius:12px; box-shadow: 0 25px 50px rgba(0,0,0,0.5);">
</div>

<script>
    const modal = document.getElementById("imageModal");
    const img = document.getElementById("mainImg");
    const modalImg = document.getElementById("modalImg");

    if(img) {
        img.onclick = function() {
            modal.style.display = "flex";
            modalImg.src = this.src;
            document.body.style.overflow = "hidden"; // Disable scroll saat zoom
        }
    }

    function closeModal() { 
        modal.style.display = "none"; 
        document.body.style.overflow = "auto";
    }
    
    modal.onclick = function(e) { if(e.target == modal) closeModal(); }
    
    // Support tombol ESC untuk tutup modal
    document.addEventListener('keydown', function(e) {
        if (e.key === "Escape") closeModal();
    });
</script>
@endsection