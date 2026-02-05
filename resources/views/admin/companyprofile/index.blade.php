@extends('admin.layouts.app')

@section('title', 'Company Profile')
@section('page-title', 'Company Profile')

@section('content')
<div class="container-fluid">

    @if (session('success'))
        <div class="alert-success-custom">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="toolbar">
        <p class="text-muted">Daftar informasi profil perusahaan yang ditampilkan di website.</p>
        <a href="{{ route('company-profile.create') }}" class="btn-primary-custom">
            <i class="fas fa-plus"></i> Tambah Profil
        </a>
    </div>

    <div class="table-card">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Informasi</th>
                    <th>Cuplikan Deskripsi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($profiles as $item)
                <tr>
                    <td class="text-center" style="width: 50px;">{{ $loop->iteration }}</td>
                    <td class="font-bold">{{ $item->title }}</td>
                    <td>
                        @php
                            $plainDesc = strip_tags($item->description);
                            $shortDesc = Str::limit($plainDesc, 70, '...');
                        @endphp
                        <span class="desc-preview" onclick="showModal('{{ $item->profile_id }}')">
                            {{ $shortDesc }}
                        </span>

                        <div id="modal-{{ $item->profile_id }}" class="modal-custom">
                            <div class="modal-content-custom">
                                <div class="modal-header">
                                    <h3>{{ $item->title }}</h3>
                                    <span class="close-btn" onclick="closeModal('{{ $item->profile_id }}')">&times;</span>
                                </div>
                                <div class="modal-body-custom">
                                    {!! $item->description !!}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="action-buttons">
                        <a href="{{ route('company-profile.edit', $item->profile_id) }}" class="btn-action edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('company-profile.destroy', $item->profile_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-action delete" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="empty-state">
                        <i class="fas fa-folder-open"></i>
                        <p>Belum ada data Company Profile.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@push('styles')
<style>
    .alert-success-custom {
        background: #ecfdf5; border: 1px solid #10b981; color: #065f46;
        padding: 15px; border-radius: 12px; margin-bottom: 25px; display: flex; align-items: center; gap: 10px;
    }
    .toolbar {
        display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;
    }
    .btn-primary-custom {
        background: var(--primary-accent); color: white; padding: 10px 20px; border-radius: 10px;
        text-decoration: none; font-weight: 600; transition: 0.3s; display: inline-flex; align-items: center; gap: 8px;
    }
    .btn-primary-custom:hover { opacity: 0.9; transform: translateY(-2px); }

    .table-card {
        background: white; border-radius: 15px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); overflow: hidden;
    }
    .modern-table { width: 100%; border-collapse: collapse; }
    .modern-table th { background: #f8fafc; padding: 15px; text-align: left; font-size: 13px; color: #64748b; text-transform: uppercase; }
    .modern-table td { padding: 15px; border-top: 1px solid #f1f5f9; font-size: 14px; }
    .font-bold { font-weight: 600; color: #1e293b; }
    
    .desc-preview { color: #6366f1; cursor: pointer; border-bottom: 1px dashed #6366f1; }
    
    .action-buttons { display: flex; justify-content: center; gap: 8px; }
    .btn-action { width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 8px; border: none; transition: 0.3s; cursor: pointer; }
    .btn-action.edit { background: #fef3c7; color: #d97706; }
    .btn-action.delete { background: #fee2e2; color: #dc2626; }
    .btn-action:hover { transform: scale(1.1); }

    .empty-state { text-align: center; padding: 50px !important; color: #94a3b8; }
    .empty-state i { font-size: 40px; margin-bottom: 10px; }

    /* Modal Styling */
    .modal-custom { display:none; position:fixed; z-index:9999; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.5); backdrop-filter: blur(4px); }
    .modal-content-custom { background:white; margin: 5% auto; padding: 0; border-radius: 15px; width: 90%; max-width: 700px; overflow: hidden; animation: zoomIn 0.3s; }
    .modal-header { padding: 20px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; background: #f8fafc; }
    .modal-body-custom { padding: 30px; max-height: 70vh; overflow-y: auto; line-height: 1.6; }
    .close-btn { font-size: 24px; cursor: pointer; color: #94a3b8; }
    @keyframes zoomIn { from {opacity: 0; transform: scale(0.9);} to {opacity: 1; transform: scale(1);} }
</style>
@endpush

@push('scripts')
<script>
    function showModal(id) { document.getElementById('modal-' + id).style.display = 'block'; }
    function closeModal(id) { document.getElementById('modal-' + id).style.display = 'none'; }
    window.onclick = function(e) { 
        if (e.target.className === 'modal-custom') {
            document.querySelectorAll('.modal-custom').forEach(m => m.style.display = 'none');
        }
    }
</script>
@endpush
@endsection