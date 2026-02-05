@extends('admin.layouts.app')

@section('title', 'Edit Partner')
@section('page-title', 'Edit Partner')

@section('content')
<div class="partner-wrapper">
    <div class="partner-card edit-mode">
        <div class="partner-header">
            <div class="circle-icon edit-icon"><i class="fas fa-edit"></i></div>
            <div>
                <h3>Edit Partner</h3>
                <p>Mengubah data partner: <strong>{{ $partner->partner_name }}</strong></p>
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

        <form action="{{ route('partners.update', $partner->partner_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-content">
                <div class="upload-section">
                    <label>Logo Partner</label>
                    <div class="upload-box" onclick="document.getElementById('logo').click()">
                        @if($partner->logo)
                            <img id="preview" src="{{ asset('storage/'.$partner->logo) }}" alt="logo">
                        @else
                            <img id="preview" src="https://via.placeholder.com/300x300?text=No+Logo" alt="preview">
                        @endif
                        <div class="upload-overlay edit-overlay">
                            <i class="fas fa-sync-alt"></i>
                            <span>Ganti Logo</span>
                        </div>
                        <input type="file" id="logo" name="logo" accept="image/*" hidden onchange="previewImg(this)">
                    </div>
                    <p class="hint">Biarkan kosong jika tidak ingin ganti logo.</p>
                </div>

                <div class="input-section">
                    <div class="input-group">
                        <label for="partner_name">Nama Partner / Instansi</label>
                        <input type="text" id="partner_name" name="partner_name" value="{{ old('partner_name', $partner->partner_name) }}" required>
                    </div>

                    <div class="info-box status-box">
                        <i class="fas fa-check-circle"></i>
                        <span>Partner ini saat ini aktif dan ditampilkan di website utama.</span>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('partners.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-update">
                    <i class="fas fa-sync-alt"></i> Update Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    :root {
        --edit-amber: #f59e0b;
        --border: #e2e8f0;
        --bg-edit: #fffdfa;
        --text-dark: #1e293b;
    }

    .partner-wrapper { max-width: 800px; margin: 40px auto; padding: 0 20px; font-family: 'Inter', sans-serif; }
    
    .partner-card { background: #ffffff; border-radius: 24px; padding: 40px; box-shadow: 0 20px 50px rgba(0,0,0,0.05); }
    .edit-mode { border-top: 6px solid var(--edit-amber); }

    .partner-header { display: flex; align-items: center; gap: 20px; margin-bottom: 40px; }
    .circle-icon { width: 55px; height: 55px; background: #2563eb; color: white; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 22px; }
    .edit-icon { background: var(--edit-amber); box-shadow: 0 8px 15px rgba(245, 158, 11, 0.2); }
    .partner-header h3 { margin: 0; color: var(--text-dark); font-weight: 700; font-size: 24px; }
    .partner-header p { margin: 5px 0 0; color: #64748b; }

    .form-content { display: flex; gap: 40px; align-items: flex-start; }

    /* Upload */
    .upload-section { flex: 0 0 220px; text-align: center; }
    .upload-section label { display: block; margin-bottom: 12px; font-weight: 600; color: #475569; }
    .upload-box { width: 100%; aspect-ratio: 1/1; background: white; border-radius: 20px; border: 2px dashed #fcd34d; overflow: hidden; position: relative; cursor: pointer; }
    .upload-box img { width: 100%; height: 100%; object-fit: contain; padding: 15px; }
    .upload-overlay { position: absolute; inset: 0; background: rgba(217, 119, 6, 0.9); color: white; display: flex; flex-direction: column; align-items: center; justify-content: center; opacity: 0; transition: 0.3s; gap: 8px; }
    .upload-box:hover .upload-overlay { opacity: 1; }
    .hint { font-size: 11px; color: #94a3b8; margin-top: 10px; }

    /* Inputs */
    .input-section { flex: 1; }
    .input-group { margin-bottom: 25px; }
    .input-group label { display: block; margin-bottom: 10px; font-weight: 600; color: #475569; font-size: 15px; }
    .input-group input { width: 100%; padding: 14px 18px; border-radius: 12px; border: 1.5px solid var(--border); background: var(--bg-edit); transition: 0.3s; }
    .input-group input:focus { border-color: var(--edit-amber); outline: none; background: white; box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1); }

    .info-box { background: #fffbeb; padding: 15px; border-radius: 12px; display: flex; gap: 12px; color: #92400e; font-size: 13px; }

    .form-actions { margin-top: 40px; padding-top: 30px; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 15px; }
    .btn-cancel { padding: 12px 25px; border-radius: 12px; color: #64748b; text-decoration: none; font-weight: 600; }
    .btn-update { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; border: none; padding: 12px 35px; border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.3s; display: flex; align-items: center; gap: 8px; }
    .btn-update:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(245, 158, 11, 0.2); }

    .alert-errors { background: #fff1f2; border: 1px solid #fecaca; color: #be123c; padding: 15px; border-radius: 12px; margin-bottom: 25px; }

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