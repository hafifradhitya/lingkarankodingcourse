@extends('front.layouts.app')
@section('title', 'Portfolio - Lingkaran Koding Online Learning Platform')

@push('after-styles')
    {{-- Optional font untuk judul stat (boleh dihapus kalau tak perlu) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&display=swap" rel="stylesheet">

    <style>
        /* ====== SOLO LEVELING CARD – THEME HIJAU LK (SCOPED) ======
           Prefix .sl- agar tidak bentrok dengan Tailwind/kode lain
        */
        .sl-root {
            /* Nilai stat dari StudentProgressService */
            --level: {{ (int) ($stats['completed_courses'] ?? 35) }};
            --exp: {{ (int) ($stats['overall_progress'] ?? 64) }};
            --hp: {{ (int) ($stats['completed_contents'] > 0 ? min(100, $stats['completed_contents']) : 82) }};
            --mp: {{ (int) ($stats['total_courses'] > 0 ? min(100, $stats['total_courses'] * 10) : 58) }};
            --str: {{ (int) ($stats['completed_courses'] > 0 ? min(100, $stats['completed_courses'] * 15) : 74) }};
            --agi: {{ (int) ($stats['overall_progress'] > 50 ? 80 : 67) }};
            --vit: {{ (int) ($stats['completed_contents'] > 0 ? min(100, $stats['completed_contents'] / 2) : 80) }};
            --int: {{ (int) ($stats['overall_progress'] > 70 ? 85 : 52) }};
            --sense: {{ (int) ($stats['total_contents'] > 0 ? min(100, $stats['total_contents'] / 3) : 44) }}
                /* Warna tema mengikuti navigasi kamu */
                --lk-green: #2F6A62;
            --lk-green-2: #3f877d;
            --lk-light: #E0EAE8;
            --lk-grey: #EAECEE;
            --lk-text: #0A0723;

            /* Mapping untuk kartu */
            --bg: #0b1211;
            /* latar gelap agar neon hijau “pop” */
            --bg2: #0e1716;
            --card: rgba(14, 24, 23, .55);
            --border: rgba(47, 106, 98, .45);
            --neon: var(--lk-green);
            --neon-2: #5bb1a5;
            --accent: #6cd8c7;
            --text: #e7fffa;
            --muted: #9fc5bf;
            --danger: #ff6b81;
            --mana: #7c9bff;
            --hpcol: #58f7b1;

            --radius: 18px;
            --gap: 18px;
            --shadow: 0 0 24px rgba(47, 106, 98, .24), inset 0 0 40px rgba(47, 106, 98, .08);
        }

        /* Layout wrapper (ikuti kontainer 1280px kamu) */
        .sl-wrap {
            width: min(1100px, 100%);
            margin: 40px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 360px 1fr;
            gap: var(--gap);
        }

        @media (max-width: 900px) {
            .sl-wrap {
                grid-template-columns: 1fr;
            }
        }

        .sl-card {
            position: relative;
            border-radius: var(--radius);
            background: linear-gradient(180deg, rgba(10, 18, 16, .78), rgba(9, 15, 14, .58));
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            overflow: hidden;
            isolation: isolate;
        }

        .sl-card::before,
        .sl-card::after {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        .sl-card::before {
            background:
                conic-gradient(from 0deg at 0 0, var(--neon) 0 25%, transparent 0 100%) top left/110px 110px no-repeat,
                conic-gradient(from 180deg at 100% 100%, var(--neon) 0 25%, transparent 0 100%) bottom right/110px 110px no-repeat;
            opacity: .16;
            filter: drop-shadow(0 0 12px var(--neon));
        }

        .sl-card::after {
            background: radial-gradient(420px 220px at 70% -20%, rgba(47, 106, 98, .22), transparent 60%);
            mix-blend-mode: screen;
        }

        .sl-panel {
            padding: 20px 18px 18px;
            color: var(--text);
        }

        .sl-title {
            font-family: Orbitron, Poppins, system-ui, sans-serif;
            letter-spacing: .06em;
            font-weight: 900;
            font-size: clamp(20px, 2.6vw, 28px);
            text-transform: uppercase;
            text-shadow: 0 0 18px rgba(47, 106, 98, .35);
            display: inline-flex;
            gap: 10px;
            align-items: center;
        }

        .sl-title .sl-blink {
            width: 8px;
            height: 8px;
            border-radius: 2px;
            background: var(--neon);
            box-shadow: 0 0 14px var(--neon);
            animation: sl-ping 1.8s infinite;
        }

        @keyframes sl-ping {
            0% {
                opacity: 1;
                transform: scale(1)
            }

            70% {
                opacity: .1;
                transform: scale(1.8)
            }

            100% {
                opacity: 0;
                transform: scale(2)
            }
        }

        .sl-grid {
            display: grid;
            gap: 12px;
        }

        .sl-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(47, 106, 98, .4), transparent);
            margin: 10px 0;
        }

        .sl-section {
            display: grid;
            gap: 12px;
        }

        .sl-section-title {
            font: 900 12px/1 Orbitron, Poppins, sans-serif;
            color: var(--neon-2);
            letter-spacing: .14em;
            text-transform: uppercase;
            opacity: .95;
        }

        .sl-header {
            display: grid;
            grid-template-columns: 72px 1fr auto;
            gap: 14px;
            align-items: center;
            padding: 6px 6px 2px;
        }

        @media (max-width:420px) {
            .sl-header {
                grid-template-columns: 60px 1fr;
            }

            .sl-rank {
                grid-column: 1/-1;
            }
        }

        .sl-avatar {
            width: 72px;
            aspect-ratio: 1;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, .08);
            background: linear-gradient(145deg, rgba(47, 106, 98, .15), transparent 60%);
            display: grid;
            place-items: center;
            color: var(--neon);
            font-family: Orbitron;
        }

        .sl-ident {
            display: grid;
            gap: 6px;
        }

        .sl-ident .sl-name {
            font-weight: 800;
            letter-spacing: .02em;
        }

        .sl-ident .sl-class {
            color: #cde7e2;
            font-size: 14px;
            opacity: .9;
        }

        .sl-rank {
            font-family: Orbitron;
            font-weight: 900;
            letter-spacing: .08em;
            font-size: 13px;
            color: #fff;
            padding: 8px 10px;
            border-radius: 999px;
            background: linear-gradient(180deg, var(--neon), var(--lk-green-2));
            box-shadow: 0 6px 18px rgba(47, 106, 98, .28);
            border: 1px solid rgba(255, 255, 255, .18);
        }

        .sl-label-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            font-size: 12px;
            color: #bce2dc;
        }

        .sl-label-row b {
            color: var(--text);
            letter-spacing: .02em;
        }

        .sl-bar {
            --val: 50;
            --color: var(--neon);
            position: relative;
            height: 12px;
            border-radius: 999px;
            overflow: hidden;
            background: rgba(255, 255, 255, .06);
            border: 1px solid rgba(255, 255, 255, .08);
        }

        .sl-bar::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(90deg, rgba(255, 255, 255, .18), transparent 30%),
                linear-gradient(90deg, var(--color) 0%, var(--color) 100%);
            width: calc(var(--val) * 1%);
            border-radius: inherit;
            filter: drop-shadow(0 0 10px var(--color));
            animation: sl-fill 1200ms cubic-bezier(.22, .9, .24, 1) forwards;
            transform-origin: left;
        }

        @keyframes sl-fill {
            from {
                width: 0
            }

            to {
                width: calc(var(--val) * 1%)
            }
        }

        .sl-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .sl-chip {
            padding: 8px 10px;
            border: 1px solid rgba(255, 255, 255, .1);
            color: var(--text);
            font: 700 12px/1 Poppins, sans-serif;
            border-radius: 999px;
            background: linear-gradient(180deg, rgba(255, 255, 255, .06), rgba(255, 255, 255, .02));
        }

        .sl-ribbon {
            font-family: Orbitron;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
            font-size: 12px;
            color: var(--neon);
            background: linear-gradient(90deg, rgba(47, 106, 98, .10), rgba(96, 187, 173, .10));
            border-top: 1px solid rgba(47, 106, 98, .25);
            padding: 14px 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .sl-ribbon small {
            color: #cfe9e4;
            letter-spacing: .06em;
        }

        .sl-statgrid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        @media (max-width:520px) {
            .sl-statgrid {
                grid-template-columns: 1fr;
            }
        }

        .sl-stat {
            padding: 14px;
            border-radius: 14px;
            border: 1px solid rgba(47, 106, 98, .25);
            background: linear-gradient(180deg, rgba(47, 106, 98, .12), rgba(47, 106, 98, .04));
            box-shadow: inset 0 0 22px rgba(47, 106, 98, .06);
        }

        .sl-stat h4 {
            margin: 0 0 8px;
            font: 800 12px/1 Orbitron, Poppins;
            letter-spacing: .08em;
            color: var(--neon-2);
            text-transform: uppercase;
        }

        .sl-stat .sl-val {
            font: 800 22px/1.1 Poppins;
            letter-spacing: .02em;
            margin-bottom: 10px;
            color: #f2fffd;
        }

        /* tipis “scanline” biar ada nuansa UI */
        .sl-scan::after {
            content: \"\";
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(to bottom, rgba(255, 255, 255, .06), rgba(255, 255, 255, .06) 1px, transparent 1px, transparent 3px);
            opacity: .055;
            mix-blend-mode: overlay;
            pointer-events: none;
        }
    </style>
@endpush

@section('content')
    <x-navigation-auth />

    <x-bottom-nav />

    {{-- ========= PORTFOLIO CONTENT ========= --}}
    <section class="pb-[118px] pt-5">
        <div class="sl-root">
            <div class="sl-wrap">
                {{-- LEFT CARD (Profile + Bars) --}}
                <section class="sl-card sl-scan">
                    <div class="sl-panel sl-grid">
                        <div class="sl-title"><span class="sl-blink"></span> My Portfolio</div>

                        <header class="sl-header">
                            <div class="sl-avatar">LV <span
                                    style="font-weight:900">{{ min(100, (int) ($stats['completed_courses'] ?? 1)) }}</span>
                            </div>
                            <div class="sl-ident">
                                <div class="sl-name">{{ $user->name ?? 'Your Name' }}</div>
                                <div class="sl-class">Student • Portfolio</div>
                            </div>
                            <div class="sl-rank">ACTIVE</div>
                        </header>

                        <div class="sl-divider"></div>

                        {{-- EXP - Based on started courses --}}
                        <div class="sl-grid" aria-label="Experience">
                            <div class="sl-label-row">
                                <b>Experience</b><span><span>{{ (int) ($stats['experience'] ?? 0) }}</span>%</span></div>
                            <div class="sl-bar"
                                style="--val: {{ (int) ($stats['experience'] ?? 0) }}; --color: var(--accent);"></div>
                        </div>

                        {{-- HP - Based on completed courses --}}
                        <div class="sl-grid" aria-label="HP">
                            <div class="sl-label-row"><b>HP</b><span><span>{{ (int) ($stats['hp'] ?? 0) }}</span>%</span>
                            </div>
                            <div class="sl-bar" style="--val: {{ (int) ($stats['hp'] ?? 0) }}; --color: var(--hpcol);">
                            </div>
                        </div>

                        {{-- MP - Based on completed categories --}}
                        <div class="sl-grid" aria-label="MP">
                            <div class="sl-label-row"><b>MP</b><span><span>{{ (int) ($stats['mp'] ?? 0) }}</span>%</span>
                            </div>
                            <div class="sl-bar" style="--val: {{ (int) ($stats['mp'] ?? 0) }}; --color: var(--mana);">
                            </div>
                        </div>

                        <div class="sl-divider"></div>

                        <div class="sl-section">
                            <div class="sl-section-title">Course Stats</div>
                            <div class="sl-chips">

                                @php
                                    // Menghitung persentase penyelesaian course
                                    $completionPercentage = 0;
                                    if (isset($stats['total_courses']) && $stats['total_courses'] > 0) {
                                        $completionPercentage = round(
                                            ($stats['completed_courses'] / $stats['total_courses']) * 100,
                                        );
                                    }

                                    // Menentukan julukan berdasarkan persentase
                                    $title = '';
                                    if ($completionPercentage <= 1) {
                                        $title = 'Malas Koding';
                                    } elseif ($completionPercentage <= 5) {
                                        $title = 'Niat Tipis';
                                    } elseif ($completionPercentage <= 10) {
                                        $title = 'Pemanas Mesin';
                                    } elseif ($completionPercentage <= 15) {
                                        $title = 'Konsisten Sebentar';
                                    } elseif ($completionPercentage <= 25) {
                                        $title = 'Pemula Tekun';
                                    } elseif ($completionPercentage <= 40) {
                                        $title = 'Mulai Konsisten';
                                    } elseif ($completionPercentage <= 50) {
                                        $title = 'Separuh Serius';
                                    } elseif ($completionPercentage <= 60) {
                                        $title = 'Terbiasa Rajin';
                                    } elseif ($completionPercentage <= 75) {
                                        $title = 'Disiplin Jalan';
                                    } elseif ($completionPercentage <= 80) {
                                        $title = 'Rajin Stabil';
                                    } elseif ($completionPercentage <= 90) {
                                        $title = 'Mode Ngoding';
                                    } elseif ($completionPercentage <= 95) {
                                        $title = 'Hampir Perfeksionis';
                                    } else {
                                        $title = 'Rajin Paripurna';
                                    }
                                @endphp

                                <span class="sl-chip">Status: {{ $title }}</span>

                                @php
                                    // Menampilkan kategori yang sudah 100% selesai
                                    $completedCategories = [];
                                    foreach ($stats['categories'] ?? [] as $categoryName => $categoryData) {
                                        if (isset($categoryData['progress']) && $categoryData['progress'] == 100) {
                                            $completedCategories[] = $categoryName;
                                        }
                                    }
                                @endphp

                                @foreach ($completedCategories as $category)
                                    <span class="sl-chip">Skill: {{ $category }} <span
                                            style="color: gold;">★</span></span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="sl-ribbon"><span>Category Mastery</span><small>{{ $stats['completed_categories'] ?? 0 }} /
                            {{ $stats['total_categories'] ?? 0 }} Categories Completed</small></div>
                </section>

                {{-- RIGHT CARD (Course Stats) --}}
                <section class="sl-card sl-scan">
                    <div class="sl-panel sl-grid">
                        <div class="sl-title"><span class="sl-blink"></span> Course Stats</div>

                        <div class="sl-statgrid">
                            @php
                                // palet fallback untuk non-100%
                                $palette = [
                                    'var(--neon)', // Green
                                    'var(--accent)', // Teal
                                    'var(--mana)', // Blue
                                    '#e3ffa6', // Lime
                                    '#ffe66b', // Yellow
                                    '#ff9f7f', // Orange
                                    '#ff7eb9', // Pink
                                ];
                                $colorIndex = 0;
                            @endphp

                            @forelse(($stats['courses'] ?? []) as $course)
                                @php
                                    // normalisasi persen (aman untuk 0..1 atau 0..100)
                                    $raw = (float) ($course->progress_percentage ?? 0);
                                    $normalized = $raw <= 1 ? $raw * 100 : $raw;
                                    $percentage = (int) round(max(0, min(100, $normalized)));

                                    // 100% => pakai hijau muda
                                    $color =
                                        $percentage === 100 ? 'var(--hpcol)' : $palette[$colorIndex % count($palette)];

                                    $colorIndex++;
                                @endphp

                                <div class="sl-stat {{ $percentage === 100 ? 'is-complete' : '' }}">
                                    <h4>
                                        {{ $course->name }}
                                        @if ($percentage === 100)
                                            <span style="color: gold;">★</span>
                                        @endif
                                    </h4>
                                    <div class="sl-val">{{ $percentage }}%</div>
                                    <div class="sl-bar" style="--val: {{ $percentage }}; --color: {{ $color }};">
                                    </div>
                                </div>
                            @empty
                                <div class="sl-stat">
                                    <h4>No courses found</h4>
                                    <div class="sl-val">0%</div>
                                    <div class="sl-bar" style="--val: 0; --color: var(--neon);"></div>
                                </div>
                            @endforelse
                        </div>

                        <div class="sl-divider"></div>

                        <div class="sl-section">
                            <div class="sl-section-title">Category Stats</div>
                            <div class="sl-statgrid">
                                @php
                                    $colors = ['#ff7675', '#74b9ff', '#55efc4', '#a29bfe', '#ffeaa7', '#fab1a0'];
                                    $colorIndex = 0;
                                @endphp

                                @forelse($stats['categories'] ?? [] as $categoryName => $category)
                                    @php
                                        $color = $colors[$colorIndex % count($colors)];
                                        $colorIndex++;
                                        $percentage = round($category['progress']);
                                        $isCompleted =
                                            $category['completed_courses'] == $category['total_courses'] &&
                                            $category['total_courses'] > 0;
                                    @endphp
                                    <div class="sl-stat">
                                        <h4>
                                            {{ $categoryName }}
                                            @if ($isCompleted)
                                                <span style="color: gold;">★</span>
                                            @endif
                                        </h4>
                                        <div class="sl-val">{{ $percentage }}%</div>
                                        <div class="sl-bar"
                                            style="--val: {{ $percentage }}; --color: {{ $color }};"></div>
                                    </div>
                                @empty
                                    <div class="sl-stat">
                                        <h4>No categories found</h4>
                                        <div class="sl-val">0</div>
                                        <div class="sl-bar" style="--val: 0; --color: var(--neon);"></div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="sl-ribbon"><span>Course Progress</span><small>{{ $stats['total_courses'] }} Courses</small>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection

@push('after-scripts')
    <script src="{{ asset('js/dropdown-navbar.js') }}"></script>
@endpush
