@extends('layouts.front')

@section('title', 'Layanan Kami')

@section('content')

<style>
    /* 1. Integrasi Tema & Variabel */
    :root {
        --primary-accent: var(--accent-color, #3b82f6);
        --secondary-accent: #10b981;
    }

    /* Background Fixed - Menyesuaikan tema */
    .services-bg-fixed {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        /* Gradasi radial yang menyesuaikan warna dasar body dari layout */
        background: radial-gradient(circle at top right, var(--card-bg), var(--bg-body));
        z-index: -1;
        transition: background 0.4s ease;
    }

    .services-page {
        position: relative;
        max-width: 1200px;
        margin: 0 auto;
        padding: 100px 20px 120px 20px;
        font-family: 'Inter', sans-serif;
        color: var(--text-main); /* Dinamis */
        transition: color 0.4s ease;
    }

    /* ===== PAGE TITLE ===== */
    .services-title {
        text-align: center;
        margin-bottom: 80px;
    }

    .services-title h1 {
        font-size: clamp(36px, 6vw, 56px);
        font-weight: 900;
        letter-spacing: -1px;
        /* Gradasi judul mengikuti teks utama tema */
        background: linear-gradient(to right, var(--text-main), var(--text-muted));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 20px;
    }

    .services-title p {
        font-size: 18px;
        color: var(--text-muted); /* Dinamis */
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* ===== SERVICES GRID ===== */
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 30px;
    }

    .service-card {
        position: relative;
        background: var(--card-bg); /* Berubah Putih/Gelap sesuai tema */
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid var(--nav-border);
        border-radius: 30px;
        padding: 40px 35px;
        transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: fit-content;
    }

    .service-card:hover {
        border-color: var(--primary-accent);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
    }

    .service-icon {
        width: 70px;
        height: 70px;
        background: var(--glass-bg); /* Dinamis */
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        transition: 0.3s;
        border: 1px solid var(--glass-border);
    }

    .service-card.active .service-icon {
        background: var(--primary-accent);
        color: #ffffff; /* Icon tetap putih saat aktif */
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.4);
    }

    .service-icon img {
        width: 40px;
        height: 40px;
        object-fit: contain;
    }

    .service-name {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-main); /* Dinamis */
        margin-bottom: 10px;
    }

    /* ===== DESCRIPTION STATE ===== */
    .service-desc {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease;
        opacity: 0;
        font-size: 15px;
        color: var(--text-muted); /* Dinamis */
        line-height: 1.8;
    }

    .service-card.active .service-desc {
        max-height: 1000px;
        opacity: 1;
        margin-bottom: 20px;
        margin-top: 10px;
    }

    /* ===== BUTTON ACTION ===== */
    .service-link {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: var(--primary-accent);
        background: transparent;
        border: none;
        padding: 0;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        margin-top: 10px;
        font-family: inherit;
    }

    .service-link svg {
        transition: transform 0.3s;
    }

    .service-card.active .service-link svg {
        transform: rotate(90deg);
    }

    /* Empty State */
    .services-empty-text {
        color: var(--text-muted);
        font-size: 18px;
        font-style: italic;
    }

    @media (max-width: 768px) {
        .services-page { padding: 60px 20px; }
        .services-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="services-bg-fixed"></div>

<div class="services-page">
    <div class="services-title">
        <h1>High-End Solutions</h1>
        <p>Eksplorasi layanan inovatif kami yang dirancang untuk efisiensi dan masa depan yang berkelanjutan.</p>
    </div>

    <div class="services-grid">
        @forelse ($services as $service)
            <div class="service-card" id="service-{{ $loop->index }}">
                <div class="service-icon">
                    @if ($service->icon)
                        <img src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->service_name }}">
                    @else
                        <svg width="35" height="35" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    @endif
                </div>

                <div class="service-name">
                    {{ $service->service_name }}
                </div>

                <div class="service-desc">
                    {!! $service->description !!}
                </div>

                <button class="service-link" onclick="toggleService('service-{{ $loop->index }}')">
                    <span class="link-text">Explore Details</span>
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        @empty
            <div style="grid-column: 1/-1; text-align:center; padding: 100px 0;">
                <p class="services-empty-text">
                    Layanan kami sedang dalam tahap pembaruan.
                </p>
            </div>
        @endforelse
    </div>
</div>

<script>
    function toggleService(cardId) {
        const card = document.getElementById(cardId);
        const linkText = card.querySelector('.link-text');
        const isActive = card.classList.contains('active');

        // Opsional: Tutup card lain (Accordion Mode)
        document.querySelectorAll('.service-card').forEach(c => {
            if(c.id !== cardId) {
                c.classList.remove('active');
                const otherText = c.querySelector('.link-text');
                if(otherText) otherText.innerText = "Explore Details";
            }
        });

        if (isActive) {
            card.classList.remove('active');
            linkText.innerText = "Explore Details";
        } else {
            card.classList.add('active');
            linkText.innerText = "Close Details";
        }
    }
</script>

@endsection