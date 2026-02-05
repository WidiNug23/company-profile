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
    }

    /* =====================
       2. PAGE TITLE
    ===================== */
    .company-profile-page-title {
        max-width: 800px;
        margin: 0 auto 80px;
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

    /* =====================
       3. MASONRY GRID LAYOUT
    ===================== */
    .company-profile-masonry {
        max-width: 1200px;
        margin: auto;
        column-count: 2; 
        column-gap: 35px; 
    }

    /* =====================
       4. CARD STYLING
    ===================== */
    .company-profile-card {
        background: var(--card-bg);
        border: 1px solid var(--nav-border);
        border-radius: 35px;
        padding: 45px;
        margin-bottom: 35px; 
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
        width: 56px;
        height: 56px;
        background: var(--brand-blue-light);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 30px;
        color: var(--brand-blue);
        transition: var(--transition-standard);
    }

    .company-profile-card:hover .card-icon {
        background: var(--brand-red);
        color: #ffffff;
        transform: rotate(-5deg) scale(1.1);
    }

    .company-profile-title {
        font-size: 28px;
        font-weight: 800;
        color: var(--brand-blue);
        margin-bottom: 15px;
        letter-spacing: -0.8px;
    }

    [data-theme="dark"] .company-profile-title {
        color: #ffffff;
    }

    .company-profile-divider {
        width: 50px;
        height: 5px;
        background: var(--brand-red);
        border-radius: 10px;
        margin-bottom: 25px;
        transition: width 0.4s ease;
    }

    .company-profile-card:hover .company-profile-divider {
        width: 90px;
    }

    .company-profile-description {
        font-size: 16px;
        line-height: 1.85;
        color: var(--text-muted);
        white-space: pre-line;
    }

    .company-profile-description strong {
        color: var(--text-main);
    }

    /* Empty State */
    .company-profile-empty {
        text-align: center;
        color: var(--text-muted);
        padding: 100px 30px;
        background: var(--card-bg);
        border: 1px solid var(--nav-border);
        border-radius: 40px;
        max-width: 600px;
        margin: 40px auto;
    }

    /* =====================
       5. RESPONSIVE
    ===================== */
    @media (max-width: 992px) {
        .company-profile-masonry {
            column-count: 1; 
            max-width: 700px;
        }
        .company-profile-wrapper { padding-top: 80px; }
    }

    @media (max-width: 480px) {
        .company-profile-card { padding: 30px; border-radius: 25px; }
        .company-profile-page-title h1 { font-size: 32px; }
    }
</style>

<div class="profile-bg-fixed"></div>

<div class="company-profile-wrapper">

    <div class="company-profile-page-title">
        <h1>Company Profile</h1>
        <div style="width: 60px; height: 4px; background: var(--brand-red); margin: 0 auto 20px;"></div>
        <p>Mengenal lebih dalam PT Danadipa Bertu Perkasa, komitmen kami terhadap inovasi, kualitas, dan masa depan energi yang berkelanjutan.</p>
    </div>

    @if($profiles->count())
        <div class="company-profile-masonry">

            @foreach($profiles as $profile)
                <div class="company-profile-card">
                    
                    <div class="card-icon">
                        <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
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
            <div style="width: 80px; height: 80px; background: var(--brand-blue-light); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                <svg width="40" height="40" style="color: var(--brand-blue); opacity: 0.6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
            </div>
            <h2 style="font-weight: 800; color: var(--brand-blue);">Informasi Belum Tersedia</h2>
            <p>Kami sedang menyiapkan informasi detail mengenai profil perusahaan. Silakan cek kembali dalam waktu dekat.</p>
        </div>
    @endif

</div>

@endsection