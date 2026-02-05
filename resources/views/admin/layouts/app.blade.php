<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-bg: #0f172a; /* Dark Navy profesional */
            --sidebar-hover: #1e293b;
            --primary-accent: #6366f1; /* Indigo modern */
            --text-gray: #94a3b8;
            --bg-main: #f8fafc;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background: var(--bg-main); 
            color: #1e293b;
            overflow-x: hidden;
        }

        .wrapper { display: flex; min-height: 100vh; }

        /* --- SIDEBAR --- */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            color: #fff;
            position: fixed;
            top: 0; left: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            transition: var(--transition);
            z-index: 1000;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar.hide { transform: translateX(-100%); }

        /* Sidebar Logo Area */
        .sidebar-header {
            padding: 30px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        
        .sidebar-header .logo-icon {
            background: var(--primary-accent);
            width: 35px; height: 35px;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 1.2rem;
        }

        .sidebar-header h2 { 
            font-size: 18px; font-weight: 700; letter-spacing: 0.5px;
            color: #fff; text-decoration: none;
        }

        /* Navigasi */
        .sidebar-content {
            flex: 1;
            padding: 20px 16px;
            overflow-y: auto;
        }

        .nav-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-gray);
            margin: 20px 0 10px 12px;
            font-weight: 600;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            margin-bottom: 4px;
            border-radius: 10px;
            color: var(--text-gray);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: var(--transition);
        }

        .sidebar a i {
            width: 20px;
            margin-right: 12px;
            font-size: 16px;
            text-align: center;
        }

        .sidebar a:hover {
            background: var(--sidebar-hover);
            color: #fff;
        }

        .sidebar a.active {
            background: var(--primary-accent);
            color: #fff;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        /* --- MAIN CONTENT --- */
        .main {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: var(--transition);
            min-width: 0; /* Menghindari layout pecah */
        }
        
        .main.full { margin-left: 0; }

        .top-navbar {
            background: #fff;
            height: 70px;
            display: flex;
            align-items: center;
            padding: 0 30px;
            justify-content: space-between;
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0; z-index: 99;
        }

        .content-body { padding: 30px; }

        .page-title { 
            font-size: 24px; font-weight: 700; color: #0f172a; 
            margin-bottom: 5px;
        }

        /* --- TOGGLE BUTTON --- */
        #toggle-sidebar {
            background: #fff;
            color: var(--sidebar-bg);
            border: 1px solid #e2e8f0;
            width: 35px; height: 35px;
            border-radius: 8px;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: var(--transition);
        }
        #toggle-sidebar:hover { background: #f1f5f9; }

        /* --- RESPONSIVE --- */
        @media(max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show-mobile { transform: translateX(0); }
            .main { margin-left: 0; }
            #toggle-sidebar { display: flex; }
        }

        /* Scrollbar Sidebar */
        .sidebar-content::-webkit-scrollbar { width: 4px; }
        .sidebar-content::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
    </style>
    @stack('styles')
</head>
<body>

<div class="wrapper">

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo-icon">A</div>
            <h2>ADMIN <span style="color: var(--primary-accent)">CMS</span></h2>
        </div>

        <div class="sidebar-content">
            <div class="nav-label">Main Menu</div>
            <a href="{{ route('admin.dashboard') }}" class="{{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i> Dashboard
            </a>

            <div class="nav-label">Website Content</div>
            <a href="{{ route('company-profile.index') }}" class="{{ Request::routeIs('company-profile.*') ? 'active' : '' }}">
                <i class="fas fa-building"></i> Company Profile
            </a>
            <a href="{{ route('services.index') }}" class="{{ Request::routeIs('services.*') ? 'active' : '' }}">
                <i class="fas fa-concierge-bell"></i> Kelola Services
            </a>
            <a href="{{ route('projects.index') }}" class="{{ Request::routeIs('projects.*') ? 'active' : '' }}">
                <i class="fas fa-project-diagram"></i> Kelola Projects
            </a>
            <a href="{{ route('project-stories.index') }}" class="{{ Request::routeIs('project-stories.*') ? 'active' : '' }}">
                <i class="fas fa-feather-alt"></i> Project Stories
            </a>

            <div class="nav-label">Marketing & Relations</div>
            <a href="{{ route('clients.index') }}" class="{{ Request::routeIs('clients.*') ? 'active' : '' }}">
                <i class="fas fa-user-tie"></i> Kelola Clients
            </a>
            <a href="{{ route('partners.index') }}" class="{{ Request::routeIs('partners.*') ? 'active' : '' }}">
                <i class="fas fa-handshake"></i> Kelola Partners
            </a>
            <a href="{{ route('certifications.index') }}" class="{{ Request::routeIs('certifications.*') ? 'active' : '' }}">
                <i class="fas fa-certificate"></i> Sertifikat
            </a>

            <div class="nav-label">Publication</div>
            <a href="{{ route('news.index') }}" class="{{ Request::routeIs('news.*') ? 'active' : '' }}">
                <i class="fas fa-newspaper"></i> Kelola News
            </a>
            <a href="{{ route('calendar.index') }}" class="{{ Request::routeIs('calendar.*') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i> Kalender Konten
            </a>
        </div>
    </aside>

    <main class="main" id="main-content">
        <header class="top-navbar">
            <button id="toggle-sidebar" title="Toggle Menu">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="user-info" style="display: flex; align-items: center; gap: 15px;">
                <span style="font-size: 14px; font-weight: 600;">{{ Auth::user()->name ?? 'Admin' }}</span>
                <div style="width: 35px; height: 35px; background: #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-user" style="color: #64748b;"></i>
                </div>
            </div>
        </header>

        <div class="content-body">
            <div class="page-header" style="margin-bottom: 30px;">
                <h1 class="page-title">@yield('page-title')</h1>
                <p style="color: var(--text-gray); font-size: 14px;">Kelola data dan konten website Anda dengan mudah.</p>
            </div>

            @yield('content')
        </div>
    </main>
</div>

<script>
    const toggleBtn = document.getElementById('toggle-sidebar');
    const sidebar = document.getElementById('sidebar');
    const main = document.getElementById('main-content');

    toggleBtn.addEventListener('click', () => {
        // Desktop behavior
        if (window.innerWidth > 992) {
            sidebar.classList.toggle('hide');
            main.classList.toggle('full');
        } else {
            // Mobile behavior
            sidebar.classList.toggle('show-mobile');
        }
    });

    // Menutup sidebar otomatis saat klik di luar pada mobile
    document.addEventListener('click', (e) => {
        if (window.innerWidth <= 992) {
            if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
                sidebar.classList.remove('show-mobile');
            }
        }
    });
</script>

@stack('scripts')
</body>
</html>