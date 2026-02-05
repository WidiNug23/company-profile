@extends('layouts.front')

@section('title', 'Solusi Energi Berkelanjutan - PT Danadipa Bertu Perkasa')

@section('content')

<style>
    /* ============================================================
       1. INTEGRASI TEMA & VARIABEL (BRAND COLORS)
    ============================================================ */
    :root {
        --brand-blue-dark: #293c91;
        --brand-blue-mid: #2a3d91;
        --brand-blue-alt: #29398f;
        --brand-red: #e92426;
        --brand-red-dark: #3b1f25;
        
        /* Functional Colors */
        --accent-color: var(--brand-red);
        --accent-hover: var(--brand-blue-dark);
        --glass-white: rgba(255, 255, 255, 0.03);
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

    /* Penyesuaian Judul Umum untuk Mode Gelap */
    [data-theme="dark"] h2, 
    [data-theme="dark"] h3 {
        color: #ffffff !important;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
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
        background: linear-gradient(to right, rgba(248, 250, 252, 0.95) 20%, rgba(248, 250, 252, 0.4) 100%);
    }

    [data-theme="dark"] .hero::before {
        background: linear-gradient(to right, rgba(15, 23, 42, 0.85) 20%, rgba(15, 23, 42, 0.4) 100%);
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
        font-size: clamp(34px, 7vw, 68px);
        font-weight: 900;
        line-height: 1.1;
        letter-spacing: -2px;
        margin-bottom: 20px;
        color: var(--brand-blue-dark);
        transition: color 0.3s ease;
    }

    [data-theme="dark"] .hero-content h1 {
        color: #ffffff;
        text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
    }

    /* =====================
       3. NEWS BANNER
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
        border-left: 3px solid var(--brand-red);
        padding-left: 15px;
        transition: 0.3s;
    }

    .news-item h4 { font-size: 14px; color: var(--text-main); margin-bottom: 3px; }
    .news-item p { font-size: 12px; color: var(--text-muted); margin: 0; }

    .btn-all-news {
        background: var(--brand-blue-dark);
        color: white !important;
        padding: 10px 24px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-all-news:hover {
        background: var(--brand-red);
    }

    /* =====================
       4. PROFIL PERUSAHAAN
    ===================== */
    .company-glass-card {
        background: var(--card-bg);
        border: 1px solid var(--nav-border);
        border-radius: 40px;
        padding: 60px;
        display: flex;
        gap: 60px;
        align-items: center;
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .company-glass-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    .company-img-placeholder {
        flex: 0 0 50%;
        height: 450px;
        border-radius: 30px;
        background-position: center center;
        background-size: cover;
        background-repeat: no-repeat;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        display: block;
    }

    .company-text h2 {
        font-size: 42px;
        font-weight: 800;
        margin-bottom: 25px;
        color: var(--brand-blue-dark);
    }

    .company-text p {
        font-size: 18px;
        line-height: 1.8;
        color: var(--text-muted);
        margin-bottom: 35px;
    }

    /* =====================
       5. PORTOFOLIO STYLES
    ===================== */
    .portfolio-grid {
        display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px;
    }

    .portfolio-card {
        height: 400px; border-radius: 24px; position: relative; overflow: hidden; display: block; text-decoration: none; background: var(--card-bg); border: 1px solid var(--nav-border);
    }

    .portfolio-card img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1); }
    
    .portfolio-overlay {
        position: absolute; inset: 0; background: linear-gradient(to top, rgba(41, 60, 145, 0.9) 0%, rgba(41, 60, 145, 0.2) 60%, transparent 100%); display: flex; flex-direction: column; justify-content: flex-end; padding: 30px;
    }

    .badge-year { background: var(--brand-red); color: white; padding: 4px 12px; border-radius: 8px; font-size: 11px; font-weight: 800; width: fit-content; margin-bottom: 12px; }
    .portfolio-card h3 { color: #ffffff !important; margin: 0 0 10px 0; font-size: 24px; font-weight: 700; }
    .badge-loc { background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); color: #ffffff; padding: 6px 14px; border-radius: 10px; font-size: 12px; width: fit-content; border: 1px solid rgba(255,255,255,0.2); }

    .portfolio-card:hover img { transform: scale(1.1); }

    /* =====================
       6. LAYANAN UNGGULAN
    ===================== */
    .service-item { 
        background: var(--card-bg); 
        border: 1px solid var(--nav-border); 
        border-radius: 20px; 
        margin-bottom: 15px; 
        overflow: hidden; 
        transition: all 0.3s ease;
    }
    
    .service-item summary { 
        padding: 25px 35px; 
        font-size: 20px; 
        font-weight: 700; 
        color: #ffffff; 
        background: var(--brand-blue-dark); 
        cursor: pointer; 
        display: flex; 
        justify-content: space-between; 
        list-style: none; 
        transition: background 0.3s ease;
    }

    .service-item summary:hover { background: var(--brand-red); }

    .service-item[open] summary {
        background: var(--brand-red);
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .service-item summary::-webkit-details-marker { display: none; }

    .service-content {
        padding: 30px 35px; 
        color: var(--text-main); 
        line-height: 1.8;
        background: var(--card-bg);
    }

    /* =====================
       7. OTHERS & RESPONSIVE
    ===================== */
    .logo-marquee-container { width: 100%; overflow: hidden; padding: 40px 0; position: relative; }
    .logo-marquee-container::before, .logo-marquee-container::after { content: ""; height: 100%; width: 150px; position: absolute; z-index: 2; pointer-events: none; }
    .logo-marquee-container::before { left: 0; top: 0; background: linear-gradient(to right, var(--bg-body), transparent); }
    .logo-marquee-container::after { right: 0; top: 0; background: linear-gradient(to left, var(--bg-body), transparent); }

    .logo-track { display: flex; width: calc(250px * 20); animation: scroll 40s linear infinite; }
    @keyframes scroll { 0% { transform: translateX(0); } 100% { transform: translateX(calc(-250px * 10)); } }
    .logo-item { width: 250px; height: 100px; display: flex; align-items: center; justify-content: center; padding: 0 40px; flex-shrink: 0; }
    .logo-item img { max-width: 100%; max-height: 60px; object-fit: contain; filter: grayscale(100%); opacity: 0.5; transition: 0.4s; }
    .logo-item:hover img { filter: grayscale(0%); opacity: 1; transform: scale(1.1); }

    .section-padding { padding: 100px 0; }
    .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
    
    .btn-hero {
        padding: 16px 40px;
        background: var(--brand-blue-dark);
        color: #ffffff !important;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        transition: 0.3s ease;
        box-shadow: 0 10px 20px rgba(41, 60, 145, 0.2);
    }

    .btn-hero:hover {
        background: var(--brand-red);
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(233, 36, 38, 0.3);
    }

    .cert-badge-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-top: 40px; }
    .cert-mini-card { padding: 25px; border-radius: 24px; background: var(--card-bg); border: 1px solid var(--nav-border); display: flex; align-items: center; gap: 15px; transition: 0.3s; }
    .cert-mini-card:hover { border-color: var(--brand-red); transform: translateY(-5px); }

    /* PERBAIKAN RESPONSIVE DI SINI */
    @media (max-width: 992px) {
        .company-glass-card { 
            flex-direction: column; 
            padding: 30px; 
            text-align: center; 
            gap: 30px; 
            border-radius: 30px;
        }
        
        /* Memberikan lebar penuh dan tinggi eksplisit agar gambar muncul */
        .company-img-placeholder {
            width: 100%;
            height: 300px; 
            flex: none; 
            order: -1; /* Memastikan gambar tetap di atas teks */
        }

        .hero-content { text-align: center; }
        .logo-item { width: 180px; }
        @keyframes scroll { 0% { transform: translateX(0); } 100% { transform: translateX(calc(-180px * 10)); } }
    }
</style>

<section class="hero">
    <div class="hero-img-fallback"></div>
    <div class="hero-content">
        <h1>Energy Transformation<br>Towards a <span style="color:var(--brand-red)">Dynamic</span> Future</h1>
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
            <div class="company-img-placeholder" style="background-image: url('{{ asset('storage/pexels-jplenio-2128162.jpg') }}') !important;"></div>            
            <div class="company-text">
                <h2>Profil Perusahaan</h2>
                <p>Kami adalah pionir dalam transformasi energi nasional. Berfokus pada inovasi teknologi untuk membantu industri beroperasi lebih efisien sambil menjaga ekosistem bumi secara berkelanjutan.</p>
                <a href="{{ url('/company-profile') }}" class="btn-hero">
                    Tentang Kami
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="section-padding" style="background: rgba(41, 60, 145, 0.03);">
    <div class="container">
        <div style="margin-bottom: 50px; text-align: center;">
            <h2 style="font-size: 36px; font-weight: 800; color: var(--brand-blue-dark);">Portofolio Proyek</h2>
            <div style="width: 50px; height: 4px; background: var(--brand-red); margin: 15px auto;"></div>
        </div>

        <div class="portfolio-grid">
            @foreach($projects as $project)
                <a href="{{ url('/proyek-stories') }}" class="portfolio-card">
                    <img src="{{ $project->thumbnail ? asset('storage/'.$project->thumbnail) : asset('storage/pexels-jplenio-2128162.jpg') }}" alt="{{ $project->project_name }}">
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
            <h2 style="font-size: 36px; font-weight: 800; color: var(--brand-blue-dark);">Layanan Unggulan</h2>
            <div style="width: 50px; height: 4px; background: var(--brand-red); margin-top: 15px;"></div>
        </div>
        <div class="service-accordion">
            @foreach($services as $service)
                <details class="service-item">
                    <summary>
                        {{ $service->service_name }} 
                        <span>+</span>
                    </summary>
                    <div class="service-content">
                        {!! $service->description !!}
                    </div>
                </details>
            @endforeach
        </div>
    </div>
</section>

<section class="section-padding" style="border-top: 1px solid var(--nav-border);">
    <div class="container">
        <div style="text-align: center; margin-bottom: 40px;">
            <h2 style="font-size: 36px; font-weight: 800; color: var(--brand-blue-dark);">Trusted by Industry Leaders</h2>
            <p style="color: var(--text-muted);">Kemitraan strategis bersama perusahaan terkemuka.</p>
        </div>
    </div>

    <div class="logo-marquee-container">
        <div class="logo-track">
            @foreach($clients as $client)
                @if($client->picture)
                <div class="logo-item"><img src="{{ asset('storage/'.$client->picture) }}" alt="Logo"></div>
                @endif
            @endforeach
            @foreach($partners as $partner)
                @if($partner->logo)
                <div class="logo-item"><img src="{{ asset('storage/'.$partner->logo) }}" alt="Logo"></div>
                @endif
            @endforeach
            {{-- Duplicate loops for seamless --}}
            @foreach($clients as $client)
                @if($client->picture)
                <div class="logo-item"><img src="{{ asset('storage/'.$client->picture) }}" alt="Logo"></div>
                @endif
            @endforeach
            @foreach($partners as $partner)
                @if($partner->logo)
                <div class="logo-item"><img src="{{ asset('storage/'.$partner->logo) }}" alt="Logo"></div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="container" style="margin-top: 60px;">
        <h3 style="font-size: 24px; font-weight: 700; color: var(--brand-blue-dark); margin-bottom: 30px; text-align: center;">Our Certifications</h3>
        <div class="cert-badge-grid">
            @foreach($certifications as $cert)
                <div class="cert-mini-card">
                    <div style="width: 45px; height: 45px; background: rgba(41, 60, 145, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--brand-blue-dark);">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h4 style="margin: 0; font-size: 16px; color: var(--text-main);">{{ $cert->certification_name }}</h4>
                        <p style="margin: 0; font-size: 12px; color: var(--text-muted);">Verified Standard</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div style="text-align: center; margin-top: 60px;">
                <a href="{{ url('/trust-booster') }}" class="btn-hero">
                    Lihat Selengkapnya
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
        </div>
    </div>
</section>

@endsection