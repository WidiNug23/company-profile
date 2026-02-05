@extends('admin.layouts.app')

@section('title', 'Tambah Service')

@section('content')
<div class="form-wrapper">
    <div class="form-card">
        <div class="form-header">
            <div class="circle-icon"><i class="fas fa-plus"></i></div>
            <div>
                <h3>Tambah Service Baru</h3>
                <p>Isi detail layanan untuk ditampilkan di halaman depan website.</p>
            </div>
        </div>

        {{-- ALERT ERROR --}}
        @if ($errors->any())
            <div class="alert alert-danger-custom">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><i class="fas fa-exclamation-triangle"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data" id="serviceForm">
            @csrf

            <div class="form-grid">
                <div class="main-inputs">
                    <div class="input-group">
                        <label for="service_name">Nama Service</label>
                        <input type="text" 
                               name="service_name" 
                               id="service_name"
                               value="{{ old('service_name') }}" 
                               placeholder="Contoh: Web Development & Mobile App" 
                               required>
                    </div>

                    <div class="input-group">
                        <label>Deskripsi Service</label>
                        <div id="editor-wrapper">
                            <div id="editor-container">{!! old('description') !!}</div>
                        </div>
                        <input type="hidden" name="description" id="description_hidden">
                    </div>
                </div>

                <div class="side-inputs">
                    <label>Icon / Ilustrasi</label>
                    <div class="upload-area" onclick="document.getElementById('icon-input').click()">
                        <img id="preview" src="https://via.placeholder.com/150?text=Upload+Icon" alt="preview">
                        <div class="overlay">
                            <i class="fas fa-camera"></i>
                            <span>Ganti Icon</span>
                        </div>
                        <input type="file" name="icon" id="icon-input" accept="image/*" hidden onchange="previewImg(this)">
                    </div>
                    <p class="upload-hint">Gunakan format <strong>PNG, SVG, atau JPG</strong>. Rekomendasi rasio 1:1.</p>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('services.index') }}" class="btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Simpan Layanan
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
        --primary-blue: #2563eb;
        --soft-bg: #f8fafc;
        --border-color: #e2e8f0;
        --text-dark: #1e293b;
    }

    .form-wrapper { max-width: 1050px; margin: 40px auto; padding: 0 20px; font-family: 'Inter', sans-serif; }
    
    .form-card { 
        background: white; 
        border-radius: 24px; 
        padding: 40px; 
        box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.02);
    }
    
    .form-header { display: flex; align-items: center; gap: 20px; margin-bottom: 35px; }
    .circle-icon { width: 55px; height: 55px; background: var(--primary-blue); color: white; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 22px; box-shadow: 0 8px 15px rgba(37, 99, 235, 0.2); }
    .form-header h3 { margin: 0; color: var(--text-dark); font-weight: 700; font-size: 24px; }
    .form-header p { margin: 5px 0 0; color: #64748b; }
    
    .form-grid { display: grid; grid-template-columns: 1fr 300px; gap: 40px; }
    
    .input-group { margin-bottom: 25px; }
    .input-group label { display: block; margin-bottom: 10px; font-weight: 600; color: #475569; font-size: 15px; }
    .input-group input { 
        width: 100%; padding: 14px 18px; border-radius: 12px; border: 1.5px solid var(--border-color); 
        background: var(--soft-bg); transition: 0.3s; font-size: 15px;
    }
    .input-group input:focus { border-color: var(--primary-blue); outline: none; background: white; box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1); }

    /* Quill Customization */
    #editor-wrapper { border-radius: 12px; overflow: hidden; border: 1.5px solid var(--border-color); }
    #editor-container { height: 350px; font-size: 16px; background: white; }
    .ql-toolbar.ql-snow { border: none !important; background: #f1f5f9 !important; border-bottom: 1.5px solid var(--border-color) !important; padding: 12px !important; }
    .ql-container.ql-snow { border: none !important; }

    /* Upload Area */
    .upload-area { 
        width: 100%; height: 220px; background: var(--soft-bg); border-radius: 20px; 
        border: 2px dashed #cbd5e1; overflow: hidden; position: relative; cursor: pointer; 
        transition: 0.3s; display: flex; align-items: center; justify-content: center;
    }
    .upload-area:hover { border-color: var(--primary-blue); background: #eff6ff; }
    .upload-area img { max-width: 100%; max-height: 100%; object-fit: contain; padding: 20px; transition: 0.3s; }
    .upload-area .overlay { 
        position: absolute; inset: 0; background: rgba(37, 99, 235, 0.85); 
        color: white; display: flex; flex-direction: column; align-items: center; 
        justify-content: center; opacity: 0; transition: 0.3s; gap: 10px;
    }
    .upload-area:hover .overlay { opacity: 1; }
    .upload-area:hover img { transform: scale(1.1); }
    .upload-hint { font-size: 13px; color: #94a3b8; margin-top: 15px; text-align: center; line-height: 1.5; }

    /* Actions */
    .form-actions { 
        margin-top: 40px; padding-top: 30px; border-top: 1px solid #f1f5f9; 
        display: flex; justify-content: flex-end; gap: 15px; 
    }
    .btn-secondary { 
        padding: 12px 25px; border-radius: 12px; color: #64748b; text-decoration: none; 
        font-weight: 600; transition: 0.3s; display: flex; align-items: center; gap: 8px;
    }
    .btn-secondary:hover { background: #f1f5f9; color: var(--text-dark); }
    
    .btn-submit { 
        background: var(--primary-blue); color: white; border: none; padding: 12px 35px; 
        border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.3s; 
        display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }
    .btn-submit:hover { background: #1d4ed8; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3); }

    .alert-danger-custom { background: #fff1f2; border: 1px solid #fecaca; color: #be123c; padding: 15px; border-radius: 12px; margin-bottom: 25px; }
    .alert-danger-custom ul { margin: 0; padding-left: 20px; }

    @media (max-width: 850px) { 
        .form-grid { grid-template-columns: 1fr; } 
        .side-inputs { order: -1; max-width: 300px; margin: 0 auto; } 
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
    // Konfigurasi Toolbar Sesuai Permintaan
    var toolbarOptions = [
        [{ 'header': [1, 2, 3, false] }],
        ['bold', 'italic', 'underline'],
        [{ 'color': [] }, { 'background': [] }],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        ['link', 'image', 'clean']
    ];

    // Inisialisasi Quill
    var quill = new Quill('#editor-container', { 
        theme: 'snow', 
        placeholder: 'Tuliskan deskripsi layanan secara detail di sini...',
        modules: {
            toolbar: toolbarOptions
        }
    });

    // Sinkronisasi data ke input hidden saat form disubmit
    var form = document.getElementById('serviceForm');
    form.onsubmit = function() {
        var description = document.querySelector('input[name=description]');
        description.value = quill.root.innerHTML;
        
        // Cek jika editor kosong
        if (quill.root.innerText.trim().length === 0) {
            description.value = ''; 
        }
    };

    // Preview Image Upload
    function previewImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush