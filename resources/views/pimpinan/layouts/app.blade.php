{{-- resources/views/pimpinan/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Executive Panel')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #4f46e5;
            --bg-body: #f8fafc;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --white: #ffffff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            overflow-x: hidden;
        }

        header {
            background: var(--white);
            border-bottom: 1px solid #f1f5f9;
            height: 70px;
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 0 1.5rem;
        }

        .nav-container {
            max-width: 1280px;
            margin: 0 auto;
            height: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand { display: flex; align-items: center; gap: 10px; }
        .brand-logo { 
            width: 35px; height: 35px; background: var(--primary); 
            border-radius: 8px; display: flex; align-items: center; 
            justify-content: center; color: white; 
        }
        .brand-text { font-size: 1.1rem; font-weight: 800; }

        /* Desktop Nav */
        nav { display: flex; align-items: center; gap: 1rem; }
        .nav-link {
            padding: 8px 16px; border-radius: 8px; font-size: 0.9rem;
            font-weight: 600; color: var(--text-muted); text-decoration: none;
        }
        .nav-link:hover, .nav-link.active { color: var(--primary); background: #f5f3ff; }
        
        .btn-logout { color: #ef4444 !important; background: #fef2f2; }
        .btn-logout:hover { background: #ef4444; color: white !important; }

        /* Mobile Menu Toggle */
        .menu-toggle { display: none; background: none; border: none; font-size: 1.5rem; cursor: pointer; }

        main { padding: 2rem 1.5rem; max-width: 1280px; margin: 0 auto; min-height: 80vh; }

        footer { padding: 2rem; background: white; border-top: 1px solid #f1f5f9; text-align: center; font-size: 0.85rem; color: var(--text-muted); }

        /* Responsive Logic */
        @media (max-width: 768px) {
            .menu-toggle { display: block; }
            nav {
                display: none; /* Sembunyikan nav standar */
                flex-direction: column; position: absolute; top: 70px; left: 0; 
                width: 100%; background: white; padding: 1rem; border-bottom: 1px solid #f1f5f9;
                box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            }
            nav.active { display: flex; }
            .nav-link { width: 100%; text-align: center; padding: 12px; }
            .btn-logout { margin-left: 0; margin-top: 10px; }
        }
    </style>
</head>
<body>

<header>
    <div class="nav-container">
        <div class="brand">
            <div class="brand-logo"><i class="fas fa-shield-halved"></i></div>
            <span class="brand-text">Executive Panel</span>
        </div>

        <button class="menu-toggle" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>
        </button>

        <nav id="main-nav">
            <a href="{{ route('pimpinan.dashboard') }}" class="nav-link {{ request()->routeIs('pimpinan.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-pie"></i> Dashboard
            </a>
            <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-power-off"></i> Logout
            </a>
        </nav>

        <form id="logout-form" action="{{ route('pimpinan.logout') }}" method="POST" style="display:none;">@csrf</form>
    </div>
</header>

<main>@yield('content')</main>

<footer>
    &copy; {{ date('Y') }} <strong>Company Profile</strong>. All rights reserved.
</footer>

<script>
    function toggleMenu() {
        const nav = document.getElementById('main-nav');
        nav.classList.toggle('active');
    }
</script>
</body>
</html>