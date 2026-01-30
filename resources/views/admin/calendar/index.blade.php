@extends('admin.layouts.app')

@section('title', 'Content Calendar')
@section('page-title', 'Content Calendar')

@section('content')
<div style="padding:20px;">

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h2>Daftar Content Calendar</h2>
        <a href="{{ route('calendar.create') }}" style="background:#2563eb; color:#fff; padding:8px 18px; border-radius:6px;">+ Tambah Kalender</a>
    </div>

    @if(session('success'))
        <div style="background:#d1fae5; color:#065f46; padding:12px 18px; border-radius:8px; margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <table style="width:100%; border-collapse:collapse; background:#fff;">
        <thead style="background:#1f2937; color:#fff;">
            <tr>
                <th style="padding:12px;">No</th>
                <th style="padding:12px;">Title</th>
                <th style="padding:12px;">Note</th>
                <th style="padding:12px;">Schedule Date</th>
                <th style="padding:12px;">Created By</th>
                <th style="padding:12px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($calendars as $calendar)
            <tr style="border-bottom:1px solid #d6d9d2;">
                <td style="padding:12px;">{{ $loop->iteration }}</td>
                <td style="padding:12px;">{{ $calendar->title }}</td>
                <td style="padding:12px;">{{ $calendar->note }}</td>
<td style="padding:12px;">{{ $calendar->scheduled_date }}</td>
                <td style="padding:12px;">{{ $calendar->user->name ?? '-' }}</td>
                <td style="padding:12px;">
<a href="{{ route('calendar.edit', $calendar->calendar_id) }}" class="btn btn-warning">Edit</a>
<form action="{{ route('calendar.destroy', $calendar->calendar_id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus item ini?')">Hapus</button>
</form>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center; padding:20px;">Belum ada Content Calendar</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
