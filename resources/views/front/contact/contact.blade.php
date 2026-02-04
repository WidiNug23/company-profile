@extends('layouts.front')

@section('title', 'Contact Us')

@section('content')

<style>
    :root {
        --primary-accent: var(--accent-color, #3b82f6);
        /* Variabel fallback jika layout utama tidak menyediakannya */
    }

    /* Background Fixed Adaptif */
    .contact-bg-fixed {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: var(--bg-body); /* Mengikuti background global tema */
        z-index: -1;
        transition: background 0.4s ease;
    }

    /* Overlay Radial dinamis (opsional untuk efek kedalaman) */
    [data-theme="dark"] .contact-bg-fixed {
        background: radial-gradient(circle at top left, #1e293b, #0f172a, #0a0f1c);
    }
    [data-theme="light"] .contact-bg-fixed {
        background: radial-gradient(circle at top left, #f8fafc, #f1f5f9, #e2e8f0);
    }

    .contact-page {
        position: relative;
        max-width: 1200px;
        margin: 0 auto;
        padding: 100px 20px 120px;
        font-family: 'Inter', sans-serif;
        color: var(--text-main);
        transition: color 0.4s ease;
    }

    /* Header Section */
    .contact-header {
        text-align: center;
        margin-bottom: 80px;
    }

    .contact-header h1 {
        font-size: clamp(34px, 5vw, 52px);
        font-weight: 900;
        letter-spacing: -1.5px;
        /* Gradien teks adaptif */
        background: linear-gradient(to right, var(--text-main), var(--text-muted));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 15px;
    }

    .contact-header p {
        font-size: 18px;
        color: var(--text-muted);
        max-width: 600px;
        margin: 0 auto;
    }

    /* Cards Grid */
    .contact-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 25px;
        justify-content: center;
    }

    .contact-card {
        background: var(--card-bg);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid var(--nav-border);
        border-radius: 24px;
        padding: 40px 25px;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        color: inherit;
    }

    .contact-card:hover {
        transform: translateY(-12px);
        border-color: var(--primary-accent);
        background: var(--glass-bg);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    /* Icon Box Adaptif */
    .icon-box {
        width: 70px;
        height: 70px;
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        transition: 0.3s;
        position: relative;
    }

    .contact-card:hover .icon-box {
        background: var(--primary-accent);
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 0 25px rgba(59, 130, 246, 0.3);
    }

    /* Kontrol warna ikon berdasarkan tema */
    .icon-box img {
        width: 35px;
        height: 35px;
        object-fit: contain;
        transition: 0.3s;
        /* Di Light Mode, ikon putih diubah jadi gelap agar terlihat */
        filter: var(--icon-filter, none);
    }

    /* Jika tema Light, balikkan warna ikon putih jadi hitam */
    [data-theme="light"] .icon-box img {
        filter: invert(0.8) brightness(0.2);
    }

    /* Saat hover, ikon harus selalu putih terang karena background icon-box jadi berwarna */
    .contact-card:hover .icon-box img {
        filter: brightness(0) invert(1) !important;
    }

    /* Typography inside Card */
    .contact-card h3 {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--text-muted);
        margin-bottom: 10px;
        font-weight: 700;
    }

    .contact-card .contact-link-text {
        font-size: 16px;
        font-weight: 500;
        color: var(--text-main);
        line-height: 1.5;
        transition: 0.3s;
    }

    .contact-card:hover .contact-link-text {
        color: var(--primary-accent);
    }

    /* Specialized Hover Colors */
    .card-whatsapp:hover { border-color: #25D366; }
    .card-whatsapp:hover .icon-box { background: #25D366; }
    
    .card-instagram:hover { border-color: #E4405F; }
    .card-instagram:hover .icon-box { background: #E4405F; }

    .card-facebook:hover { border-color: #1877F2; }
    .card-facebook:hover .icon-box { background: #1877F2; }

    /* Responsive */
    @media (max-width: 768px) {
        .contact-page { padding: 60px 20px; }
        .contact-cards { grid-template-columns: 1fr; }
    }
</style>

<div class="contact-bg-fixed"></div>

<div class="contact-page">
    <div class="contact-header">
        <h1>Contact Us</h1>
        <p>Hubungi kami melalui berbagai platform di bawah ini. Kami siap membantu kebutuhan Anda.</p>
    </div>

    <div class="contact-cards">
        <a href="https://goo.gl/maps/example" target="_blank" class="contact-card">
            <div class="icon-box">
                <img src="https://img.icons8.com/ios-filled/100/ffffff/marker.png" alt="Alamat">
            </div>
            <h3>Alamat</h3>
            <span class="contact-link-text">Jl. Merdeka No. 123, Jakarta Pusat</span>
        </a>

        <a href="https://wa.me/6281234567890" target="_blank" class="contact-card card-whatsapp">
            <div class="icon-box">
                <img src="https://img.icons8.com/ios-filled/100/ffffff/whatsapp.png" alt="WhatsApp">
            </div>
            <h3>WhatsApp</h3>
            <span class="contact-link-text">+62 812-3456-7890</span>
        </a>

        <a href="mailto:info@company.com" class="contact-card">
            <div class="icon-box">
                <img src="https://img.icons8.com/ios-filled/100/ffffff/mail.png" alt="Email">
            </div>
            <h3>Email</h3>
            <span class="contact-link-text">info@company.com</span>
        </a>

        <a href="https://instagram.com/company" target="_blank" class="contact-card card-instagram">
            <div class="icon-box">
                <img src="https://img.icons8.com/ios-filled/100/ffffff/instagram-new.png" alt="Instagram">
            </div>
            <h3>Instagram</h3>
            <span class="contact-link-text">@company</span>
        </a>

        <a href="https://facebook.com/company" target="_blank" class="contact-card card-facebook">
            <div class="icon-box">
                <img src="https://img.icons8.com/ios-filled/100/ffffff/facebook-new.png" alt="Facebook">
            </div>
            <h3>Facebook</h3>
            <span class="contact-link-text">Company Page</span>
        </a>

        <a href="https://linkedin.com/company/company" target="_blank" class="contact-card">
            <div class="icon-box">
                <img src="https://img.icons8.com/ios-filled/100/ffffff/linkedin.png" alt="LinkedIn">
            </div>
            <h3>LinkedIn</h3>
            <span class="contact-link-text">Company Profile</span>
        </a>

        <a href="https://t.me/company" target="_blank" class="contact-card">
            <div class="icon-box">
                <img src="https://img.icons8.com/ios-filled/100/ffffff/telegram-app.png" alt="Telegram">
            </div>
            <h3>Telegram</h3>
            <span class="contact-link-text">@company</span>
        </a>
    </div>
</div>

@endsection