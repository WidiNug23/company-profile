<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-main: #f4f5f7;
            --bg-card: #ffffff;
            --primary: #1a73e8;
            --muted: #6b7280;
            --border: #d6d9d2;
            --accent: #b89b6a;
            --error-color: #d32f2f;
            --card-shadow: rgba(0,0,0,0.1);
        }

        * { box-sizing: border-box; }
        body { margin:0; font-family:'Inter', sans-serif; background:var(--bg-main); color:#333; }

        .wrapper { display:flex; min-height:100vh; }

        /* SIDEBAR */
        .sidebar {
            width:260px;
            background:#111827;
            color:#fff;
            padding:28px 22px;
            display:flex;
            flex-direction:column;
            position:fixed;
            top:0; left:0;
            height:100vh;
            overflow-y:auto;
            transition: transform 0.3s ease;
            z-index:1000;
        }
        .sidebar.hide { transform: translateX(-100%); }

        .sidebar h2 { font-size:20px; margin-bottom:32px; position:relative; }
        .sidebar h2 a { color:#fff; text-decoration:none; }

        .sidebar a { display:block; padding:12px 14px; margin-bottom:10px; border-radius:8px; color:#e5e7eb; text-decoration:none; font-size:14px; transition:0.3s; }
        .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,.08); color:#fff; font-weight:600; }

        /* MAIN CONTENT */
        .main {
            flex:1;
            padding:40px;
            margin-left:260px;
            transition: margin-left 0.3s ease;
        }
        .main.full { margin-left:0; }

        .page-title { font-size:28px; font-weight:700; margin-bottom:32px; color:var(--primary); text-align:center; }

        /* CARD */
        .stat-card, .action-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 26px;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            text-align: center;
        }
        .stat-card:hover, .action-card:hover { transform: translateY(-3px); box-shadow:0 8px 20px rgba(0,0,0,0.1); }
        .stat-card span { font-size:13px; color:var(--muted); display:block; }
        .stat-card h3 { font-size:32px; margin-top:8px; color:var(--primary); }

        .actions { display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:20px; margin-bottom:40px; }
        .action-card h4 { margin-bottom:8px; }
        .action-card p { font-size:14px; color:var(--muted); }

        /* LOGOUT */
        .logout { text-align:right; margin-top:40px; }
        .logout button { background:none; border:1px solid var(--border); padding:10px 18px; border-radius:8px; cursor:pointer; transition:0.3s; }
        .logout button:hover { background:#111827; color:#fff; }

        /* TABLE */
        table { width:100%; border-collapse:collapse; margin-top:20px; background:var(--bg-card); border:1px solid var(--border); border-radius:12px; overflow:hidden; }
        table th, table td { padding:12px 16px; text-align:left; border-bottom:1px solid var(--border); }
        table th { background:#e5e7eb; color:var(--primary); }

        @media(max-width:900px){
            .wrapper { flex-direction:column; }
            .sidebar { width:100%; height:auto; position:relative; transform:none; }
            .main { margin-left:0; padding:20px; }
            #toggle-sidebar { top:10px; left:10px; }
        }

        /* TOGGLE BUTTON di tepi kanan sidebar */
        #toggle-sidebar {
            position:fixed;
            top:20px;
            left:260px;
            background:#1f2937;
            color:#fff;
            border:none;
            padding:10px 14px;
            border-radius:0 6px 6px 0;
            cursor:pointer;
            z-index:1101;
            font-size:18px;
            display:flex;
            align-items:center;
            justify-content:center;
            transition: all 0.3s ease;
        }
        #toggle-sidebar:hover { background:#374151; }
    </style>
    @stack('styles')
</head>
<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <h2><a href="{{ route('admin.dashboard') }}">Admin Panel</a></h2>
        <a href="{{ route('company-profile.index') }}" class="{{ Request::routeIs('company-profile.*') ? 'active' : '' }}">Company Profile</a>
        <a href="{{ route('services.index') }}" class="{{ Request::routeIs('services.*') ? 'active' : '' }}">Kelola Services</a>
        <a href="{{ route('projects.index') }}" class="{{ Request::routeIs('projects.*') ? 'active' : '' }}">Kelola Projects</a>
        <a href="{{ route('project-stories.index') }}" class="{{ Request::routeIs('project-stories.*') ? 'active' : '' }}">Kelola Project Stories</a>
        <a href="{{ route('clients.index') }}" class="{{ Request::routeIs('clients.*') ? 'active' : '' }}">Kelola Clients</a>
        <a href="{{ route('partners.index') }}" class="{{ Request::routeIs('partners.*') ? 'active' : '' }}">Kelola Partners</a>
        <a href="{{ route('certifications.index') }}" class="{{ Request::routeIs('certifications.*') ? 'active' : '' }}">Kelola Sertifikat</a>
        <a href="{{ route('news.index') }}" class="{{ Request::routeIs('news.*') ? 'active' : '' }}">Kelola News</a>
        <a href="{{ route('calendar.index') }}" class="{{ Request::routeIs('calendar.*') ? 'active' : '' }}">Kelola Kalender Konten</a>       
    </aside>

    <!-- Toggle Sidebar Button -->
    <button id="toggle-sidebar" aria-label="Toggle Sidebar">✖</button>

    <!-- MAIN CONTENT -->
    <main class="main" id="main-content">
        <div class="page-title">@yield('page-title')</div>
        @yield('content')
    </main>
</div>

<script>
    const toggleBtn = document.getElementById('toggle-sidebar');
    const sidebar = document.getElementById('sidebar');
    const main = document.getElementById('main-content');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('hide');
        main.classList.toggle('full');

        if(sidebar.classList.contains('hide')){
            toggleBtn.textContent = '☰';
            toggleBtn.style.left = '0px'; 
        } else {
            toggleBtn.textContent = '✖';
            toggleBtn.style.left = '260px'; 
        }
    });
</script>

@stack('scripts')
</body>
</html>
