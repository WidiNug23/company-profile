@extends('layouts.front')

@section('title', 'Portofolio Proyek')

@section('content')
<div style="max-width:1200px; margin:60px auto; padding:0 16px; font-family:'Inter', sans-serif;">

    <h1 style="
        text-align:center;
        font-size:34px;
        font-weight:800;
        margin-bottom:50px;
        color:#111827;
        letter-spacing:-0.5px;
    ">
        Portofolio Proyek
    </h1>

    @forelse($projects as $project)
    <div style="
        background:#ffffff;
        border-radius:16px;
        box-shadow:0 10px 30px rgba(0,0,0,0.08);
        padding:28px;
        margin-bottom:40px;
        transition:0.3s;
    ">

        <!-- HEADER PROJECT -->
        <div style="display:flex; gap:24px; align-items:center;">

            @if($project->thumbnail)
                <img src="{{ asset('storage/'.$project->thumbnail) }}"
                     alt="{{ $project->project_name }}"
                     style="
                        width:140px;
                        height:95px;
                        object-fit:cover;
                        border-radius:12px;
                        box-shadow:0 4px 10px rgba(0,0,0,0.15);
                     ">
            @endif

            <div>
                <h2 style="
                    margin:0;
                    font-size:24px;
                    font-weight:700;
                    color:#1f2937;
                ">
                    {{ $project->project_name }}
                </h2>

                <p style="
                    margin-top:6px;
                    font-size:14px;
                    color:#6b7280;
                ">
                    {{ $project->location }} &nbsp;•&nbsp; {{ $project->year }}
                </p>
            </div>
        </div>

        <!-- STORIES -->
        <div style="margin-top:28px;">
            @if($project->stories->count() > 0)
                @foreach($project->stories as $story)
                <div style="
                    display:grid;
                    grid-template-columns:1fr;
                    gap:14px;
                    background:#f9fafb;
                    border-radius:12px;
                    padding:18px 20px;
                    margin-bottom:16px;
                    border-left:4px solid #2563eb;
                ">

                    <div>
                        <div style="font-size:13px; font-weight:700; color:#2563eb; margin-bottom:4px;">
                            Challenge
                        </div>
                        <div style="color:#374151; line-height:1.6;">
                            {{ strip_tags($story->challenge) }}
                        </div>
                    </div>

                    <div>
                        <div style="font-size:13px; font-weight:700; color:#10b981; margin-bottom:4px;">
                            Solution
                        </div>
                        <div style="color:#374151; line-height:1.6;">
                            {{ strip_tags($story->solution) }}
                        </div>
                    </div>

                    <div>
                        <div style="font-size:13px; font-weight:700; color:#f59e0b; margin-bottom:4px;">
                            Result
                        </div>
                        <div style="color:#374151; line-height:1.6;">
                            {{ strip_tags($story->result) }}
                        </div>
                    </div>

                </div>
                @endforeach
            @else
                <p style="color:#9ca3af; font-style:italic;">
                    Belum ada story untuk project ini.
                </p>
            @endif
        </div>
    </div>
    @empty
        <p style="text-align:center; color:#9ca3af;">
            Belum ada project yang tersedia.
        </p>
    @endforelse

</div>
@endsection
