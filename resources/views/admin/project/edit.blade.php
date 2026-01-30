@extends('admin.layouts.app')

@section('title', 'Edit Project')
@section('page-title', 'Edit Project')

@section('content')
<div class="card">

    <h2 class="card-title">Edit Project</h2>

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

    <form action="{{ route('projects.update', $project->project_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="project_name">Nama Project</label>
            <input type="text" id="project_name" name="project_name" value="{{ old('project_name', $project->project_name) }}" required placeholder="Masukkan nama project">
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" id="location" name="location" value="{{ old('location', $project->location) }}" required placeholder="Masukkan lokasi project">
        </div>

        <div class="form-group">
            <label for="year">Year</label>
            <input type="number" id="year" name="year" value="{{ old('year', $project->year) }}" required placeholder="Masukkan tahun project">
        </div>

        <div class="form-group">
            <label for="thumbnail">Thumbnail</label>
            <input type="file" id="thumbnail" name="thumbnail">
            @if($project->thumbnail)
                <img src="{{ asset('storage/'.$project->thumbnail) }}" width="100" style="object-fit:cover; border-radius:6px; margin-top:10px;">
            @endif
        </div>

        <div class="form-actions">
            <button type="submit">Update Project</button>
        </div>
    </form>

</div>
@endsection

@push('styles')
<style>
:root {
    --primary: #2563eb;
    --primary-gradient: linear-gradient(135deg, #2563eb, #4f46e5);
    --border: #e5e7eb;
    --shadow: rgba(0,0,0,0.12);
    --error: #dc2626;
}

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

@keyframes fadeUp {
    from { opacity:0; transform: translateY(25px); }
    to { opacity:1; transform: translateY(0); }
}

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
.form-group input {
    width: 100%;
    padding: 14px 18px;
    font-size: 15px;
    border-radius: 12px;
    border: 1px solid var(--border);
    background: #f9fafb;
    transition: .3s;
}
.form-group input:focus {
    border-color: #6366f1;
    box-shadow: 0 0 15px rgba(99,102,241,.25);
    outline: none;
}

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

@media (max-width:768px) {
    .card {
        padding: 30px 25px;
        margin: 25px;
    }
}
</style>
@endpush
