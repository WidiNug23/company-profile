@extends('admin.layouts.app')

@section('title', 'Edit Client')
@section('page-title', 'Edit Client')

@section('content')
<div class="client-wrapper">
    <div class="client-card edit-border">
        <div class="client-header">
            <div class="circle-icon edit-icon"><i class="fas fa-user-edit"></i></div>
            <div>
                <h3>Edit Client</h3>
                <p>Memperbarui informasi client: <strong>{{ $client->client_name }}</strong></p>
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

        <form action="{{ route('clients.update', $client->client_id) }}" method="POST" enctype="multipart/form-data" id="editClientForm">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="main-inputs">
                    <div class="input-group">
                        <label for="client_name">Nama Client / Perusahaan</label>
                        <input type="text" id="client_name" name="client_name" value="{{ old('client_name', $client->client_name) }}" required>
                    </div>

                    <div class="input-group">
                        <label>Deskripsi Client</label>
                        <div class="quill-wrapper">
                            <div id="editor-container">{!! old('description', $client->description) !!}</div>
                        </div>
                        <input type="hidden" name="description" id="description_hidden">
                    </div>
                </div>

                <div class="side-inputs">
                    <label>Logo / Foto Client</label>
                    <div class="upload-area edit-upload-area" onclick="document.getElementById('picture').click()">
                        @if($client->picture)
                            <img id="preview" src="{{ asset('storage/'.$client->picture) }}" alt="client picture">
                        @else
                            <img id="preview" src="https://via.placeholder.com/300x300?text=No+Logo" alt="preview">
                        @endif
                        <div class="overlay">
                            <i class="fas fa-sync-alt"></i>
                            <span>Ganti Foto</span>
                        </div>
                        <input type="file" id="picture" name="picture" accept="image/*" hidden onchange="previewImg(this)">
                    </div>
                    <p class="upload-hint">Biarkan kosong jika tidak ingin mengubah foto.</p>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('clients.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-update">
                    <i class="fas fa-sync-alt"></i> Update Client
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
        --edit-amber: #f59e0b;
        --border: #e2e8f0;
        --bg-edit: #fffdfa;
        --text-dark: #1e293b;
    }

    .client-wrapper { max-width: 1000px; margin: 40px auto; padding: 0 20px; font-family: 'Inter', sans-serif; }
    
    .client-card { background: #ffffff; border-radius: 24px; padding: 40px; box-shadow: 0 20px 50px rgba(0,0,0,0.05); }
    .edit-border { border-top: 6px solid var(--edit-amber); }

    .client-header { display: flex; align-items: center; gap: 20px; margin-bottom: 35px; }
    .circle-icon { width: 55px; height: 55px; background: #2563eb; color: white; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 22px; }
    .edit-icon { background: var(--edit-amber); box-shadow: 0 8px 15px rgba(245, 158, 11, 0.2); }
    
    .client-header h3 { margin: 0; color: var(--text-dark); font-weight: 700; font-size: 24px; }
    .client-header p { margin: 5px 0 0; color: #64748b; }

    .form-grid { display: grid; grid-template-columns: 1fr 280px; gap: 40px; }

    .input-group { margin-bottom: 25px; }
    .input-group label { display: block; margin-bottom: 10px; font-weight: 600; color: #475569; }
    .input-group input { width: 100%; padding: 14px 18px; border-radius: 12px; border: 1.5px solid var(--border); background: var(--bg-edit); transition: 0.3s; }
    .input-group input:focus { border-color: var(--edit-amber); outline: none; background: white; box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1); }

    .quill-wrapper { border-radius: 12px; overflow: hidden; border: 1.5px solid var(--border); background: white; }
    .ql-toolbar.ql-snow { border: none !important; background: #f8fafc !important; border-bottom: 1px solid var(--border) !important; }
    .ql-container.ql-snow { border: none !important; height: 250px; font-size: 15px; }

    .upload-area { width: 100%; aspect-ratio: 1/1; background: var(--bg-edit); border-radius: 20px; border: 2px dashed #fcd34d; overflow: hidden; position: relative; cursor: pointer; }
    .upload-area img { width: 100%; height: 100%; object-fit: cover; }
    .upload-area .overlay { position: absolute; inset: 0; background: rgba(217, 119, 6, 0.85); color: white; display: flex; flex-direction: column; align-items: center; justify-content: center; opacity: 0; transition: 0.3s; gap: 8px; }
    .upload-area:hover .overlay { opacity: 1; }
    .upload-hint { font-size: 12px; color: #94a3b8; margin-top: 12px; text-align: center; }

    .form-actions { margin-top: 40px; padding-top: 30px; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 15px; }
    .btn-cancel { padding: 12px 25px; border-radius: 12px; color: #64748b; text-decoration: none; font-weight: 600; }
    
    .btn-update { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; border: none; padding: 12px 35px; border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.3s; display: flex; align-items: center; gap: 8px; }
    .btn-update:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(245, 158, 11, 0.2); }

    .alert-errors { background: #fff1f2; border: 1px solid #fecaca; color: #be123c; padding: 15px; border-radius: 12px; margin-bottom: 25px; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
    var quill = new Quill('#editor-container', {
        theme: 'snow',
        modules: {
            toolbar: [[{ 'header': [1, 2, false] }], ['bold', 'italic', 'underline'], [{ 'list': 'ordered'}, { 'list': 'bullet' }], ['link', 'clean']]
        }
    });

    document.getElementById('editClientForm').onsubmit = function() {
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