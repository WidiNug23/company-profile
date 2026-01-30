@extends('admin.layouts.app')

@section('title', 'Edit Client')
@section('page-title', 'Edit Client')

@section('content')
<div class="card">

    <h2 class="card-title">Edit Client</h2>

    <!-- ERROR VALIDATION -->
    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clients.update', $client->client_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="client_name">Nama Client</label>
            <input type="text" id="client_name" name="client_name" value="{{ old('client_name', $client->client_name) }}" required placeholder="Masukkan nama client">
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <!-- Text editor Quill -->
            <div id="editor">{!! old('description', $client->description) !!}</div>
            <input type="hidden" name="description" id="description_hidden">
        </div>

        <div class="form-group">
            <label for="picture">Picture</label>
            <input type="file" id="picture" name="picture">
            @if($client->picture)
                <img src="{{ asset('storage/'.$client->picture) }}" width="80" style="object-fit:cover; border-radius:6px; margin-top:10px;">
            @endif
        </div>

        <div class="form-actions">
            <button type="submit">Update Client</button>
        </div>
    </form>
</div>
@endsection

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

/* CARD */
.card {
    background: #ffffff;
    border-radius: 20px;
    padding: 45px 40px;
    max-width: 700px;
    margin: 40px auto;
    box-shadow: 0 15px 40px var(--shadow);
    border-top: 6px solid var(--primary);
    animation: fadeUp .7s ease;
}

.card-title {
    text-align: center;
    font-size: 26px;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 35px;
}

/* ANIMATION */
@keyframes fadeUp {
    from { opacity:0; transform: translateY(25px); }
    to { opacity:1; transform: translateY(0); }
}

/* ERROR */
.errors {
    background: #fdecea;
    border: 1px solid #f5c6cb;
    color: var(--error);
    padding: 16px 20px;
    border-radius: 12px;
    margin-bottom: 25px;
}
.errors li {
    margin-bottom: 6px;
}

/* FORM */
.form-group {
    margin-bottom: 28px;
}
.form-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 8px;
    color: var(--primary);
    font-size: 15px;
}
.form-group input,
.form-group textarea {
    width: 100%;
    padding: 14px 18px;
    font-size: 15px;
    border-radius: 12px;
    border: 1px solid var(--border);
    background: #f9fafb;
    transition: .3s;
    resize: vertical;
}
.form-group input:focus,
.form-group textarea:focus {
    border-color: #6366f1;
    box-shadow: 0 0 15px rgba(99,102,241,.25);
    outline: none;
}

/* QUILL EDITOR */
#editor {
    height: 250px;
    background: #ffffff;
    border: 2px solid #6366f1;
    border-radius: 12px;
}

/* BUTTON */
.form-actions {
    text-align: center;
    margin-top: 35px;
}
.form-actions button {
    background: var(--primary-gradient);
    color: #ffffff;
    padding: 15px 42px;
    font-size: 16px;
    font-weight: 700;
    border: none;
    border-radius: 14px;
    cursor: pointer;
    transition: .3s;
    box-shadow: 0 5px 22px rgba(37,99,235,.35);
}
.form-actions button:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 28px rgba(37,99,235,.45);
}

/* RESPONSIVE */
@media (max-width:768px) {
    .card {
        padding: 30px 25px;
        margin: 25px;
    }
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
const toolbarOptions = [
    [{ 'header': [1, 2, 3, false] }],
    ['bold', 'italic', 'underline', 'strike'],
    [{ 'color': [] }, { 'background': [] }],
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    [{ 'align': [] }],
    ['link', 'image'],
    ['clean']
];

const quill = new Quill('#editor', {
    theme: 'snow',
    placeholder: 'Tulis deskripsi client di sini...',
    modules: { toolbar: toolbarOptions }
});

// Set initial value untuk edit (jika ada)
document.addEventListener('DOMContentLoaded', function() {
    quill.root.innerHTML = `{!! old('description', $client->description) !!}`;
});

document.querySelector('form').addEventListener('submit', function () {
    document.getElementById('description_hidden').value = quill.root.innerHTML;
});
</script>
@endpush
