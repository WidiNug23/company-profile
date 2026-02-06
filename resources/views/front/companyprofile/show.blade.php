@extends('layouts.front')

@section('title', 'Profil Perusahaan - PT Danadipa Bertu Perkasa')

@section('content')

<style>
    /* ============================================================
       1. VARIABEL WARNA (BRAND PALETTE)
    ============================================================ */
    :root {
        --brand-blue: #293c91;
        --brand-red: #e92426;
        --brand-blue-light: rgba(41, 60, 145, 0.1);
        --transition-standard: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        --video-label-bg: rgba(41, 60, 145, 0.1);
        --video-label-text: #293c91;
    }

    [data-theme="dark"] {
        --video-label-bg: rgba(255, 255, 255, 0.1);
        --video-label-text: #ffffff;
    }

    /* Background Dinamis */
    .profile-bg-fixed {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: radial-gradient(circle at top right, var(--brand-blue-light), var(--bg-body));
        z-index: -1;
        transition: background 0.4s ease;
    }

    .company-profile-wrapper {
        position: relative;
        padding: 120px 20px 120px;
        font-family: 'Inter', sans-serif;
        color: var(--text-main);
        max-width: 1400px; 
        margin: 0 auto;
    }

    /* =====================
       2. PAGE TITLE
    ===================== */
    .company-profile-page-title {
        max-width: 800px;
        margin: 0 auto 60px;
        text-align: center;
    }

    .company-profile-page-title h1 {
        font-size: clamp(38px, 6vw, 56px);
        font-weight: 900;
        letter-spacing: -2px;
        color: var(--brand-blue);
        margin-bottom: 20px;
    }

    [data-theme="dark"] .company-profile-page-title h1 {
        color: #ffffff;
        text-shadow: 0 4px 12px rgba(0,0,0,0.3);
    }

    .company-profile-page-title p {
        font-size: 18px;
        color: var(--text-muted);
        line-height: 1.6;
    }

    /* ========================================
       3. LAYOUT UTAMA (VIDEO KIRI, KONTEN KANAN)
    =========================================== */
    .main-profile-content {
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
        align-items: flex-start;
    }

    .video-portrait-container {
        flex: 0 0 350px;
        position: sticky;
        top: 100px;
    }

    .video-wrapper {
        position: relative;
        width: 100%;
        padding-top: 177.78%; /* Aspect Ratio 9:16 */
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        background: #000;
    }

    .video-wrapper iframe {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        border: none;
    }

    /* Label Watch Our Story (Dark/Light Support) */
    .video-label-container {
        margin-top: 20px;
        text-align: center;
    }

    .video-label {
        font-size: 14px;
        font-weight: 600;
        color: var(--video-label-text);
        background: var(--video-label-bg);
        padding: 8px 20px;
        border-radius: 20px;
        display: inline-block;
        transition: var(--transition-standard);
        border: 1px solid transparent;
    }

    [data-theme="dark"] .video-label {
        border-color: rgba(255, 255, 255, 0.2);
    }

    /* Kolom Kanan (Masonry) */
    .company-profile-masonry {
        flex: 1;
        column-count: 2; 
        column-gap: 30px; 
    }

    /* =====================
       4. CARD STYLING
    ===================== */
    .company-profile-card {
        background: var(--card-bg);
        border: 1px solid var(--nav-border);
        border-radius: 35px;
        padding: 40px;
        margin-bottom: 30px; 
        break-inside: avoid; 
        display: inline-block; 
        width: 100%;
        position: relative;
        transition: var(--transition-standard);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
    }

    .company-profile-card:hover {
        transform: translateY(-10px);
        border-color: var(--brand-blue);
        box-shadow: 0 25px 50px rgba(41, 60, 145, 0.1);
    }

    [data-theme="dark"] .company-profile-card:hover {
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
        border-color: var(--brand-red);
    }

    .card-icon {
        width: 50px;
        height: 50px;
        background: var(--brand-blue-light);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        color: var(--brand-blue);
        transition: var(--transition-standard);
    }

    .company-profile-card:hover .card-icon {
        background: var(--brand-red);
        color: #ffffff;
        transform: rotate(-5deg) scale(1.1);
    }

    .company-profile-title {
        font-size: 24px;
        font-weight: 800;
        color: var(--brand-blue);
        margin-bottom: 15px;
        letter-spacing: -0.8px;
    }

    [data-theme="dark"] .company-profile-title {
        color: #ffffff;
    }

    .company-profile-divider {
        width: 40px;
        height: 4px;
        background: var(--brand-red);
        border-radius: 10px;
        margin-bottom: 20px;
        transition: width 0.4s ease;
    }

    .company-profile-card:hover .company-profile-divider {
        width: 70px;
    }

    .company-profile-description {
        font-size: 15px;
        line-height: 1.7;
        color: var(--text-muted);
        white-space: pre-line;
    }

    /* =====================
       5. RESPONSIVE
    ===================== */
    @media (max-width: 1100px) {
        .company-profile-masonry { column-count: 1; }
    }

    @media (max-width: 850px) {
        .main-profile-content { flex-direction: column; align-items: center; }
        .video-portrait-container {
            flex: 0 0 auto;
            width: 100%;
            max-width: 400px;
            position: relative;
            top: 0;
            margin-bottom: 40px;
        }
        .company-profile-masonry { width: 100%; }
    }

    @media (max-width: 480px) {
        .company-profile-card { padding: 30px; border-radius: 25px; }
        .company-profile-page-title h1 { font-size: 32px; }
        .company-profile-wrapper { padding-top: 80px; }
    }
</style>

<div class="profile-bg-fixed"></div>

<div class="company-profile-wrapper">

    <div class="company-profile-page-title">
        <h1>Company Profile</h1>
        <div style="width: 60px; height: 4px; background: var(--brand-red); margin: 0 auto 20px;"></div>
        <p>Mengenal lebih dalam PT Danadipa Bertu Perkasa, komitmen kami terhadap inovasi, kualitas, dan masa depan energi yang berkelanjutan.</p>
    </div>

    <div class="main-profile-content">
        
        <div class="video-portrait-container">
            <div class="video-wrapper">
                <iframe 
                    src="https://www.youtube.com/embed/y6oMutwJQCw?autoplay=0&rel=0" 
                    title="Company Video"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
            </div>
            <div class="video-label-container">
                <span class="video-label">
                    Watch Our Story
                </span>
            </div>
        </div>

        @if($profiles->count())
            <div class="company-profile-masonry">
                @foreach($profiles as $profile)
                    <div class="company-profile-card">
                        <div class="card-icon">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h2 class="company-profile-title">{{ $profile->title }}</h2>
                        <div class="company-profile-divider"></div>
                        <div class="company-profile-description">
                            {!! $profile->description !!}
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="company-profile-empty">
                <div style="width: 80px; height: 80px; background: var(--brand-blue-light); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                    <svg width="40" height="40" style="color: var(--brand-blue); opacity: 0.6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                </div>
                <h2 style="font-weight: 800; color: var(--brand-blue);">Informasi Belum Tersedia</h2>
                <p>Kami sedang menyiapkan informasi detail mengenai profil perusahaan.</p>
            </div>
        @endif

    </div>
</div>

@endsection