@extends('front.layouts.app')
@section('title', 'My Courses - Lingkaran Koding Online Learning Platform')
@section('content')
    <x-navigation-auth />

    <x-bottom-nav />

    <main class="flex flex-col gap-10 pb-10 mt-[30px] main-content">
        <section id="roadmap" class="flex flex-col w-full max-w-[1280px] px-[75px] gap-4 mx-auto section-container">
            <h2 class="font-bold text-[22px] leading-[33px] section-title">Popular Roadmap</h2>
            <div class="grid grid-cols-2 gap-5 roadmap-grid">
                @forelse($popularCourses as $course)
                    <a href="{{ route('dashboard.course.details', $course) }}" class="card">
                        <div
                            class="roadmap-card flex items-center rounded-[20px] border border-obito-grey p-[10px] pr-4 gap-4 bg-white hover:border-obito-green transition-all duration-300">
                            <div
                                class="relative flex shrink-0 w-[240px] h-[150px] rounded-[14px] overflow-hidden bg-obito-grey roadmap-thumbnail">
                                <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('assets/images/thumbnails/thumbnail-1.png') }}"
                                    class="w-full h-full object-cover" alt="{{ $course->name }}">
                                <p
                                    class="absolute flex m-[10px] bottom-0 w-[calc(100%-20px)] items-center gap-0.5 bg-white rounded-[14px] py-[6px] px-2 roadmap-badge">
                                    <img src="{{ asset('assets/images/icons/cup.svg') }}" class="flex shrink-0 w-5"
                                        alt="icon">
                                    <span class="font-semibold text-xs leading-[18px] badge-text">
                                        {{ $course->category->name ?? 'Uncategorized' }}
                                    </span>
                                </p>

                                <span class="badge {{ $course->is_free ? 'badge--free' : 'badge--premium' }}">
                                    {{ $course->is_free ? 'FREE' : 'PREMIUM' }}
                                </span>
                            </div>
                            <div class="flex flex-col gap-3 roadmap-content">
                                <h3 class="font-bold text-lg line-clamp-2 roadmap-title">{{ $course->name }}</h3>
                                <p class="flex items-center gap-[6px] roadmap-info">
                                    <img src="{{ asset('assets/images/icons/briefcase-green.svg') }}"
                                        class="flex shrink-0 w-5" alt="icon">
                                    <span class="text-sm text-obito-text-secondary">
                                        {{ $course->courseStudents()->count() }} Students
                                    </span>
                                </p>
                                <p class="flex items-center gap-[6px] roadmap-info">
                                    <img src="{{ asset('assets/images/icons/menu-board-green.svg') }}"
                                        class="flex shrink-0 w-5" alt="icon">
                                    <span class="text-sm text-obito-text-secondary">
                                        {{ $course->content_count }} Contents
                                    </span>
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="text-obito-text-secondary">Belum ada course populer untuk ditampilkan.</p>
                @endforelse
            </div>
        </section>
        <section id="catalog" class="flex flex-col w-full max-w-[1280px] px-[75px] gap-4 mx-auto section-container">
            <h1 class="font-bold text-[22px] leading-[33px] section-title">Course Catalog</h1>
            <div id="tabs-container" class="flex items-center gap-3 tabs-wrapper">

                @foreach ($coursesByCategory as $category => $courses)
                    <button type="button" class="tab-btn group {{ $loop->first ? 'active' : '' }}"
                        data-target="{{ Str::slug($category) }}-content">
                        <p
                            class="rounded-full border border-obito-grey py-2 px-4 hover:border-obito-green bg-white transition-all duration-300 group-[.active]:bg-obito-black tab-button">
                            <span class="group-[.active]:font-semibold group-[.active]:text-white tab-text">
                                {{ $category }}
                            </span>
                        </p>
                    </button>
                @endforeach

            </div>
            <div id="tabs-content-container" class="mt-1">

                @foreach ($coursesByCategory as $category => $courses)
                    <div id="{{ Str::slug($category) }}-content"
                        class="{{ $loop->first ? '' : 'hidden' }} tab-content grid grid-cols-4 gap-5 course-grid">

                        @forelse ($courses as $course)
                            <x-course-card :course="$course" />
                        @empty
                            <p class="empty-message">belum ada kelas pada kategori ini</p>
                        @endforelse

                    </div>
                @endforeach

            </div>
        </section>
    </main>
@endsection

@push('after-styles')
    <style>
        /* Responsive Styles */
        @media (max-width: 768px) {
            /* Main Content Mobile Styles */
            .main-content {
                margin-top: 20px;
                margin-bottom: 80px;
                /* Space for fixed bottom nav */
                gap: 30px;
            }

            .section-container {
                padding: 0 20px;
                max-width: 100%;
            }

            .section-title {
                font-size: 20px;
                line-height: 28px;
            }

            /* Roadmap Mobile Styles */
            .roadmap-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .roadmap-card {
                flex-direction: column;
                padding: 15px;
                gap: 15px;
                align-items: flex-start;
            }

            .roadmap-thumbnail {
                width: 100%;
                height: 180px;
            }

            .roadmap-badge {
                margin: 10px;
                width: calc(100% - 20px);
            }

            .badge-text {
                font-size: 10px;
            }

            .roadmap-content {
                width: 100%;
            }

            .roadmap-title {
                font-size: 16px;
            }

            .roadmap-info span {
                font-size: 13px;
            }

            /* Tabs Mobile Styles */
            .tabs-wrapper {
                overflow-x: auto;
                scrollbar-width: none;
                -ms-overflow-style: none;
                padding-bottom: 5px;
            }

            .tabs-wrapper::-webkit-scrollbar {
                display: none;
            }

            .tab-btn {
                flex-shrink: 0;
            }

            .tab-button {
                padding: 8px 16px;
                white-space: nowrap;
            }

            .tab-text {
                font-size: 14px;
            }

            /* Course Grid Mobile Styles */
            .course-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .empty-message {
                grid-column: 1 / -1;
                text-align: center;
                padding: 20px;
                color: #6b7280;
            }
        }

        /* Tablet Styles */
        @media (min-width: 769px) and (max-width: 1024px) {
            .section-container {
                padding: 0 40px;
            }

            .nav-list {
                padding: 0 40px;
            }

            .roadmap-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .roadmap-thumbnail {
                width: 200px;
                height: 130px;
            }

            .course-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* Small Mobile Styles */
        @media (max-width: 480px) {
            .nav-list {
                padding: 0 15px;
                gap: 6px;
            }

            .nav-link {
                padding: 6px 10px;
            }

            .nav-text {
                font-size: 11px;
            }

            .section-container {
                padding: 0 15px;
            }

            .section-title {
                font-size: 18px;
                line-height: 26px;
            }

            .roadmap-card {
                padding: 12px;
            }

            .roadmap-thumbnail {
                height: 160px;
            }

            .roadmap-title {
                font-size: 15px;
            }

            .tab-button {
                padding: 6px 12px;
            }

            .tab-text {
                font-size: 13px;
            }

            .course-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }
        }

        /* Desktop Styles - Keep Original */
        @media (min-width: 1025px) {

            /* Original desktop styles are preserved */
            #bottom-nav {
                position: static;
                border-bottom: 1px solid #e5e7eb;
                border-top: none;
            }

            .main-content {
                margin-bottom: 40px;
            }
        }
    </style>
@endpush
@push('after-scripts')
    <script src="{{ asset('js/dropdown-navbar.js') }}"></script>
    <script src="{{ asset('js/tabs.js') }}"></script>
@endpush
