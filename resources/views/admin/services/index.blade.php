@extends('admin.layouts.app')

@section('content')
<style>
    .page-container {
        padding: 24px;
        font-family: 'Inter', sans-serif;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .page-header h2 {
        font-size: 22px;
        font-weight: 600;
        color: #111827;
    }

    .btn-primary {
        background: #2563eb;
        color: #fff;
        padding: 10px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
    }

    .btn-primary:hover {
        background: #1e40af;
    }

    .alert-success {
        background: #ecfdf5;
        color: #065f46;
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .table-wrapper {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        overflow: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: #f9fafb;
    }

    th {
        text-align: left;
        padding: 14px 16px;
        font-size: 13px;
        color: #6b7280;
        font-weight: 600;
        text-transform: uppercase;
    }

    td {
        padding: 14px 16px;
        font-size: 14px;
        color: #374151;
        vertical-align: top;
        border-top: 1px solid #e5e7eb;
    }

    tbody tr:hover {
        background: #f9fafb;
    }

    .desc {
        max-width: 380px;
        line-height: 1.6;
        color: #4b5563;
    }

    .toggle-desc {
        display: inline-block;
        margin-top: 6px;
        font-size: 13px;
        color: #2563eb;
        cursor: pointer;
        user-select: none;
    }

    .icon-img {
        width: 48px;
        height: 48px;
        object-fit: contain;
    }

    .badge-empty {
        font-size: 13px;
        color: #9ca3af;
    }

    .action-btn {
        display: flex;
        gap: 8px;
    }

    .btn-edit {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 13px;
        background: #f3f4f6;
        color: #111827;
        text-decoration: none;
    }

    .btn-edit:hover {
        background: #e5e7eb;
    }

    .btn-delete {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 13px;
        background: #fee2e2;
        color: #991b1b;
        border: none;
        cursor: pointer;
    }

    .btn-delete:hover {
        background: #fecaca;
    }
</style>

<div class="page-container">

    <div class="page-header">
        <h2>Daftar Services</h2>
        <a href="{{ route('services.create') }}" class="btn-primary">
            Tambah Service
        </a>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Service</th>
                    <th>Deskripsi</th>
                    <th>Icon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                    @php
                        // 🔥 BERSIHKAN HTML EDITOR
                        $cleanDesc = trim(strip_tags($service->description));
                        $shortDesc = \Illuminate\Support\Str::limit($cleanDesc, 120);
                    @endphp

                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <strong>{{ $service->service_name }}</strong>
                        </td>

                        <td class="desc">
                            <span class="desc-text">{{ $shortDesc }}</span>

                            @if(strlen($cleanDesc) > 120)
                                <span class="toggle-desc"
                                      onclick="
                                        this.previousElementSibling.innerText = '{{ addslashes($cleanDesc) }}';
                                        this.remove();
                                      ">
                                    Selengkapnya
                                </span>
                            @endif
                        </td>

                        <td style="text-align:center">
                            @if($service->icon)
                                <img src="{{ asset('storage/'.$service->icon) }}" class="icon-img">
                            @else
                                <span class="badge-empty">Tidak ada</span>
                            @endif
                        </td>

                        <td>
                            <div class="action-btn">
                                <a href="{{ route('services.edit', $service->service_id) }}"
                                   class="btn-edit">
                                    Edit
                                </a>

                                <form action="{{ route('services.destroy', $service->service_id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus service ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
