@extends('admin.layouts.app')

@section('title', 'Tambah Profil')
@section('page-title', 'Tambah Company Profile')

@section('content')
<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            <i class="fas fa-plus-circle"></i>
            <div>
                <h4>Buat Informasi Baru</h4>
                <p>Silakan isi formulir di bawah untuk menambah informasi profil perusahaan.</p>
            </div>
        </div>

        <form method="POST" action="{{ route('company-profile.store') }}">
            @csrf

            <div class="form-group-custom">
                <label for="title"><i class="fas fa-heading"></i> Judul Informasi</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" 
                       required placeholder="Contoh: Visi dan Misi Perusahaan">
                @error('title') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group-custom">
                <label><i class="fas fa-align-left"></i> Deskripsi Lengkap</label>
                <div id="editor-container">{!! old('description') !!}</div>
                <input type="hidden" name="description" id="description_hidden">
                @error('description') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-footer">
                <a href="{{ route('company-profile.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-save">
                    <i class="fas fa-paper-plane"></i> Simpan Company Profile
                </button>
            </div>
        </form>
    </div>
</div>

@push('styles')
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<style>
    .form-container { max-width: 900px; margin: 0 auto; animation: fadeInUp 0.4s ease; }
    .form-card { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); border: 1px solid #f1f5f9; }
    
    .form-header { display: flex; align-items: center; gap: 15px; margin-bottom: 35px; padding-bottom: 20px; border-bottom: 1px solid #f8fafc; }
    .form-header i { font-size: 2.5rem; color: var(--primary-accent); }
    .form-header h4 { font-size: 1.25rem; color: #1e293b; margin: 0; }
    .form-header p { color: #94a3b8; font-size: 0.9rem; margin: 0; }

    .form-group-custom { margin-bottom: 25px; }
    .form-group-custom label { display: block; margin-bottom: 10px; font-weight: 600; color: #1e293b; font-size: 0.95rem; }
    .form-group-custom input { 
        width: 100%; padding: 14px 18px; border-radius: 12px; border: 1px solid #e2e8f0; 
        font-size: 1rem; transition: 0.3s; background: #f8fafc;
    }
    .form-group-custom input:focus { outline: none; border-color: var(--primary-accent); background: white; box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1); }
    
    #editor-container { height: 350px; border-radius: 0 0 12px 12px; font-size: 1rem; }
    .ql-toolbar { border-radius: 12px 12px 0 0; background: #f8fafc; border-color: #e2e8f0; }
    .ql-container { border-color: #e2e8f0; }
    
    .form-footer { display: flex; justify-content: flex-end; gap: 15px; margin-top: 35px; padding-top: 25px; border-top: 1px solid #f1f5f9; }
    .btn-cancel { text-decoration: none; color: #64748b; padding: 12px 25px; font-weight: 600; border-radius: 10px; transition: 0.3s; }
    .btn-cancel:hover { background: #f1f5f9; }
    .btn-save { background: var(--primary-accent); color: white; border: none; padding: 12px 30px; border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2); }
    .btn-save:hover { opacity: 0.9; transform: translateY(-2px); box-shadow: 0 6px 15px rgba(99, 102, 241, 0.3); }
    .error-msg { color: #dc2626; font-size: 0.85rem; margin-top: 8px; display: block; font-weight: 500; }

    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endpush

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
    var quill = new Quill('#editor-container', {
        theme: 'snow',
        placeholder: 'Tuliskan deskripsi profil di sini...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link', 'image', 'clean']
            ]
        }
    });

    document.querySelector('form').onsubmit = function() {
        document.getElementById('description_hidden').value = quill.root.innerHTML;
    };
</script>
@endpush
@endsection