@extends('layouts.front')

@section('title', 'Content Calendar')

@section('content')
<div style="max-width:1200px; margin:50px auto; padding:0 20px; font-family:'Inter', sans-serif;">

    <h1 style="font-size:36px; font-weight:700; color:#2563eb; text-align:center; margin-bottom:40px;">Content Calendar</h1>

    @if($calendars->isEmpty())
        <p style="text-align:center; color:#6b7280;">Belum ada content calendar</p>
    @else
        <div style="display:grid; gap:20px; grid-template-columns:repeat(auto-fit, minmax(300px, 1fr));">
            @foreach($calendars as $calendar)
                <div style="background:#fff; padding:20px; border-radius:15px; box-shadow:0 8px 20px rgba(0,0,0,0.08); border-left:5px solid #2563eb;">
                    <h2 style="font-size:22px; font-weight:600; color:#111;">{{ $calendar->title }}</h2>
                    <p style="color:#374151; margin:10px 0;">{{ $calendar->note }}</p>
                    <p style="font-size:14px; color:#6b7280;">Scheduled Date: {{ \Carbon\Carbon::parse($calendar->scheduled_date)->translatedFormat('d M Y') }}</p>
                    <p style="font-size:14px; color:#6b7280;">Created by: {{ $calendar->user->name ?? '-' }}</p>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
