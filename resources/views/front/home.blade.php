@extends('layouts.front')

@section('title', 'Profile Company')

@section('content')

{{-- ===== STYLES ===== --}}
<style>
:root {
    --primary-color: #2563eb;
    --accent-color: #60a5fa;
    --secondary-color: #f3f4f6;
    --card-bg: #ffffff;
    --text-color: #1f2937;
    --shadow: rgba(0,0,0,0.1);
}

body.dark {
    --card-bg: #1f2937;
    --text-color: #f9fafb;
}

html { scroll-behavior: smooth; }
.container { width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 20px; }
.section { padding: 80px 0; }
.section-title { text-align: center; font-size: 32px; font-weight: 700; margin-bottom: 50px; color: var(--primary-color); }

.grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; }
.card { background: var(--card-bg); border-radius: 16px; padding: 24px; box-shadow: 0 12px 28px var(--shadow); transition: all 0.3s ease; display: flex; flex-direction: column; height: 100%; color: var(--text-color); overflow: hidden; }
.card:hover { transform: translateY(-6px); box-shadow: 0 20px 50px var(--shadow); }
.card h3 { margin-bottom: 12px; font-size: 20px; font-weight: 700; }
.card p { font-size: 15px; line-height: 1.6; flex: 1; overflow-wrap: break-word; }

.project-thumbnail, .news-image, .card img { width: 100%; height: 180px; object-fit: cover; border-radius: 12px; margin-bottom: 14px; }
.news-link { text-decoration: none; color: var(--text-color); }
.news-link:hover h4 { color: var(--accent-color); }
.btn-primary { display: inline-block; padding: 14px 28px; background-color: var(--primary-color); color: #fff; font-weight: 600; border-radius: 8px; text-decoration: none; transition: all 0.3s ease; }
.btn-primary:hover { background-color: var(--accent-color); transform: translateY(-2px); }
.empty { text-align: center; font-style: italic; font-size: 16px; margin-top: 20px; color: var(--text-color); }
.banner { position: relative; color: #fff; border-radius: 16px; text-align: left; margin-bottom: 60px; box-shadow: 0 12px 30px var(--shadow); background: linear-gradient(rgba(26,115,232,0.6), rgba(37,99,235,0.6)), url('{{ asset('storage/pexels-jplenio-2128162.jpg') }}') center/cover no-repeat; display: flex; align-items: flex-end; height: 700px; overflow: hidden; }
.banner .container { position: absolute; bottom: 20px; left: 20px; max-width: 600px; }
.banner h1 { font-size: 42px; font-weight: 700; margin-bottom: 10px; }
.banner p { font-size: 20px; font-weight: 500; margin-bottom: 20px; }

/* ===== RESPONSIVE ===== */
@media(max-width:1024px){ .banner{height:500px;} .banner h1{font-size:36px;} .banner p{font-size:18px;} .section-title{font-size:28px; margin-bottom:40px;} .card h3{font-size:18px;} .card p{font-size:14px;} }
@media(max-width:768px){ .banner{height:400px;} .banner h1{font-size:30px;} .banner p{font-size:16px;} .btn-primary{padding:12px 20px; font-size:14px;} .card h3{font-size:17px;} .card p{font-size:13px;} }
@media(max-width:480px){ .banner{height:300px;} .banner h1{font-size:24px;} .banner p{font-size:14px;} .btn-primary{padding:10px 16px; font-size:12px;} .card h3{font-size:16px;} .card p{font-size:12px;} }
</style>

{{-- ===== BANNER ===== --}}
<section class="banner">
    <div class="container">
        <h1>Selamat Datang di Company Profile Kami</h1>
        <p>Informasi terbaru, layanan unggulan, dan berita terkini untuk Anda</p>
        <a href="#news" class="btn-primary">Lihat Berita Terbaru</a>
    </div>
</section>

{{-- ===== COMPANY PROFILE ===== --}}
<section class="section">
    <div class="container">
        <h2 class="section-title">Profil Perusahaan</h2>
        @if($profiles->count())
            <div class="grid">
                @foreach($profiles as $profile)
                    <div class="card">
                        <h3>{{ $profile->title }}</h3>
                        <div style="width:56px; height:4px; background: linear-gradient(135deg, #2563eb, #60a5fa); border-radius:4px; margin:12px 0;"></div>
                        <p>{{ strip_tags($profile->description) }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="empty">Data company profile belum tersedia.</p>
        @endif
    </div>
</section>

{{-- ===== PORTFOLIO PROYEK ===== --}}
<section class="section">
    <div class="container">
        <h2 class="section-title">Portofolio Proyek</h2>

        @if($projects->count())
            <div class="grid">
                @foreach($projects as $project)
                    <div class="card">
                        {{-- Thumbnail --}}
                        @if($project->thumbnail)
                            <div class="project-thumb-wrapper">
                                <img src="{{ asset('storage/'.$project->thumbnail) }}" alt="{{ $project->project_name }}" class="project-thumbnail">
                            </div>
                        @endif

                        {{-- Project Info --}}
                        <h3>{{ $project->project_name }}</h3>
                        <p><strong></strong> {{ $project->location }} &bull; <strong></strong> {{ $project->year }}</p>

                        {{-- Project Stories Accordion --}}
                        @if($project->stories->count())
                            <div class="stories-accordion">
                                @foreach($project->stories as $index => $story)
                                    <div class="story-card">
                                        <button class="story-toggle">
                                            Selengkapnya <span class="arrow">▼</span>
                                        </button>
                                        <div class="story-content">
                                            <p><strong>Challenge:</strong> {{ strip_tags($story->challenge) }}</p>
                                            <p><strong>Solution:</strong> {{ strip_tags($story->solution) }}</p>
                                            <p><strong>Result:</strong> {{ strip_tags($story->result) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="empty">Belum ada story untuk project ini.</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="empty">Belum ada project yang tersedia.</p>
        @endif
    </div>
</section>

{{-- ===== STYLES KHUSUS PORTFOLIO ===== --}}
<style>
.project-thumbnail {
    width: 100%;
    height: 220px;
    object-fit: cover;
    border-radius: 12px;
    margin-bottom: 16px;
    transition: transform 0.3s ease;
}
.project-thumbnail:hover {
    transform: scale(1.03);
}

.stories-accordion {
    margin-top: 16px;
}

.story-card {
    margin-bottom: 12px;
    border-radius: 10px;
    background: #f9fafb;
    border-left: 4px solid var(--primary-color);
    overflow: hidden;
    transition: box-shadow 0.3s;
}
.story-card:hover {
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}

.story-toggle {
    width: 100%;
    padding: 12px 16px;
    background: #fff;
    border: none;
    outline: none;
    cursor: pointer;
    font-weight: 600;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 15px;
    transition: background 0.3s;
}
.story-toggle:hover {
    background: var(--secondary-color);
}

.story-content {
    max-height: 0;
    overflow: hidden;
    padding: 0 16px;
    transition: max-height 0.3s ease, padding 0.3s ease;
}
.story-content p {
    margin: 8px 0;
    font-size: 14px;
    line-height: 1.6;
}

/* Arrow rotate */
.story-card.active .story-content {
    max-height: 500px; /* cukup tinggi untuk konten panjang */
    padding: 12px 16px;
}
.story-card.active .story-toggle .arrow {
    transform: rotate(180deg);
    transition: transform 0.3s;
}
.arrow {
    font-size: 12px;
    transition: transform 0.3s;
}
</style>

{{-- ===== SCRIPT ACCORDION ===== --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggles = document.querySelectorAll('.story-toggle');
    toggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const card = this.closest('.story-card');
            card.classList.toggle('active');
        });
    });
});
</script>


{{-- ===== SERVICES ===== --}}
<section class="section">
    <div class="container">
        <h2 class="section-title">Layanan Kami</h2>
        @if ($services->count())
            <div class="grid">
                @foreach ($services as $service)
                    <div class="card">
                        <h3>{{ $service->service_name }}</h3>
                        <p>{{ strip_tags($service->description) }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="empty">Belum ada layanan.</p>
        @endif
    </div>
</section>

{{-- ===== NEWS ===== --}}
<section class="section" id="news" style="background: var(--secondary-color);">
    <div class="container">
        <h2 class="section-title">Berita Terbaru</h2>
        @if ($news->count())
            <div class="grid">
                @foreach ($news as $item)
                    <div class="card">
                        @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->judul }}" class="news-image">
                        @endif
                        <a href="{{ route('news.front.show', $item->id_berita) }}" class="news-link">
                            <h4>{{ $item->judul }}</h4>
                        </a>
                        <small style="color:var(--text-color); font-size:13px;">Dipublikasikan: {{ $item->tanggal_publikasi->format('d M Y') }}</small>
                    </div>
                @endforeach
            </div>
            <div style="text-align:center; margin-top:40px;">
                <a href="{{ route('news.front.index') }}" class="btn-primary">Berita Selengkapnya</a>
            </div>
        @else
            <p class="empty">Belum ada berita.</p>
        @endif
    </div>
