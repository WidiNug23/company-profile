@extends('admin.layouts.app')

@section('title', 'Tambah Client')
@section('page-title', 'Tambah Client')

@section('content')
<div class="client-wrapper">
    <div class="client-card">
        <div class="client-header">
            <div class="circle-icon"><i class="fas fa-user-tie"></i></div>
            <div>
                <h3>Tambah Client Baru</h3>
                <p>Input data mitra atau client baru ke dalam sistem.</p>
            </div>
        </div>

        {{-- ERROR VALIDATION --}}
        @if ($errors->any())
            <div class="alert-errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data" id="clientForm">
            @csrf

            <div class="form-grid">
                <div class="main-inputs">
                    <div class="input-group">
                        <label for="client_name">Nama Client / Perusahaan</label>
                        <input type="text" id="client_name" name="client_name" value="{{ old('client_name') }}" required placeholder="Contoh: PT. Maju Bersama">
                    </div>

                    <div class="input-group">
                        <label>Deskripsi Client</label>
                        <div class="quill-wrapper">
                            <div id="editor-container">{!! old('description') !!}</div>
                        </div>
                        <input type="hidden" name="description" id="description_hidden">
                    </div>
                </div>

                <div class="side-inputs">
                    <label>Logo / Foto Client</label>
                    <div class="upload-area" onclick="document.getElementById('picture').click()">
                        <img id="preview" src="https://via.placeholder.com/300x300?text=Upload+Logo" alt="preview">
                        <div class="overlay">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>Pilih File</span>
                        </div>
                        <input type="file" id="picture" name="picture" accept="image/*" hidden onchange="previewImg(this)">
                    </div>
                    <p class="upload-hint">Format: JPG, PNG, WEBP. Maks 2MB.</p>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('clients.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Simpan Client
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<style>
    :root {
        --primary: #2563eb;
        --border: #e2e8f0;
        --bg-light: #f8fafc;
        --text-dark: #1e293b;
    }

    .client-wrapper { max-width: 1000px; margin: 40px auto; padding: 0 20px; font-family: 'Inter', sans-serif; }
    
    .client-card { 
        background: #ffffff; border-radius: 24px; padding: 40px; 
        box-shadow: 0 20px 50px rgba(0,0,0,0.05); border-top: 6px solid var(--primary);
        animation: fadeUp .6s ease-out;
    }

    @keyframes fadeUp { from { opacity:0; transform: translateY(20px); } to { opacity:1; transform: translateY(0); } }

    .client-header { display: flex; align-items: center; gap: 20px; margin-bottom: 35px; }
    .circle-icon { width: 55px; height: 55px; background: var(--primary); color: white; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 22px; }
    .client-header h3 { margin: 0; color: var(--text-dark); font-weight: 700; font-size: 24px; }
    .client-header p { margin: 5px 0 0; color: #64748b; }

    .form-grid { display: grid; grid-template-columns: 1fr 280px; gap: 40px; }

    .input-group { margin-bottom: 25px; }
    .input-group label { display: block; margin-bottom: 10px; font-weight: 600; color: #475569; font-size: 15px; }
    .input-group input { 
        width: 100%; padding: 14px 18px; border-radius: 12px; border: 1.5px solid var(--border); 
        background: var(--bg-light); transition: 0.3s;
    }
    .input-group input:focus { border-color: var(--primary); outline: none; background: white; box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1); }

    /* Quill Styling */
    .quill-wrapper { border-radius: 12px; overflow: hidden; border: 1.5px solid var(--border); }
    .ql-toolbar.ql-snow { border: none !important; background: #f1f5f9 !important; border-bottom: 1px solid var(--border) !important; }
    .ql-container.ql-snow { border: none !important; height: 250px; font-size: 15px; }

    /* Upload Styling */
    .upload-area { 
        width: 100%; aspect-ratio: 1/1; background: var(--bg-light); border-radius: 20px; 
        border: 2px dashed #cbd5e1; overflow: hidden; position: relative; cursor: pointer; transition: 0.3s;
    }
    .upload-area:hover { border-color: var(--primary); background: #eff6ff; }
    .upload-area img { width: 100%; height: 100%; object-fit: cover; }
    .upload-area .overlay { position: absolute; inset: 0; background: rgba(37, 99, 235, 0.8); color: white; display: flex; flex-direction: column; align-items: center; justify-content: center; opacity: 0; transition: 0.3s; gap: 8px; }
    .upload-area:hover .overlay { opacity: 1; }
    .upload-hint { font-size: 12px; color: #94a3b8; margin-top: 12px; text-align: center; }

    .form-actions { margin-top: 40px; padding-top: 30px; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 15px; }
    .btn-cancel { padding: 12px 25px; border-radius: 12px; color: #64748b; text-decoration: none; font-weight: 600; }
    .btn-submit { background: linear-gradient(135deg, #2563eb, #4f46e5); color: white; border: none; padding: 12px 35px; border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.3s; display: flex; align-items: center; gap: 8px; }
    .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2); }

    .alert-errors { background: #fff1f2; border: 1px solid #fecaca; color: #be123c; padding: 15px; border-radius: 12px; margin-bottom: 25px; }
    .alert-errors ul { margin: 0; padding-left: 20px; }

    @media (max-width: 850px) { .form-grid { grid-template-columns: 1fr; } .side-inputs { order: -1; max-width: 200px; margin: 0 auto; } }
</style>
@endpush

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
    var quill = new Quill('#editor-container', {
        theme: 'snow',
        placeholder: 'Tuliskan deskripsi atau testimoni client...',
        modules: {
            toolbar: [[{ 'header': [1, 2, false] }], ['bold', 'italic', 'underline'], [{ 'list': 'ordered'}, { 'list': 'bullet' }], ['link', 'clean']]
        }
    });

    document.getElementById('clientForm').onsubmit = function() {
        document.getElementById('description_hidden').value = quill.root.innerHTML;
    };

    function previewImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = e => document.getElementById('preview').src = e.target.result;
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush