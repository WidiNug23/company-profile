@extends('layouts.front')

@section('title', 'Profil Perusahaan')

@section('content')

<style>
    /* Menggunakan variabel dari Layout */
    :root {
        --primary-blue: #3b82f6;
        --secondary-blue: #60a5fa;
    }

    /* Background Fixed - Sekarang Dinamis mengikuti tema */
    .profile-bg-fixed {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        /* Radial gradient menyesuaikan warna dasar body */
        background: radial-gradient(circle at bottom left, var(--card-bg), var(--bg-body));
        z-index: -1;
        transition: background 0.4s ease;
    }

    .company-profile-wrapper {
        position: relative;
        padding: 100px 20px 120px;
        font-family: 'Inter', sans-serif;
        color: var(--text-main); /* Dinamis */
        transition: color 0.4s ease;
    }

    /* ===== PAGE TITLE ===== */
    .company-profile-page-title {
        max-width: 800px;
        margin: 0 auto 60px;
        text-align: center;
    }

    .company-profile-page-title h1 {
        font-size: clamp(34px, 5vw, 52px);
        font-weight: 900;
        letter-spacing: -1.5px;
        /* Gradasi menyesuaikan tema */
        background: linear-gradient(to bottom, var(--text-main) 40%, var(--text-muted) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 15px;
    }

    .company-profile-page-title p {
        font-size: 18px;
        color: var(--text-muted);
    }

    /* ===== MASONRY GRID LAYOUT ===== */
    .company-profile-masonry {
        max-width: 1150px;
        margin: auto;
        column-count: 2; 
        column-gap: 30px; 
    }

    /* ===== CARD ===== */
    .company-profile-card {
        background: var(--card-bg); /* Berubah Putih/Biru Gelap */
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid var(--nav-border);
        border-radius: 32px;
        padding: 40px;
        margin-bottom: 30px; 
        break-inside: avoid; 
        display: inline-block; 
        width: 100%;
        position: relative;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .company-profile-card:hover {
        transform: translateY(-8px);
        border-color: var(--primary-blue);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .card-icon {
        width: 50px;
        height: 50px;
        background: rgba(59, 130, 246, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        color: var(--primary-blue);
    }

    .company-profile-title {
        font-size: 26px;
        font-weight: 800;
        color: var(--text-main); /* Dinamis */
        margin-bottom: 12px;
        letter-spacing: -0.5px;
    }

    .company-profile-divider {
        width: 40px;
        height: 4px;
        background: var(--primary-blue);
        border-radius: 10px;
        margin-bottom: 25px;
        transition: width 0.3s ease;
    }

    .company-profile-card:hover .company-profile-divider {
        width: 70px;
    }

    .company-profile-description {
        font-size: 15.5px;
        line-height: 1.75;
        color: var(--text-muted); /* Dinamis */
        white-space: pre-line;
    }

    .company-profile-empty {
        text-align: center;
        color: var(--text-muted);
        padding: 80px 20px;
        background: var(--card-bg);
        border: 1px solid var(--nav-border);
        border-radius: 30px;
        max-width: 600px;
        margin: auto;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .company-profile-masonry {
            column-count: 1; 
        }
        .company-profile-wrapper { padding-top: 60px; }
        .company-profile-card { padding: 30px; }
    }
</style>

<div class="profile-bg-fixed"></div>

<div class="company-profile-wrapper">

    <div class="company-profile-page-title">
        <h1>Company Profile</h1>
        <p>Eksplorasi visi, misi, dan perjalanan profesional kami.</p>
    </div>

    @if($profiles->count())
        <div class="company-profile-masonry">

            @foreach($profiles as $profile)
                <div class="company-profile-card">
                    
                    <div class="card-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>

                    <h2 class="company-profile-title">
                        {{ $profile->title }}
                    </h2>

                    <div class="company-profile-divider"></div>

                    <div class="company-profile-description">
                        {!! $profile->description !!}
                    </div>

                </div>
            @endforeach

        </div>
    @else
        <div class="company-profile-empty">
            <svg style="width: 50px; height: 50px; margin-bottom: 20px; opacity: 0.4;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
            </svg>
            <h2>Data Belum Tersedia</h2>
            <p>Silakan kembali lagi nanti untuk informasi profil terbaru.</p>
        </div>
    @endif

</div>

@endsection