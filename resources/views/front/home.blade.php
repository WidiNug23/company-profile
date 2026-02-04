@extends('layouts.front')

@section('title', 'Solusi Energi Berkelanjutan')

@section('content')

<style>
    /* ============================================================
       1. INTEGRASI TEMA & VARIABEL
    ============================================================ */
    :root {
        --accent-emerald: #10b981; 
    }

    html { 
        scroll-behavior: smooth; 
    }
    
    body { 
        background-color: var(--bg-body);
        color: var(--text-main); 
        margin: 0; 
        font-family: 'Inter', sans-serif;
        transition: background 0.4s ease, color 0.4s ease;
        overflow-x: hidden;
    }

    .content-wrapper, main, .container-fluid {
        padding: 0 !important;
        margin: 0 !important;
        max-width: none !important;
    }

    /* =====================
       2. HERO SECTION
    ===================== */
    .hero {
        width: 100vw;
        height: 100vh;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        overflow: hidden;
        background-color: var(--bg-body);
    }

    .hero-img-fallback {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background-image: url('{{ asset("storage/pexels-jplenio-2128162.jpg") }}');
        background-position: center;
        background-size: cover;
        z-index: 1;
    }

    .hero::before {
        content: '';
        position: absolute;
        inset: 0;
        z-index: 2;
    }

    [data-theme="light"] .hero::before {
        background: linear-gradient(to right, rgba(248, 250, 252, 0.9) 20%, rgba(248, 250, 252, 0.2) 100%);
    }

    [data-theme="dark"] .hero::before {
        background: linear-gradient(to right, rgba(15, 23, 42, 0.8) 20%, rgba(15, 23, 42, 0.3) 100%);
    }

    .hero-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 40px;
        width: 100%;
        position: relative;
        z-index: 10;
    }

    .hero-content h1 {
        font-size: clamp(38px, 7vw, 68px);
        font-weight: 900;
        line-height: 1.1;
        letter-spacing: -2px;
        margin-bottom: 20px;
        color: var(--text-main);
    }

    /* =====================
       3. NEWS BANNER & BUTTON
    ===================== */
    .hero-news {
        position: absolute;
        bottom: 0;
        width: 100%;
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        padding: 20px 0;
        border-top: 1px solid var(--glass-border);
        z-index: 11;
    }

    .news-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        gap: 30px;
        padding: 0 40px;
    }

    .news-slider {
        display: flex;
        gap: 30px;
        overflow-x: auto;
        scrollbar-width: none;
        flex: 1;
    }

    .news-item {
        min-width: 250px;
        text-decoration: none;
        border-left: 3px solid var(--accent-color);
        padding-left: 15px;
        transition: 0.3s;
    }

    .news-item h4 { font-size: 14px; color: var(--text-main); margin-bottom: 3px; }
    .news-item p { font-size: 12px; color: var(--text-muted); margin: 0; }

    .btn-all-news {
        background: var(--accent-color);
        color: white !important;
        padding: 10px 24px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
        white-space: nowrap;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .btn-all-news:hover {
        transform: translateY(-2px);
        filter: brightness(1.1);
        box-shadow: 0 6px 15px rgba(0,0,0,0.2);
    }

    /* =====================
       4. PROFIL PERUSAHAAN (SESUAI REQUEST)
    ===================== */
    .company-glass-card {
        background: var(--card-bg);
        border: 1px solid var(--nav-border);
        border-radius: 40px;
        padding: 60px;
        display: flex;
        gap: 60px;
        align-items: center;
        transition: background 0.4s ease;
    }

    .company-img-placeholder {
        flex: 1;
        height: 400px;
        border-radius: 30px;
        background: url('{{ asset("storage/pexels-jplenio-2128162.jpg") }}') center/cover;
        border: 1px solid var(--nav-border);
    }

    .company-text { flex: 1; }
    .company-text h2 { color: var(--text-main); font-size: 36px; margin-bottom: 20px; }
    .company-text p { color: var(--text-muted); line-height: 1.8; margin-bottom: 30px; }

    /* =====================
       5. PORTFOLIO WITH BADGES
    ===================== */
    .portfolio-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
    }

    .portfolio-card {
        height: 380px;
        border-radius: 24px;
        position: relative;
        overflow: hidden;
        display: block;
        text-decoration: none;
        background: var(--card-bg);
        border: 1px solid var(--nav-border);
    }

    .portfolio-card img { 
        width: 100%; height: 100%; object-fit: cover; 
        transition: 0.7s ease; 
    }
    
    .portfolio-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 70%);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 30px;
    }

    .badge-year {
        background: var(--accent-emerald);
        color: white;
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 800;
        width: fit-content;
        margin-bottom: 10px;
    }

    .portfolio-card h3 { color: #ffffff; margin: 5px 0 10px 0; font-size: 22px; }

    .badge-loc {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        color: #ffffff;
        padding: 6px 14px;
        border-radius: 10px;
        font-size: 12px;
        width: fit-content;
        border: 1px solid rgba(255,255,255,0.1);
    }

    .portfolio-card:hover img { transform: scale(1.1); }

    /* =====================
       6. OTHERS
    ===================== */
    .btn-hero {
        padding: 15px 35px;
        background: var(--accent-color);
        color: #ffffff !important;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        transition: 0.3s ease;
    }

    .service-item {
        background: var(--card-bg);
        border: 1px solid var(--nav-border);
        border-radius: 20px;
        margin-bottom: 15px;
        overflow: hidden;
    }

    .service-item summary {
        padding: 25px 35px;
        font-size: 20px;
        font-weight: 700;
        color: var(--text-main);
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        list-style: none;
    }

    .section-padding { padding: 100px 0; }
    .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

    @media (max-width: 992px) {
        .company-glass-card { flex-direction: column; padding: 40px; text-align: center; }
        .hero-content { text-align: center; }
        .btn-hero { justify-content: center; }
    }
</style>

<section class="hero">
    <div class="hero-img-fallback"></div>
    <div class="hero-content">
        <h1>Energy Transformation<br>Towards a <span style="color:var(--accent-emerald)">Greener</span> Future</h1>
        <p>Transition Towards More Efficient and Renewable Energy Solutions for a Better Tomorrow.</p>
        <a href="#about" class="btn-hero">
            Mulai Eksplorasi
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7"/></svg>
        </a>
    </div>

    <div class="hero-news">
        <div class="news-container">
            <div class="news-slider">
                @foreach($news as $item)
                    <a href="{{ url('news/'.$item->id_berita) }}" class="news-item">
                        <h4>{{ Str::limit($item->judul, 45) }}</h4>
                        <p>{{ $item->tanggal_publikasi->format('d M Y') }}</p>
                    </a>
                @endforeach
            </div>
            <a href="{{ url('/news') }}" class="btn-all-news">Berita Lainnya</a>
        </div>
    </div>
</section>

<section class="section-padding" id="about">
    <div class="container">
        <div class="company-glass-card">
            <div class="company-img-placeholder"></div>
            <div class="company-text">
                <h2>Profil Perusahaan</h2>
                <p>
                    Kami adalah pionir dalam transformasi energi nasional. Berfokus pada inovasi teknologi hijau untuk membantu industri beroperasi lebih efisien sambil menjaga ekosistem bumi.
                </p>
                <a href="{{ url('/company-profile') }}" class="btn-hero">
                    Tentang Kami
                </a>
            </div>
        </div>
    </div>
</section>

<section class="section-padding" style="background: rgba(0,0,0,0.02);">
    <div class="container">
        <div style="margin-bottom: 50px; text-align: center;">
            <h2 style="font-size: 36px; font-weight: 800; color: var(--text-main);">Portofolio Proyek</h2>
            <div style="width: 50px; height: 4px; background: var(--accent-color); margin: 15px auto;"></div>
        </div>

        <div class="portfolio-grid">
            @foreach($projects as $project)
                <a href="{{ url('/proyek-stories') }}" class="portfolio-card">
                    <img src="{{ $project->thumbnail ? asset('storage/'.$project->thumbnail) : asset('storage/pexels-jplenio-2128162.jpg') }}" alt="">
                    <div class="portfolio-overlay">
                        <div class="badge-year">{{ $project->year }}</div>
                        <h3>{{ $project->project_name }}</h3>
                        <div class="badge-loc">{{ $project->location }}</div>
                    </div>
                </a>
            @endforeach
        </div>

        <div style="display: flex; justify-content: center; margin-top: 50px;">
            <a href="{{ url('/proyek-stories') }}" class="btn-hero">
                Lihat Semua Proyek
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div style="margin-bottom: 50px;">
            <h2 style="font-size: 36px; font-weight: 800; color: var(--text-main);">Layanan Unggulan</h2>
            <div style="width: 50px; height: 4px; background: var(--accent-color); margin-top: 15px;"></div>
        </div>

        <div class="service-accordion">
            @foreach($services as $service)
                <details class="service-item">
                    <summary>
                        {{ $service->service_name }}
                        <span style="color:var(--accent-color);">+</span>
                    </summary>
                    <div style="padding: 0 35px 30px 35px; color: var(--text-muted); line-height: 1.8;">
                        {{ strip_tags($service->description) }}
                    </div>
                </details>
            @endforeach
        </div>
    </div>
</section>

@endsection