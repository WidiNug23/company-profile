@extends('layouts.front')

@section('title', 'Contact Us')

@section('content')

<style>
.contact-page {
    max-width: 1100px;
    margin: 60px auto;
    padding: 0 20px;
    font-family: 'Inter', sans-serif;
}

.contact-page h1 {
    font-size: 32px;
    color: #1e40af;
    font-weight: 700;
    text-align: center;
    margin-bottom: 40px;
    position: relative;
}

.contact-page h1::after {
    content: "";
    width: 50px;
    height: 4px;
    background: #1e40af;
    display: block;
    margin: 12px auto 0;
    border-radius: 2px;
}

.contact-cards {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.contact-card {
    flex: 1;
    min-width: 220px;
    max-width: 280px;
    background: #fff;
    border-radius: 16px;
    padding: 25px 15px;
    text-align: center;
    box-shadow: 0 6px 20px rgba(0,0,0,0.06);
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}

.contact-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 36px rgba(0,0,0,0.12);
}

.contact-card img {
    width: 50px;
    height: 50px;
    margin-bottom: 15px;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
}

.contact-card h3 {
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 8px;
    color: #374151; /* lebih subtle */
}

.contact-card a {
    display: block;
    color: #1e40af;
    font-weight: 500;
    font-size: 14px;
    text-decoration: none;
    padding: 6px 8px;
    border-radius: 6px;
    transition: all 0.3s;
    word-break: break-word;
}

.contact-card a:hover {
    background-color: #e0e7ff;
    color: #1e3a8a;
    transform: translateY(-2px);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1024px) {
    .contact-cards { gap: 16px; }
    .contact-card { padding: 20px 12px; }
}

@media (max-width: 768px) {
    .contact-page h1 { font-size: 28px; margin-bottom: 30px; }
    .contact-card { min-width: 200px; max-width: 260px; padding: 18px 12px; }
    .contact-card h3 { font-size: 14px; }
    .contact-card img { width: 45px; height: 45px; margin-bottom: 10px; }
    .contact-card a { font-size: 13px; }
}
</style>

<div class="contact-page">
    <h1>Contact Us</h1>

    <div class="contact-cards">
        <!-- Alamat Kantor -->
        <div class="contact-card">
            <img src="https://img.icons8.com/ios-filled/100/1e40af/marker.png" alt="Alamat">
            <h3 class="text-muted">Alamat</h3>
            <a href="https://goo.gl/maps/example" target="_blank">
                Jl. Merdeka No. 123, Jakarta Pusat
            </a>
        </div>

        <!-- WhatsApp -->
        <div class="contact-card">
            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp">
            <h3 class="text-muted">WhatsApp</h3>
            <a href="https://wa.me/6281234567890" target="_blank">+62 812-3456-7890</a>
        </div>

        <!-- Email -->
        <div class="contact-card">
            <img src="https://upload.wikimedia.org/wikipedia/commons/4/4e/Mail_%28iOS%29.svg" alt="Email">
            <h3 class="text-muted">Email</h3>
            <a href="mailto:info@company.com">info@company.com</a>
        </div>

        <!-- Instagram -->
        <div class="contact-card">
            <img src="https://upload.wikimedia.org/wikipedia/commons/e/e7/Instagram_logo_2016.svg" alt="Instagram">
            <h3 class="text-muted">Instagram</h3>
            <a href="https://instagram.com/company" target="_blank">@company</a>
        </div>

        <!-- Facebook -->
        <div class="contact-card">
            <img src="https://upload.wikimedia.org/wikipedia/commons/0/05/Facebook_Logo_%282019%29.png" alt="Facebook">
            <h3 class="text-muted">Facebook</h3>
            <a href="https://facebook.com/company" target="_blank">Company Page</a>
        </div>

        <!-- LinkedIn -->
        <div class="contact-card">
            <img src="https://upload.wikimedia.org/wikipedia/commons/8/81/LinkedIn_icon.svg" alt="LinkedIn">
            <h3 class="text-muted">LinkedIn</h3>
            <a href="https://linkedin.com/company/company" target="_blank">Company Profile</a>
        </div>

        <!-- Telegram -->
        <div class="contact-card">
            <img src="https://upload.wikimedia.org/wikipedia/commons/8/82/Telegram_logo.svg" alt="Telegram">
            <h3 class="text-muted">Telegram</h3>
            <a href="https://t.me/company" target="_blank">@company</a>
        </div>
    </div>
</div>

@endsection
