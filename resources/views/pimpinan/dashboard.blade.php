{{-- resources/views/pimpinan/dashboard.blade.php --}}
@extends('pimpinan.layouts.app')

@section('title', 'Dashboard Pimpinan')

@section('content')
<div class="dashboard-container">

    <h2 class="page-title">Dashboard Pimpinan</h2>

    {{-- SUMMARY CARDS --}}
    <div class="summary-cards">
        <div class="card card-blue">
            <h4>Total Visitor</h4>
            <p>{{ $totalVisitors }}</p>
        </div>

        <div class="card card-teal">
            <h4>Visitor Hari Ini</h4>
            <p>{{ $todayVisitors }}</p>
        </div>
    </div>

    {{-- STATISTIK VISITOR --}}
    <div class="table-section">
        <h4>Statistik Visitor (7 Hari Terakhir)</h4>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Total Visitor</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($visitorsPerDay as $item)
                    <tr>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->total }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" align="center">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- CONTENT CALENDAR --}}
    <div class="table-section">
        <h4>Content Calendar</h4>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Catatan</th>
                    <th>Tanggal Publish</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($calendar as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->note }}</td>
                        <td>{{ $item->scheduled_date }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" align="center">Belum ada konten</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

{{-- STYLES --}}
<style>
.dashboard-container {
    max-width: 1200px;
    margin: auto;
    padding: 20px;
}

.page-title {
    font-size: 28px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 25px;
}

/* SUMMARY CARDS */
.summary-cards {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 40px;
}

.card {
    flex: 1 1 200px;
    padding: 25px 20px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    color: #fff;
    transition: transform 0.3s, box-shadow 0.3s;
}

.card h4 {
    font-size: 16px;
    margin-bottom: 10px;
    font-weight: 600;
}

.card p {
    font-size: 28px;
    font-weight: 700;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
}

/* Card Colors */
.card-blue { background: #1e3a8a; }
.card-teal { background: #0d9488; }

/* TABLES */
.table-section {
    margin-bottom: 40px;
}

.styled-table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 6px 18px rgba(0,0,0,0.06);
    background: #fff;
}

.styled-table thead tr {
    background-color: #1e293b;
    color: #fff;
    text-align: left;
    font-weight: 600;
}

.styled-table th, .styled-table td {
    padding: 14px 18px;
}

.styled-table tbody tr {
    border-bottom: 1px solid #e5e7eb;
    transition: background 0.2s;
}

.styled-table tbody tr:hover {
    background: #f3f4f6;
}

/* RESPONSIVE */
@media(max-width: 768px) {
    .summary-cards {
        flex-direction: column;
    }

    .card {
        width: 100%;
    }

    .styled-table th, .styled-table td {
        padding: 10px 12px;
    }
}
</style>
@endsection
