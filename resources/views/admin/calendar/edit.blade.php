@extends('admin.layouts.app')

@section('title', 'Edit Content Calendar')
@section('page-title', 'Edit Content Calendar')

@section('content')
<div class="card" style="max-width:800px; margin:50px auto; padding:40px; border-radius:20px; box-shadow:0 15px 45px rgba(0,0,0,0.1); background:#fefefe; border-top:6px solid #2563eb;">
    <h2 class="card-title" style="text-align:center; font-size:28px; color:#2563eb; margin-bottom:30px;">Edit Content Calendar</h2>

    @if ($errors->any())
        <div class="errors" style="background:#fdecea; border:1px solid #f5c6cb; color:#d32f2f; padding:15px 20px; border-radius:12px; margin-bottom:20px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('calendar.update', $calendar->calendar_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group" style="margin-bottom:20px;">
            <label style="font-weight:600; margin-bottom:6px; display:block; color:#2563eb;">Title</label>
            <input type="text" name="title" value="{{ old('title', $calendar->title) }}" required placeholder="Masukkan title" style="width:100%; padding:12px 16px; border-radius:10px; border:1px solid #d6d9d2; background:#f9faff; font-size:15px;">
        </div>

        <div class="form-group" style="margin-bottom:20px;">
            <label style="font-weight:600; margin-bottom:6px; display:block; color:#2563eb;">Note</label>
            <textarea name="note" placeholder="Masukkan note" style="width:100%; padding:12px 16px; border-radius:10px; border:1px solid #d6d9d2; background:#f9faff; font-size:15px;" rows="5">{{ old('note', $calendar->note) }}</textarea>
        </div>

        <div class="form-group" style="margin-bottom:20px;">
            <label style="font-weight:600; margin-bottom:6px; display:block; color:#2563eb;">Scheduled Date</label>
            <input type="date" name="scheduled_date" value="{{ old('scheduled_date', $calendar->scheduled_date) }}" required style="width:100%; padding:12px 16px; border-radius:10px; border:1px solid #d6d9d2; background:#f9faff; font-size:15px;">
        </div>

        <div class="form-actions" style="text-align:center; margin-top:30px;">
            <button type="submit" style="background: linear-gradient(135deg, #2563eb, #4f46e5); color:#fff; padding:14px 35px; font-size:16px; border:none; border-radius:12px; cursor:pointer;">Update</button>
        </div>
    </form>
</div>
@endsection
