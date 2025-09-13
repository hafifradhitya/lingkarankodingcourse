@extends('front.layouts.app')
@section('title', 'Course Learning - Lingkaran Koding Online Learning Platform')

@section('content')
    <div class="learning-shell flex h-screen overflow-hidden">
        {{-- ===== Aside (desktop tetap, mobile jadi off-canvas) ===== --}}
        <aside id="learning-aside"
            class="learning-aside flex flex-col border border-obito-grey bg-white
                  transition-transform duration-300
                  w-[260px] shrink-0 h-full">
            <button id="aside-close" class="aside-close" type="button" aria-label="Tutup daftar materi">
                <!-- Ikon X -->
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"
                    aria-hidden="true">
                    <path
                        d="M18.3 5.7a1 1 0 0 1 0 1.4L13.4 12l4.9 4.9a1 1 0 1 1-1.4 1.4L12 13.4l-4.9 4.9a1 1 0 0 1-1.4-1.4L10.6 12 5.7 7.1A1 1 0 0 1 7.1 5.7L12 10.6l4.9-4.9a1 1 0 0 1 1.4 0z" />
                </svg>
            </button>

            <div class="w-[260px] pb-[20px] h-[280px] px-5 pt-5 flex flex-col gap-5">
                <ul>
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <div
                                class="flex items-center gap-2 py-[10px] px-[14px] rounded-full border border-obito-grey bg-white hover:border-obito-green transition-all duration-300">
                                <img src="{{ asset('assets/images/icons/home-trend-up.svg') }}" alt="icon"
                                    class="size-[20px] shrink-0" />
                                <p>Back to Dashboard</p>
                            </div>
                        </a>
                    </li>
                </ul>

                <header class="flex flex-col gap-[12px]">
                    <div class="flex justify-center items-center overflow-hidden w-full h-[100px] rounded-[14px]">
                        <img src="{{ Storage::url($course->thumbnail) }}" alt="image"
                            class="w-full h-full object-cover" />
                    </div>
                    <h1 class="font-bold">{{ $course->name }}</h1>
                </header>

                <hr class="border-obito-grey" />
            </div>

            <div id="lessons-container" class="h-full overflow-y-auto [&::-webkit-scrollbar]:hidden w-[260px]">
                <nav class="px-5 pb-[33px] flex flex-col gap-5">
                    @foreach ($course->courseSections as $section)
                        <div class="lesson accordion flex flex-col gap-4">
                            <button type="button" data-expand="{{ $section->id }}"
                                class="flex items-center justify-between">
                                <h2 class="font-semibold">{{ $section->name }}</h2>
                                <img src="{{ asset('assets/images/icons/arrow-circle-down.svg') }}" alt="icon"
                                    class="size-6 shrink-0 transition-all duration-300" />
                            </button>
                            <div id="{{ $section->id }}">
                                <ul class="flex flex-col gap-4">
                                    @foreach ($section->sectionContents as $content)
                                        <li
                                            class="group {{ $currentSection && $section->id == $currentSection->id && $currentContent->id == $content->id ? 'active' : '' }}">
                                            <a href="{{ route('dashboard.course.learning', [
                                                'course' => $course->slug,
                                                'courseSection' => $section->id,
                                                'sectionContent' => $content->id,
                                            ]) }}"
                                                class="lesson-link block">
                                                <div
                                                    class="px-4 group-[&.active]:bg-obito-black group-[&.active]:border-transparent group-[&.active]:text-white py-[10px] rounded-full border border-obito-grey group-hover:bg-obito-black transition-all duration-300">
                                                    <h3
                                                        class="font-semibold text-sm leading-[21px] group-hover:text-white transition-all duration-300">
                                                        {{ $content->name }}
                                                    </h3>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <hr class="border-obito-grey" />
                    @endforeach
                </nav>
            </div>
        </aside>

        {{-- ===== Content ===== --}}
        <div class="learning-content flex-grow overflow-y-auto">
            {{-- Mobile top bar: tombol buka sidebar + judul singkat --}}
            <div class="mobile-topbar">
                <button id="aside-toggle" class="btn-lessons" type="button" aria-controls="learning-aside"
                    aria-expanded="false" aria-label="Buka daftar materi">
                    <!-- Ikon buku -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block align-[-2px]" width="14" height="14"
                        viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path
                            d="M3 4.5A2.5 2.5 0 0 1 5.5 2H20a1 1 0 0 1 1 1v15.5a1 1 0 0 1-1.3.96A10.3 10.3 0 0 0 15 18H6.5A1.5 1.5 0 0 0 5 19.5v.5a1 1 0 0 1-2 0V4.5zM5.5 4A.5.5 0 0 0 5 4.5V17c.44-.32.97-.5 1.5-.5H19V4H5.5z" />
                    </svg>
                    <span style="margin-left:6px">Materi</span>
                </button>
                <div class="topbar-title line-clamp-1">{{ $course->name }}</div>
            </div>

            <main class="learning-main pt-[30px] pb-[118px] pl-[50px] pr-[50px]">
                <article class="content-ebook">
                    <h1 class="mb-5">{{ $currentContent->name }}</h1>
                    {!! $currentContent->content !!}

                    {{-- Video player (jika ada) --}}
                    @if (!empty($currentContent?->path_video))
                        <div class="video-wrapper" style="position: relative; width: 100%; padding-top: 56.25%;">
                            <div class="plyr__video-embed" id="player"
                                style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                <iframe
                                    src="https://www.youtube.com/embed/{{ $currentContent->youtube_id ?? $currentContent->path_video }}?origin={{ urlencode(config('app.url')) }}&iv_load_policy=3&modestbranding=1&playsinline=1&showinfo=0&rel=0&enablejsapi=1"
                                    allowfullscreen allowtransparency allow="autoplay"></iframe>
                            </div>
                        </div>
                        <div style="height:20px;"></div>
                    @endif
                </article>
            </main>

            {{-- Bottom bar --}}
            <nav id="learning-bottombar"
                class="fixed bottom-0 left-0 right-0 z-30 mx-auto w-[calc(100%-260px)] pt-5 pb-[30px] bg-[#F8FAF9]">
                <div class="px-[30px]">
                    <div
                        class="content border border-obito-grey rounded-[20px] bg-white p-[12px] flex items-center justify-between gap-3">
                        <p class="text-obito-text-secondary text-sm md:text-base">
                            Pelajari materi dengan baik, jika bingung maka tanya mentor kelas
                        </p>
                        <div class="buttons flex items-center gap-[12px]">
                            <a href="#"
                                class="rounded-full border border-obito-grey px-5 py-[10px] hover:border-obito-green transition-all duration-300">
                                <span class="font-semibold">Ask Mentor</span>
                            </a>

                            @if (!$isFinished && $nextContent)
                <a href="{{ route('dashboard.course.learning', [
                    'course' => $course->slug,
                    'courseSection' => $nextContent->course_section_id,
                    'sectionContent' => $nextContent->id,
                ]) }}"
                    class="rounded-full border bg-obito-green text-white px-5 py-[10px] hover:drop-shadow-effect transition-all duration-300">
                    <span class="font-semibold">Next Lesson</span>
                </a>
                            @else
                                @php
                                    $allContents = collect();
                                    foreach ($course->courseSections as $section) {
                                        $allContents = $allContents->merge($section->sectionContents);
                                    }
                                    
                                    $completedContents = app(\App\Services\StudentProgressService::class)->getCompletedContents($course);
                                    $completedContentIds = $completedContents->pluck('id');
                                    
                                    $totalContents = $allContents->count();
                                    $completedCount = $completedContentIds->count();
                                    
                                    $isAllCompleted = $totalContents > 0 && $completedCount >= $totalContents;
                                @endphp
                                
                                @if ($isAllCompleted)
                                    <a href="{{ route('dashboard.course.learning.finished', $course->slug) }}"
                                        class="rounded-full border bg-obito-green text-white px-5 py-[10px] hover:drop-shadow-effect transition-all duration-300">
                                        <span class="font-semibold">Finish Learning</span>
                                    </a>
                                @else
                                    <a href="{{ route('dashboard.course.details', $course->slug) }}"
                                        class="rounded-full border bg-obito-green text-white px-5 py-[10px] hover:drop-shadow-effect transition-all duration-300">
                                        <span class="font-semibold">Back</span>
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
@endsection

