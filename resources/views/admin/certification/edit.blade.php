@extends('admin.layouts.app')

@section('title', 'Edit Certification')
@section('page-title', 'Edit Certification')

@section('content')
<div class="cert-wrapper">
    <div class="cert-card edit-border">
        <div class="cert-header">
            <div class="circle-icon edit-icon"><i class="fas fa-edit"></i></div>
            <div>
                <h3>Edit Sertifikasi</h3>
                <p>Memperbarui data: <strong>{{ $certification->certification_name }}</strong></p>
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

        <form action="{{ route('certifications.update', $certification->certification_id) }}" method="POST" enctype="multipart/form-data" id="editCertForm">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="main-inputs">
                    <div class="input-group">
                        <label for="certification_name">Nama Sertifikasi</label>
                        <input type="text" id="certification_name" name="certification_name" value="{{ old('certification_name', $certification->certification_name) }}" required>
                    </div>

                    <div class="input-group">
                        <label>Deskripsi Sertifikasi</label>
                        <div class="quill-wrapper">
                            <div id="editor-container">{!! old('description', $certification->description) !!}</div>
                        </div>
                        <input type="hidden" name="description" id="description_hidden">
                    </div>
                </div>

                <div class="side-inputs">
                    <label>File Saat Ini</label>
                    <div class="upload-area edit-upload" onclick="document.getElementById('file').click()">
                        @php
                            $ext = pathinfo($certification->file, PATHINFO_EXTENSION);
                            $isPdf = strtolower($ext) === 'pdf';
                        @endphp

                        @if($certification->file)
                            <img id="preview" src="{{ $isPdf ? 'https://cdn-icons-png.flaticon.com/512/337/337946.png' : asset('storage/'.$certification->file) }}" alt="file">
                        @else
                            <img id="preview" src="https://via.placeholder.com/300x400?text=No+File" alt="preview">
                        @endif

                        <div class="overlay">
                            <i class="fas fa-sync-alt"></i>
                            <span>Ganti File</span>
                        </div>
                        <input type="file" id="file" name="file" accept=".jpg,.jpeg,.png,.pdf" hidden onchange="previewFile(this)">
                    </div>
                    @if($isPdf)
                        <div style="text-align:center; margin-top:10px;">
                            <a href="{{ asset('storage/'.$certification->file) }}" target="_blank" class="btn-view-pdf">Lihat PDF <i class="fas fa-external-link-alt"></i></a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('certifications.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-update">
                    <i class="fas fa-sync-alt"></i> Update Sertifikasi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<style>
    :root { --edit-color: #0d9488; --border: #e2e8f0; --bg-light: #f0fdfa; }
    .cert-wrapper { max-width: 1000px; margin: 40px auto; padding: 0 20px; font-family: 'Inter', sans-serif; }
    .cert-card { background: #fff; border-radius: 24px; padding: 40px; box-shadow: 0 20px 50px rgba(0,0,0,0.05); }
    .edit-border { border-top: 6px solid var(--edit-color); }
    .cert-header { display: flex; align-items: center; gap: 20px; margin-bottom: 35px; }
    .edit-icon { background: var(--edit-color) !important; color: white; width: 55px; height: 55px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 22px; }
    .form-grid { display: grid; grid-template-columns: 1fr 280px; gap: 40px; }
    .input-group label { display: block; margin-bottom: 10px; font-weight: 600; color: #475569; }
    .input-group input { width: 100%; padding: 14px 18px; border-radius: 12px; border: 1.5px solid var(--border); background: var(--bg-light); transition: 0.3s; }
    .quill-wrapper { border-radius: 12px; overflow: hidden; border: 1.5px solid var(--border); }
    .upload-area { width: 100%; aspect-ratio: 3/4; background: var(--bg-light); border-radius: 20px; border: 2px dashed #99f6e4; overflow: hidden; position: relative; cursor: pointer; }
    .upload-area img { width: 100%; height: 100%; object-fit: cover; }
    .upload-area .overlay { position: absolute; inset: 0; background: rgba(13, 148, 136, 0.8); color: white; display: flex; flex-direction: column; align-items: center; justify-content: center; opacity: 0; transition: 0.3s; }
    .upload-area:hover .overlay { opacity: 1; }
    .form-actions { margin-top: 40px; padding-top: 30px; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 15px; }
    .btn-update { background: linear-gradient(135deg, #0d9488, #0f766e); color: white; border: none; padding: 12px 30px; border-radius: 12px; font-weight: 700; cursor: pointer; }
    .btn-view-pdf { font-size: 13px; color: #0d9488; text-decoration: none; font-weight: 600; }
    .alert-errors { background: #fff1f2; border: 1px solid #fecaca; color: #be123c; padding: 15px; border-radius: 12px; margin-bottom: 25px; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
    var quill = new Quill('#editor-container', {
        theme: 'snow',
        modules: { toolbar: [[{ 'header': [1, 2, false] }], ['bold', 'italic', 'underline'], [{ 'list': 'ordered'}, { 'list': 'bullet' }], ['link', 'clean']] }
    });

    document.getElementById('editCertForm').onsubmit = function() {
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