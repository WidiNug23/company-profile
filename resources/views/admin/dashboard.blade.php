{{-- resources/views/admin/dashboard.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<style>
/* =======================
   Dashboard Styles
======================= */
.stats, .visitor-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 24px;
    margin-bottom: 40px;
}

.stat-card, .action-card {
    background: #fff;
    border-radius: 16px;
    padding: 26px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    text-decoration: none;
}

.stat-card:hover, .action-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.12);
}

.stat-card span {
    font-size: 13px;
    color: #6b7280;
    display: block;
    margin-bottom: 6px;
}

.stat-card h3 {
    font-size: 32px;
    color: #111827;
    margin: 0;
}

.actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.action-card h4 {
    margin-bottom: 8px;
    color: #1f2937;
    font-size: 18px;
    font-weight: 600;
}

.action-card p {
    font-size: 14px;
    color: #6b7280;
    margin: 0;
}

h4.section-title {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 16px;
    color: #1f2937;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 16px;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

table th, table td {
    padding: 14px 18px;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
}

table th {
    background: #1f2937;
    color: #fff;
}

table tr:hover {
    background: #f3f4f6;
}

.logout {
    text-align: right;
    margin-top: 20px;
}

.logout button {
    background: #ef4444;
    color: #fff;
    border: none;
    padding: 12px 20px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    transition: background 0.3s ease;
}

.logout button:hover {
    background: #b91c1c;
}

@media(max-width:900px){
    .stats, .visitor-stats, .actions {
        grid-template-columns: 1fr;
    }
}
</style>

<!-- STAT KELAS -->
<section class="stats">
    <div class="stat-card">
        <span>Total Services</span>
        <h3>{{ $serviceCount }}</h3>
    </div>

    <div class="stat-card">
        <span>Total News</span>
        <h3>{{ $newsCount }}</h3>
    </div>

    <div class="stat-card">
        <span>Total Trust Booster</span>
        <h3>{{ $trustCount }}</h3>
    </div>

    <div class="stat-card">
        <span>Total Projects</span>
        <h3>{{ $projectCount }}</h3>
    </div>

    <div class="stat-card">
        <span>Total Project Stories</span>
        <h3>{{ $projectStoryCount }}</h3>
    </div>

    <div class="stat-card">
        <span>Total Clients</span>
        <h3>{{ $clientCount }}</h3>
    </div>

    <div class="stat-card">
        <span>Total Partners</span>
        <h3>{{ $partnerCount }}</h3>
    </div>

    <div class="stat-card">
        <span>Total Certificates</span>
        <h3>{{ $certificateCount }}</h3>
    </div>

    <div class="stat-card">
        <span>Total Kalender Konten</span>
        <h3>{{ $calendarCount }}</h3>
    </div>
</section>

<section class="visitor-stats">
    <div class="stat-card">
        <span>Total Visitor</span>
        <h3>{{ $totalVisits }}</h3>
    </div>
    <div class="stat-card">
        <span>Unique Visitor</span>
        <h3>{{ $uniqueVisitors }}</h3>
    </div>
</section>

<!-- Halaman paling sering dikunjungi -->
<section>
    <h4 class="section-title">Halaman Paling Sering Dikunjungi</h4>
    <table>
        <thead>
            <tr>
                <th>URL</th>
                <th>Jumlah Kunjungan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($topPages as $page)
                <tr>
                    <td>{{ $page->url }}</td>
                    <td>{{ $page->visits }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" style="text-align:center; color:#6b7280;">Belum ada data pengunjung</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</section>

<!-- ACTION -->
<section class="actions">
    <a href="{{ route('company-profile.index') }}" class="action-card">
        <h4>Company Profile</h4>
        <p>Kelola informasi perusahaan.</p>
    </a>

    <a href="{{ route('services.index') }}" class="action-card">
        <h4>Kelola Services</h4>
        <p>Kelola layanan perusahaan.</p>
    </a>

    <a href="{{ route('projects.index') }}" class="action-card">
        <h4>Kelola Projects</h4>
        <p>Kelola proyek yang sedang dan telah berjalan.</p>
    </a>

    <a href="{{ route('project-stories.index') }}" class="action-card">
        <h4>Kelola Project Stories</h4>
        <p>Kelola cerita proyek dan studi kasus.</p>
    </a>

    <a href="{{ route('clients.index') }}" class="action-card">
        <h4>Kelola Clients</h4>
        <p>Kelola daftar klien perusahaan.</p>
    </a>

    <a href="{{ route('partners.index') }}" class="action-card">
        <h4>Kelola Partners</h4>
        <p>Kelola mitra kerja dan kolaborasi.</p>
    </a>

    <a href="{{ route('certifications.index') }}" class="action-card">
        <h4>Kelola Sertifikat</h4>
        <p>Kelola sertifikat perusahaan.</p>
    </a>

    <a href="{{ route('news.index') }}" class="action-card">
        <h4>Kelola News</h4>
        <p>Kelola berita perusahaan.</p>
    </a>

    <a href="{{ route('calendar.index') }}" class="action-card">
        <h4>Kelola Kalender Konten</h4>
        <p>Kelola jadwal dan konten publikasi.</p>
    </a>
</section>

<!-- LOGOUT -->
<div class="logout">
    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</div>

@endsection
