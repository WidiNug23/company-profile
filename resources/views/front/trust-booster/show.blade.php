@extends('layouts.front')

@section('title', 'Trust Booster - Kemitraan & Kepercayaan')

@section('content')

<style>
    :root {
        --brand-blue: #293c91;
        --brand-red: #e92426;
        --brand-blue-rgb: 41, 60, 145;
    }

    /* 1. Background Setup */
    .profile-bg-fixed {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: radial-gradient(circle at bottom left, var(--card-bg), var(--bg-body));
        z-index: -1;
        transition: background 0.4s ease;
    }

    .trust-page-wrapper {
        position: relative;
        padding: 120px 20px;
        font-family: 'Inter', sans-serif;
        color: var(--text-main);
    }

    /* 2. Header Style */
    .trust-page-header {
        max-width: 800px;
        margin: 0 auto 80px;
        text-align: center;
    }

    .trust-page-header h1 {
        font-size: clamp(34px, 5vw, 52px);
        font-weight: 900;
        letter-spacing: -1.5px;
        color: var(--brand-blue);
        margin-bottom: 20px;
    }

    [data-theme="dark"] .trust-page-header h1 {
        background: linear-gradient(to bottom, #ffffff 60%, #a1a1a1 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .trust-page-header p {
        font-size: 18px;
        color: var(--text-muted);
        line-height: 1.6;
    }

    /* 3. Section Dividers */
    .section-divider-wrapper {
        max-width: 1150px;
        margin: 0 auto 40px;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .section-divider-wrapper h2 {
        font-size: 24px;
        font-weight: 800;
        color: var(--text-main);
        margin: 0;
        letter-spacing: -0.5px;
        text-transform: uppercase;
    }

    .section-line {
        flex-grow: 1;
        height: 2px;
        background: linear-gradient(to right, var(--brand-red), transparent);
        opacity: 0.6;
    }

    /* 4. Grid & Cards */
    .trust-masonry-grid {
        max-width: 1150px;
        margin: 0 auto 100px;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
    }

    .trust-card {
        background: var(--card-bg);
        border: 1px solid var(--nav-border);
        border-radius: 28px;
        padding: 40px;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
    }

    /* MENGEMBALIKAN GARIS VERTIKAL MERAH SAAT HOVER */
    .trust-card::before {
        content: '';
        position: absolute;
        top: 0; 
        left: 0; 
        width: 5px; 
        height: 0;
        background: var(--brand-red);
        transition: height 0.4s ease;
        z-index: 2;
    }

    .trust-card:hover {
        transform: translateY(-8px);
        border-color: var(--brand-blue);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    }

    .trust-card:hover::before {
        height: 100%;
    }

    /* Expandable Description Style */
    .desc-container {
        position: relative;
        margin-bottom: 10px;
    }

    .desc-text {
        font-size: 15px;
        color: var(--text-muted);
        line-height: 1.7;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .desc-text.expanded {
        -webkit-line-clamp: unset;
        display: block;
    }

    .btn-read-more {
        background: none;
        border: none;
        color: var(--brand-red);
        font-size: 13px;
        font-weight: 700;
        padding: 0;
        margin-top: 8px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: 0.3s;
    }

    .btn-read-more:hover {
        color: var(--brand-blue);
    }

    .trust-icon-box {
        width: 100%;
        height: 90px;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        margin-bottom: 30px;
        filter: grayscale(100%);
        opacity: 0.6;
        transition: 0.4s ease;
    }

    .trust-card:hover .trust-icon-box {
        filter: grayscale(0%);
        opacity: 1;
    }

    .logo-img {
        max-width: 140px;
        max-height: 70px;
        object-fit: contain;
    }

    .cert-link-box {
        width: 100%;
        height: 180px;
        background: rgba(var(--brand-blue-rgb), 0.03);
        border-radius: 20px;
        border: 1px dashed var(--nav-border);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        text-decoration: none;
        overflow: hidden;
        transition: 0.3s;
    }

    .cert-link-box:hover {
        border-color: var(--brand-blue);
        background: rgba(var(--brand-blue-rgb), 0.08);
    }

    .trust-card h3 {
        font-size: 20px;
        font-weight: 800;
        color: var(--brand-blue);
        margin-bottom: 15px;
        line-height: 1.4;
    }

    [data-theme="dark"] .trust-card h3 { color: #fff; }

    .svg-accent { color: var(--brand-blue); }
    [data-theme="dark"] .svg-accent { color: var(--brand-red); }

    @media (max-width: 768px) {
        .trust-masonry-grid { grid-template-columns: 1fr; }
        .trust-page-wrapper { padding-top: 80px; }
        .trust-icon-box { justify-content: center; }
        .trust-card { text-align: center; }
        .btn-read-more { justify-content: center; width: 100%; }
    }
</style>

<div class="profile-bg-fixed"></div>

<div class="trust-page-wrapper">
    
    <div class="trust-page-header">
        <h1>Trust Booster</h1>
        <p>Membangun transparansi dan akuntabilitas melalui kolaborasi strategis dan standar kualitas yang teruji.</p>
    </div>

    <div class="section-divider-wrapper">
        <h2>Klien Kami</h2>
        <div class="section-line"></div>
    </div>
    
    <div class="trust-masonry-grid">
        @forelse($clients as $client)
            <div class="trust-card">
                <div class="trust-icon-box">
                    @if(!empty($client->picture))
                        <img src="{{ asset('storage/'.$client->picture) }}" alt="{{ $client->client_name }}" class="logo-img">
                    @else
                        <svg class="svg-accent" width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    @endif
                </div>
                <h3>{{ $client->client_name }}</h3>
                <div class="desc-container">
                    <p class="desc-text" id="desc-client-{{ $loop->index }}">
                        {{ strip_tags($client->description ?? 'Tidak ada deskripsi.') }}
                    </p>
                    <button class="btn-read-more" onclick="toggleDesc('desc-client-{{ $loop->index }}', this)">
                        Selengkapnya <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
            </div>
        @empty
            <div style="grid-column: 1/-1; text-align: center; color: var(--text-muted); padding: 50px;">Data klien kosong.</div>
        @endforelse
    </div>

    <div class="section-divider-wrapper">
        <h2>Mitra Strategis</h2>
        <div class="section-line"></div>
    </div>

    <div class="trust-masonry-grid">
        @forelse($partners as $partner)
            <div class="trust-card">
                <div class="trust-icon-box">
                    @if(!empty($partner->logo))
                        <img src="{{ asset('storage/'.$partner->logo) }}" alt="{{ $partner->partner_name }}" class="logo-img">
                    @else
                        <svg class="svg-accent" width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    @endif
                </div>
                <h3 style="margin-bottom: 0;">{{ $partner->partner_name }}</h3>
            </div>
        @empty
            <div style="grid-column: 1/-1; text-align: center; color: var(--text-muted); padding: 50px;">Data mitra kosong.</div>
        @endforelse
    </div>

    <div class="section-divider-wrapper">
        <h2>Sertifikasi & Standar</h2>
        <div class="section-line"></div>
    </div>

    <div class="trust-masonry-grid">
        @forelse($certifications as $cert)
            <div class="trust-card">
                @php $ext = strtolower(pathinfo($cert->file, PATHINFO_EXTENSION)); @endphp

                <a href="{{ asset('storage/'.$cert->file) }}" target="_blank" class="cert-link-box">
                    @if(in_array($ext, ['jpg','jpeg','png','gif']))
                        <img src="{{ asset('storage/'.$cert->file) }}" alt="{{ $cert->certification_name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <svg class="svg-accent" width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span style="font-size: 11px; margin-top: 10px; font-weight: 800; color: var(--brand-blue); letter-spacing: 1px;">LIHAT DOKUMEN</span>
                    @endif
                </a>

                <h3>{{ $cert->certification_name }}</h3>
                <div class="desc-container">
                    <p class="desc-text" id="desc-cert-{{ $loop->index }}">
                        {{ strip_tags($cert->description ?? 'Tidak ada deskripsi.') }}
                    </p>
                    <button class="btn-read-more" onclick="toggleDesc('desc-cert-{{ $loop->index }}', this)">
                        Selengkapnya <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
            </div>
        @empty
            <div style="grid-column: 1/-1; text-align: center; color: var(--text-muted); padding: 50px;">Data sertifikasi kosong.</div>
        @endforelse
    </div>
</div>

<script>
    function toggleDesc(id, btn) {
        const textElement = document.getElementById(id);
        const isExpanded = textElement.classList.contains('expanded');

        if (isExpanded) {
            textElement.classList.remove('expanded');
            btn.innerHTML = 'Selengkapnya <i class="fas fa-chevron-down"></i>';
        } else {
            textElement.classList.add('expanded');
            btn.innerHTML = 'Sembunyikan <i class="fas fa-chevron-up"></i>';
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        const descTexts = document.querySelectorAll('.desc-text');
        descTexts.forEach(text => {
            // Jika tinggi konten tidak melebihi batas (3 baris), sembunyikan tombol
            if (text.scrollHeight <= 75) { 
                const btn = text.nextElementSibling;
                if(btn) btn.style.display = 'none';
            }
        });
    });
</script>

@endsection