@extends('admin.layouts.app')

@section('title', 'Edit Content Calendar')
@section('page-title', 'Edit Content Calendar')

@section('content')
<div class="calendar-wrapper">
    <div class="calendar-card edit-border">
        <div class="calendar-header">
            <div class="circle-icon edit-icon"><i class="fas fa-edit"></i></div>
            <div>
                <h3>Edit Jadwal Konten</h3>
                <p>Perbarui rencana konten: <strong>{{ $calendar->title }}</strong></p>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert-errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('calendar.update', $calendar->calendar_id) }}" method="POST" id="editCalendarForm">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="title">Judul Konten</label>
                <input type="text" id="title" name="title" value="{{ old('title', $calendar->title) }}" required>
            </div>

            <div class="form-group">
                <label for="scheduled_date">Tanggal Penjadwalan</label>
                <input type="date" id="scheduled_date" name="scheduled_date" value="{{ old('scheduled_date', $calendar->scheduled_date) }}" required>
            </div>

            <div class="form-group">
                <label>Catatan Detail (Note)</label>
                <div class="quill-container">
                    <div id="editor-note">{!! old('note', $calendar->note) !!}</div>
                </div>
                <input type="hidden" name="note" id="note_hidden">
            </div>

            <div class="form-actions">
                <a href="{{ route('calendar.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-update">
                    <i class="fas fa-sync-alt"></i> Update Jadwal
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<style>
    :root { --edit-indigo: #4f46e5; --border: #e2e8f0; --bg-edit: #f5f7ff; }
    .calendar-wrapper { max-width: 850px; margin: 40px auto; padding: 0 20px; font-family: 'Inter', sans-serif; }
    .calendar-card { background: #fff; border-radius: 24px; padding: 40px; box-shadow: 0 20px 50px rgba(0,0,0,0.05); }
    .edit-border { border-top: 6px solid var(--edit-indigo); }
    .calendar-header { display: flex; align-items: center; gap: 20px; margin-bottom: 35px; }
    .circle-icon { width: 55px; height: 55px; color: white; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 22px; }
    .edit-icon { background: var(--edit-indigo); }
    .form-group { margin-bottom: 25px; }
    .form-group label { display: block; margin-bottom: 10px; font-weight: 600; color: #475569; }
    .form-group input { width: 100%; padding: 14px 18px; border-radius: 12px; border: 1.5px solid var(--border); background: var(--bg-edit); transition: 0.3s; }
    .quill-container { border-radius: 12px; overflow: hidden; border: 1.5px solid var(--border); background: white; }
    .ql-editor { min-height: 200px; font-size: 15px; }
    .form-actions { margin-top: 40px; padding-top: 30px; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 15px; }
    .btn-update { background: linear-gradient(135deg, #4f46e5, #3730a3); color: white; border: none; padding: 12px 35px; border-radius: 12px; font-weight: 700; cursor: pointer; }
    .alert-errors { background: #fff1f2; border: 1px solid #fecaca; color: #be123c; padding: 15px; border-radius: 12px; margin-bottom: 25px; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
    var quill = new Quill('#editor-note', {
        theme: 'snow',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link', 'clean']
            ]
        }
    });

    document.getElementById('editCalendarForm').onsubmit = function() {
        document.getElementById('note_hidden').value = quill.root.innerHTML;
    };
</script>
@endpush