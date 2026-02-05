{{-- resources/views/admin/dashboard.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary: #4f46e5;
        --primary-soft: #eef2ff;
        --success: #10b981;
        --danger: #ef4444;
        --warning: #f59e0b;
        --text-dark: #111827;
        --text-muted: #6b7280;
        --bg-main: #f9fafb;
        --card-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    }

    .dashboard-container {
        font-family: 'Inter', system-ui, sans-serif;
        color: var(--text-dark);
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Top Header Section */
    .top-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding: 1rem 1.5rem;
        background: #fff;
        border-radius: 12px;
        box-shadow: var(--card-shadow);
    }

    .user-greeting h2 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 700;
    }

    .btn-logout-top {
        display: flex;
        align-items: center;
        gap: 8px;
        background: var(--primary-soft);
        color: var(--primary);
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-logout-top:hover {
        background: var(--danger);
        color: #fff;
    }

    /* Section Header */
    .section-header {
        margin-bottom: 1.25rem;
        border-left: 4px solid var(--primary);
        padding-left: 1rem;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
    }

    /* Stats Grid - Mini Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;
        margin-bottom: 2.5rem;
    }

    .stat-mini-card {
        background: #fff;
        padding: 1rem;
        border-radius: 12px;
        border: 1px solid #f3f4f6;
        box-shadow: var(--card-shadow);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .stat-mini-card .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }

    .bg-blue { background: #e0f2fe; color: #0369a1; }
    .bg-green { background: #dcfce7; color: #15803d; }
    .bg-purple { background: #f3e8ff; color: #7e22ce; }
    .bg-orange { background: #ffedd5; color: #c2410c; }
    .bg-rose { background: #ffe4e6; color: #be123c; }

    .stat-mini-card .info span { display: block; font-size: 0.75rem; color: var(--text-muted); }
    .stat-mini-card .info h3 { margin: 0; font-size: 1.25rem; font-weight: 700; }

    /* Visitor Section - Style Pimpinan */
    .visitor-row {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    .glass-card {
        background: #fff;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: var(--card-shadow);
        border: 1px solid #f3f4f6;
    }

    /* Style Identik dengan Pimpinan */
    .stat-card-executive {
        background: white;
        padding: 1.5rem;
        border-radius: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid #f1f5f9;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        margin-bottom: 1rem;
    }

    .stat-card-executive .stat-info h4 { font-size: 0.75rem; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.5rem; }
    .stat-card-executive .stat-info p { font-size: 1.75rem; font-weight: 800; color: #0f172a; margin: 0; }
    .stat-card-executive .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    /* Visitor Item Side-stats */
    .visitor-item-small {
        padding: 0.75rem 1rem;
        border-radius: 12px;
        background: var(--bg-main);
        margin-bottom: 0.75rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Table Styling */
    .table-container { overflow-x: auto; }
    .modern-table { width: 100%; border-collapse: separate; border-spacing: 0; }
    .modern-table th { background: #f8fafc; padding: 12px 16px; font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); border-bottom: 2px solid #f1f5f9; text-align: left; }
    .modern-table td { padding: 12px 16px; border-bottom: 1px solid #f1f5f9; font-size: 0.85rem; }
    .url-badge { background: #f1f5f9; padding: 4px 8px; border-radius: 6px; font-family: monospace; color: var(--primary); }

    /* Action Grid */
    .action-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 1rem;
        margin-bottom: 3rem;
    }

    .action-link {
        display: flex;
        align-items: center;
        padding: 1.25rem;
        background: #fff;
        border-radius: 12px;
        text-decoration: none;
        color: inherit;
        border: 1px solid #f3f4f6;
        transition: all 0.2s ease;
        box-shadow: var(--card-shadow);
    }

    .action-link:hover {
        border-color: var(--primary);
        transform: translateY(-3px);
    }

    .action-icon { font-size: 1.5rem; margin-right: 1rem; color: var(--primary); width: 35px; text-align: center; }
    .action-details h4 { margin: 0; font-size: 0.95rem; font-weight: 600; }
    .action-details p { margin: 0; font-size: 0.8rem; color: var(--text-muted); }

    @media (max-width: 1024px) {
        .visitor-row { grid-template-columns: 1fr; }
    }
</style>

<div class="dashboard-container">

    <header class="top-header">
        <div class="user-greeting">
            <h2>Welcome Back, {{ Auth::user()->name ?? 'Admin' }}</h2>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn-logout-top">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </header>

    <div class="section-header">
        <h4 class="section-title">Data Overview</h4>
    </div>

    {{-- Kumpulan Stat Kecil --}}
    <section class="stats-grid">
        <div class="stat-mini-card">
            <div class="stat-icon bg-blue"><i class="fas fa-building"></i></div>
            <div class="info"><span>Profile</span><h3>1</h3></div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-icon bg-green"><i class="fas fa-concierge-bell"></i></div>
            <div class="info"><span>Services</span><h3>{{ $serviceCount }}</h3></div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-icon bg-purple"><i class="fas fa-project-diagram"></i></div>
            <div class="info"><span>Projects</span><h3>{{ $projectCount }}</h3></div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-icon bg-orange"><i class="fas fa-book"></i></div>
            <div class="info"><span>Stories</span><h3>{{ $projectStoryCount }}</h3></div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-icon bg-rose"><i class="fas fa-user-tie"></i></div>
            <div class="info"><span>Clients</span><h3>{{ $clientCount }}</h3></div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-icon bg-blue"><i class="fas fa-handshake"></i></div>
            <div class="info"><span>Partners</span><h3>{{ $partnerCount }}</h3></div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-icon bg-green"><i class="fas fa-certificate"></i></div>
            <div class="info"><span>Certs</span><h3>{{ $certificateCount }}</h3></div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-icon bg-purple"><i class="fas fa-newspaper"></i></div>
            <div class="info"><span>News</span><h3>{{ $newsCount }}</h3></div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-icon bg-orange"><i class="fas fa-calendar-alt"></i></div>
            <div class="info"><span>Calendar</span><h3>{{ $calendarCount }}</h3></div>
        </div>
    </section>

    <div class="visitor-row">
        {{-- TRAFFIC SUMMARY --}}
        <div class="glass-card">
            <h4 class="section-title" style="margin-bottom: 1.5rem;">Traffic Analysis</h4>
            
            {{-- Kartu Hari Ini (Identik dengan Pimpinan) --}}
            <div class="stat-card-executive">
                <div class="stat-info">
                    <h4>Hari Ini</h4>
                    <p>{{ number_format($todayVisitors ?? 0) }}</p>
                </div>
                <div class="stat-icon" style="background: #ecfdf5; color: #10b981;">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>

            <div class="visitor-item-small" style="border-left: 4px solid var(--primary);">
                <span style="color: var(--text-muted); font-size: 0.8rem;">Total Kunjungan</span>
                <span style="font-weight: 800; font-size: 1.1rem;">{{ number_format($totalVisits) }}</span>
            </div>
            
            <div class="visitor-item-small" style="border-left: 4px solid var(--success);">
                <span style="color: var(--text-muted); font-size: 0.8rem;">Unique Visitors</span>
                <span style="font-weight: 800; font-size: 1.1rem;">{{ number_format($uniqueVisitors) }}</span>
            </div>
        </div>

        {{-- POPULAR CONTENT --}}
        <div class="glass-card">
            <h4 class="section-title" style="margin-bottom: 1.25rem;">Popular Content</h4>
            <div class="table-container">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>URL Halaman</th>
                            <th style="text-align: right;">Hits</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topPages as $page)
                            <tr>
                                <td><span class="url-badge">{{ Str::limit($page->url, 45) }}</span></td>
                                <td style="font-weight:700; text-align: right;">{{ $page->visits }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="2" style="text-align:center;">Data belum tersedia</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="section-header">
        <h4 class="section-title">Quick Management</h4>
    </div>

    <section class="action-grid">
        <a href="{{ route('company-profile.index') }}" class="action-link">
            <div class="action-icon"><i class="fas fa-id-card"></i></div>
            <div class="action-details"><h4>Company Profile</h4><p>Update informasi profil</p></div>
        </a>
        <a href="{{ route('services.index') }}" class="action-link">
            <div class="action-icon"><i class="fas fa-laptop-code"></i></div>
            <div class="action-details"><h4>Kelola Services</h4><p>Layanan unggulan</p></div>
        </a>
        <a href="{{ route('projects.index') }}" class="action-link">
            <div class="action-icon"><i class="fas fa-briefcase"></i></div>
            <div class="action-details"><h4>Kelola Projects</h4><p>Portfolio proyek</p></div>
        </a>
        <a href="{{ route('project-stories.index') }}" class="action-link">
            <div class="action-icon"><i class="fas fa-history"></i></div>
            <div class="action-details"><h4>Project Stories</h4><p>Narasi & studi kasus</p></div>
        </a>
        <a href="{{ route('clients.index') }}" class="action-link">
            <div class="action-icon"><i class="fas fa-users"></i></div>
            <div class="action-details"><h4>Kelola Clients</h4><p>Daftar klien</p></div>
        </a>
        <a href="{{ route('partners.index') }}" class="action-link">
            <div class="action-icon"><i class="fas fa-handshake"></i></div>
            <div class="action-details"><h4>Kelola Partners</h4><p>Mitra kolaborasi</p></div>
        </a>
        <a href="{{ route('certifications.index') }}" class="action-link">
            <div class="action-icon"><i class="fas fa-award"></i></div>
            <div class="action-details"><h4>Kelola Sertifikat</h4><p>Pencapaian resmi</p></div>
        </a>
        <a href="{{ route('news.index') }}" class="action-link">
            <div class="action-icon"><i class="fas fa-newspaper"></i></div>
            <div class="action-details"><h4>Kelola News</h4><p>Berita & artikel</p></div>
        </a>
        <a href="{{ route('calendar.index') }}" class="action-link">
            <div class="action-icon"><i class="fas fa-calendar-check"></i></div>
            <div class="action-details"><h4>Kalender Konten</h4><p>Jadwal publikasi</p></div>
        </a>
    </section>

</div>

@endsection