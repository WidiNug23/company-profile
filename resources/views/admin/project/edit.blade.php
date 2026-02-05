@extends('admin.layouts.app')

@section('title', 'Edit Project')
@section('page-title', 'Edit Project')

@section('content')
<div class="project-wrapper">
    <div class="project-card edit-mode">
        <div class="project-header">
            <div class="circle-icon edit-icon"><i class="fas fa-edit"></i></div>
            <div>
                <h3>Edit Project</h3>
                <p>Mengubah data project: <strong>{{ $project->project_name }}</strong></p>
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

        <form action="{{ route('projects.update', $project->project_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="main-inputs">
                    <div class="input-group">
                        <label for="project_name">Nama Project</label>
                        <input type="text" id="project_name" name="project_name" value="{{ old('project_name', $project->project_name) }}" required>
                    </div>

                    <div class="row-inputs">
                        <div class="input-group">
                            <label for="location">Location</label>
                            <input type="text" id="location" name="location" value="{{ old('location', $project->location) }}" required>
                        </div>

                        <div class="input-group">
                            <label for="year">Year</label>
                            <input type="number" id="year" name="year" value="{{ old('year', $project->year) }}" required>
                        </div>
                    </div>
                </div>

                <div class="side-inputs">
                    <label>Thumbnail Saat Ini</label>
                    <div class="upload-area" onclick="document.getElementById('thumbnail').click()">
                        @if($project->thumbnail)
                            <img id="preview" src="{{ asset('storage/'.$project->thumbnail) }}" alt="thumbnail">
                        @else
                            <img id="preview" src="https://via.placeholder.com/300x200?text=No+Image" alt="preview">
                        @endif
                        <div class="overlay">
                            <i class="fas fa-sync-alt"></i>
                            <span>Ganti Gambar</span>
                        </div>
                        <input type="file" id="thumbnail" name="thumbnail" accept="image/*" hidden onchange="previewImg(this)">
                    </div>
                    <p class="upload-hint">Biarkan kosong jika tidak ingin mengubah thumbnail.</p>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('projects.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-update">
                    <i class="fas fa-sync-alt"></i> Update Project
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Menggunakan base style yang sama dengan create untuk konsistensi */
    :root {
        --edit-color: #f59e0b;
        --edit-gradient: linear-gradient(135deg, #f59e0b, #d97706);
        --border: #e2e8f0;
        --text-dark: #1e293b;
    }

    .project-wrapper { max-width: 950px; margin: 40px auto; padding: 0 20px; font-family: 'Inter', sans-serif; }
    
    .project-card { 
        background: #ffffff; border-radius: 24px; padding: 40px; 
        box-shadow: 0 20px 50px rgba(0,0,0,0.05); border-top: 6px solid var(--edit-color);
    }

    .project-header { display: flex; align-items: center; gap: 20px; margin-bottom: 35px; }
    .circle-icon { width: 55px; height: 55px; background: #2563eb; color: white; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 22px; }
    .edit-icon { background: var(--edit-color); box-shadow: 0 8px 15px rgba(245, 158, 11, 0.2); }
    .project-header h3 { margin: 0; color: var(--text-dark); font-weight: 700; font-size: 24px; }

    .form-grid { display: grid; grid-template-columns: 1fr 300px; gap: 40px; }
    .row-inputs { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

    .input-group { margin-bottom: 25px; }
    .input-group label { display: block; margin-bottom: 10px; font-weight: 600; color: #475569; }
    .input-group input { width: 100%; padding: 14px 18px; border-radius: 12px; border: 1.5px solid var(--border); background: #fffdfa; transition: 0.3s; }
    .input-group input:focus { border-color: var(--edit-color); outline: none; box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1); }

    .upload-area { width: 100%; height: 200px; background: #fffdfa; border-radius: 20px; border: 2px dashed #fcd34d; overflow: hidden; position: relative; cursor: pointer; display: flex; align-items: center; justify-content: center; }
    .upload-area img { width: 100%; height: 100%; object-fit: cover; }
    .upload-area .overlay { position: absolute; inset: 0; background: rgba(217, 119, 6, 0.85); color: white; display: flex; flex-direction: column; align-items: center; justify-content: center; opacity: 0; transition: 0.3s; gap: 10px; }
    .upload-area:hover .overlay { opacity: 1; }
    .upload-hint { font-size: 13px; color: #94a3b8; margin-top: 15px; text-align: center; }

    .form-actions { margin-top: 40px; padding-top: 30px; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 15px; }
    .btn-cancel { padding: 12px 25px; border-radius: 12px; color: #64748b; text-decoration: none; font-weight: 600; }
    
    .btn-update { 
        background: var(--edit-gradient); color: white; border: none; padding: 12px 35px; 
        border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.3s; 
        display: flex; align-items: center; gap: 8px; box-shadow: 0 10px 20px rgba(245, 158, 11, 0.2);
    }
    .btn-update:hover { transform: translateY(-2px); box-shadow: 0 12px 25px rgba(217, 119, 6, 0.3); }

    .alert-errors { background: #fff1f2; border: 1px solid #fecaca; color: #be123c; padding: 15px; border-radius: 12px; margin-bottom: 25px; }
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