@extends('admin.layouts.app')

@section('title', 'Kelola Certification')
@section('page-title', 'Kelola Certification')

@section('content')
<div style="padding:20px; font-family:'Inter', sans-serif;">

    <!-- Header -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h2 style="font-size:24px; font-weight:700; color:#1f2937;">Daftar Certification</h2>
        <a href="{{ route('certifications.create') }}" style="background-color:#2563eb; color:#fff; padding:10px 18px; border-radius:8px; text-decoration:none; font-weight:600;">
            + Tambah Certification
        </a>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div style="background-color:#d1fae5; color:#065f46; padding:12px 18px; border-radius:8px; margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table -->
    <div style="box-shadow:0 2px 12px rgba(0,0,0,0.05); border-radius:10px; overflow:hidden;">
        <table style="width:100%; border-collapse:collapse; background:#fff;">
            <thead style="background:#1f2937; color:#fff;">
                <tr>
                    <th style="padding:12px 15px;">No</th>
                    <th style="padding:12px 15px;">Nama Certification</th>
                    <th style="padding:12px 15px;">File</th>
                    <th style="padding:12px 15px;">Deskripsi</th>
                    <th style="padding:12px 15px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($certifications as $cert)
                <tr style="border-bottom:1px solid #d6d9d2; vertical-align:middle;">
                    <td style="padding:12px 15px;">{{ $loop->iteration }}</td>
                    <td style="padding:12px 15px;">{{ $cert->certification_name }}</td>
                    <td style="padding:12px 15px;">
                        @if($cert->file)
                            @php
                                $ext = pathinfo($cert->file, PATHINFO_EXTENSION);
                            @endphp

                            @if(in_array(strtolower($ext), ['jpg','jpeg','png','gif']))
                                <!-- Thumbnail gambar -->
                                <a href="{{ asset('storage/'.$cert->file) }}" target="_blank">
                                    <img src="{{ asset('storage/'.$cert->file) }}" alt="File" style="max-width:80px; max-height:60px; border-radius:6px; object-fit:cover; border:1px solid #d1d5db;">
                                </a>
                            @elseif(strtolower($ext) === 'pdf')
                                <!-- Icon PDF -->
                                <a href="{{ asset('storage/'.$cert->file) }}" target="_blank" style="display:inline-flex; align-items:center; gap:5px; text-decoration:none;">
                                    <img src="https://cdn-icons-png.flaticon.com/512/337/337946.png" alt="PDF" style="width:30px; height:30px;">
                                    <span style="color:#1f2937; font-weight:500;">PDF</span>
                                </a>
                            @else
                                <!-- File lain -->
                                <a href="{{ asset('storage/'.$cert->file) }}" target="_blank" style="color:#1f2937; text-decoration:underline; font-weight:500;">
                                    {{ basename($cert->file) }}
                                </a>
                            @endif
                        @else
                            <span style="color:#9ca3af">Tidak ada</span>
                        @endif
                    </td>
                    <td style="padding:12px 15px;">{!! \Illuminate\Support\Str::limit(strip_tags($cert->description), 50) !!}</td>
                    <td style="padding:12px 15px;">
                        <a href="{{ route('certifications.edit', $cert->certification_id) }}" style="background-color:#f59e0b; color:#fff; padding:6px 12px; border-radius:6px; text-decoration:none; margin-right:5px; font-weight:500;">Edit</a>
                        <form action="{{ route('certifications.destroy', $cert->certification_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus certification ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background-color:#dc2626; color:#fff; padding:6px 12px; border-radius:6px; border:none; cursor:pointer; font-weight:500;">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center; padding:20px; color:#6b7280;">Belum ada certification</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
