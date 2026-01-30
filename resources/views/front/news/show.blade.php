@extends('layouts.front')

@section('title', $news->judul)

@section('content')

<style>
:root {
    --primary-color: #1e40af;
    --accent-color: #2563eb;
    --card-bg: #ffffff;
    --text-color: #1f2937;
    --text-color-secondary: #6b7280;
    --shadow: rgba(0,0,0,0.08);
    --border-radius: 12px;
    --transition: 0.3s;
}

body.dark {
    --primary-color: #93c5fd;
    --accent-color: #60a5fa;
    --card-bg: #1f2937;
    --text-color: #f3f4f6;
    --text-color-secondary: #d1d5db;
    --shadow: rgba(0,0,0,0.3);
}

/* ===== PAGE LAYOUT ===== */
.news-page {
    display: flex;
    gap: 40px;
    max-width: 1200px;
    margin: 50px auto;
    padding: 0 20px;
    font-family: 'Inter', sans-serif;
}

.news-article {
    flex: 2;
    background: var(--card-bg);
    padding: 35px;
    border-radius: var(--border-radius);
    box-shadow: 0 6px 20px var(--shadow);
    line-height: 1.8;
    color: var(--text-color);
    transition: box-shadow var(--transition);
}

.news-article:hover {
    box-shadow: 0 12px 30px var(--shadow);
}

.news-article h1 {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 12px;
    color: var(--primary-color);
}

.news-article small {
    display: block;
    color: var(--text-color-secondary);
    margin-bottom: 5px;
    font-size: 14px;
}

.news-article img {
    width: 100%;
    max-height: 500px;
    object-fit: cover;
    border-radius: var(--border-radius);
    margin: 25px 0;
    cursor: pointer;
    transition: transform var(--transition), filter var(--transition);
}

body.dark .news-article img {
    filter: brightness(0.85);
}

.news-article img:hover {
    transform: scale(1.03);
}

.news-article .content {
    font-size: 17px;
    margin-bottom: 30px;
}

.news-article .buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}

.news-article .buttons a {
    display: inline-block;
    padding: 10px 22px;
    background: var(--primary-color);
    color: #fff;
    border-radius: var(--border-radius);
    text-decoration: none;
    font-weight: 500;
    transition: background var(--transition), transform 0.2s;
}

.news-article .buttons a:hover {
    background: var(--accent-color);
    transform: translateY(-2px);
}

/* ===== SIDEBAR ===== */
.news-sidebar {
    flex: 1;
    background: var(--card-bg);
    padding: 25px;
    border-radius: var(--border-radius);
    height: fit-content;
    box-shadow: 0 4px 14px var(--shadow);
    color: var(--text-color);
    position: sticky;
    top: 100px;
}

.news-sidebar h3 {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 15px;
    color: var(--primary-color);
    border-bottom: 1px solid #e2e8f0;
    padding-bottom: 8px;
}

.news-sidebar ul {
    list-style: none;
    padding-left: 0;
}

.news-sidebar li {
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.news-sidebar li img {
    width: 60px;
    height: 40px;
    object-fit: cover;
    border-radius: 6px;
    flex-shrink: 0;
}

.news-sidebar li a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
    transition: color var(--transition);
}

.news-sidebar li a:hover {
    color: var(--accent-color);
}

/* IMAGE MODAL */
#imageModal {
    display: none;
    position: fixed;
    z-index: 9999;
    padding-top: 60px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.85);
}

#imageModal img {
    margin: auto;
    display: block;
    max-width: 90%;
    max-height: 80%;
    border-radius: var(--border-radius);
}

#imageModal .close {
    position: absolute;
    top: 20px;
    right: 35px;
    color: #fff;
    font-size: 40px;
    font-weight: bold;
    cursor: pointer;
    transition: color var(--transition);
}

#imageModal .close:hover {
    color: #ccc;
}

/* RESPONSIVE */
@media (max-width: 992px) {
    .news-page {
        flex-direction: column;
    }

    .news-article {
        background: transparent;
        box-shadow: none;
        border-radius: 0;
        padding: 20px 0;
    }

    .news-sidebar {
        margin-top: 30px;
        position: relative;
        top: auto;
        background: transparent;
        box-shadow: none;
        border-radius: 0;
        padding: 0;
    }

    .news-sidebar h3 {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 12px;
    }

    .news-sidebar li img {
        width: 50px;
        height: 35px;
    }
}
</style>

<div class="news-page">
    <!-- MAIN ARTICLE -->
    <article class="news-article">
        <h1>{{ $news->judul }}</h1>
        <small>Dipublikasikan: {{ $news->tanggal_publikasi->format('d M Y') }}</small>
        <small>Diupdate: {{ $news->tanggal_update->format('d M Y') }}</small>
        <small>Publisher: {{ $news->author }}</small>

        @if ($news->image)
            <img id="newsImage" src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->judul }}">
        @endif

        <div class="content">
            {!! $news->isi !!}
        </div>

        <div class="buttons">
            <a href="{{ route('news.front.index') }}">⬅ Kembali ke Berita</a>
            <a href="{{ route('home') }}">🏠 Home</a>
        </div>
    </article>

    <!-- SIDEBAR -->
    <aside class="news-sidebar">
        <h3>Berita Lainnya</h3>
        <ul>
            @forelse($otherNews as $item)
                <li>
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->judul }}">
                    @endif
                    <a href="{{ route('news.front.show', $item->id_berita) }}">
                        {{ Str::limit($item->judul, 50) }}
                    </a>
                </li>
            @empty
                <li>Tidak ada berita lain</li>
            @endforelse
        </ul>
    </aside>
</div>

<!-- IMAGE MODAL -->
<div id="imageModal">
    <span class="close">&times;</span>
    <img id="modalImg" src="">
</div>

<script>
// Modal image script
var modal = document.getElementById("imageModal");
var img = document.getElementById("newsImage");
var modalImg = document.getElementById("modalImg");
var closeBtn = document.getElementsByClassName("close")[0];

if(img){
    img.onclick = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
    }
}

closeBtn.onclick = function() {
    modal.style.display = "none";
}

modal.onclick = function(e){
    if(e.target == modal){
        modal.style.display = "none";
    }
}
</script>

@endsection
