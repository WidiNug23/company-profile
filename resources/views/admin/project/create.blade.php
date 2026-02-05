@extends('admin.layouts.app')

@section('title', 'Tambah Project')
@section('page-title', 'Tambah Project')

@section('content')
<div class="project-wrapper">
    <div class="project-card">
        <div class="project-header">
            <div class="circle-icon"><i class="fas fa-briefcase"></i></div>
            <div>
                <h3>Tambah Project Baru</h3>
                <p>Silakan isi detail project untuk portofolio website.</p>
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

        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" id="projectForm">
            @csrf

            <div class="form-grid">
                <div class="main-inputs">
                    <div class="input-group">
                        <label for="project_name">Nama Project</label>
                        <input type="text" id="project_name" name="project_name" value="{{ old('project_name') }}" required placeholder="Contoh: Modern Office Building">
                    </div>

                    <div class="row-inputs">
                        <div class="input-group">
                            <label for="location">Location</label>
                            <input type="text" id="location" name="location" value="{{ old('location') }}" required placeholder="Contoh: Jakarta, Indonesia">
                        </div>

                        <div class="input-group">
                            <label for="year">Year</label>
                            <input type="number" id="year" name="year" value="{{ old('year', date('Y')) }}" required placeholder="2024">
                        </div>
                    </div>
                </div>

                <div class="side-inputs">
                    <label>Thumbnail Project</label>
                    <div class="upload-area" onclick="document.getElementById('thumbnail').click()">
                        <img id="preview" src="https://via.placeholder.com/300x200?text=Upload+Thumbnail" alt="preview">
                        <div class="overlay">
                            <i class="fas fa-camera"></i>
                            <span>Pilih Gambar</span>
                        </div>
                        <input type="file" id="thumbnail" name="thumbnail" accept="image/*" hidden onchange="previewImg(this)">
                    </div>
                    <p class="upload-hint">Format: JPG, PNG, WEBP. Maks 2MB.</p>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('projects.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Simpan Project
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    :root {
        --primary: #2563eb;
        --primary-gradient: linear-gradient(135deg, #2563eb, #4f46e5);
        --bg-light: #f8fafc;
        --text-dark: #1e293b;
        --border: #e2e8f0;
    }

    .project-wrapper { max-width: 950px; margin: 40px auto; padding: 0 20px; font-family: 'Inter', sans-serif; }
    
    .project-card { 
        background: #ffffff; border-radius: 24px; padding: 40px; 
        box-shadow: 0 20px 50px rgba(0,0,0,0.05); border-top: 6px solid var(--primary);
        animation: fadeUp .6s ease-out;
    }

    @keyframes fadeUp { from { opacity:0; transform: translateY(20px); } to { opacity:1; transform: translateY(0); } }

    .project-header { display: flex; align-items: center; gap: 20px; margin-bottom: 35px; }
    .circle-icon { width: 55px; height: 55px; background: var(--primary); color: white; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 22px; box-shadow: 0 8px 15px rgba(37, 99, 235, 0.2); }
    .project-header h3 { margin: 0; color: var(--text-dark); font-weight: 700; font-size: 24px; }
    .project-header p { margin: 5px 0 0; color: #64748b; }

    .form-grid { display: grid; grid-template-columns: 1fr 300px; gap: 40px; }
    .row-inputs { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

    .input-group { margin-bottom: 25px; }
    .input-group label { display: block; margin-bottom: 10px; font-weight: 600; color: #475569; font-size: 15px; }
    .input-group input { 
        width: 100%; padding: 14px 18px; border-radius: 12px; border: 1.5px solid var(--border); 
        background: var(--bg-light); transition: 0.3s; font-size: 15px;
    }
    .input-group input:focus { border-color: var(--primary); outline: none; background: white; box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1); }

    .upload-area { 
        width: 100%; height: 200px; background: var(--bg-light); border-radius: 20px; 
        border: 2px dashed #cbd5e1; overflow: hidden; position: relative; cursor: pointer; 
        transition: 0.3s; display: flex; align-items: center; justify-content: center;
    }
    .upload-area:hover { border-color: var(--primary); background: #eff6ff; }
    .upload-area img { width: 100%; height: 100%; object-fit: cover; transition: 0.3s; }
    .upload-area .overlay { 
        position: absolute; inset: 0; background: rgba(37, 99, 235, 0.85); 
        color: white; display: flex; flex-direction: column; align-items: center; 
        justify-content: center; opacity: 0; transition: 0.3s; gap: 10px;
    }
    .upload-area:hover .overlay { opacity: 1; }
    .upload-hint { font-size: 13px; color: #94a3b8; margin-top: 15px; text-align: center; }

    .form-actions { 
        margin-top: 40px; padding-top: 30px; border-top: 1px solid #f1f5f9; 
        display: flex; justify-content: flex-end; gap: 15px; 
    }
    .btn-cancel { padding: 12px 25px; border-radius: 12px; color: #64748b; text-decoration: none; font-weight: 600; transition: 0.3s; }
    .btn-cancel:hover { background: #f1f5f9; }
    
    .btn-submit { 
        background: var(--primary-gradient); color: white; border: none; padding: 12px 35px; 
        border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.3s; 
        display: flex; align-items: center; gap: 8px; box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);
    }
    .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 12px 25px rgba(37, 99, 235, 0.3); }

    .alert-errors { background: #fff1f2; border: 1px solid #fecaca; color: #be123c; padding: 15px; border-radius: 12px; margin-bottom: 25px; }
    .alert-errors ul { margin: 0; padding-left: 20px; }

    @media (max-width: 850px) { 
        .form-grid { grid-template-columns: 1fr; } 
        .side-inputs { order: -1; } 
    }
</style>
@endpush

@push('scripts')
<script>
    function previewImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = e => document.getElementById('preview').src = e.target.result;
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush