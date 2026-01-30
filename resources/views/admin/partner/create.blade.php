@extends('admin.layouts.app')

@section('title', 'Tambah Partner')
@section('page-title', 'Tambah Partner')

@section('content')
<div class="card">

    <h2 class="card-title">Tambah Partner</h2>

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

    <form action="{{ route('partners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label for="partner_name">Nama Partner</label>
                <input type="text" id="partner_name" name="partner_name" value="{{ old('partner_name') }}" required placeholder="Masukkan nama partner">
            </div>

            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" id="logo" name="logo" accept="image/*">
            </div>
        </div>

        <!-- <div class="form-group">
            <label for="description">Deskripsi</label>
            <div id="editor">{!! old('description') !!}</div>
            <input type="hidden" name="description" id="description_hidden">
        </div> -->

        <div class="form-actions">
            <button type="submit">Simpan Partner</button>
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
    --bg-card: #fefefe;
    --border: #d6d9d2;
    --card-shadow: rgba(0,0,0,0.12);
    --error-color: #d32f2f;
}

/* CARD */
.card {
    background: var(--bg-card);
    border-radius: 20px;
    padding: 50px 40px;
    max-width: 900px;
    margin: 50px auto;
    box-shadow: 0 15px 45px var(--card-shadow);
    border-top: 6px solid var(--primary);
    animation: fadeInUp 0.8s ease forwards;
}

.card-title {
    font-size: 28px;
    font-weight: 700;
    color: var(--primary);
    text-align: center;
    margin-bottom: 35px;
}

/* ANIMATION */
@keyframes fadeInUp {
    0% { opacity:0; transform: translateY(25px); }
    100% { opacity:1; transform: translateY(0); }
}

/* ERROR */
.errors {
    background: #fdecea;
    border: 1px solid #f5c6cb;
    color: var(--error-color);
    padding: 18px 22px;
    border-radius: 14px;
    margin-bottom: 30px;
    font-size: 14px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
}
.errors li { margin-bottom: 6px; }

/* FORM */
.form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
    margin-bottom: 25px;
}

.form-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 8px;
    color: var(--primary);
    font-size: 15px;
}

.form-group input[type="text"],
.form-group input[type="file"] {
    width: 100%;
    padding: 14px 18px;
    font-size: 15px;
    border-radius: 12px;
    border: 1px solid var(--border);
    outline: none;
    background: #f9faff;
    transition: all 0.3s ease;
}
.form-group input:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 15px rgba(79,70,229,0.25);
}

/* QUILL EDITOR */
#editor {
    height: 350px;
    background: #fff;
    border: 2px solid #4f46e5;
    border-radius: 12px;
    margin-top: 5px;
}

/* BUTTON */
.form-actions {
    text-align: center;
    margin-top: 30px;
}
.form-actions button {
    background: var(--primary-gradient);
    color: #fff;
    padding: 16px 40px;
    font-size: 17px;
    font-weight: 700;
    border: none;
    border-radius: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 5px 20px rgba(37,99,235,0.3);
}
.form-actions button:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(37,99,235,0.35);
}

/* RESPONSIVE */
@media(max-width:768px){
    .card { padding: 30px 25px; margin: 25px; }
    .form-row { grid-template-columns: 1fr; gap: 20px; }
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
var toolbarOptions = [
    [{ 'font': [] }, { 'size': ['small', false, 'large', 'huge'] }],
    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
    ['bold', 'italic', 'underline', 'strike'],
    [{ 'color': [] }, { 'background': [] }],
    [{ 'script': 'sub'}, { 'script': 'super' }],
    ['blockquote', 'code-block'],
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    [{ 'align': [] }],
    ['link', 'image', 'video'],
    ['clean']
];

var quill = new Quill('#editor', {
    theme: 'snow',
    placeholder: 'Tulis deskripsi partner di sini...',
    modules: {
        toolbar: toolbarOptions,
        history: { delay: 1000, maxStack: 100, userOnly: true }
    }
});

document.querySelector('form').addEventListener('submit', function(){
    document.getElementById('description_hidden').value = quill.root.innerHTML;
});
</script>
@endpush
