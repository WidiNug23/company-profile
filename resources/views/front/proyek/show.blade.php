@extends('layouts.front')

@section('title', 'Portofolio Proyek - PT Danadipa Bertu Perkasa')

@section('content')
<style>
    /* ============================================================
       1. VARIABEL & INTEGRASI TEMA (BRAND PALETTE)
    ============================================================ */
    :root {
        --brand-blue: #293c91;
        --brand-red: #e92426;
        --solution-accent: #06b6d4; /* Cyan cerah untuk visibilitas Dark Mode */
        --result-accent: #10b981;
        --transition-speed: 0.4s;
    }

    /* FORCE NAVBAR & FOOTER TO BRAND RED */
    .navbar .nav-link.active, 
    .navbar .navbar-brand,
    .footer .footer-title,
    header.sticky .nav-link:hover {
        color: var(--brand-red) !important;
    }

    .navbar .btn-contact,
    .footer-divider,
    .btn-primary {
        background-color: var(--brand-red) !important;
        border-color: var(--brand-red) !important;
    }

    /* Wrapper Background Solid (Tanpa Image) */
    .portfolio-wrapper-global {
        position: relative;
        width: 100%;
        min-height: 100vh;
        background-color: var(--bg-body); /* Mengikuti variabel global tema */
        transition: background-color var(--transition-speed) ease;
    }

    .portfolio-section {
        position: relative;
        padding: 120px 0;
        color: var(--text-main);
        font-family: 'Inter', sans-serif;
    }

    /* =====================
       2. HEADER
    ===================== */
    .portfolio-header {
        text-align: center;
        margin-bottom: 80px;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    .portfolio-header h1 {
        font-size: clamp(38px, 6vw, 56px);
        font-weight: 900;
        letter-spacing: -2px;
        color: var(--brand-blue);
        margin-bottom: 20px;
    }

    [data-theme="dark"] .portfolio-header h1 { color: #ffffff; }

    .header-accent {
        width: 60px;
        height: 5px;
        background: var(--brand-red);
        margin: 0 auto 25px;
        border-radius: 10px;
    }

    /* =====================
       3. TIMELINE LAYOUT
    ===================== */
    .timeline-container {
        max-width: 1150px;
        margin: 0 auto;
        padding: 0 25px;
    }

    .timeline-wrapper {
        position: relative;
        padding: 40px 0;
    }

    .timeline-wrapper::before {
        content: '';
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(to bottom, 
            var(--brand-red), 
            var(--brand-blue), 
            var(--brand-red), 
            transparent);
        border-radius: 10px;
        opacity: 0.3;
    }

    .project-item {
        position: relative;
        margin-bottom: 100px;
        width: 100%;
        display: flex;
        justify-content: flex-end;
    }

    .project-item:nth-child(even) {
        justify-content: flex-start;
    }

    .project-node {
        position: absolute;
        left: 50%;
        top: 40px;
        transform: translateX(-50%);
        width: 24px;
        height: 24px;
        background: var(--card-bg);
        border: 5px solid var(--brand-red);
        border-radius: 50%;
        z-index: 10;
        box-shadow: 0 0 15px rgba(233, 36, 38, 0.4);
        transition: all 0.3s ease;
    }

    .project-item.active .project-node {
        background: var(--brand-red);
        transform: translateX(-50%) scale(1.3);
        box-shadow: 0 0 25px var(--brand-red);
    }

    /* Card Styling */
    .project-card {
        width: 44%;
        background: var(--card-bg);
        border: 1px solid var(--nav-border);
        border-radius: 30px;
        overflow: hidden;
        transition: var(--transition-standard);
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
    }

    .project-card:hover {
        transform: translateY(-10px);
        border-color: var(--brand-blue);
    }

    .project-img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .project-body {
        padding: 35px;
    }

    /* =====================
       4. BADGE STYLING
    ===================== */
    .badge-container {
        margin-bottom: 15px;
        display: flex;
        gap: 8px;
    }

    .year-badge {
        background: var(--brand-red);
        color: #fff;
        padding: 5px 14px;
        font-size: 12px;
        font-weight: 700;
        border-radius: 8px;
    }

    .location-badge {
        background: rgba(0, 0, 0, 0.05);
        color: var(--text-main);
        padding: 5px 14px;
        font-size: 12px;
        font-weight: 600;
        border-radius: 8px;
        border: 1px solid var(--nav-border);
    }

    [data-theme="dark"] .location-badge {
        background: rgba(255, 255, 255, 0.1);
        color: #ccc;
    }

    .project-body h2 {
        font-size: clamp(22px, 3vw, 28px);
        font-weight: 800;
        margin-bottom: 20px;
        color: var(--brand-blue);
        line-height: 1.3;
    }

    [data-theme="dark"] .project-body h2 { color: #fff; }

    /* =====================
       5. BUTTON HOVER BLUE
    ===================== */
    .btn-toggle-story {
        background: transparent;
        color: var(--brand-red) !important;
        border: 2px solid var(--brand-red);
        padding: 10px 22px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-toggle-story:hover, 
    .project-item.active .btn-toggle-story {
        background: var(--brand-blue);
        border-color: var(--brand-blue);
        color: white !important;
        box-shadow: 0 8px 20px rgba(41, 60, 145, 0.3);
    }

    /* Story Section */
    .story-section {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        background: rgba(0, 0, 0, 0.02);
    }

    [data-theme="dark"] .story-section {
        background: rgba(255, 255, 255, 0.03);
    }

    .project-item.active .story-section {
        max-height: 2000px;
        border-top: 1px dashed var(--nav-border);
    }

    .story-content { padding: 35px; }

    .story-item {
        margin-bottom: 25px;
        padding-left: 20px;
        border-left: 4px solid var(--brand-red);
    }

    .story-item .title {
        font-size: 12px;
        text-transform: uppercase;
        color: var(--brand-red);
        font-weight: 900;
        letter-spacing: 1px;
        margin-bottom: 5px;
    }

    /* Warna Solusi & Result */
    .story-item.solution-item { border-left-color: var(--solution-accent); }
    .story-item.solution-item .title { color: var(--solution-accent); }

    .story-item.result-item { border-left-color: var(--result-accent); }
    .story-item.result-item .title { color: var(--result-accent); }

    .story-item p {
        color: var(--text-muted);
        font-size: 15.5px;
        line-height: 1.8;
    }

    .btn-close-bottom {
        background: var(--brand-blue);
        color: #fff;
        border: none;
        padding: 12px;
        border-radius: 12px;
        margin-top: 20px;
        width: 100%;
        cursor: pointer;
        font-weight: 700;
        transition: 0.3s;
    }

    .btn-close-bottom:hover {
        background: var(--brand-red);
    }

    /* Responsif */
    @media (max-width: 992px) {
        .timeline-wrapper::before { left: 30px; transform: none; }
        .project-node { left: 30px; transform: none; }
        .project-item { justify-content: flex-start !important; padding-left: 70px; }
        .project-card { width: 100%; }
    }
</style>

<div class="portfolio-wrapper-global">
    <section class="portfolio-section">
        <div class="timeline-container">
            
            <div class="portfolio-header">
                <div class="header-accent"></div>
                <h1>Our Project Journey</h1>
                <p>Melihat kembali dedikasi kami dalam membangun infrastruktur berkualitas tinggi.</p>
            </div>

            <div class="timeline-wrapper">
                @forelse($projects as $project)
                <div class="project-item" id="project-{{ $loop->index }}">
                    <div class="project-node"></div>

                    <div class="project-card">
                        @if($project->thumbnail)
                            <img src="{{ asset('storage/'.$project->thumbnail) }}" alt="{{ $project->project_name }}" class="project-img">
                        @else
                            <div style="height:250px; background: rgba(0,0,0,0.05); display:flex; align-items:center; justify-content:center; color:var(--text-muted)">
                                <strong>No Image Available</strong>
                            </div>
                        @endif

                        <div class="project-body">
                            <div class="badge-container">
                                <span class="year-badge">{{ $project->year }}</span>
                                <span class="location-badge">{{ $project->location }}</span>
                            </div>
                            
                            <h2>{{ $project->project_name }}</h2>
                            
                            <button class="btn-toggle-story" onclick="toggleProject('project-{{ $loop->index }}')">
                                <span class="btn-text">Explore Story</span>
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </div>

                        <div class="story-section">
                            <div class="story-content">
                                @if($project->stories->count() > 0)
                                    @foreach($project->stories as $story)
                                        <div class="story-item">
                                            <div class="title">The Challenge</div>
                                            <p>{{ strip_tags($story->challenge) }}</p>
                                        </div>
                                        <div class="story-item solution-item">
                                            <div class="title">Our Solution</div>
                                            <p>{{ strip_tags($story->solution) }}</p>
                                        </div>
                                        <div class="story-item result-item">
                                            <div class="title">The Result</div>
                                            <p>{{ strip_tags($story->result) }}</p>
                                        </div>
                                    @endforeach
                                    
                                    <button class="btn-close-bottom" onclick="toggleProject('project-{{ $loop->index }}')">
                                        Close Project Detail
                                    </button>
                                @else
                                    <p style="text-align:center; color:var(--text-muted); font-style:italic;">Narasi proyek sedang dalam penyusunan.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <div style="text-align:center; padding:100px 0;">
                        <h3 style="color: var(--brand-blue)">Belum ada proyek yang dipublikasikan.</h3>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>

<script>
    function toggleProject(projectId) {
        const targetElement = document.getElementById(projectId);
        const btnText = targetElement.querySelector('.btn-text');
        const isActive = targetElement.classList.contains('active');
        
        document.querySelectorAll('.project-item').forEach(item => {
            if(item.id !== projectId) {
                item.classList.remove('active');
                const otherBtn = item.querySelector('.btn-text');
                if(otherBtn) otherBtn.innerText = "Explore Story";
            }
        });

        if (isActive) {
            targetElement.classList.remove('active');
            btnText.innerText = "Explore Story";
            targetElement.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        } else {
            targetElement.classList.add('active');
            btnText.innerText = "Close Story";
            setTimeout(() => {
                targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 150);
        }
    }
</script>
@endsection