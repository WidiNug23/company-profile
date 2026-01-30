@extends('pimpinan.layouts.app')

@section('title', 'Dashboard Pimpinan')

@section('content')
<div class="container">

    <h2>Dashboard Pimpinan</h2>

    {{-- SUMMARY --}}
    <div style="display:flex; gap:20px; margin-bottom:30px;">
        <div style="padding:20px; background:#f3f4f6; border-radius:10px;">
            <h4>Total Visitor</h4>
            <p style="font-size:24px; font-weight:bold;">
                {{ $totalVisitors }}
            </p>
        </div>

        <div style="padding:20px; background:#e0f2fe; border-radius:10px;">
            <h4>Visitor Hari Ini</h4>
            <p style="font-size:24px; font-weight:bold;">
                {{ $todayVisitors }}
            </p>
        </div>
    </div>

    {{-- VISITOR PER DAY --}}
    <h4>Statistik Visitor (7 Hari Terakhir)</h4>
    <table border="1" cellpadding="10" cellspacing="0" width="100%">
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

    <br>

    {{-- CONTENT CALENDAR --}}
    <h4>Content Calendar</h4>
    <table border="1" cellpadding="10" cellspacing="0" width="100%">
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
@endsection
