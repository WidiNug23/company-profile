@extends('admin.layouts.app')

@section('title', 'Kelola Partners')
@section('page-title', 'Kelola Partners')

@section('content')
<div style="padding:20px; font-family:'Inter', sans-serif;">

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h2 style="font-size:24px; font-weight:700; color:#1f2937;">Daftar Partners</h2>
        <a href="{{ route('partners.create') }}" style="background-color:#2563eb; color:#fff; padding:10px 18px; border-radius:8px; text-decoration:none;">
            + Tambah Partner
        </a>
    </div>

    @if(session('success'))
        <div style="background-color:#d1fae5; color:#065f46; padding:12px 18px; border-radius:8px; margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="box-shadow:0 2px 8px rgba(0,0,0,0.05); border-radius:10px; overflow:hidden;">
        <table style="width:100%; border-collapse:collapse; background:#fff;">
            <thead style="background:#1f2937; color:#fff;">
                <tr>
                    <th style="padding:12px 15px;">No</th>
                    <th style="padding:12px 15px;">Nama Partner</th>
                    <th style="padding:12px 15px;">Logo</th>
                    <th style="padding:12px 15px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($partners as $partner)
                <tr style="border-bottom:1px solid #d6d9d2;">
                    <td style="padding:12px 15px;">{{ $loop->iteration }}</td>
                    <td style="padding:12px 15px;">{{ $partner->partner_name }}</td>
                    <td style="padding:12px 15px;">
                        @if($partner->logo)
                            <img src="{{ asset('storage/'.$partner->logo) }}" width="48" height="48" style="object-fit:cover; border-radius:6px;">
                        @else
                            <span style="color:#9ca3af">Tidak ada</span>
                        @endif
                    </td>
                    <td style="padding:12px 15px;">
                        <a href="{{ route('partners.edit', $partner->partner_id) }}" style="background-color:#f59e0b; color:#fff; padding:6px 12px; border-radius:6px; text-decoration:none; margin-right:5px;">Edit</a>
                        <form action="{{ route('partners.destroy', $partner->partner_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus partner ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background-color:#dc2626; color:#fff; padding:6px 12px; border-radius:6px; border:none; cursor:pointer;">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center; padding:20px; color:#6b7280;">Belum ada partner</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
