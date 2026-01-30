@extends('admin.layouts.app')

@section('title', 'Tambah Certification')
@section('page-title', 'Tambah Certification')

@section('content')
<div class="card">

    <h2 class="card-title">Tambah Certification</h2>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('certifications.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="certification_name">Nama Certification</label>
            <input type="text" id="certification_name" name="certification_name" value="{{ old('certification_name') }}" required placeholder="Masukkan nama certification">
        </div>

        <div class="form-group">
            <label for="file">File (Gambar/PDF)</label>
            <input type="file" id="file" name="file" accept=".jpg,.jpeg,.png,.pdf">
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <div id="editor">{!! old('description') !!}</div>
            <input type="hidden" name="description" id="description_hidden">
        </div>

        <div class="form-actions">
            <button type="submit">Simpan Certification</button>
        </div>
    </form>
</div>
@endsection

@push('styles')
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<style>
:root {
    --primary: #2563eb;
    --primary-gradient: linear-gradient(135deg, #2563eb, #4f46e5);
    --bg-card: #fefefe;
    --border: #d6d9d2;
    --card-shadow: rgba(0,0,0,0.12);
    --error-color: #d32f2f;
}
.card {
    background: var(--bg-card);
    border-radius: 20px;
    padding: 50px 40px;
    max-width: 900px;
    margin: 50px auto;
    box-shadow: 0 15px 45px var(--card-shadow);
    border-top: 6px solid var(--primary);
}
.card-title {
    font-size: 28px;
    font-weight: 700;
    color: var(--primary);
    text-align: center;
    margin-bottom: 35px;
}
.errors {
    background: #fdecea;
    border: 1px solid #f5c6cb;
    color: var(--error-color);
    padding: 18px 22px;
    border-radius: 14px;
    margin-bottom: 30px;
}
.errors li { margin-bottom: 6px; }
.form-group label { font-weight: 600; margin-bottom: 8px; display:block; color: var(--primary);}
.form-group input[type="text"], .form-group input[type="file"] {
    width: 100%; padding: 14px 18px; font-size: 15px; border-radius:12px; border:1px solid var(--border); background:#f9faff;
}
#editor { height:350px; background:#fff; border:2px solid #4f46e5; border-radius:12px; margin-top:5px;}
.form-actions { text-align:center; margin-top:30px;}
.form-actions button { background:var(--primary-gradient); color:#fff; padding:16px 40px; font-size:17px; border:none; border-radius:14px; cursor:pointer; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
var quill = new Quill('#editor', {
    theme: 'snow',
    placeholder: 'Tulis deskripsi sertifikasi di sini...',
    modules: { toolbar: [
        [{ 'font': [] }, { 'size': ['small', false, 'large', 'huge'] }],
        ['bold','italic','underline','strike'],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        ['link','image','video'],
        ['clean']
    ] }
});

document.querySelector('form').addEventListener('submit', function(){
    document.getElementById('description_hidden').value = quill.root.innerHTML;
});
</script>
@endpush
