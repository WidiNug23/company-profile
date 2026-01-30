@extends('admin.layouts.app')

@section('content')
<div style="padding:20px; font-family:'Inter', sans-serif;">

    <!-- Judul dan Tombol Tambah -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h2 style="font-size:24px; font-weight:700; color:#1f2937;">Daftar Project Stories</h2>
        <a href="{{ route('project-stories.create') }}" 
           style="background-color:#2563eb; color:#fff; padding:10px 18px; border-radius:8px; font-weight:600; text-decoration:none; transition:0.3s;"
           onmouseover="this.style.backgroundColor='#1d4ed8'"
           onmouseout="this.style.backgroundColor='#2563eb'">
           + Tambah Story
        </a>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div style="background-color:#d1fae5; color:#065f46; padding:12px 18px; border-radius:8px; margin-bottom:20px; border:1px solid #a7f3d0;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Project Stories -->
    <div style="box-shadow:0 2px 8px rgba(0,0,0,0.05); border-radius:10px; overflow:hidden;">
        <table style="width:100%; border-collapse:collapse; background:#fff;">
            <thead style="background:#1f2937; color:#fff;">
                <tr>
                    <th style="padding:12px 15px;">No</th>
                    <th style="padding:12px 15px;">Project</th>
                    <th style="padding:12px 15px;">Challenge</th>
                    <th style="padding:12px 15px;">Solution</th>
                    <th style="padding:12px 15px;">Result</th>
                    <th style="padding:12px 15px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stories as $story)
                <tr style="border-bottom:1px solid #d6d9d2; cursor:pointer;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='white'">
                    <td style="padding:12px 15px;">{{ $loop->iteration }}</td>

                    <!-- Kolom Project yang bisa diklik untuk popup -->
                    <td style="padding:12px 15px;">
                        <div style="color:#2563eb; font-weight:600; text-decoration:underline; cursor:pointer;"
                             onclick="showModal(
                                {{ $story->project->project_id }},
                                '{{ addslashes($story->project->project_name) }}',
                                '{{ addslashes($story->project->location) }}',
                                '{{ $story->project->year }}',
                                '{{ $story->project->thumbnail ? asset('storage/' . $story->project->thumbnail) : '' }}',
                                '{{ addslashes($story->challenge) }}',
                                '{{ addslashes($story->solution) }}',
                                '{{ addslashes($story->result) }}'
                             )">
                             {{ $story->project->project_name }}
                        </div>
                    </td>

<td style="padding:12px 15px;">
    {{ Str::limit(strip_tags($story->challenge), 80) }}
</td>
<td style="padding:12px 15px;">
    {{ Str::limit(strip_tags($story->solution), 80) }}
</td>
<td style="padding:12px 15px;">
    {{ Str::limit(strip_tags($story->result), 80) }}
</td>
                    <td style="padding:12px 15px;">
                        <a href="{{ route('project-stories.edit', $story->story_id) }}" 
                           style="background-color:#f59e0b; color:#fff; padding:6px 12px; border-radius:6px; text-decoration:none; margin-right:5px; transition:0.3s;"
                           onmouseover="this.style.backgroundColor='#d97706'" onmouseout="this.style.backgroundColor='#f59e0b'">
                           Edit
                        </a>
                        <form action="{{ route('project-stories.destroy', $story->story_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus story ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background-color:#dc2626; color:#fff; padding:6px 12px; border-radius:6px; border:none; cursor:pointer; transition:0.3s;"
                                    onmouseover="this.style.backgroundColor='#b91c1c'" onmouseout="this.style.backgroundColor='#dc2626'">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding:20px; color:#6b7280;">Belum ada story</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Project -->
<div id="project-modal" style="display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%; overflow:auto; background-color:rgba(0,0,0,0.5);">
    <div style="background:#fff; margin:5% auto; padding:20px; border-radius:8px; width:80%; max-width:500px; position:relative; max-height:80vh; overflow-y:auto;">
        <span onclick="closeModal()" style="color:#aaa; float:right; font-size:28px; font-weight:bold; cursor:pointer;">&times;</span>
        <img id="modal-project-thumbnail" src="" alt="Thumbnail" style="width:100%; max-height:200px; object-fit:cover; border-radius:6px; margin-bottom:15px; display:none;">
        <h3 id="modal-project-name" style="font-size:20px; font-weight:700; margin-bottom:10px;"></h3>
        <p style="color:#374151; margin-bottom:5px;"><strong>Lokasi:</strong> <span id="modal-project-location"></span></p>
        <p style="color:#374151; margin-bottom:10px;"><strong>Tahun:</strong> <span id="modal-project-year"></span></p>
        <p style="color:#374151; margin-bottom:5px;"><strong>Challenge:</strong> <span id="modal-challenge"></span></p>
        <p style="color:#374151; margin-bottom:5px;"><strong>Solution:</strong> <span id="modal-solution"></span></p>
        <p style="color:#374151;"><strong>Result:</strong> <span id="modal-result"></span></p>
    </div>
</div>

<!-- Script Modal -->
<script>
function showModal(id, name, location, year, thumbnail, challenge, solution, result) {
    document.getElementById('modal-project-name').textContent = name;
    document.getElementById('modal-project-location').textContent = location;
    document.getElementById('modal-project-year').textContent = year;

    const thumb = document.getElementById('modal-project-thumbnail');
    if(thumbnail){
        thumb.src = thumbnail;
        thumb.style.display = 'block';
    } else {
        thumb.style.display = 'none';
    }

    document.getElementById('modal-challenge').textContent = challenge;
    document.getElementById('modal-solution').textContent = solution;
    document.getElementById('modal-result').textContent = result;

    document.getElementById('project-modal').style.display = 'block';
}

function closeModal() {
    document.getElementById('project-modal').style.display = 'none';
}

// Klik di luar modal untuk menutup
window.onclick = function(event) {
    const modal = document.getElementById('project-modal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>
@endsection
