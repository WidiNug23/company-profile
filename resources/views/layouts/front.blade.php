<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Company Profile')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        :root {
            --primary-color: #1a73e8;
            --primary-gradient: linear-gradient(90deg, #1a73e8, #0f4c81);
            --secondary-color: #f5f7fa;
            --accent-color: #0f4c81;
            --text-color: #333;
            --shadow: rgba(0,0,0,0.1);
        }

        body.dark {
            --primary-color: #0f4c81;
            --primary-gradient: linear-gradient(90deg, #0f4c81, #1a73e8);
            --secondary-color: #1e1e1e;
            --accent-color: #1a73e8;
            --text-color: #f4f4f4;
            --shadow: rgba(0,0,0,0.4);
        }

        * { box-sizing: border-box; transition: all 0.3s ease; }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        /* ===== HEADER ===== */
        header {
            background: var(--primary-gradient);
            color: white;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
            box-shadow: 0 4px 10px var(--shadow);
            border-bottom: 2px solid rgba(255,255,255,0.1);
            transition: top 0.3s, padding 0.3s;
        }

        header h1 {
            font-weight: 700;
            font-size: 1.6rem; /* compact */
            margin: 0;
        }

        nav {
            display: flex;
            align-items: center;
        }

        nav a {
            color: white;
            margin-left: 30px;
            text-decoration: none;
            font-weight: 500;
            position: relative;
            padding: 5px 0;
        }

        nav a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0;
            height: 2px;
            background: white;
            transition: width 0.3s ease;
            border-radius: 1px;
        }

        nav a:hover::after { width: 100%; }
        nav a.active { font-weight: 600; }

        /* ===== BURGER MENU ===== */
        .burger {
            display: none;
            width: 28px;
            height: 22px;
            position: relative;
            cursor: pointer;
            flex-direction: column;
            justify-content: space-between;
            z-index: 1001;
        }

        .burger span {
            display: block;
            height: 3px;
            width: 100%;
            background: white;
            border-radius: 3px;
            transition: all 0.4s ease;
        }

        .burger.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .burger.active span:nth-child(2) {
            opacity: 0;
        }

        .burger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(5px, -5px);
        }

        .mobile-nav {
            display: flex;
            flex-direction: column;
            gap: 20px;
            background: var(--primary-gradient);
            position: absolute;
            top: 60px; /* lebih menempel ke header */
            right: 0;
            width: 100%;
            padding: 0 20px;
            overflow: hidden;
            opacity: 0;
            transform: translateY(-20px);
            pointer-events: none;
            transition: opacity 0.4s ease, transform 0.4s ease, padding 0.4s ease;
            z-index: 1000;
        }

        .mobile-nav.show {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
            padding: 20px;
        }

        .mobile-nav a {
            color: white;
            font-size: 18px;
            font-weight: 500;
            padding: 10px 0;
            text-decoration: none;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }

        .mobile-nav a:last-child {
            border-bottom: none;
        }

        /* ===== CONTENT ===== */
        main {
            max-width: 1200px;
            margin: 90px auto 40px auto;
            padding: 0 20px;
        }

        /* ===== FOOTER ===== */
        footer {
            background: var(--primary-gradient);
            color: white;
            padding: 50px 40px 30px 40px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
            gap: 40px;
            border-top: 4px solid rgba(255,255,255,0.2);
        }

        footer .footer-section { min-width: 200px; }
        footer h4 { margin-bottom: 15px; font-size: 18px; font-weight: 600; }
        footer p, footer a { font-size: 14px; color: white; text-decoration: none; margin-bottom: 8px; display: block; }
        footer a:hover { text-decoration: underline; }

        footer .social-icons a {
            display: inline-block;
            width: 36px; height: 36px; line-height: 36px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            color: white;
            text-align: center;
            margin-right: 10px;
            transition: all 0.3s;
        }

        footer .social-icons a:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-3px);
        }

        footer .copyright {
            width: 100%;
            text-align: center;
            margin-top: 30px;
            font-size: 13px;
            color: rgba(255,255,255,0.8);
        }

        /* Responsive */
        @media(max-width:768px){
            nav { display: none; }
            .burger { display: flex; flex-direction: column; justify-content: space-between; }
            header { padding: 12px 20px; }
            header h1 { font-size: 1.3rem; }
        }
    </style>
</head>
<body>

<header id="header">
    <h1>Company Profile</h1>
    <div style="display:flex; align-items:center;">
        <nav id="nav">
            <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="/company-profile" class="{{ request()->is('company-profile') ? 'active' : '' }}">Company Profile</a>
            <a href="/services" class="{{ request()->is('services') ? 'active' : '' }}">Services</a>
            <a href="/proyek-stories" class="{{ request()->is('proyek-stories') ? 'active' : '' }}">Portofolio Proyek</a>
            <a href="/trust-booster" class="{{ request()->is('trust-booster') ? 'active' : '' }}">Trust Booster</a>
            <!-- <a href="/calendar" class="{{ request()->is('calendar') ? 'active' : '' }}">Kalender Konten</a> -->
            <a href="/news" class="{{ request()->is('news') ? 'active' : '' }}">News</a>
            <a href="/contact" class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a>
        </nav>

        <div class="burger" id="burger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="mobile-nav" id="mobileNav">
        <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
        <a href="/company-profile" class="{{ request()->is('company-profile') ? 'active' : '' }}">Company Profile</a>
        <a href="/services" class="{{ request()->is('services') ? 'active' : '' }}">Services</a>
        <a href="/proyek-stories" class="{{ request()->is('proyek-stories') ? 'active' : '' }}">Portofolio Proyek</a> 
        <a href="/trust-booster" class="{{ request()->is('trust-booster') ? 'active' : '' }}">Trust Booster</a>
        <!-- <a href="/calendar" class="{{ request()->is('calendar') ? 'active' : '' }}">Kalender Konten</a> -->
        <a href="/news" class="{{ request()->is('news') ? 'active' : '' }}">News</a>
        <a href="/contact" class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a>
    </div>
</header>

<main>
    @yield('content')
</main>

<footer>
    <div class="footer-section">
        <h4>Company</h4>
        <p>123 Jalan Utama, Jakarta</p>
        <p>Email: info@company.com</p>
        <p>Tel: +62 812-3456-7890</p>
    </div>

    <div class="footer-section">
        <h4>Quick Links</h4>
        <a href="/">Home</a>
        <a href="/company-profile">Company Profile</a>
        <a href="/services">Services</a>
        <a href="/news">News</a>
        <a href="/contact">Contact</a>
    </div>

    <div class="footer-section">
        <h4>Follow Us</h4>
        <div class="social-icons">
            <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>

    <div class="copyright">
        &copy; {{ date('Y') }} Company Profile. All rights reserved.
    </div>
</footer>

<script>
    // Header show/hide on scroll
    let prevScroll = window.pageYOffset;
    const header = document.getElementById('header');

    window.onscroll = function() {
        let currentScroll = window.pageYOffset;
        if (prevScroll > currentScroll) {
            header.style.top = "0";
        } else {
            header.style.top = "-100px";
        }
        prevScroll = currentScroll;
    }

    // Burger menu toggle dengan animasi smooth
    const burger = document.getElementById('burger');
    const mobileNav = document.getElementById('mobileNav');

    burger.addEventListener('click', () => {
        burger.classList.toggle('active');
        mobileNav.classList.toggle('show');
    });
</script>

</body>
</html>
