@extends('layouts.front')

@section('title', 'Trust Booster')

@section('content')
<div style="max-width:1200px; margin:70px auto; padding:0 16px; font-family:'Inter', sans-serif;">

    <!-- PAGE TITLE -->
    <h1 style="
        text-align:center;
        font-size:36px;
        font-weight:800;
        color:#111827;
        margin-bottom:70px;
        letter-spacing:-0.5px;
    ">
        Trust Booster
    </h1>

    <!-- ================= CLIENTS ================= -->
    <section style="margin-bottom:80px;">
        <h2 style="font-size:28px; font-weight:700; color:#1f2937; margin-bottom:35px;">
            Clients
        </h2>

        <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:24px;">
            @forelse($clients as $client)
                <div style="
                    background:#ffffff;
                    border-radius:16px;
                    padding:22px;
                    box-shadow:0 8px 25px rgba(0,0,0,0.08);
                    text-align:center;
                    transition: transform 0.3s, box-shadow 0.3s;
                "
                onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 12px 35px rgba(0,0,0,0.12)';"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.08)';"
                >
                    @if(!empty($client->picture))
                        <img src="{{ asset('storage/'.$client->picture) }}"
                             alt="{{ $client->client_name }}"
                             style="width:140px; height:90px; object-fit:contain; margin-bottom:14px; border-radius:6px;">
                    @endif

                    <h3 style="font-size:16px; font-weight:700; color:#111827; margin-bottom:6px;">
                        {{ $client->client_name }}
                    </h3>

                    <p style="font-size:14px; color:#6b7280; line-height:1.6;">
                        {{ strip_tags($client->description ?? '') }}
                    </p>
                </div>
            @empty
                <p style="color:#9ca3af;">Tidak ada client.</p>
            @endforelse
        </div>
    </section>

    <!-- ================= PARTNERS ================= -->
    <section style="margin-bottom:80px;">
        <h2 style="font-size:28px; font-weight:700; color:#1f2937; margin-bottom:35px;">
            Partners
        </h2>

        <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:24px;">
            @forelse($partners as $partner)
                <div style="
                    background:#ffffff;
                    border-radius:16px;
                    padding:22px;
                    box-shadow:0 8px 25px rgba(0,0,0,0.08);
                    text-align:center;
                    transition: transform 0.3s, box-shadow 0.3s;
                "
                onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 12px 35px rgba(0,0,0,0.12)';"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.08)';"
                >
                    @if(!empty($partner->logo))
                        <img src="{{ asset('storage/'.$partner->logo) }}"
                             alt="{{ $partner->partner_name }}"
                             style="width:140px; height:90px; object-fit:contain; margin-bottom:14px; border-radius:6px;">
                    @endif

                    <h3 style="font-size:16px; font-weight:700; color:#111827; margin-bottom:6px;">
                        {{ $partner->partner_name }}
                    </h3>

                    <p style="font-size:14px; color:#6b7280; line-height:1.6;">
                        {{ strip_tags($partner->description ?? '') }}
                    </p>
                </div>
            @empty
                <p style="color:#9ca3af;">Tidak ada partner.</p>
            @endforelse
        </div>
    </section>

    <!-- ================= CERTIFICATIONS ================= -->
    <section style="margin-bottom:60px;">
        <h2 style="font-size:28px; font-weight:700; color:#1f2937; margin-bottom:35px;">
            Certifications
        </h2>

        <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:24px;">
            @forelse($certifications as $cert)
                <div style="
                    background:#ffffff;
                    border-radius:16px;
                    padding:22px;
                    box-shadow:0 8px 25px rgba(0,0,0,0.08);
                    transition: transform 0.3s, box-shadow 0.3s;
                    text-align:center;
                "
                onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 12px 35px rgba(0,0,0,0.12)';"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.08)';"
                >
                    @if(!empty($cert->file))
                        @php
                            $ext = strtolower(pathinfo($cert->file, PATHINFO_EXTENSION));
                        @endphp

                        @if(in_array($ext, ['jpg','jpeg','png','gif']))
                            <a href="{{ asset('storage/'.$cert->file) }}" target="_blank">
                                <img
                                    src="{{ asset('storage/'.$cert->file) }}"
                                    alt="{{ $cert->certification_name }}"
                                    style="width:100%; height:140px; object-fit:contain; margin-bottom:14px; border-radius:6px;"
                                >
                            </a>
                        @elseif($ext === 'pdf')
                            <a href="{{ asset('storage/'.$cert->file) }}" target="_blank" style="display:inline-flex; align-items:center; gap:6px; text-decoration:none; color:#1f2937;">
                                <img src="https://cdn-icons-png.flaticon.com/512/337/337946.png" alt="PDF" style="width:30px; height:30px;">
                                <span>{{ $cert->certification_name }}</span>
                            </a>
                        @endif
                    @endif

                    <h3 style="font-size:16px; font-weight:700; color:#111827; margin-bottom:6px;">
                        {{ $cert->certification_name }}
                    </h3>

                    <p style="font-size:14px; color:#6b7280; line-height:1.6;">
                        {{ strip_tags($cert->description ?? '') }}
                    </p>
                </div>
            @empty
                <p style="color:#9ca3af;">Tidak ada certification.</p>
            @endforelse
        </div>
    </section>

</div>
@endsection
