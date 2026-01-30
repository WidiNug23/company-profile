@extends('layouts.admin')

@section('title', 'Visitor Statistics')

@section('content')
<div class="container" style="padding:30px;">
    <h1>Visitor Statistics</h1>

    <div style="display:flex; gap:20px; flex-wrap:wrap; margin-top:20px;">
        <div class="card" style="flex:1; min-width:200px;">
            <h3>Total Visits</h3>
            <p style="font-size:24px; font-weight:bold;">{{ $totalVisitors }}</p>
        </div>

        <div class="card" style="flex:1; min-width:200px;">
            <h3>Unique Visitors</h3>
            <p style="font-size:24px; font-weight:bold;">{{ $uniqueVisitors }}</p>
        </div>
    </div>

    <div style="margin-top:30px;">
        <h3>Top Pages</h3>
        <table class="table" style="width:100%; border-collapse:collapse; margin-top:10px;">
            <thead>
                <tr style="background:#1a73e8; color:white;">
                    <th style="padding:10px; text-align:left;">Page URL</th>
                    <th style="padding:10px; text-align:left;">Hits</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topPages as $page)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $page->url }}</td>
                    <td style="padding:10px;">{{ $page->hits }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
