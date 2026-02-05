<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'PT Danadipa Bertu Perkasa - Solusi Energi Berkelanjutan')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            /* Brand Colors */
            --brand-blue: #293c91;
            --brand-red: #e92426;
            --brand-blue-rgb: 41, 60, 145;
            
            /* Theme Colors */
            --bg-body: #f8fafc;
            --bg-nav: rgba(255, 255, 255, 0.95); 
            --bg-topbar: #ffffff; 
            --text-main: #0f172a;
            --text-muted: #64748b;
            --accent-color: var(--brand-blue);
            --nav-border: rgba(0, 0, 0, 0.08);
            --footer-bg: #0f172a;
            --mobile-menu-bg: #ffffff; 

            /* FONT PALETTE SPECIFICATIONS */
            --font-title: "Century Gothic", "CenturyGothic", "AppleGothic", sans-serif;
            --font-body: 'Poppins', sans-serif;
        }

        [data-theme="dark"] {
            --bg-body: #020617;
            --bg-nav: rgba(15, 23, 42, 0.95); 
            --bg-topbar: #0f172a;
            --text-main: #f1f5f9;
            --text-muted: #94a3b8;
            --accent-color: #3b82f6;
            --nav-border: rgba(255, 255, 255, 0.1);
            --footer-bg: #01040a;
            --mobile-menu-bg: #0f172a; 
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: var(--font-body);
            background-color: var(--bg-body);
            color: var(--text-main);
            overflow-x: hidden;
            line-height: 1.6;
            font-size: 1.1rem;
        }

        /* Typography Helper Classes */
        h1, .main-title { 
            font-family: var(--font-title); font-weight: bold; text-transform: uppercase; 
            font-size: clamp(2.5rem, 8vw, 3.4rem);
        }

        h2, .section-heading { 
            font-family: var(--font-body); font-weight: 400; 
            font-size: 2.5rem;
        }

        /* ================= HEADER & NAV ================= */
        header {
            position: fixed; top: 0; left: 0; width: 100%; z-index: 9999;
            background-color: var(--bg-nav); border-bottom: 1px solid var(--nav-border);
            backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
        }

        .top-bar {
            background-color: var(--bg-topbar); padding: 8px 5%;
            display: flex; justify-content: flex-end; border-bottom: 1px solid var(--nav-border);
        }

        .social-icons { display: flex; gap: 20px; }
        .social-icons a { color: var(--text-muted); font-size: 16px; transition: 0.3s; }
        .social-icons a:hover { color: var(--brand-red); }

        .navbar-container { padding: 0 5%; }
        .main-nav {
            max-width: 1400px; margin: 0 auto; height: 85px;
            display: flex; justify-content: space-between; align-items: center; gap: 20px;
        }

        .brand { display: flex; align-items: center; gap: 12px; text-decoration: none; color: var(--text-main); }
        .brand img { height: clamp(35px, 5vw, 50px); width: auto; }
        .brand span {
            font-family: var(--font-title); font-weight: bold; text-transform: uppercase;
            font-size: clamp(0.8rem, 2vw, 1.1rem); letter-spacing: 0.5px;
        }

        .nav-links { display: flex; align-items: center; gap: clamp(15px, 3vw, 35px); }
        .nav-links a {
            text-decoration: none; color: var(--text-main); font-size: 14px;
            font-weight: 600; opacity: 0.85; transition: 0.3s;
        }

        .nav-links a.active { 
            opacity: 1 !important; 
            color: var(--brand-red) !important; 
        }
        
        .nav-links a:hover { 
            opacity: 1; 
            color: var(--brand-red); 
        }

        .theme-toggle {
            background: rgba(var(--brand-blue-rgb), 0.1); border: 1px solid var(--nav-border);
            color: var(--text-main); width: 42px; height: 42px; border-radius: 12px;
            cursor: pointer; display: flex; align-items: center; justify-content: center;
        }

        .mobile-socials { display: none; }

        /* Burger Menu */
        .burger { display: none; cursor: pointer; z-index: 10001; }
        .burger span { 
            display: block; width: 26px; height: 2.5px; background: var(--text-main); 
            margin: 5px 0; transition: 0.4s; border-radius: 2px;
        }

        /* ================= RESPONSIVE DESIGN ================= */
        @media (max-width: 1024px) {
            .nav-links { gap: 15px; }
            .nav-links a { font-size: 13px; }
        }

        @media (max-width: 991px) {
            .top-bar { display: none; }
            .burger { display: block; }
            .nav-links {
                position: fixed; top: 0; right: -100%; width: 300px; height: 100vh;
                background-color: var(--mobile-menu-bg); flex-direction: column;
                justify-content: flex-start; padding: 100px 40px; gap: 25px;
                transition: 0.4s cubic-bezier(0.16, 1, 0.3, 1);
                box-shadow: -15px 0 40px rgba(0,0,0,0.15);
            }
            .nav-links.active { right: 0; }
            .mobile-socials { 
                display: flex; gap: 25px; margin-top: auto; 
                padding-top: 30px; border-top: 1px solid var(--nav-border); 
                width: 100%; justify-content: flex-start;
            }
            .mobile-socials a { font-size: 24px; color: var(--text-muted); transition: 0.3s; }
            .mobile-socials a:hover { color: var(--brand-red); }
        }

        .burger.active span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
        .burger.active span:nth-child(2) { opacity: 0; }
        .burger.active span:nth-child(3) { transform: rotate(-45deg) translate(5px, -5px); }

        /* ================= FOOTER ================= */
        footer {
            background: var(--footer-bg); color: #ffffff; padding: 80px 5% 40px;
            border-top: 4px solid var(--brand-red);
        }
        .footer-grid {
            max-width: 1300px; margin: 0 auto;
            display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 60px;
        }
        .footer-about img { height: 55px; margin-bottom: 25px; filter: brightness(0) invert(1); }
        .footer-section h4 {
            font-family: var(--font-title); font-weight: bold; text-transform: uppercase;
            font-size: 16px; margin-bottom: 25px; letter-spacing: 1px; position: relative;
        }
        .footer-section h4::after {
            content: ''; position: absolute; left: 0; bottom: -8px;
            width: 30px; height: 3px; background: var(--brand-red);
        }
        .footer-section ul { list-style: none; }
        .footer-section ul li { margin-bottom: 15px; }
        .footer-section ul li a { color: #94a3b8; text-decoration: none; font-size: 14px; transition: 0.3s; }
        .footer-section ul li a:hover { color: #fff; padding-left: 8px; }

        .footer-bottom {
            max-width: 1300px; margin: 60px auto 0; padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.08);
            display: flex; flex-wrap: wrap; justify-content: space-between;
            align-items: center; gap: 20px; color: #64748b; font-size: 13px;
        }

        main { padding-top: 140px; min-height: 85vh; }
        @media (max-width: 991px) { main { padding-top: 100px; } }
    </style>
</head>
<body>

<header>
    <div class="top-bar">
        <div class="social-icons">
            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="mailto:hello@danadipa.co.id" aria-label="Email"><i class="fas fa-envelope"></i></a>
        </div>
    </div>

    <div class="navbar-container">
        <div class="main-nav">
            <a href="/" class="brand">
                <img src="{{ asset('storage/logo PT Danadipa Bertu Perkasa.png') }}" alt="Logo">
                <span>PT Danadipa Bertu Perkasa</span>
            </a>

            <nav class="nav-links" id="navLinks">
                <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">BERANDA</a>
                <a href="/company-profile" class="{{ request()->is('company-profile*') ? 'active' : '' }}">PROFIL</a>
                <a href="/services" class="{{ request()->is('services*') ? 'active' : '' }}">LAYANAN</a>
                <a href="/proyek-stories" class="{{ request()->is('proyek-stories*') ? 'active' : '' }}">PORTOFOLIO</a>
                <a href="/trust-booster" class="{{ request()->is('trust-booster*') ? 'active' : '' }}">TRUST BOOSTER</a>
                <a href="/news" class="{{ request()->is('news*') ? 'active' : '' }}">BERITA</a>
                <a href="/contact" class="{{ request()->is('contact*') ? 'active' : '' }}">KONTAK</a>
                
                <button class="theme-toggle" id="themeToggle" aria-label="Toggle Theme">
                    <i class="fas fa-moon"></i>
                </button>

                <div class="mobile-socials">
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="mailto:hello@danadipa.co.id" aria-label="Email"><i class="fas fa-envelope"></i></a>
                </div>
            </nav>

            <div class="burger" id="burger">
                <span></span><span></span><span></span>
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
            <img src="{{ asset('storage/logo PT Danadipa Bertu Perkasa.png') }}" alt="Logo Footer">
            <p><strong>PT Danadipa Bertu Perkasa</strong> menghadirkan solusi energi masa depan dengan standar kualitas internasional.</p>
        </div>

        <div class="footer-section">
            <h4>Navigasi</h4>
            <ul>
                <li><a href="/">Beranda</a></li>
                <li><a href="/company-profile">Tentang Kami</a></li>
                <li><a href="/services">Layanan</a></li>
                <li><a href="/proyek-stories">Portofolio</a></li>
                <li><a href="/trust-booster">Trust Booster</a></li>
                <li><a href="/news">Berita dan Artikel</a></li>
                <li><a href="/contact">Kontak</a></li>

            </ul>
        </div>

        <div class="footer-section">
            <h4>Bantuan</h4>
            <ul>
                <li><a href="/news">Update Berita</a></li>
                <li><a href="/contact">Hubungi Kami</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>Hubungi Kami</h4>
            <div style="font-size: 14px; color: #94a3b8;">
                <p style="margin-bottom: 12px;"><i class="fas fa-map-marker-alt" style="color:var(--brand-red); margin-right: 12px;"></i> Jakarta, Indonesia</p>
                <p><i class="fas fa-envelope" style="color:var(--brand-red); margin-right: 12px;"></i> hello@danadipa.co.id</p>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div>&copy; {{ date('Y') }} PT Danadipa Bertu Perkasa. All rights reserved.</div>
        <div style="letter-spacing: 2px; font-weight: 600; opacity: 0.5;">SUSTAINABILITY FOR FUTURE</div>
    </div>
</footer>

<script>
    const themeToggle = document.getElementById('themeToggle');
    const htmlElement = document.documentElement;
    const themeIcon = themeToggle.querySelector('i');

    function updateTheme(theme) {
        htmlElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        themeIcon.className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
    }

    const savedTheme = localStorage.getItem('theme') || 'dark';
    updateTheme(savedTheme);

    themeToggle.addEventListener('click', () => {
        const newTheme = htmlElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        updateTheme(newTheme);
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