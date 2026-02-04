@extends('layouts.front')

@section('title', 'Portofolio Proyek')

@section('content')
<style>
    /* 1. Background Dinamis */
    .portfolio-bg-fixed {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        /* Overlay berubah berdasarkan tema: Gelap di Dark Mode, Terang di Light Mode */
        background-image: url('{{ asset("storage/pexels-jplenio-2128162.jpg") }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        z-index: -1;
    }

    /* Lapisan overlay agar teks tetap terbaca di kedua tema */
    .portfolio-bg-fixed::after {
        content: '';
        position: absolute;
        inset: 0;
        transition: background 0.4s ease;
    }

    [data-theme="dark"] .portfolio-bg-fixed::after {
        background: rgba(10, 15, 28, 0.9);
    }

    [data-theme="light"] .portfolio-bg-fixed::after {
        background: rgba(255, 255, 255, 0.85);
    }

    .portfolio-wrapper-global {
        position: relative;
        width: 100%;
        min-height: 80vh; 
    }

    .portfolio-section {
        position: relative;
        padding: 80px 0;
        color: var(--text-main); /* Mengikuti tema */
        font-family: 'Inter', sans-serif;
        transition: color 0.4s ease;
    }

    .timeline-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .portfolio-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .portfolio-header h1 {
        font-size: clamp(34px, 5vw, 52px);
        font-weight: 900;
        margin-bottom: 15px;
        color: var(--text-main);
        transition: color 0.4s ease;
    }

    .portfolio-header p {
        color: var(--text-muted);
    }

    /* Timeline Line */
    .timeline-wrapper {
        position: relative;
        padding: 20px 0;
    }

    .timeline-wrapper::before {
        content: '';
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(to bottom, var(--accent-color), #10b981, #f59e0b, transparent);
    }

    .project-item {
        position: relative;
        margin-bottom: 80px;
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
        top: 30px;
        transform: translateX(-50%);
        width: 20px;
        height: 20px;
        background: var(--bg-body);
        border: 4px solid var(--accent-color);
        border-radius: 50%;
        z-index: 10;
        box-shadow: 0 0 15px var(--accent-color);
        transition: all 0.3s ease;
    }

    /* Card Dinamis */
    .project-card {
        width: 45%;
        background: var(--card-bg); /* Berubah Putih/Gelap */
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid var(--nav-border);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s ease;
    }

    .project-card:hover {
        transform: translateY(-5px);
        border-color: var(--accent-color);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .project-img {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }

    .project-body {
        padding: 25px;
    }

    .year-badge, .location-badge {
        display: inline-block;
        padding: 4px 12px;
        background: var(--glass-bg);
        color: var(--accent-color);
        font-size: 11px;
        font-weight: 700;
        border-radius: 6px;
        margin-bottom: 10px;
        margin-right: 5px;
        border: 1px solid var(--glass-border);
    }

    .project-body h2 {
        font-size: 24px;
        margin: 0 0 15px 0;
        color: var(--text-main);
    }

    /* Buttons */
    .btn-toggle-story {
        background: var(--accent-color);
        color: white !important;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-close-bottom {
        background: var(--glass-bg);
        color: var(--text-main);
        border: 1px solid var(--nav-border);
        padding: 12px;
        border-radius: 10px;
        margin-top: 25px;
        width: 100%;
        cursor: pointer;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-close-bottom:hover {
        background: #ef4444;
        color: white;
        border-color: #ef4444;
    }

    /* Story Section Dinamis */
    .story-section {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        background: var(--glass-bg);
    }

    .project-item.active .story-section {
        max-height: 2000px;
    }

    .project-item.active .project-node {
        background: #10b981;
        box-shadow: 0 0 20px #10b981;
        border-color: #fff;
    }

    .story-content {
        padding: 25px;
    }

    .story-item {
        margin-bottom: 20px;
        padding-left: 15px;
        border-left: 3px solid var(--accent-color);
    }

    .story-item .title {
        font-size: 11px;
        text-transform: uppercase;
        color: var(--accent-color);
        font-weight: 800;
        letter-spacing: 0.5px;
    }

    .story-item p {
        margin: 8px 0 0;
        color: var(--text-muted);
        font-size: 14.5px;
        line-height: 1.6;
    }

    /* Responsif */
    @media (max-width: 768px) {
        .timeline-wrapper::before { left: 20px; }
        .project-node { left: 20px; }
        .project-item { justify-content: flex-start !important; padding-left: 45px; }
        .project-card { width: 100%; }
    }
</style>

<div class="portfolio-wrapper-global">
    <div class="portfolio-bg-fixed"></div>

    <section class="portfolio-section">
        <div class="timeline-container">
            
            <div class="portfolio-header">
                <h1>Our Project Journey</h1>
                <p>Menjelajahi setiap tantangan dan solusi di balik mahakarya kami.</p>
            </div>

            <div class="timeline-wrapper">
                @forelse($projects as $project)
                <div class="project-item" id="project-{{ $loop->index }}">
                    <div class="project-node"></div>

                    <div class="project-card">
                        @if($project->thumbnail)
                            <img src="{{ asset('storage/'.$project->thumbnail) }}" alt="{{ $project->project_name }}" class="project-img">
                        @else
                            <div style="height:220px; background: var(--glass-bg); display:flex; align-items:center; justify-content:center; color:var(--text-muted)">No Image</div>
                        @endif

                        <div class="project-body">
                            <span class="year-badge">{{ $project->year }}</span>
                            <span class="location-badge">{{ $project->location }}</span>
                            <h2>{{ $project->project_name }}</h2>
                            
                            <button class="btn-toggle-story" onclick="toggleProject('project-{{ $loop->index }}')">
                                <span class="btn-text">Selengkapnya</span>
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
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
                                        <div class="story-item" style="border-left-color: #10b981;">
                                            <div class="title" style="color: #10b981;">Our Solution</div>
                                            <p>{{ strip_tags($story->solution) }}</p>
                                        </div>
                                        <div class="story-item" style="border-left-color: #f59e0b;">
                                            <div class="title" style="color: #f59e0b;">The Result</div>
                                            <p>{{ strip_tags($story->result) }}</p>
                                        </div>
                                    @endforeach
                                    
                                    <button class="btn-close-bottom" onclick="toggleProject('project-{{ $loop->index }}')">
                                        Sembunyikan Cerita
                                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                    </button>
                                @else
                                    <p style="text-align:center; color:var(--text-muted); font-style:italic;">Detail cerita belum tersedia.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <div style="text-align:center; padding:100px 0;">
                        <p class="services-empty-text">Belum ada proyek yang dipublikasikan.</p>
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
        
        // Tutup yang lain agar fokus
        document.querySelectorAll('.project-item').forEach(item => {
            if(item.id !== projectId) {
                item.classList.remove('active');
                const otherBtn = item.querySelector('.btn-text');
                if(otherBtn) otherBtn.innerText = "Selengkapnya";
            }
        });

        if (isActive) {
            targetElement.classList.remove('active');
            btnText.innerText = "Selengkapnya";
            targetElement.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        } else {
            targetElement.classList.add('active');
            btnText.innerText = "Sembunyikan";
            setTimeout(() => {
                targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 100);
        }
    }
</script>
@endsection