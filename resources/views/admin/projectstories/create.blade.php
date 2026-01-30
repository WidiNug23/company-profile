@extends('admin.layouts.app')

@section('title', 'Tambah Project Story')
@section('page-title', 'Tambah Project Story')

@section('content')
<div class="card">
    <h2 class="card-title">Tambah Project Story</h2>

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

    <form action="{{ route('project-stories.store') }}" method="POST">
        @csrf

        <!-- Project Select -->
        <div class="form-group">
            <label for="project_id">Project</label>
            <select id="project_id" name="project_id" required>
                <option value="">-- Pilih Project --</option>
                @foreach($projects as $project)
                    <option value="{{ $project->project_id }}" {{ old('project_id') == $project->project_id ? 'selected' : '' }}>
                        {{ $project->project_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Challenge -->
        <div class="form-group">
            <label for="challenge_editor">Challenge</label>
            <div id="challenge_editor">{!! old('challenge') !!}</div>
            <input type="hidden" name="challenge" id="challenge_hidden">
        </div>

        <!-- Solution -->
        <div class="form-group">
            <label for="solution_editor">Solution</label>
            <div id="solution_editor">{!! old('solution') !!}</div>
            <input type="hidden" name="solution" id="solution_hidden">
        </div>

        <!-- Result -->
        <div class="form-group">
            <label for="result_editor">Result</label>
            <div id="result_editor">{!! old('result') !!}</div>
            <input type="hidden" name="result" id="result_hidden">
        </div>

        <!-- Submit -->
        <div class="form-actions">
            <button type="submit">Simpan Project Story</button>
        </div>
    </form>

    <div class="back-link">
        <a href="{{ route('project-stories.index') }}">⬅ Kembali ke Daftar Project Stories</a>
    </div>
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
    max-width: 900px;
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
.form-group select {
    width: 100%;
    padding: 14px 18px;
    font-size: 15px;
    border-radius: 12px;
    border: 1px solid var(--border);
    background: #f9fafb;
    transition: .3s;
}
.form-group select:focus {
    border-color: #6366f1;
    box-shadow: 0 0 15px rgba(99,102,241,.25);
    outline: none;
}

/* QUILL */
#challenge_editor, #solution_editor, #result_editor {
    height: 200px;
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

/* BACK LINK */
.back-link {
    text-align: center;
    margin-top: 25px;
}
.back-link a {
    color: #6366f1;
    font-weight: 600;
    text-decoration: none;
}
.back-link a:hover {
    text-decoration: underline;
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

const challengeEditor = new Quill('#challenge_editor', { theme: 'snow', modules: { toolbar: toolbarOptions } });
const solutionEditor = new Quill('#solution_editor', { theme: 'snow', modules: { toolbar: toolbarOptions } });
const resultEditor = new Quill('#result_editor', { theme: 'snow', modules: { toolbar: toolbarOptions } });

document.querySelector('form').addEventListener('submit', function () {
    document.getElementById('challenge_hidden').value = challengeEditor.root.innerHTML;
    document.getElementById('solution_hidden').value = solutionEditor.root.innerHTML;
    document.getElementById('result_hidden').value = resultEditor.root.innerHTML;
});
</script>
@endpush
