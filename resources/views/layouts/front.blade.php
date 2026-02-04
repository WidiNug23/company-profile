<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Solusi Energi Berkelanjutan')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --bg-body: #f8fafc;
            --bg-nav: #ffffff; 
            /* Menyamakan warna background topbar dengan navbar */
            --bg-topbar: #ffffff; 
            --text-main: #0f172a;
            --text-muted: #64748b;
            --accent-color: #3b82f6;
            --nav-border: rgba(0, 0, 0, 0.05);
            --footer-bg: #0f172a;
            --card-bg: #ffffff;
            --mobile-menu-bg: #ffffff; 
        }

        [data-theme="dark"] {
            --bg-body: #0f172a;
            --bg-nav: #0f172a; 
            --bg-topbar: #0f172a;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --accent-color: #3b82f6;
            --nav-border: rgba(255, 255, 255, 0.08);
            --footer-bg: #020617;
            --card-bg: #1e293b;
            --mobile-menu-bg: #0f172a; 
        }

        * { 
            box-sizing: border-box; 
            transition: background 0.3s ease, color 0.3s ease; 
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* ================= HEADER & NAV ================= */
        header {
            position: fixed;
            top: 0; left: 0; width: 100%;
            z-index: 9999;
            background-color: var(--bg-nav);
            border-bottom: 1px solid var(--nav-border);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        /* Top Bar Section */
        .top-bar {
            background-color: var(--bg-topbar);
            padding: 10px 40px 0px 40px; /* Padding bawah kecil karena akan menyambung ke menu */
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .top-socials {
            display: flex;
            gap: 18px;
        }

        .top-socials a {
            color: var(--text-muted);
            font-size: 14px;
            text-decoration: none;
            transition: 0.3s;
        }

        .top-socials a:hover {
            color: var(--accent-color);
        }

        /* Main Navbar Section */
        .navbar-container {
            padding: 0 40px;
        }

        .main-nav {
            max-width: 1300px;
            margin: 0 auto;
            height: 70px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--text-main);
            font-weight: 800;
            font-size: 1.4rem;
            z-index: 10001;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-main);
            font-size: 15px;
            font-weight: 500;
            opacity: 0.7;
        }

        .nav-links a.active, .nav-links a:hover {
            opacity: 1;
            color: var(--accent-color);
        }

        /* Ikon Sosial Media di Mobile Menu */
        .mobile-only {
            display: none;
            gap: 20px;
            margin-top: 30px;
            border-top: 1px solid var(--nav-border);
            padding-top: 20px;
        }

        .mobile-only a {
            color: var(--text-main);
            font-size: 20px;
            opacity: 0.8;
        }

        /* ================= BURGER ================= */
        .burger { 
            display: none; 
            cursor: pointer; 
            flex-direction: column; 
            gap: 6px; 
            z-index: 10001;
        }
        
        .burger span { 
            width: 25px; 
            height: 2px; 
            background: var(--text-main); 
            transition: 0.3s; 
        }

        .burger.active span:nth-child(1) { transform: translateY(8px) rotate(45deg); }
        .burger.active span:nth-child(2) { opacity: 0; }
        .burger.active span:nth-child(3) { transform: translateY(-8px) rotate(-45deg); }

        /* ================= FOOTER ================= */
        footer {
            background: var(--footer-bg);
            color: #fff;
            padding: 80px 0 40px;
            margin-top: 50px;
        }

        .footer-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 40px;
            padding: 0 40px;
        }

        .footer-about img { height: 45px; margin-bottom: 20px; filter: brightness(0) invert(1); }
        .footer-about p { color: #94a3b8; font-size: 15px; }

        .footer-section h4 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 25px;
            position: relative;
        }

        .footer-section h4::after {
            content: '';
            position: absolute;
            left: 0; bottom: -8px;
            width: 30px; height: 2px;
            background: var(--accent-color);
        }

        .footer-section ul { list-style: none; padding: 0; }
        .footer-section ul li { margin-bottom: 12px; }
        .footer-section ul li a { color: #94a3b8; text-decoration: none; transition: 0.3s; }
        .footer-section ul li a:hover { color: #fff; padding-left: 5px; }

        .social-group { display: flex; gap: 12px; margin-top: 20px; }
        .social-group a {
            width: 38px; height: 38px;
            background: rgba(255,255,255,0.05);
            display: flex; align-items: center; justify-content: center;
            border-radius: 8px; color: #fff; text-decoration: none;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 60px auto 0;
            padding: 30px 40px 0;
            border-top: 1px solid rgba(255,255,255,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #64748b; font-size: 14px;
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 992px) {
            .top-bar { display: none; } /* Desktop topbar sembunyi di mobile */
            .navbar-container { padding: 0 20px; }
            .burger { display: flex; }

            .nav-links {
                position: fixed;
                top: 0; 
                right: -100%;
                width: 100%; 
                height: 100vh;
                background-color: var(--mobile-menu-bg);
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 25px;
                transition: 0.4s ease-in-out;
            }

            .nav-links.active { right: 0; }
            .nav-links a { font-size: 20px; opacity: 1; }
            
            .mobile-only { display: flex; } /* Munculkan sosial media di dalam menu burger */
            
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 640px) {
            .footer-grid { grid-template-columns: 1fr; }
            .footer-bottom { flex-direction: column; gap: 15px; text-align: center; }
        }

        main { padding-top: 120px; min-height: 80vh; }
    </style>
</head>
<body>

<header id="mainHeader">
    <div class="top-bar">
        <div class="top-socials">
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
    </div>

    <div class="navbar-container">
        <div class="main-nav">
            <a href="/" class="brand">
                <img src="/assets/logo.png" alt="Logo" style="height: 40px;">
                <span>Energy<span style="color:var(--accent-color)">Co</span></span>
            </a>

            <nav class="nav-links" id="navLinks">
                <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a>
                <a href="/company-profile" class="{{ request()->is('company-profile') ? 'active' : '' }}">Profil</a>
                <a href="/services" class="{{ request()->is('services') ? 'active' : '' }}">Layanan</a>
                <a href="/proyek-stories" class="{{ request()->is('proyek-stories') ? 'active' : '' }}">Portofolio</a>
                <a href="/news" class="{{ request()->is('news') ? 'active' : '' }}">Berita</a>
                <a href="/contact" class="{{ request()->is('contact') ? 'active' : '' }}">Kontak</a>
                
                <button class="theme-toggle" id="themeToggle" style="background:none; border:1px solid var(--nav-border); color:var(--text-main); padding:8px 12px; border-radius:10px; cursor:pointer;">
                    <i class="fas fa-moon"></i>
                </button>

                <div class="mobile-only">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </nav>

            <div class="burger" id="burger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</header>

<main>
    @yield('content')
</main>

<footer>
    <div class="footer-grid">
        <div class="footer-about">
            <img src="/assets/logo.png" alt="Logo">
            <p>Memimpin revolusi energi berkelanjutan di Indonesia dengan solusi teknologi inovatif dan ramah lingkungan untuk masa depan yang lebih baik.</p>
            <div class="social-group">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
        </div>

        <div class="footer-section">
            <h4>Navigasi</h4>
            <ul>
                <li><a href="/">Beranda</a></li>
                <li><a href="/company-profile">Tentang Kami</a></li>
                <li><a href="/services">Layanan Kami</a></li>
                <li><a href="/proyek-stories">Proyek</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>Bantuan</h4>
            <ul>
                <li><a href="/news">Berita Terbaru</a></li>
                <li><a href="/contact">Hubungi Kami</a></li>
                <li><a href="#">Kebijakan Privasi</a></li>
                <li><a href="#">Syarat & Ketentuan</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>Kontak Kami</h4>
            <p style="margin-bottom: 10px; font-size: 14px; color: #94a3b8;"><i class="fas fa-map-marker-alt" style="color:var(--accent-color); margin-right: 10px;"></i> Gedung Inovasi Lt. 5, Jakarta</p>
            <p style="margin-bottom: 10px; font-size: 14px; color: #94a3b8;"><i class="fas fa-phone-alt" style="color:var(--accent-color); margin-right: 10px;"></i> +62 21 5550 1234</p>
            <p style="font-size: 14px; color: #94a3b8;"><i class="fas fa-envelope" style="color:var(--accent-color); margin-right: 10px;"></i> hello@energyco.id</p>
        </div>
    </div>

    <div class="footer-bottom">
        <div>&copy; {{ date('Y') }} EnergyCo. All rights reserved.</div>
    </div>
</footer>

<script>
    const themeToggle = document.getElementById('themeToggle');
    const htmlElement = document.documentElement;
    const themeIcon = themeToggle.querySelector('i');

    const savedTheme = localStorage.getItem('theme') || 'dark';
    htmlElement.setAttribute('data-theme', savedTheme);
    themeIcon.className = savedTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';

    themeToggle.addEventListener('click', () => {
        const currentTheme = htmlElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        htmlElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        themeIcon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
    });

    const burger = document.getElementById('burger');
    const navLinks = document.getElementById('navLinks');

    burger.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        burger.classList.toggle('active');
        document.body.style.overflow = navLinks.classList.contains('active') ? 'hidden' : 'auto';
    });

    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', () => {
            navLinks.classList.remove('active');
            burger.classList.remove('active');
            document.body.style.overflow = 'auto';
        });
    });
</script>

</body>
</html>