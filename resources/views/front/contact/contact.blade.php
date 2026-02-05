@extends('layouts.front')

@section('title', 'Hubungi Kami - PT Danadipa Bertu Perkasa')

@section('content')

<style>
    :root {
        /* Color Palette Brand */
        --brand-blue: #293c91;
        --brand-red: #e92426;
        --brand-blue-rgb: 41, 60, 145;
    }

    /* Background Fixed Adaptif */
    .contact-bg-fixed {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: var(--bg-body);
        z-index: -1;
        transition: background 0.4s ease;
    }

    [data-theme="dark"] .contact-bg-fixed {
        background: radial-gradient(circle at bottom left, #0a0f1c, #1e293b, var(--brand-blue));
        opacity: 0.4;
    }
    
    [data-theme="light"] .contact-bg-fixed {
        background: radial-gradient(circle at top right, #ffffff, #f1f5f9, rgba(var(--brand-blue-rgb), 0.05));
    }

    .contact-page {
        position: relative;
        max-width: 1200px;
        margin: 0 auto;
        padding: 120px 20px 100px;
        font-family: 'Poppins', sans-serif;
        color: var(--text-main);
    }

    /* Header Section */
    .contact-header {
        text-align: center;
        margin-bottom: 70px;
    }

    .contact-header h1 {
        font-size: clamp(34px, 5vw, 52px);
        font-weight: 800;
        letter-spacing: -1.5px;
        color: var(--brand-blue);
        margin-bottom: 20px;
        text-transform: uppercase;
    }

    [data-theme="dark"] .contact-header h1 {
        background: linear-gradient(to bottom, #ffffff 60%, #cbd5e1 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .contact-header p {
        font-size: 18px;
        color: var(--text-muted);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Cards Grid */
    .contact-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
        justify-content: center;
    }

    .contact-card {
        background: var(--bg-nav);
        border: 1px solid var(--nav-border);
        border-radius: 24px;
        padding: 40px 25px;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        color: inherit;
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(10px);
    }

    .contact-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 4px;
        background: var(--brand-red);
        transform: scaleX(0);
        transition: transform 0.4s ease;
        z-index: 2;
    }

    .contact-card:hover {
        transform: translateY(-10px);
        border-color: var(--brand-blue);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .contact-card:hover::before {
        transform: scaleX(1);
    }

    /* Icon Box */
    .icon-box {
        width: 70px;
        height: 70px;
        background: rgba(var(--brand-blue-rgb), 0.08);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        transition: 0.4s;
    }

    .icon-box i {
        font-size: 30px;
        transition: 0.3s;
        color: var(--text-main);
    }

    /* Hover State Icon */
    .contact-card:hover .icon-box {
        background: var(--brand-blue);
        transform: scale(1.1) rotate(5deg);
    }

    .contact-card:hover .icon-box i {
        color: #ffffff !important;
    }

    /* Typography */
    .contact-card h3 {
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: var(--brand-red);
        margin-bottom: 10px;
        font-weight: 700;
    }

    .contact-card .contact-link-text {
        font-size: 16px;
        font-weight: 500;
        color: var(--text-main);
        line-height: 1.4;
        word-break: break-word;
    }

    /* Custom Hover Colors for Specific Brands */
    .card-wa:hover .icon-box { background: #25D366; }
    .card-ig:hover .icon-box { background: #E4405F; }
    .card-fb:hover .icon-box { background: #1877F2; }
    .card-yt:hover .icon-box { background: #FF0000; }
    .card-tk:hover .icon-box { background: #000000; }

    @media (max-width: 768px) {
        .contact-page { padding: 100px 20px 60px; }
        .contact-cards { grid-template-columns: 1fr; }
    }
</style>

<div class="contact-bg-fixed"></div>

<div class="contact-page">
    <div class="contact-header">
        <h1>Hubungi Kami</h1>
        <p>Silakan hubungi kami melalui saluran komunikasi resmi PT Danadipa Bertu Perkasa di bawah ini.</p>
    </div>

    <div class="contact-cards">
        <a href="https://maps.google.com" target="_blank" class="contact-card">
            <div class="icon-box">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <h3>Alamat Kantor</h3>
            <span class="contact-link-text">Jakarta, Indonesia</span>
        </a>

        <a href="mailto:hello@danadipa.co.id" class="contact-card">
            <div class="icon-box">
                <i class="fas fa-envelope"></i>
            </div>
            <h3>Email Resmi</h3>
            <span class="contact-link-text">hello@danadipa.co.id</span>
        </a>

        <a href="https://wa.me/628123456789" target="_blank" class="contact-card card-wa">
            <div class="icon-box">
                <i class="fab fa-whatsapp"></i>
            </div>
            <h3>WhatsApp</h3>
            <span class="contact-link-text">+62 812-3456-789</span>
        </a>

        <a href="#" target="_blank" class="contact-card card-ig">
            <div class="icon-box">
                <i class="fab fa-instagram"></i>
            </div>
            <h3>Instagram</h3>
            <span class="contact-link-text">@danadipa_id</span>
        </a>

        <a href="#" target="_blank" class="contact-card card-fb">
            <div class="icon-box">
                <i class="fab fa-facebook-f"></i>
            </div>
            <h3>Facebook</h3>
            <span class="contact-link-text">Danadipa Bertu Perkasa</span>
        </a>

        <a href="#" target="_blank" class="contact-card card-tk">
            <div class="icon-box">
                <i class="fab fa-tiktok"></i>
            </div>
            <h3>TikTok</h3>
            <span class="contact-link-text">@danadipa.official</span>
        </a>

        <a href="#" target="_blank" class="contact-card card-yt">
            <div class="icon-box">
                <i class="fab fa-youtube"></i>
            </div>
            <h3>YouTube</h3>
            <span class="contact-link-text">Danadipa TV</span>
        </a>
    </div>
</div>

@endsection