@push('after-styles')
    {{-- Plyr CSS --}}
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css">
    {{-- Highlight.js --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/default.min.css">
    <link rel="stylesheet" href="{{ asset('content.css') }}">

    <style>
        /* =========================
                                                                                       Responsive rules (mobile)
                                                                                       ========================= */
        :root {
            --lk-green: #2F6A62;
            --lk-border: #E5E7EB;
            --lk-shadow: 0 10px 30px rgba(0, 0, 0, .06);
        }

        /* shell */
        .learning-shell {
            position: relative
        }

        /* ----- Aside: desktop default (tidak diubah) ----- */
        /* ----- Mobile: jadikan off-canvas ----- */
        @media (max-width: 1024px) {
            .learning-aside {
                position: fixed;
                top: 0;
                left: 0;
                height: 100dvh;
                transform: translateX(-100%);
                background: #fff;
                z-index: 40;
                box-shadow: var(--lk-shadow);
            }

            .learning-aside.is-open {
                transform: translateX(0);
            }

            /* overlay */
            .learning-shell::after {
                content: '';
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, .3);
                opacity: 0;
                pointer-events: none;
                transition: .2s;
                z-index: 30;
            }

            .learning-shell.has-overlay::after {
                opacity: 1;
                pointer-events: auto;
            }

            /* topbar (mobile only) */
            .mobile-topbar {
                position: sticky;
                top: 0;
                z-index: 20;
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 10px 14px;
                border-bottom: 1px solid var(--lk-border);
                background: #fff;
            }

            .btn-lessons {
                border: 1px solid var(--lk-border);
                padding: 8px 12px;
                border-radius: 999px;
                font-weight: 600;
                background: #fff;
            }

            .topbar-title {
                font-weight: 600;
                flex: 1;
                overflow: hidden;
            }

            /* main content padding lebih kecil & full width */
            .learning-main {
                padding: 16px 14px 120px 14px !important;
            }

            /* artikel & elemen internal full width */
            .content-ebook,
            .content-ebook article,
            article {
                width: 100% !important;
                max-width: 100% !important;
            }

            .content-ebook img,
            article img {
                width: 100% !important;
                height: auto;
                border-radius: 14px;
            }

            /* bottom bar full width */
            #learning-bottombar {
                width: 100% !important;
                padding-bottom: 18px !important;
                background: rgba(248, 250, 249, .9);
                backdrop-filter: saturate(120%) blur(6px);
            }

            /* tombol di bottom bar wrap */
            #learning-bottombar .content {
                gap: 10px;
                flex-wrap: wrap;
            }

            #learning-bottombar .buttons {
                width: 100%;
                justify-content: flex-end;
                gap: 8px;
            }
        }

        /* ====== FIX: Desktop layout rapi, tombol Lessons hilang ====== */

        /* Default: sembunyikan topbar mobile */
        .mobile-topbar {
            display: none;
        }

        /* Desktop ≥1025px: pastikan aside fixed ke layout normal & tak ada overlay */
        @media (min-width: 1025px) {
            .learning-aside {
                position: relative !important;
                transform: none !important;
                box-shadow: none !important;
                height: auto;
                /* biar ngikut parent */
            }

            /* Jangan tampilkan overlay di desktop */
            .learning-shell::after {
                display: none !important;
            }

            /* Sembunyikan baris topbar mobile + tombol Lessons */
            .mobile-topbar,
            #aside-toggle {
                display: none !important;
            }

            /* Main content padding seperti semula (desktop) */
            .learning-main {
                padding: 30px 50px 118px 50px !important;
            }

            /* Bottom bar menyesuaikan lebar konten (offset oleh aside 260px) */
            #learning-bottombar {
                left: 260px !important;
                /* offset sidebar */
                right: 0 !important;
                width: calc(100% - 260px) !important;
                background: #F8FAF9;
                /* tanpa blur di desktop */
                backdrop-filter: none !important;
                padding-bottom: 30px !important;
            }

            /* Tombol di bottombar tetap sejajar kanan di desktop */
            #learning-bottombar .content {
                flex-wrap: nowrap !important;
            }

            #learning-bottombar .buttons {
                width: auto !important;
                justify-content: flex-end !important;
                gap: 12px !important;
            }
        }

        /* Mobile ≤1024px: tampilkan topbar + aktifkan off-canvas (sudah ada sebelumnya) */
        @media (max-width: 1024px) {
            .mobile-topbar {
                display: flex;
                align-items: center;
                gap: 10px;
                position: sticky;
                top: 0;
                z-index: 20;
                padding: 10px 14px;
                border-bottom: 1px solid var(--lk-border);
                background: #fff;
            }
        }


        /* ----- Video & code polish (tetap) ----- */
        .video-wrapper {
            border: 1px solid var(--lk-border);
            border-radius: 20px;
            box-shadow: var(--lk-shadow);
            background: #fff;
            overflow: hidden;
        }

        .plyr--full-ui.plyr--video {
            border-radius: 20px
        }

        .plyr__control.plyr__tab-focus,
        .plyr__control:hover {
            background: var(--lk-green)
        }

        /* Code blocks */
        pre.theme-tokyo-night-dark {
            background: #0b1220;
            color: #e6edf3;
            border: 1px solid #1f2a44;
            border-radius: 14px;
            box-shadow: var(--lk-shadow);
            padding: 16px 18px;
            overflow: auto;
            line-height: 1.6;
            position: relative;
        }

        pre.theme-tokyo-night-dark code {
            border: none !important;
            outline: none !important;
            background: transparent !important;
        }

        .code-copy-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            border: 1px solid var(--lk-border);
            background: #fff;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
        }

        /* ===== Copy button: kontras & readable di code block gelap ===== */
        pre.theme-tokyo-night-dark {
            position: relative;
        }

        .code-copy-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border: 1px solid rgba(255, 255, 255, .25);
            border-radius: 999px;
            background: rgba(0, 0, 0, .55);
            /* kontras di atas code bg */
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            box-shadow: 0 6px 18px rgba(0, 0, 0, .25);
            backdrop-filter: saturate(140%) blur(2px);
            transition: background .15s ease, transform .15s ease, border-color .15s ease;
            z-index: 2;
        }

        .code-copy-btn:hover {
            background: rgba(0, 0, 0, .75);
            transform: translateY(-1px);
        }

        .code-copy-btn:active {
            transform: translateY(0);
        }

        .code-copy-btn:focus-visible {
            outline: 2px solid var(--lk-green, #2F6A62);
            outline-offset: 2px;
        }

        /* ikon kertas & centang (SVG inline via mask) */
        .code-copy-btn .copy-ic,
        .code-copy-btn .check-ic {
            width: 14px;
            height: 14px;
            display: inline-block;
            background: currentColor;
            -webkit-mask-size: cover;
            mask-size: cover;
        }

        .code-copy-btn .copy-ic {
            -webkit-mask-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23000" viewBox="0 0 24 24"><path d="M16 1H4a2 2 0 0 0-2 2v12h2V3h12V1zm3 4H8a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2zm0 16H8V7h11v14z"/></svg>');
            mask-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23000" viewBox="0 0 24 24"><path d="M16 1H4a2 2 0 0 0-2 2v12h2V3h12V1zm3 4H8a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2zm0 16H8V7h11v14z"/></svg>');
        }

        .code-copy-btn .check-ic {
            display: none;
            /* default tersembunyi */
            -webkit-mask-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23000" viewBox="0 0 24 24"><path d="M9 16.2 4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4z"/></svg>');
            mask-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23000" viewBox="0 0 24 24"><path d="M9 16.2 4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4z"/></svg>');
        }

        /* state: berhasil dicopy */
        .code-copy-btn[data-copied="true"] {
            background: var(--lk-green, #2F6A62);
            border-color: var(--lk-green, #2F6A62);
            color: #fff;
        }

        .code-copy-btn[data-copied="true"] .copy-ic {
            display: none;
        }

        .code-copy-btn[data-copied="true"] .check-ic {
            display: inline-block;
        }

        /* dukungan theme terang: kalau nanti pre-nya terang, tetap kontras */
        @media (prefers-color-scheme: light) {
            .code-copy-btn {
                background: rgba(0, 0, 0, .6);
                color: #fff;
                border-color: rgba(255, 255, 255, .35);
            }
        }

        /* === FIX: Konten artikel patuh viewport (mobile ≤1024px) === */
        @media (max-width: 1024px) {

            /* pastikan area konten boleh menyusut & tidak bikin body melar */
            .learning-content {
                min-width: 0;
                overflow-x: hidden;
            }

            .learning-main {
                padding: 16px 14px 120px 14px !important;
            }

            /* artikel full-width, tapi tetap nyaman dibaca */
            .content-ebook {
                width: 100% !important;
                max-width: min(100%, 720px) !important;
                margin: 0 auto;
            }

            /* ini kunci: batasi semua anak agar tidak melebihi viewport */
            .content-ebook *,
            .content-ebook article {
                max-width: 100% !important;
            }

            /* gambar & video responsif */
            .content-ebook img,
            .content-ebook video {
                display: block;
                width: 100% !important;
                height: auto !important;
                border-radius: 14px;
            }

            /* iframe (YouTube) responsif penuh */
            .content-ebook iframe {
                display: block;
                width: 100% !important;
                max-width: 100% !important;
            }

            /* tabel lebar → scroll lokal, bukan halaman */
            .content-ebook table {
                display: block;
                max-width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                border-collapse: collapse;
            }

            /* kode panjang → scroll lokal di dalam pre */
            .content-ebook pre {
                max-width: 100%;
                overflow-x: auto;
                white-space: pre;
                /* biar format kode aman */
            }

            /* kata/URL super panjang → patah elegan */
            .content-ebook p,
            .content-ebook li {
                overflow-wrap: anywhere;
                word-break: break-word;
            }

            /* bottombar full width di mobile, override kelas w-[calc(100%-260px)] */
            #learning-bottombar {
                left: 0 !important;
                right: 0 !important;
                width: 100% !important;
            }
        }
    </style>
    <style>
        .mobile-topbar {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }

        .btn-lessons {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            background-color: #1e293b;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-lessons:hover {
            background-color: #2F6A62;
        }

        .btn-lessons svg {
            flex-shrink: 0;
        }

        .topbar-title {
            font-size: 16px;
            font-weight: 600;
            color: #1e293b;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Untuk memastikan penyelarasan sempurna di semua perangkat */
        @media (max-width: 640px) {
            .mobile-topbar {
                padding: 10px 12px;
            }

            .btn-lessons {
                padding: 6px 10px;
                font-size: 13px;
            }

            .topbar-title {
                font-size: 14px;
            }
        }

        .aside-close {
            --lk-accent: #2F6A62;
        }

        .aside-close::before {
            content: "";
            position: absolute;
            left: -16px;
            /* sedikit lebih overlap */
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            /* lebih besar dari 14px */
            height: 36px;
            /* lebih tinggi agar proporsional dengan tombol 44px */
            background:
                linear-gradient(180deg, #fff 0%, #fff 60%, #F8FAF9 100%);
            /* gradasi subtle */
            border: 1px solid var(--lk-border, #E5E7EB);
            border-right: none;
            /* biar "menyatu" */
            border-radius: 18px 0 0 18px;
            /* kapsul setengah */
            box-shadow: 0 10px 30px rgba(0, 0, 0, .10);
        }

        /* Tombol close aside (mobile only) */
        .aside-close {
            display: none;
            /* default hidden */
            position: absolute;
            top: 50%;
            left: 100%;
            /* keluar persis di sisi kanan aside */
            transform: translate(8px, -50%);
            /* sedikit menjauh dari tepi */
            width: 42px;
            height: 42px;
            border-radius: 999px;
            background: #fff;
            border: 1px solid var(--lk-border, #E5E7EB);
            box-shadow: 0 10px 30px rgba(0, 0, 0, .12);
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 41;
            /* di atas overlay (overlay zIndex:39) dan aside (40) */
            transition: transform .15s ease, box-shadow .15s ease, background .15s ease;
        }

        .aside-close::after {
            content: "";
            position: absolute;
            left: -16px;
            /* sejajar dengan ::before */
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            /* ketebalan aksen */
            height: 24px;
            /* lebih pendek dari body -> terlihat elegan */
            background: var(--lk-accent);
            border-radius: 4px;
            /* ujung membulat */
            box-shadow: 0 2px 10px rgba(47, 106, 98, .25);
            /* glow halus hijau */
            opacity: .95;
            pointer-events: none;
            /* tidak menghalangi klik */
        }

        /* interaksi halus saat hover/active */
        .aside-close:hover::after {
            height: 28px;
        }

        .aside-close:active::after {
            height: 22px;
            opacity: .9;
        }

        /* opsional: ring tipis saat hover di tombol (matching aksen) */
        .aside-close:hover {
            box-shadow: 0 14px 36px rgba(0, 0, 0, .16), 0 0 0 3px rgba(47, 106, 98, .08);
        }

        /* Tampilkan hanya pada mobile dan hanya saat aside terbuka */
        @media (max-width: 1024px) {
            .learning-aside.is-open .aside-close {
                display: inline-flex;
            }
        }

        /* Sembunyikan paksa di desktop */
        @media (min-width: 1025px) {
            .aside-close {
                display: none !important;
            }
        }
    </style>
@endpush

@push('after-scripts')
    {{-- deps --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/accordion.js') }}"></script>
    <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            /* =========================
               0) Safe query helpers
               ========================= */
            const $ = (sel, root = document) => root.querySelector(sel);
            const $$ = (sel, root = document) => Array.from(root.querySelectorAll(sel));

            /* =========================
               1) MOBILE ASIDE TOGGLE
               ========================= */
            const aside = $('#learning-aside');
            const shell = $('.learning-shell');
            const toggleBtn = $('#aside-toggle');

            // real overlay element (lebih reliabel daripada ::after)
            let overlay = $('#aside-overlay');
            if (!overlay) {
                overlay = document.createElement('div');
                overlay.id = 'aside-overlay';
                Object.assign(overlay.style, {
                    position: 'fixed',
                    inset: '0',
                    background: 'rgba(0,0,0,.3)',
                    zIndex: '39',
                    display: 'none'
                });
                document.body.appendChild(overlay);
            }

            const openAside = () => {
                if (!aside || !shell) return;
                aside.classList.add('is-open');
                shell.classList.add('has-overlay');
                overlay.style.display = 'block';
                toggleBtn && toggleBtn.setAttribute('aria-expanded', 'true');
                document.documentElement.style.overflow = 'hidden';
                document.body.style.overflow = 'hidden';
            };

            const closeAside = () => {
                if (!aside || !shell) return;
                aside.classList.remove('is-open');
                shell.classList.remove('has-overlay');
                overlay.style.display = 'none';
                toggleBtn && toggleBtn.setAttribute('aria-expanded', 'false');
                document.documentElement.style.overflow = '';
                document.body.style.overflow = '';
            };

            // ⬇⬇⬇ Tambahkan binding tombol close DI SINI
            const closeBtn = $('#aside-close');
            if (closeBtn) {
                closeBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    closeAside();
                });
                // aksesibilitas keyboard (optional)
                closeBtn.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        closeAside();
                    }
                });
            }
            // ⬆⬆⬆

            toggleBtn && toggleBtn.addEventListener('click', () => {
                aside.classList.contains('is-open') ? closeAside() : openAside();
            });

            overlay.addEventListener('click', closeAside);

            $$('.lesson-link').forEach(a => a.addEventListener('click', closeAside));

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && aside && aside.classList.contains('is-open')) {
                    closeAside();
                }
            });

            const mq = window.matchMedia('(min-width: 1025px)');
            const handleMQ = (ev) => {
                if (ev.matches) closeAside();
            };
            mq.addEventListener ? mq.addEventListener('change', handleMQ) : mq.addListener(handleMQ);

            /* =========================
               2) HIGHLIGHT + COPY BUTTON
               ========================= */
            // live region untuk screen reader
            let live = $('#copy-live');
            if (!live) {
                live = document.createElement('div');
                live.id = 'copy-live';
                live.setAttribute('aria-live', 'polite');
                live.setAttribute('aria-atomic', 'true');
                // visually hidden
                Object.assign(live.style, {
                    position: 'fixed',
                    width: '1px',
                    height: '1px',
                    overflow: 'hidden',
                    clipPath: 'inset(50%)',
                    inset: 'auto 0 0 0'
                });
                document.body.appendChild(live);
            }

            $$('#learning-aside pre, .learning-content pre, pre').forEach(pre => {
                // hindari duplikasi tombol
                if (pre.dataset.copyInit === '1') return;
                pre.dataset.copyInit = '1';

                pre.classList.add('theme-tokyo-night-dark');

                // Pastikan <code> ada
                if (!pre.querySelector('code')) {
                    const code = document.createElement('code');
                    // pakai textContent agar indentasi/karakter tidak berubah
                    code.textContent = pre.textContent.trim();
                    pre.innerHTML = '';
                    pre.appendChild(code);
                }

                // tombol copy (ikon + label)
                const btn = document.createElement('button');
                btn.className = 'code-copy-btn';
                btn.type = 'button';
                btn.setAttribute('aria-label', 'Copy code');

                const icCopy = document.createElement('span');
                icCopy.className = 'copy-ic';

                const icCheck = document.createElement('span');
                icCheck.className = 'check-ic';

                const label = document.createElement('span');
                label.textContent = 'Copy';

                btn.append(icCopy, icCheck, label);

                btn.addEventListener('click', async () => {
                    const codeEl = pre.querySelector('code');
                    const text = codeEl ? codeEl.textContent : '';
                    try {
                        await navigator.clipboard.writeText(text);
                        // state sukses
                        btn.dataset.copied = 'true';
                        label.textContent = 'Copied';
                        live.textContent = 'Code copied to clipboard';
                        setTimeout(() => {
                            btn.dataset.copied = 'false';
                            label.textContent = 'Copy';
                        }, 1300);
                    } catch (e) {
                        console.error('Copy failed', e);
                        live.textContent = 'Copy failed';
                    }
                });

                pre.appendChild(btn);
            });

            // init highlight.js kalau tersedia
            if (window.hljs && typeof window.hljs.highlightAll === 'function') {
                window.hljs.highlightAll();
            }
        });
    </script>
@endpush
