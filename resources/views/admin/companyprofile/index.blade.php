@extends('admin.layouts.app')

@section('title', 'Company Profile')
@section('page-title', 'Company Profile')

@section('content')
<div style="padding:20px;">

    <!-- Alert Success -->
    @if (session('success'))
        <div style="background-color:#d1fae5; color:#065f46; padding:12px 18px; border-radius:8px; margin-bottom:20px; border:1px solid #a7f3d0;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol Tambah -->
    <div style="text-align:right; margin-bottom:20px;">
        <a href="{{ route('company-profile.create') }}" class="btn-add">
            Tambah Company Profile
        </a>
    </div>

    <!-- Tabel -->
    <div style="box-shadow:0 2px 8px rgba(0,0,0,0.05); border-radius:10px; overflow:hidden;">
        <table style="width:100%; border-collapse:collapse; background:#fff;">
            <thead style="background:#1f2937; color:#fff;">
                <tr>
                    <th style="padding:12px 15px; width:5%;">No</th>
                    <th style="padding:12px 15px;">Title</th>
                    <th style="padding:12px 15px;">Description</th>
                    <th style="padding:12px 15px; width:18%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($profiles as $item)
                <tr style="border-bottom:1px solid #e5e7eb;">
                    <td style="padding:12px 15px;">{{ $loop->iteration }}</td>

                    <td style="padding:12px 15px; font-weight:600; color:#111827;">
                        {{ $item->title }}
                    </td>

                    <td style="padding:12px 15px;">
                        @php
                            $plainDesc = strip_tags($item->description);
                            $shortDesc = Str::limit($plainDesc, 80, '...');
                        @endphp

                        @if(strlen($plainDesc) > 80)
                            <div style="max-width:320px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; cursor:pointer; color:#111827;"
                                 onclick="showModal('{{ $item->profile_id }}')"
                                 title="Klik untuk melihat selengkapnya">
                                {{ $shortDesc }}
                            </div>

                            <!-- Modal -->
                            <div id="modal-{{ $item->profile_id }}" class="modal">
                                <div class="modal-content">
                                    <span class="close" onclick="closeModal('{{ $item->profile_id }}')">&times;</span>
                                    <h3 style="margin-bottom:15px;">{{ $item->title }}</h3>
                                    <div class="modal-body">
                                        {!! $item->description !!}
                                    </div>
                                </div>
                            </div>
                        @else
                            {{ $plainDesc }}
                        @endif
                    </td>

                    <td style="padding:12px 15px;">
                        <a href="{{ route('company-profile.edit', $item->profile_id) }}" class="btn-edit">
                            Edit
                        </a>

                        <form action="{{ route('company-profile.destroy', $item->profile_id) }}"
                              method="POST"
                              style="display:inline;"
                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center; padding:20px; color:#6b7280;">
                        Data Company Profile belum tersedia
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<!-- Button Styles -->
<style>
.btn-add {
    background-color:#2563eb;
    color:#fff;
    padding:10px 18px;
    border-radius:8px;
    font-weight:600;
    text-decoration:none;
    transition:0.3s;
}
.btn-add:hover {
    background-color:#1d4ed8;
}

.btn-edit {
    background-color:#f59e0b;
    color:#fff;
    padding:6px 12px;
    border-radius:6px;
    text-decoration:none;
    margin-right:6px;
    transition:0.3s;
}
.btn-edit:hover {
    background-color:#d97706;
}

.btn-delete {
    background-color:#dc2626;
    color:#fff;
    padding:6px 12px;
    border-radius:6px;
    border:none;
    cursor:pointer;
    transition:0.3s;
}
.btn-delete:hover {
    background-color:#b91c1c;
}
</style>

<!-- Modal Styles -->
<style>
.modal {
    display:none;
    position:fixed;
    z-index:1000;
    left:0;
    top:0;
    width:100%;
    height:100%;
    background-color:rgba(0,0,0,0.5);
}
.modal-content {
    background-color:#fff;
    margin:5% auto;
    padding:20px;
    border-radius:8px;
    width:80%;
    max-width:600px;
    position:relative;
    max-height:80vh;
    overflow-y:auto;
}
.close {
    position:absolute;
    right:15px;
    top:10px;
    font-size:28px;
    cursor:pointer;
    color:#9ca3af;
}
.close:hover {
    color:#111827;
}
</style>

<!-- Modal Script -->
<script>
function showModal(id) {
    document.getElementById('modal-' + id).style.display = 'block';
}
function closeModal(id) {
    document.getElementById('modal-' + id).style.display = 'none';
}
window.onclick = function(event) {
    document.querySelectorAll('.modal').forEach(modal => {
        if (event.target === modal) modal.style.display = 'none';
    });
}
</script>
@endsection
