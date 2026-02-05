@extends('admin.layouts.app')

@section('title', 'Tambah Certification')
@section('page-title', 'Tambah Certification')

@section('content')
<div class="cert-wrapper">
    <div class="cert-card">
        <div class="cert-header">
            <div class="circle-icon"><i class="fas fa-certificate"></i></div>
            <div>
                <h3>Tambah Sertifikasi Baru</h3>
                <p>Input data sertifikasi atau penghargaan ke dalam sistem.</p>
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

        <form action="{{ route('certifications.store') }}" method="POST" enctype="multipart/form-data" id="certForm">
            @csrf

            <div class="form-grid">
                <div class="main-inputs">
                    <div class="input-group">
                        <label for="certification_name">Nama Sertifikasi</label>
                        <input type="text" id="certification_name" name="certification_name" value="{{ old('certification_name') }}" required placeholder="Contoh: ISO 9001:2015">
                    </div>

                    <div class="input-group">
                        <label>Deskripsi Sertifikasi</label>
                        <div class="quill-wrapper">
                            <div id="editor-container">{!! old('description') !!}</div>
                        </div>
                        <input type="hidden" name="description" id="description_hidden">
                    </div>
                </div>

                <div class="side-inputs">
                    <label>File Sertifikat (JPG/PNG/PDF)</label>
                    <div class="upload-area" onclick="document.getElementById('file').click()">
                        <img id="preview" src="https://via.placeholder.com/300x400?text=Pilih+File" alt="preview">
                        <div class="overlay">
                            <i class="fas fa-file-upload"></i>
                            <span>Upload File</span>
                        </div>
                        <input type="file" id="file" name="file" accept=".jpg,.jpeg,.png,.pdf" hidden onchange="previewFile(this)">
                    </div>
                    <p class="upload-hint">Format: Gambar atau PDF. Maks 2MB.</p>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('certifications.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Simpan Sertifikasi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<style>
    :root { --primary: #2563eb; --border: #e2e8f0; --bg-light: #f8fafc; }
    .cert-wrapper { max-width: 1000px; margin: 40px auto; padding: 0 20px; font-family: 'Inter', sans-serif; }
    .cert-card { background: #fff; border-radius: 24px; padding: 40px; box-shadow: 0 20px 50px rgba(0,0,0,0.05); border-top: 6px solid var(--primary); animation: fadeUp .6s ease-out; }
    @keyframes fadeUp { from { opacity:0; transform: translateY(20px); } to { opacity:1; transform: translateY(0); } }
    .cert-header { display: flex; align-items: center; gap: 20px; margin-bottom: 35px; }
    .circle-icon { width: 55px; height: 55px; background: var(--primary); color: white; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 22px; }
    .form-grid { display: grid; grid-template-columns: 1fr 280px; gap: 40px; }
    .input-group { margin-bottom: 25px; }
    .input-group label { display: block; margin-bottom: 10px; font-weight: 600; color: #475569; }
    .input-group input { width: 100%; padding: 14px 18px; border-radius: 12px; border: 1.5px solid var(--border); background: var(--bg-light); transition: 0.3s; }
    .quill-wrapper { border-radius: 12px; overflow: hidden; border: 1.5px solid var(--border); }
    .ql-container.ql-snow { height: 250px; font-size: 15px; border: none !important; }
    .upload-area { width: 100%; aspect-ratio: 3/4; background: var(--bg-light); border-radius: 20px; border: 2px dashed #cbd5e1; overflow: hidden; position: relative; cursor: pointer; }
    .upload-area img { width: 100%; height: 100%; object-fit: cover; }
    .upload-area .overlay { position: absolute; inset: 0; background: rgba(37, 99, 235, 0.8); color: white; display: flex; flex-direction: column; align-items: center; justify-content: center; opacity: 0; transition: 0.3s; }
    .upload-area:hover .overlay { opacity: 1; }
    .form-actions { margin-top: 40px; padding-top: 30px; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 15px; }
    .btn-submit { background: linear-gradient(135deg, #2563eb, #4f46e5); color: white; border: none; padding: 12px 30px; border-radius: 12px; font-weight: 700; cursor: pointer; }
    .alert-errors { background: #fff1f2; border: 1px solid #fecaca; color: #be123c; padding: 15px; border-radius: 12px; margin-bottom: 25px; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
    var quill = new Quill('#editor-container', {
        theme: 'snow',
        placeholder: 'Tulis deskripsi sertifikasi...',
        modules: { toolbar: [[{ 'header': [1, 2, false] }], ['bold', 'italic', 'underline'], [{ 'list': 'ordered'}, { 'list': 'bullet' }], ['link', 'clean']] }
    });

    document.getElementById('certForm').onsubmit = function() {
        document.getElementById('description_hidden').value = quill.root.innerHTML;
    };

    function previewFile(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();
            
            if (file.type === "application/pdf") {
                document.getElementById('preview').src = "https://cdn-icons-png.flaticon.com/512/337/337946.png";
            } else {
                reader.onload = e => document.getElementById('preview').src = e.target.result;
                reader.readAsDataURL(file);
            }
        }
    }
</script>
@endpush