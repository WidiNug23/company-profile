@extends('admin.layouts.app')

@section('title', 'Daftar Services')

@section('content')
<div class="page-container">
    <div class="page-header">
        <div>
            <h2>Daftar Services</h2>
            <p class="text-muted">Kelola layanan dan jasa yang ditawarkan perusahaan.</p>
        </div>
        <a href="{{ route('services.create') }}" class="btn-primary-custom">
            <i class="fas fa-plus"></i> Tambah Service
        </a>
    </div>

    @if(session('success'))
        <div class="alert-success-custom">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="table-card">
        <table class="modern-table">
            <thead>
                <tr>
                    <th style="width: 60px;" class="text-center">No</th>
                    <th style="width: 80px;" class="text-center">Icon</th>
                    <th>Nama Service</th>
                    <th>Deskripsi</th>
                    <th style="width: 150px;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                    @php
                        $cleanDesc = trim(strip_tags($service->description));
                        $shortDesc = \Illuminate\Support\Str::limit($cleanDesc, 100);
                    @endphp
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">
                            <div class="icon-box">
                                @if($service->icon)
                                    <img src="{{ asset('storage/'.$service->icon) }}" alt="icon">
                                @else
                                    <i class="fas fa-image text-muted"></i>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span class="font-bold">{{ $service->service_name }}</span>
                        </td>
                        <td>
                            <div class="desc-container">
                                <span class="desc-text">{{ $shortDesc }}</span>
                                @if(strlen($cleanDesc) > 100)
                                    <button class="btn-link" onclick="expandText(this, '{{ addslashes($cleanDesc) }}')">Selengkapnya</button>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('services.edit', $service->service_id) }}" class="btn-action edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('services.destroy', $service->service_id) }}" method="POST" onsubmit="return confirm('Hapus service ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action delete" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty-state">
                            <i class="fas fa-concierge-bell"></i>
                            <p>Belum ada layanan yang ditambahkan.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@push('styles')
<style>
    .page-container { padding: 30px; font-family: 'Inter', sans-serif; }
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .page-header h2 { font-weight: 700; color: #1e293b; margin: 0; }
    .text-muted { color: #64748b; font-size: 0.9rem; margin-top: 5px; }

    .btn-primary-custom {
        background: #2563eb; color: white; padding: 10px 20px; border-radius: 10px;
        text-decoration: none; font-weight: 600; transition: 0.3s; display: inline-flex; align-items: center; gap: 8px;
    }
    .btn-primary-custom:hover { background: #1d4ed8; transform: translateY(-2px); color: white; }

    .alert-success-custom {
        background: #ecfdf5; border-left: 5px solid #10b981; color: #065f46;
        padding: 15px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;
    }

    .table-card { background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #f1f5f9; }
    .modern-table { width: 100%; border-collapse: collapse; }
    .modern-table th { background: #f8fafc; padding: 16px; text-align: left; font-size: 13px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; }
    .modern-table td { padding: 16px; border-top: 1px solid #f1f5f9; vertical-align: middle; color: #334155; }
    .modern-table tr:hover { background: #fcfdfe; }

    .font-bold { font-weight: 600; color: #1e293b; }
    .icon-box { width: 50px; height: 50px; background: #f1f5f9; border-radius: 10px; display: flex; align-items: center; justify-content: center; overflow: hidden; margin: 0 auto; }
    .icon-box img { width: 100%; height: 100%; object-fit: cover; }

    .btn-link { background: none; border: none; color: #2563eb; padding: 0; font-size: 13px; cursor: pointer; font-weight: 500; text-decoration: underline; }
    
    .action-buttons { display: flex; justify-content: center; gap: 10px; }
    .btn-action { width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border-radius: 8px; transition: 0.3s; text-decoration: none; border: none; }
    .btn-action.edit { background: #eff6ff; color: #2563eb; }
    .btn-action.delete { background: #fff1f2; color: #e11d48; }
    .btn-action:hover { transform: scale(1.1); }

    .empty-state { text-align: center; padding: 60px !important; color: #94a3b8; }
    .empty-state i { font-size: 48px; margin-bottom: 15px; opacity: 0.3; }
</style>
@endpush

@push('scripts')
<script>
    function expandText(btn, fullText) {
        const container = btn.parentElement.querySelector('.desc-text');
        container.innerText = fullText;
        btn.remove();
    }
</script>
@endpush
@endsection