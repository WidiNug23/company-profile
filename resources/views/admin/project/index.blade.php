@extends('admin.layouts.app')

@section('title', 'Daftar Projects')
@section('page-title', 'Daftar Projects')

@section('content')
<div style="padding:20px; font-family:'Inter', sans-serif;">

    <!-- Judul dan Tombol Tambah -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h2 style="font-size:24px; font-weight:700; color:#1f2937;">Daftar Projects</h2>
        <a href="{{ route('projects.create') }}" 
           style="background-color:#2563eb; color:#fff; padding:10px 18px; border-radius:8px; font-weight:600; text-decoration:none; transition:0.3s;"
           onmouseover="this.style.backgroundColor='#1d4ed8'"
           onmouseout="this.style.backgroundColor='#2563eb'">
           + Tambah Project
        </a>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div style="background-color:#d1fae5; color:#065f46; padding:12px 18px; border-radius:8px; margin-bottom:20px; border:1px solid #a7f3d0;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table Projects -->
    <div style="box-shadow:0 2px 8px rgba(0,0,0,0.05); border-radius:10px; overflow:hidden;">
        <table style="width:100%; border-collapse:collapse; background:#fff;">
            <thead style="background:#1f2937; color:#fff;">
                <tr>
                    <th style="padding:12px 15px;">No</th>
                    <th style="padding:12px 15px;">Nama Project</th>
                    <th style="padding:12px 15px;">Location</th>
                    <th style="padding:12px 15px;">Year</th>
                    <th style="padding:12px 15px;">Thumbnail</th>
                    <th style="padding:12px 15px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr style="border-bottom:1px solid #e5e7eb; transition:0.3s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='white'">
                    <td style="padding:12px 15px;">{{ $loop->iteration }}</td>
                    <td style="padding:12px 15px; font-weight:600;">{{ $project->project_name }}</td>
                    <td style="padding:12px 15px;">{{ $project->location }}</td>
                    <td style="padding:12px 15px;">{{ $project->year }}</td>
                    <td style="padding:12px 15px;">
                        @if($project->thumbnail)
                            <img src="{{ asset('storage/'.$project->thumbnail) }}" width="48" height="48" style="object-fit:cover; border-radius:6px; box-shadow:0 2px 4px rgba(0,0,0,0.1)">
                        @else
                            <span style="color:#9ca3af; font-style:italic;">Tidak ada</span>
                        @endif
                    </td>
                    <td style="padding:12px 15px; display:flex; gap:8px;">
                        <a href="{{ route('projects.edit', $project->project_id) }}" 
                           style="background-color:#f59e0b; color:#fff; padding:6px 12px; border-radius:6px; text-decoration:none; font-weight:600; transition:0.3s;"
                           onmouseover="this.style.backgroundColor='#d97706'" onmouseout="this.style.backgroundColor='#f59e0b'">
                           Edit
                        </a>
                        <form action="{{ route('projects.destroy', $project->project_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus data?')"
                                    style="background-color:#dc2626; color:#fff; padding:6px 12px; border-radius:6px; border:none; cursor:pointer; font-weight:600; transition:0.3s;"
                                    onmouseover="this.style.backgroundColor='#b91c1c'" onmouseout="this.style.backgroundColor='#dc2626'">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding:20px; color:#6b7280;">Belum ada project</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
