@extends('layouts.front')

@section('title', $news->judul)

@section('content')
<style>
    :root {
        --primary: var(--accent-color, #3b82f6);
    }

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
        padding: 60px 20px;
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 50px;
        color: var(--text-main);
    }

    .main-article {
        background: var(--card-bg);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid var(--nav-border);
        border-radius: 32px;
        padding: 40px;
        transition: all 0.4s ease;
    }

    .meta-top {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        color: var(--text-muted);
        font-size: 14px;
        margin-bottom: 25px;
    }

    .article-title {
        font-size: clamp(28px, 4vw, 42px);
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 30px;
        color: var(--text-main);
    }

    .featured-image {
        width: 100%;
        border-radius: 24px;
        margin-bottom: 40px;
        cursor: zoom-in;
        transition: transform 0.3s ease;
        border: 1px solid var(--nav-border);
    }

    .article-content {
        font-size: 18px;
        line-height: 1.8;
        color: var(--text-main);
    }

    /* Sidebar Adaptif */
    .sidebar-sticky {
        position: sticky;
        top: 100px;
        height: fit-content;
    }

    .sidebar-card {
        background: var(--card-bg);
        border: 1px solid var(--nav-border);
        border-radius: 24px;
        padding: 25px;
    }

    .sidebar-card h3 {
        font-size: 20px;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid var(--nav-border);
        color: var(--text-main);
    }

    .related-item {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        text-decoration: none;
        transition: 0.3s;
    }

    .related-item:hover { transform: translateX(5px); }

    .related-img {
        width: 80px; height: 80px;
        border-radius: 12px;
        object-fit: cover;
        border: 1px solid var(--nav-border);
    }

    .related-info h4 {
        font-size: 14px;
        color: var(--text-main);
        line-height: 1.4;
        margin-bottom: 5px;
    }

    /* Modal Image Lightbox */
    #imageModal {
        display: none;
        position: fixed;
        z-index: 9999;
        inset: 0;
        background: rgba(0,0,0,0.9);
        backdrop-filter: blur(10px);
        padding: 40px;
        align-items: center;
        justify-content: center;
    }

    @media (max-width: 992px) {
        .detail-container { grid-template-columns: 1fr; }
        .sidebar-sticky { position: static; }
        .main-article { padding: 25px; border-radius: 20px; }
    }
</style>

<div class="detail-bg-fixed"></div>

<div class="detail-container">
    <article class="main-article">
        <div class="meta-top">
            <span style="background:var(--primary); color:#fff; padding:2px 12px; border-radius:50px; font-size:12px; font-weight:700;">
                {{ $news->jenis_berita ?? 'Update' }}
            </span>
            <span>📅 {{ $news->tanggal_publikasi->format('d M Y') }}</span>
            <span>✍️ {{ $news->author }}</span>
        </div>

        <h1 class="article-title">{{ $news->judul }}</h1>

        @if ($news->image)
            <img id="mainImg" class="featured-image" src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->judul }}">
        @endif

        <div class="article-content">
            {!! $news->isi !!}
        </div>

        <hr style="border:0; border-top:1px solid var(--nav-border); margin: 40px 0;">
        
        <a href="{{ route('news.front.index') }}" style="display:inline-block; text-decoration:none; padding:12px 25px; background:var(--primary); color:#fff; border-radius:12px; font-weight:600; transition:0.3s; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            ⬅ Kembali ke Daftar Berita
        </a>
    </article>

    <aside class="sidebar-sticky">
        <div class="sidebar-card">
            <h3>Berita Lainnya</h3>
            @forelse($otherNews as $item)
                <a href="{{ route('news.front.show', $item->id_berita) }}" class="related-item">
                    @if($item->image)
                        <img class="related-img" src="{{ asset('storage/' . $item->image) }}" alt="">
                    @else
                         <div class="related-img" style="background:var(--glass-bg); display:flex; align-items:center; justify-content:center; font-size:10px; color:var(--text-muted)">No Image</div>
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
    <span style="position:absolute; top:30px; right:30px; color:#fff; font-size:40px; cursor:pointer;" onclick="closeModal()">&times;</span>
    <img id="modalImg" style="max-width:95%; max-height:90vh; border-radius:8px;">
</div>

<script>
    const modal = document.getElementById("imageModal");
    const img = document.getElementById("mainImg");
    const modalImg = document.getElementById("modalImg");

    if(img) {
        img.onclick = function() {
            modal.style.display = "flex";
            modalImg.src = this.src;
        }
    }

    function closeModal() { modal.style.display = "none"; }
    modal.onclick = function(e) { if(e.target == modal) closeModal(); }
</script>
@endsection