</section>

{{-- ===== CLIENTS, PARTNERS, CERTIFICATIONS ===== --}}
@foreach([['title'=>'Clients','data'=>$clients], ['title'=>'Partners','data'=>$partners], ['title'=>'Certifications','data'=>$certifications]] as $section)
<section class="section">
    <div class="container">
        <h2 class="section-title">{{ $section['title'] }}</h2>
        @if($section['data']->count())
            <div class="grid">
                @foreach($section['data'] as $item)
                    <div class="card card-center">
                        @php
                            $image = $item->picture ?? $item->logo ?? $item->file ?? null;
                        @endphp
                        @if($image)
                            <div class="card-image-wrapper">
                                <img src="{{ asset('storage/'.$image) }}" 
                                     alt="{{ $item->client_name ?? $item->partner_name ?? $item->certification_name }}">
                            </div>
                        @endif
                        <h3>{{ $item->client_name ?? $item->partner_name ?? $item->certification_name }}</h3>
                        <p>{{ strip_tags($item->description ?? '') }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="empty">Tidak ada data.</p>
        @endif
    </div>
</section>
@endforeach

{{-- ===== STYLE KHUSUS CARD IMAGE CENTER ===== --}}
<style>
.card.card-center {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.card-image-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 140px;
    height: 90px;
    margin-bottom: 14px;
    border-radius: 6px;
    overflow: hidden;
}

.card-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: transform 0.3s ease;
}

.card-image-wrapper img:hover {
    transform: scale(1.05);
}
</style>


@endsection
