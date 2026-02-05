{{-- resources/views/pimpinan/dashboard.blade.php --}}
@extends('pimpinan.layouts.app')

@section('title', 'Dashboard Pimpinan')

@section('content')
<style>
    /* 1. Global & Layout Container */
    .dashboard-content { 
        padding: 1rem; 
        max-width: 1400px; 
        margin: 0 auto; 
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }

    /* 2. Page Header */
    .page-header { 
        display: flex; justify-content: space-between; align-items: center; 
        margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;
    }
    .page-header h2 { font-size: 1.5rem; font-weight: 800; color: #1e293b; margin: 0; }
    .date-badge { 
        background: white; padding: 0.6rem 1.2rem; border-radius: 12px; 
        font-size: 0.85rem; font-weight: 600; color: #64748b; 
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #f1f5f9;
    }

    /* 3. Stat Cards */
    .summary-grid {
        display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); 
        gap: 1.5rem; margin-bottom: 2rem;
    }
    .stat-card {
        background: white; padding: 1.5rem; border-radius: 20px; 
        display: flex; align-items: center; gap: 1.25rem;
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.04); border: 1px solid #f1f5f9;
    }
    .stat-icon {
        width: 56px; height: 56px; border-radius: 16px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.5rem;
    }
    .stat-info h4 { font-size: 0.8rem; color: #94a3b8; text-transform: uppercase; margin: 0 0 0.25rem 0; letter-spacing: 0.025em; }
    .stat-info p { font-size: 1.75rem; font-weight: 800; color: #0f172a; margin: 0; }

    /* 4. Main Grid & Tables */
    .main-grid {
        display: grid; grid-template-columns: 1fr 2fr; gap: 1.5rem; align-items: start;
    }
    .card-box {
        background: white; border-radius: 20px; padding: 1.5rem;
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.04); border: 1px solid #f1f5f9;
    }
    .card-box h4 { margin-bottom: 1.5rem; font-size: 1.1rem; font-weight: 700; color: #1e293b; display: flex; align-items: center; gap: 10px; }

    /* 5. Desktop Table Style */
    .table-custom { width: 100%; border-collapse: collapse; }
    .table-custom th { text-align: left; padding: 12px; font-size: 0.75rem; color: #94a3b8; text-transform: uppercase; border-bottom: 1px solid #f1f5f9; }
    .table-custom td { padding: 16px 12px; font-size: 0.9rem; border-bottom: 1px solid #f8fafc; }

    /* 6. Note Styling (Quill Output) */
    .note-wrapper {
        max-width: 400px; color: #475569; font-size: 0.85rem; line-height: 1.6;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }
    .note-wrapper:hover { -webkit-line-clamp: unset; }

    /* 7. Responsive Magic: Card List for Mobile */
    @media (max-width: 1024px) {
        .main-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 768px) {
        /* Sembunyikan Header Tabel di Mobile */
        .table-custom thead { display: none; }
        
        /* Ubah baris tabel menjadi kartu */
        .table-custom tr { 
            display: block; background: #f8fafc; margin-bottom: 1rem; 
            padding: 1rem; border-radius: 12px; border: 1px solid #f1f5f9;
        }
        
        .table-custom td { 
            display: block; width: 100%; padding: 0.5rem 0; 
            border: none; text-align: left !important; 
        }

        /* Label data untuk mobile */
        .table-custom td::before {
            content: attr(data-label);
            display: block; font-size: 0.7rem; font-weight: 700; 
            color: #94a3b8; text-transform: uppercase; margin-bottom: 2px;
        }

        .note-wrapper { max-width: 100%; -webkit-line-clamp: 3; }
        
        .page-header h2 { font-size: 1.25rem; }
        .stat-card { padding: 1.25rem; }
    }
</style>

<div class="dashboard-content">
    {{-- HEADER --}}
    <div class="page-header">
        <div>
            <h2>Executive Overview</h2>
            <p style="color: #64748b; font-size: 0.9rem; margin-top: 4px;">Pantauan trafik dan rencana konten strategis.</p>
        </div>
        <div class="date-badge">
            <i class="fas fa-calendar-day"></i> {{ date('l, d M Y') }}
        </div>
    </div>

    {{-- STATS --}}
    <div class="summary-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: #eff6ff; color: #2563eb;"><i class="fas fa-eye"></i></div>
            <div class="stat-info">
                <h4>Total Visitor</h4>
                <p>{{ number_format($totalVisitors) }}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #ecfdf5; color: #10b981;"><i class="fas fa-bolt"></i></div>
            <div class="stat-info">
                <h4>Hari Ini</h4>
                <p>{{ number_format($todayVisitors) }}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #fff7ed; color: #f59e0b;"><i class="fas fa-paper-plane"></i></div>
            <div class="stat-info">
                <h4>Rencana Konten</h4>
                <p>{{ $calendar->count() }}</p>
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="main-grid">
        {{-- TREN VISITOR --}}
        <div class="card-box">
            <h4><i class="fas fa-chart-area" style="color: #cbd5e1;"></i> Tren 7 Hari</h4>
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th style="text-align: right;">Visitor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visitorsPerDay as $item)
                    <tr>
                        <td data-label="Tanggal">{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>
                        <td data-label="Visitor" style="text-align: right; font-weight: 800; color: #2563eb;">{{ $item->total }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- JADWAL KONTEN --}}
        <div class="card-box">
            <h4><i class="fas fa-calendar-alt" style="color: #cbd5e1;"></i> Jadwal Konten & Brief</h4>
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Judul Konten</th>
                        <th>Note / Brief</th>
                        <th style="text-align: right;">Jadwal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($calendar as $item)
                    <tr>
                        <td data-label="Judul Konten" style="font-weight: 700; color: #1e293b;">
                            {{ $item->title }}
                        </td>
                        <td data-label="Note / Brief">
                            <div class="note-wrapper">
                                {!! $item->note ?? '<span class="text-muted">Tidak ada catatan detail.</span>' !!}
                            </div>
                        </td>
                        <td data-label="Jadwal" style="text-align: right;">
                            <span style="background: #f1f5f9; color: #475569; padding: 6px 12px; border-radius: 8px; font-weight: 700; font-size: 0.75rem;">
                                {{ \Carbon\Carbon::parse($item->scheduled_date)->format('d/m/Y') }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="text-align: center; padding: 3rem; color: #94a3b8;">
                            <i class="fas fa-inbox fa-3x mb-3"></i><br>Belum ada jadwal konten terinput.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection