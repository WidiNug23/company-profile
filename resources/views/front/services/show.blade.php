@extends('layouts.front')

@section('title', 'Layanan Kami - PT Danadipa Bertu Perkasa')

@section('content')

<style>
    /* =====================
       1. BRAND COLOR PALETTE
    ===================== */
    :root {
        --brand-blue: #293c91;
        --brand-red: #e92426;
        --brand-red-light: rgba(233, 36, 38, 0.1);
        --brand-blue-light: rgba(41, 60, 145, 0.05);
        --transition-standard: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    /* OVERWRITE NAVBAR & FOOTER (FORCE TO RED) */
    .navbar .nav-link.active, 
    .navbar .navbar-brand,
    .footer .footer-title,
    .footer a:hover,
    header.sticky .nav-link:hover {
        color: var(--brand-red) !important;
    }

    .navbar .btn-contact,
    .footer-divider,
    .btn-primary {
        background-color: var(--brand-red) !important;
        border-color: var(--brand-red) !important;
    }

    /* Background Fixed */
    .services-bg-fixed {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: radial-gradient(circle at top right, var(--brand-blue-light), var(--bg-body));
        z-index: -1;
    }

    .services-page {
        position: relative;
        max-width: 1240px;
        margin: 0 auto;
        padding: 120px 20px 120px;
        font-family: 'Inter', sans-serif;
        color: var(--text-main);
    }

    /* =====================
       2. PAGE TITLE
    ===================== */
    .services-title {
        text-align: center;
        margin-bottom: 80px;
    }

    .services-title h1 {
        font-size: clamp(38px, 6vw, 56px);
        font-weight: 900;
        letter-spacing: -2px;
        color: var(--brand-blue);
        margin-bottom: 20px;
    }

    [data-theme="dark"] .services-title h1 {
        color: #ffffff;
    }

    .services-title p {
        font-size: 18px;
        color: var(--text-muted);
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.7;
    }

    .title-accent {
        width: 60px;
        height: 5px;
        background: var(--brand-red);
        margin: 0 auto 25px;
        border-radius: 10px;
    }

    /* =====================
       3. SERVICES GRID & CARD
    ===================== */
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
        gap: 35px;
    }

    .service-card {
        background: var(--card-bg);
        border: 1px solid var(--nav-border);
        border-radius: 35px;
        padding: 45px 40px;
        transition: var(--transition-standard);
        display: flex;
        flex-direction: column;
        height: fit-content;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
    }

    .service-card:hover {
        transform: translateY(-10px);
        border-color: var(--brand-red);
        box-shadow: 0 25px 50px rgba(233, 36, 38, 0.1);
    }

    [data-theme="dark"] .service-card:hover {
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
    }

    .service-icon {
        width: 76px;
        height: 76px;
        background: var(--brand-red-light);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 30px;
        color: var(--brand-red);
        transition: var(--transition-standard);
        border: 1px solid rgba(233, 36, 38, 0.1);
    }

    .service-card:hover .service-icon {
        background: var(--brand-red);
        color: #ffffff;
        transform: scale(1.1) rotate(-5deg);
    }

    .service-icon img {
        width: 42px;
        height: 42px;
        object-fit: contain;
    }

    .service-name {
        font-size: 26px;
        font-weight: 800;
        color: var(--brand-blue);
        margin-bottom: 15px;
        letter-spacing: -0.5px;
    }

    [data-theme="dark"] .service-name {
        color: #ffffff;
    }

    /* Description Expandable */
    .service-desc {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.6s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.4s ease;
        opacity: 0;
        font-size: 15.5px;
        color: var(--text-muted);
        line-height: 1.8;
    }

    .service-card.active .service-desc {
        max-height: 800px;
        opacity: 1;
        margin-top: 15px;
        margin-bottom: 25px;
        padding-top: 15px;
        border-top: 1px dashed var(--nav-border);
    }

    /* Action Link */
    .service-link {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        color: var(--brand-red);
        background: transparent;
        border: none;
        padding: 0;
        font-weight: 700;
        font-size: 15px;
        cursor: pointer;
        margin-top: 15px;
        font-family: inherit;
        transition: gap 0.3s;
    }

    .service-link:hover {
        gap: 18px;
    }

    .service-link svg {
        transition: transform 0.4s;
    }

    .service-card.active .service-link svg {
        transform: rotate(90deg);
    }

    /* Empty State */
    .services-empty {
        grid-column: 1/-1;
        text-align: center;
        padding: 100px 30px;
        background: var(--card-bg);
        border-radius: 40px;
        border: 1px dashed var(--nav-border);
    }

    .services-empty-text {
        color: var(--text-muted);
        font-size: 18px;
    }

    @media (max-width: 768px) {
        .services-page { padding: 80px 20px; }
        .services-grid { grid-template-columns: 1fr; }
        .service-card { padding: 35px; }
    }
</style>

<div class="services-bg-fixed"></div>

<div class="services-page">
    <div class="services-title">
        <div class="title-accent"></div>
        <h1>Our High-End Solutions</h1>
        <p>Solusi teknis terintegrasi untuk mendukung keunggulan operasional dan keberlanjutan bisnis Anda di masa depan.</p>
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
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        @empty
            <div class="services-empty">
                <div style="width: 80px; height: 80px; background: var(--brand-red-light); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                    <svg width="40" height="40" style="color: var(--brand-red); opacity: 0.6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                </div>
                <p class="services-empty-text">Layanan kami sedang dalam tahap pembaruan sistem.</p>
            </div>
        @endforelse
    </div>
</div>

<script>
    function toggleService(cardId) {
        const card = document.getElementById(cardId);
        const linkText = card.querySelector('.link-text');
        const isActive = card.classList.contains('active');

        // Accordion effect: Close other cards
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