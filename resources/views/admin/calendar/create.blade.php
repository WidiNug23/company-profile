@extends('admin.layouts.app')

@section('title', 'Tambah Content Calendar')
@section('page-title', 'Tambah Content Calendar')

@section('content')
<div class="card">
    <h2 class="card-title">Tambah Content Calendar</h2>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('calendar.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title') }}" required>
        </div>
        <div class="form-group">
            <label>Note</label>
            <textarea name="note">{{ old('note') }}</textarea>
        </div>
<div class="form-group">
    <label>Scheduled Date</label>
    <input type="date" name="scheduled_date" value="{{ old('scheduled_date', $calendar->scheduled_date ?? '') }}" required>
</div>

        <div class="form-actions">
            <button type="submit">Simpan</button>
        </div>
    </form>
</div>
@endsection
