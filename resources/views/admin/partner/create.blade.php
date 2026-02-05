@extends('admin.layouts.app')

@section('title', 'Tambah Partner')
@section('page-title', 'Tambah Partner')

@section('content')
<div class="partner-wrapper">
    <div class="partner-card">
        <div class="partner-header">
            <div class="circle-icon"><i class="fas fa-handshake"></i></div>
            <div>
                <h3>Tambah Partner Baru</h3>
                <p>Silakan masukkan nama perusahaan dan unggah logo partner.</p>
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

        <form action="{{ route('partners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-content">
                <div class="upload-section">
                    <label>Logo Partner</label>
                    <div class="upload-box" onclick="document.getElementById('logo').click()">
                        <img id="preview" src="https://via.placeholder.com/300x300?text=Pilih+Logo" alt="preview">
                        <div class="upload-overlay">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>Unggah Logo</span>
                        </div>
                        <input type="file" id="logo" name="logo" accept="image/*" hidden onchange="previewImg(this)">
                    </div>
                    <p class="hint">Format: PNG, JPG, atau SVG. Maks 2MB.</p>
                </div>

                <div class="input-section">
                    <div class="input-group">
                        <label for="partner_name">Nama Partner / Instansi</label>
                        <input type="text" id="partner_name" name="partner_name" value="{{ old('partner_name') }}" required placeholder="Contoh: Microsoft Corporation">
                    </div>

                    <div class="info-box">
                        <i class="fas fa-info-circle"></i>
                        <span>Logo akan ditampilkan di halaman depan website pada bagian daftar partner.</span>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('partners.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Simpan Partner
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
        --border: #e2e8f0;
        --bg-light: #f8fafc;
        --text-dark: #1e293b;
    }

    .partner-wrapper { max-width: 800px; margin: 40px auto; padding: 0 20px; font-family: 'Inter', sans-serif; }
    
    .partner-card { 
        background: #ffffff; border-radius: 24px; padding: 40px; 
        box-shadow: 0 20px 50px rgba(0,0,0,0.05); border-top: 6px solid var(--primary);
        animation: fadeUp .6s ease-out;
    }

    @keyframes fadeUp { from { opacity:0; transform: translateY(20px); } to { opacity:1; transform: translateY(0); } }

    .partner-header { display: flex; align-items: center; gap: 20px; margin-bottom: 40px; }
    .circle-icon { width: 55px; height: 55px; background: var(--primary); color: white; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 22px; }
    .partner-header h3 { margin: 0; color: var(--text-dark); font-weight: 700; font-size: 24px; }
    .partner-header p { margin: 5px 0 0; color: #64748b; }

    .form-content { display: flex; gap: 40px; align-items: flex-start; }

    /* Upload Styling */
    .upload-section { flex: 0 0 220px; text-align: center; }
    .upload-section label { display: block; margin-bottom: 12px; font-weight: 600; color: #475569; }
    .upload-box { width: 100%; aspect-ratio: 1/1; background: white; border-radius: 20px; border: 2px dashed #cbd5e1; overflow: hidden; position: relative; cursor: pointer; transition: 0.3s; }
    .upload-box:hover { border-color: var(--primary); }
    .upload-box img { width: 100%; height: 100%; object-fit: contain; padding: 15px; }
    .upload-overlay { position: absolute; inset: 0; background: rgba(37, 99, 235, 0.9); color: white; display: flex; flex-direction: column; align-items: center; justify-content: center; opacity: 0; transition: 0.3s; gap: 8px; }
    .upload-box:hover .upload-overlay { opacity: 1; }
    .hint { font-size: 11px; color: #94a3b8; margin-top: 10px; }

    /* Input Styling */
    .input-section { flex: 1; }
    .input-group { margin-bottom: 25px; }
    .input-group label { display: block; margin-bottom: 10px; font-weight: 600; color: #475569; font-size: 15px; }
    .input-group input { width: 100%; padding: 14px 18px; border-radius: 12px; border: 1.5px solid var(--border); background: var(--bg-light); transition: 0.3s; }
    .input-group input:focus { border-color: var(--primary); outline: none; background: white; box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1); }

    .info-box { background: #eff6ff; padding: 15px; border-radius: 12px; display: flex; gap: 12px; color: #1e40af; font-size: 13px; line-height: 1.5; }

    .form-actions { margin-top: 40px; padding-top: 30px; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 15px; }
    .btn-cancel { padding: 12px 25px; border-radius: 12px; color: #64748b; text-decoration: none; font-weight: 600; }
    .btn-submit { background: linear-gradient(135deg, #2563eb, #4f46e5); color: white; border: none; padding: 12px 35px; border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.3s; display: flex; align-items: center; gap: 8px; }
    .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2); }

    .alert-errors { background: #fff1f2; border: 1px solid #fecaca; color: #be123c; padding: 15px; border-radius: 12px; margin-bottom: 25px; font-size: 14px; }
    .alert-errors ul { margin: 0; padding-left: 20px; }

    @media (max-width: 650px) { .form-content { flex-direction: column; } .upload-section { width: 100%; } }
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