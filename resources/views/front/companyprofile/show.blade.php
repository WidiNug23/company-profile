@extends('layouts.front')

@section('title', 'Profil Perusahaan')

@section('content')

<style>
/* ===== BASE ===== */
.company-profile-wrapper {
    padding: 40px 16px 80px;
    font-family: 'Inter', sans-serif;
}

/* ===== PAGE TITLE ===== */
.company-profile-page-title {
    max-width: 1100px;
    margin: 0 auto 32px;
    text-align: center;
    margin-top: -20px;
}

.company-profile-page-title h1 {
    font-size: 44px;
    font-weight: 900;
    color: #111827;
    margin-bottom: 10px;
}

.company-profile-page-title p {
    font-size: 16px;
    color: #6b7280;
}

/* ===== GRID LAYOUT ===== */
.company-profile-grid {
    max-width: 1100px;
    margin: auto;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 32px;
}

/* ===== CARD ===== */
.company-profile-card {
    background: #ffffff;
    border-radius: 18px;
    padding: 40px;

    box-shadow:
        0 10px 25px rgba(0, 0, 0, 0.08),
        0 4px 10px rgba(0, 0, 0, 0.05);

    overflow: hidden;
    height: auto; /* ⬅ otomatis sesuai konten */
}

/* ===== CARD TITLE ===== */
.company-profile-title {
    font-size: 28px;
    font-weight: 800;
    color: #111827;
    margin-bottom: 18px;
}

/* ===== DIVIDER ===== */
.company-profile-divider {
    width: 56px;
    height: 4px;
    background: linear-gradient(135deg, #2563eb, #60a5fa);
    border-radius: 4px;
    margin-bottom: 24px;
}

/* ===== DESCRIPTION ===== */
.company-profile-description {
    font-size: 16px;
    line-height: 1.85;
    color: #374151;

    white-space: pre-line;
    word-wrap: break-word;
    overflow-wrap: break-word;
    word-break: break-word;
}

.company-profile-description * {
    max-width: 100%;
    box-sizing: border-box;
}

/* ===== FOOTER ===== */
.company-profile-footer {
    margin-top: 32px;
    padding-top: 16px;
    border-top: 1px solid #e5e7eb;
    font-size: 13px;
    color: #6b7280;
}

/* ===== EMPTY ===== */
.company-profile-empty {
    text-align: center;
    color: #6b7280;
    padding: 80px 20px;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1024px) {
    .company-profile-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .company-profile-page-title h1 {
        font-size: 32px;
    }

    .company-profile-card {
        padding: 28px 22px;
    }

    .company-profile-title {
        font-size: 24px;
    }

    .company-profile-description {
        font-size: 15px;
    }
}
</style>

<div class="company-profile-wrapper">

    <!-- JUDUL HALAMAN -->
    <div class="company-profile-page-title">
        <h1>Profil Perusahaan</h1>
        <p>Mengenal lebih dekat perusahaan kami</p>
    </div>

    @if($profiles->count())
        <div class="company-profile-grid">

            @foreach($profiles as $profile)
                <div class="company-profile-card">

                    <h2 class="company-profile-title">
                        {{ $profile->title }}
                    </h2>

                    <div class="company-profile-divider"></div>

                    <div class="company-profile-description">
                        {!! $profile->description !!}
                    </div>

                    <!-- <div class="company-profile-footer">
                        Terakhir diperbarui:
                        {{ $profile->updated_at->format('d M Y') }}
                    </div> -->

                </div>
            @endforeach

        </div>
    @else
        <div class="company-profile-empty">
            <h2>Company Profile</h2>
            <p>Data company profile belum tersedia.</p>
        </div>
    @endif

</div>

@endsection
