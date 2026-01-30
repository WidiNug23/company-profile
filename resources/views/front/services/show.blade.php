@extends('layouts.front')

@section('title', 'Layanan Kami')

@section('content')

<style>
.services-page {
    max-width: 1200px;
    margin: 80px auto;
    padding: 0 20px;
    font-family: 'Inter', sans-serif;
}

.services-title {
    text-align: center;
    margin-bottom: 60px;
}

.services-title h1 {
    font-size: 36px;
    font-weight: 700;
    color: #1f2937;
}

.services-title p {
    font-size: 16px;
    color: #6b7280;
    margin-top: 8px;
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 30px;
}

.service-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 30px 25px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    transition: all .3s ease;
}

.service-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 45px rgba(0,0,0,0.08);
}

.service-icon img {
    width: 64px;
    height: 64px;
    object-fit: contain;
    margin-bottom: 20px;
}

.service-name {
    font-size: 20px;
    font-weight: 600;
    color: #111827;
    margin-bottom: 12px;
}

.service-desc {
    font-size: 14px;
    color: #6b7280;
    line-height: 1.6;
}
</style>

<div class="services-page">

    <div class="services-title">
        <h1>Layanan Kami</h1>
        <p>Solusi terbaik yang kami tawarkan untuk Anda</p>
    </div>

    <div class="services-grid">
        @forelse ($services as $service)
            <div class="service-card">

<div class="service-icon">
    @if ($service->icon)
        <img src="{{ asset('storage/' . $service->icon) }}"
             alt="{{ $service->service_name }}">
    @else
        <img src="{{ asset('assets/default-service.png') }}"
             alt="Service">
    @endif
</div>


                <div class="service-name">
                    {{ $service->service_name }}
                </div>

                <div class="service-desc">
                    {!! $service->description !!}
                </div>

            </div>
        @empty
            <p style="text-align:center; color:#6b7280;">
                Belum ada layanan yang tersedia.
            </p>
        @endforelse
    </div>

</div>

@endsection
