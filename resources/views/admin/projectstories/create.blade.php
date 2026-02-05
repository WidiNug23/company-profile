@extends('admin.layouts.app')

@section('title', 'Tambah Project Story')
@section('page-title', 'Tambah Project Story')

@section('content')
<div class="story-wrapper">
    <div class="story-card">
        <div class="story-header">
            <div class="circle-icon"><i class="fas fa-book"></i></div>
            <div>
                <h3>Tambah Project Story</h3>
                <p>Bagikan narasi tantangan, solusi, dan hasil dari project ini.</p>
            </div>
        </div>

        {{-- ERROR VALIDATION --}}
        @if ($errors->any())
            <div class="alert-errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><i class="fas fa-exclamation-triangle"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('project-stories.store') }}" method="POST" id="storyForm">
            @csrf

            <div class="form-group">
                <label for="project_id">Pilih Project</label>
                <select id="project_id" name="project_id" required>
                    <option value="">-- Pilih Project yang Terkait --</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->project_id }}" {{ old('project_id') == $project->project_id ? 'selected' : '' }}>
                            {{ $project->project_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="editor-grid">
                <div class="form-group">
                    <label>Challenge (Tantangan)</label>
                    <div class="quill-wrapper">
                        <div id="challenge_editor">{!! old('challenge') !!}</div>
                    </div>
                    <input type="hidden" name="challenge" id="challenge_hidden">
                </div>

                <div class="form-group">
                    <label>Solution (Solusi)</label>
                    <div class="quill-wrapper">
                        <div id="solution_editor">{!! old('solution') !!}</div>
                    </div>
                    <input type="hidden" name="solution" id="solution_hidden">
                </div>

                <div class="form-group">
                    <label>Result (Hasil Akhir)</label>
                    <div class="quill-wrapper">
                        <div id="result_editor">{!! old('result') !!}</div>
                    </div>
                    <input type="hidden" name="result" id="result_hidden">
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('project-stories.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Simpan Story
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
        --primary: #2563eb;
        --border: #e2e8f0;
        --bg-light: #f8fafc;
        --text-dark: #1e293b;
    }

    .story-wrapper { max-width: 1000px; margin: 40px auto; padding: 0 20px; font-family: 'Inter', sans-serif; }
    
    .story-card { 
        background: #ffffff; border-radius: 24px; padding: 40px; 
        box-shadow: 0 20px 50px rgba(0,0,0,0.05); border-top: 6px solid var(--primary);
        animation: fadeUp .6s ease-out;
    }

    @keyframes fadeUp { from { opacity:0; transform: translateY(20px); } to { opacity:1; transform: translateY(0); } }

    .story-header { display: flex; align-items: center; gap: 20px; margin-bottom: 35px; }
    .circle-icon { width: 55px; height: 55px; background: var(--primary); color: white; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 22px; }
    .story-header h3 { margin: 0; color: var(--text-dark); font-weight: 700; font-size: 24px; }
    .story-header p { margin: 5px 0 0; color: #64748b; }

    .form-group { margin-bottom: 25px; }
    .form-group label { display: block; margin-bottom: 10px; font-weight: 600; color: #475569; font-size: 15px; }
    
    .form-group select { 
        width: 100%; padding: 14px 18px; border-radius: 12px; border: 1.5px solid var(--border); 
        background: var(--bg-light); transition: 0.3s; font-size: 15px; cursor: pointer;
    }
    .form-group select:focus { border-color: var(--primary); outline: none; background: white; box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1); }

    /* Quill Styling */
    .quill-wrapper { border-radius: 12px; overflow: hidden; border: 1.5px solid var(--border); background: white; }
    .ql-toolbar.ql-snow { background: #f1f5f9 !important; border: none !important; border-bottom: 1px solid var(--border) !important; padding: 10px !important; }
    .ql-container.ql-snow { border: none !important; height: 180px; font-size: 15px; }

    .form-actions { 
        margin-top: 40px; padding-top: 30px; border-top: 1px solid #f1f5f9; 
        display: flex; justify-content: flex-end; gap: 15px; 
    }
    .btn-cancel { padding: 12px 25px; border-radius: 12px; color: #64748b; text-decoration: none; font-weight: 600; transition: 0.3s; }
    .btn-submit { 
        background: linear-gradient(135deg, #2563eb, #4f46e5); color: white; border: none; padding: 12px 35px; 
        border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.3s; 
        display: flex; align-items: center; gap: 8px;
    }
    .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2); }

    .alert-errors { background: #fff1f2; border: 1px solid #fecaca; color: #be123c; padding: 15px; border-radius: 12px; margin-bottom: 25px; }
    .alert-errors ul { margin: 0; list-style: none; padding: 0; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
    const toolbarOptions = [
        [{ 'header': [1, 2, 3, false] }],
        ['bold', 'italic', 'underline'],
        [{ 'color': [] }, { 'background': [] }],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        ['link', 'clean']
    ];

    const challengeEditor = new Quill('#challenge_editor', { theme: 'snow', modules: { toolbar: toolbarOptions } });
    const solutionEditor = new Quill('#solution_editor', { theme: 'snow', modules: { toolbar: toolbarOptions } });
    const resultEditor = new Quill('#result_editor', { theme: 'snow', modules: { toolbar: toolbarOptions } });

    document.getElementById('storyForm').onsubmit = function () {
        document.getElementById('challenge_hidden').value = challengeEditor.root.innerHTML;
        document.getElementById('solution_hidden').value = solutionEditor.root.innerHTML;
        document.getElementById('result_hidden').value = resultEditor.root.innerHTML;
    };
</script>
@endpush