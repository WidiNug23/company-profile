@extends('admin.layouts.app')

@section('title', 'Edit Certification')
@section('page-title', 'Edit Certification')

@section('content')
<div class="card">

    <h2 class="card-title">Edit Certification</h2>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('certifications.update', $certification->certification_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="certification_name">Nama Certification</label>
            <input type="text" id="certification_name" name="certification_name" value="{{ old('certification_name', $certification->certification_name) }}" required placeholder="Masukkan nama certification">
        </div>

        <div class="form-group">
            <label for="file">File (Gambar/PDF)</label>
            <input type="file" id="file" name="file" accept=".jpg,.jpeg,.png,.pdf">

            @if($certification->file)
                @php
                    $ext = pathinfo($certification->file, PATHINFO_EXTENSION);
                @endphp

                @if(in_array(strtolower($ext), ['jpg','jpeg','png','gif']))
                    <!-- Thumbnail gambar -->
                    <a href="{{ asset('storage/'.$certification->file) }}" target="_blank" style="display:block; margin-top:10px;">
                        <img src="{{ asset('storage/'.$certification->file) }}" alt="File" style="max-width:150px; max-height:100px; border-radius:6px; object-fit:cover; border:1px solid #d1d5db;">
                    </a>
                @elseif(strtolower($ext) === 'pdf')
                    <!-- Icon PDF -->
                    <a href="{{ asset('storage/'.$certification->file) }}" target="_blank" style="display:inline-flex; align-items:center; gap:5px; margin-top:10px; text-decoration:none;">
                        <img src="https://cdn-icons-png.flaticon.com/512/337/337946.png" alt="PDF" style="width:30px; height:30px;">
                        <span style="color:#1f2937; font-weight:500;">PDF</span>
                    </a>
                @else
                    <!-- File lain -->
                    <a href="{{ asset('storage/'.$certification->file) }}" target="_blank" style="display:block; margin-top:10px; color:#1f2937; text-decoration:underline; font-weight:500;">
                        {{ basename($certification->file) }}
                    </a>
                @endif
            @endif
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <div id="editor">{!! old('description', $certification->description) !!}</div>
            <input type="hidden" name="description" id="description_hidden">
        </div>

        <div class="form-actions">
            <button type="submit">Update Certification</button>
        </div>
    </form>
</div>
@endsection

@push('styles')
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<style>
.card {
    background: #fefefe;
    border-radius: 20px;
    padding: 50px 40px;
    max-width: 900px;
    margin: 50px auto;
    box-shadow: 0 15px 45px rgba(0,0,0,0.12);
    border-top: 6px solid #2563eb;
}
.card-title {
    font-size: 28px;
    font-weight: 700;
    color: #2563eb;
    text-align: center;
    margin-bottom: 35px;
}
.errors {
    background: #fdecea;
    border: 1px solid #f5c6cb;
    color: #d32f2f;
    padding: 18px 22px;
    border-radius: 14px;
    margin-bottom: 30px;
}
.errors li { margin-bottom: 6px; }
.form-group label { font-weight: 600; margin-bottom: 8px; display:block; color: #2563eb;}
.form-group input[type="text"], .form-group input[type="file"] {
    width: 100%; padding: 14px 18px; font-size: 15px; border-radius:12px; border:1px solid #d6d9d2; background:#f9faff;
}
#editor { height:350px; background:#fff; border:2px solid #4f46e5; border-radius:12px; margin-top:5px;}
.form-actions { text-align:center; margin-top:30px;}
.form-actions button { background: linear-gradient(135deg, #2563eb, #4f46e5); color:#fff; padding:16px 40px; font-size:17px; border:none; border-radius:14px; cursor:pointer; }
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
