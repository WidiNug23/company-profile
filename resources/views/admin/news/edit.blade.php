@extends('admin.layouts.app')

@section('title', 'Edit Berita')

@section('content')
<div class="card">
    <h2 class="card-title">Edit Berita</h2>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('news.update', $news->id_berita) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" id="judul" name="judul" value="{{ $news->judul }}" required placeholder="Masukkan judul berita">
            </div>

            <div class="form-group">
                <label for="jenis_berita">Jenis Berita</label>
                <input type="text" id="jenis_berita" name="jenis_berita" value="{{ $news->jenis_berita }}" required placeholder="Contoh: Berita, Artikel, Pengumuman">
            </div>

            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" id="author" name="author" value="{{ $news->author }}" required placeholder="Nama penulis">
            </div>
        </div>

        <div class="form-group">
            <label for="isi">Isi Berita</label>
            <div id="editor">{!! $news->isi !!}</div>
            <input type="hidden" name="isi" id="isi_hidden">
        </div>

        @if ($news->image)
        <div class="image-preview">
            <p>Gambar Saat Ini:</p>
            <img src="{{ asset('storage/' . $news->image) }}" alt="Gambar berita" class="current-image">
        </div>
        @endif

        <div class="form-group">
            <label for="image">Ganti Gambar (opsional)</label>
            <input type="file" id="image" name="image" accept="image/*">
        </div>

        <div class="form-actions">
            <button type="submit">Update Berita</button>
        </div>
    </form>

    <div class="back-link">
        <a href="{{ route('news.index') }}">⬅ Kembali ke Daftar Berita</a>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<style>
:root {
    --primary: #1a73e8;
    --primary-gradient: linear-gradient(135deg, #1a73e8, #4facfe);
    --bg-card: #fefefe;
    --border: #d6d9d2;
    --card-shadow: rgba(0,0,0,0.12);
    --error-color: #d32f2f;
    --muted: #6b7280;
}

/* CARD */
.card {
    background: var(--bg-card);
    border-radius: 20px;
    padding: 50px 40px;
    max-width: 950px;
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
    letter-spacing: 0.5px;
}

/* ANIMASI */
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
    border-color: #4facfe;
    box-shadow: 0 0 15px rgba(79,172,254,0.25);
}

/* QUILL EDITOR */
#editor {
    height: 420px;
    background: #fff;
    border: 2px solid #4facfe;
    border-radius: 12px;
    margin-top: 5px;
}

/* IMAGE PREVIEW */
.image-preview {
    margin-bottom: 25px;
}
.image-preview p {
    font-weight: 600;
    margin-bottom: 8px;
}
.current-image {
    border-radius: 12px;
    max-width: 250px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
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
    box-shadow: 0 5px 20px rgba(26,115,232,0.3);
}
.form-actions button:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(26,115,232,0.35);
}

/* BACK LINK */
.back-link {
    text-align: center;
    margin-top: 25px;
}
.back-link a {
    color: #4facfe;
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s;
}
.back-link a:hover {
    text-decoration: underline;
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
    placeholder: 'Tulis berita di sini...',
    modules: {
        toolbar: toolbarOptions,
        history: { delay: 1000, maxStack: 100, userOnly: true }
    }
});

document.querySelector('form').addEventListener('submit', function(){
    document.getElementById('isi_hidden').value = quill.root.innerHTML;
});
</script>
@endpush
