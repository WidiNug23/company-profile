@extends('admin.layouts.app')

@section('title', 'Edit Service')
@section('page-title', 'Edit Service')

@section('content')

<div class="service-form-wrapper">
    <div class="service-card">

        <!-- HEADER -->
        <div class="service-header">
            <h2>Edit Service</h2>
            <p>Perbarui layanan yang ditampilkan di website</p>
        </div>

        {{-- ERROR VALIDATION --}}
        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM -->
        <form method="POST"
              action="{{ route('services.update', $service->service_id) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- NAMA SERVICE -->
            <div class="form-group">
                <label>Nama Service</label>
                <input
                    type="text"
                    name="service_name"
                    class="form-control"
                    value="{{ old('service_name', $service->service_name) }}"
                    required>
            </div>

            <!-- DESKRIPSI (QUILL EDITOR) -->
            <div class="form-group">
                <label>Deskripsi Service</label>

                <div id="editor">
                    {!! old('description', $service->description) !!}
                </div>

                <input type="hidden" name="description" id="description_hidden">
            </div>

            <!-- ICON IMAGE -->
            <div class="form-group">
                <label>Icon Service (Upload Gambar)</label>

                <label class="icon-upload">
                    <img id="iconPreview"
                         src="{{ $service->icon
                                ? asset('storage/' . $service->icon)
                                : 'https://via.placeholder.com/64?text=Icon' }}">
                    <div class="icon-text">
                        Klik untuk upload icon baru (PNG / JPG / SVG)
                    </div>
                    <input
                        type="file"
                        name="icon"
                        accept="image/*"
                        hidden
                        onchange="previewIcon(this)">
                </label>
            </div>

            <!-- ACTION -->
            <div class="form-actions">
                <a href="{{ route('services.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-save">Update Service</button>
            </div>

        </form>
    </div>
</div>

@endsection

{{-- ================== STYLES ================== --}}
@push('styles')
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

<style>
:root {
    --primary: #2563eb;
    --primary-gradient: linear-gradient(135deg, #2563eb, #4f46e5);
    --border: #e5e7eb;
    --shadow: rgba(0,0,0,0.12);
    --error: #dc2626;
}

/* WRAPPER */
.service-form-wrapper {
    max-width: 820px;
    margin: 40px auto;
    font-family: 'Inter', sans-serif;
}

/* CARD */
.service-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 15px 40px var(--shadow);
    border-top: 6px solid var(--primary);
    animation: fadeUp .6s ease;
}

/* HEADER */
.service-header h2 {
    font-size: 28px;
    font-weight: 800;
    color: #111827;
}
.service-header p {
    color: #6b7280;
    margin-top: 6px;
}

/* ANIMATION */
@keyframes fadeUp {
    from { opacity:0; transform: translateY(20px); }
    to { opacity:1; transform: translateY(0); }
}

/* ERROR */
.errors {
    background: #fdecea;
    border: 1px solid #f5c6cb;
    color: var(--error);
    padding: 16px 20px;
    border-radius: 12px;
    margin: 25px 0;
}

/* FORM */
.form-group {
    margin-bottom: 28px;
}
.form-group label {
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
    display: block;
}
.form-control {
    width: 100%;
    padding: 14px 16px;
    border-radius: 12px;
    border: 1px solid var(--border);
    background: #f9fafb;
}
.form-control:focus {
    border-color: #6366f1;
    box-shadow: 0 0 15px rgba(99,102,241,.25);
    outline: none;
}

/* QUILL */
#editor {
    height: 340px;
    background: #ffffff;
    border: 2px solid #6366f1;
    border-radius: 12px;
}

/* ICON UPLOAD */
.icon-upload {
    border: 2px dashed var(--border);
    border-radius: 16px;
    padding: 24px;
    text-align: center;
    cursor: pointer;
    transition: .3s;
}
.icon-upload:hover {
    border-color: var(--primary);
    background: #f8fafc;
}
.icon-upload img {
    width: 64px;
    height: 64px;
    object-fit: contain;
    margin-bottom: 10px;
}
.icon-text {
    font-size: 14px;
    color: #6b7280;
}

/* BUTTON */
.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 14px;
    margin-top: 35px;
}
.btn-cancel {
    padding: 12px 22px;
    border-radius: 12px;
    border: 1px solid var(--border);
    background: #ffffff;
    font-weight: 600;
}
.btn-save {
    padding: 14px 32px;
    border-radius: 14px;
    background: var(--primary-gradient);
    color: #fff;
    font-weight: 700;
    border: none;
    cursor: pointer;
    box-shadow: 0 6px 22px rgba(37,99,235,.35);
}
.btn-save:hover {
    transform: translateY(-2px);
}

/* RESPONSIVE */
@media (max-width:768px) {
    .service-card {
        padding: 28px;
    }
}
</style>
@endpush

{{-- ================== SCRIPTS ================== --}}
@push('scripts')
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>

<script>
const toolbarOptions = [
    [{ header: [1, 2, 3, false] }],
    ['bold', 'italic', 'underline'],
    [{ color: [] }, { background: [] }],
    [{ list: 'ordered' }, { list: 'bullet' }],
    [{ align: [] }],
    ['link'],
    ['clean']
];

const quill = new Quill('#editor', {
    theme: 'snow',
    placeholder: 'Tulis deskripsi service di sini...',
    modules: { toolbar: toolbarOptions }
});

document.querySelector('form').addEventListener('submit', function () {
    document.getElementById('description_hidden').value = quill.root.innerHTML;
});

/* PREVIEW ICON */
function previewIcon(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('iconPreview').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
