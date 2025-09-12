@extends('front.layouts.app')
@section('title', 'Details - Lingkaran Koding Online Learning Platform')
@section('content')
    <x-navigation-auth />

    <x-bottom-nav />

    <main class="flex flex-col gap-[30px] pb-10 mt-[30px]">
        <header
            class="flex items-center w-full max-w-[1000px] rounded-[20px] border border-obito-grey p-5 gap-[30px] bg-white mx-auto">
            <div id="thumbnail-container"
                class="flex relative w-[500px] h-[350px] shrink-0 rounded-[14px] overflow-hidden bg-obito-grey">
                <img src="{{ Storage::url($course->thumbnail) }}" class="w-full h-full object-cover" alt="thumbnail">
                <p
                    class="absolute bottom-[10px] left-[10px] z-10 w-fit h-fit flex flex-col items-center rounded-[14px] py-[6px] px-[10px] bg-white gap-0.5 z-10">
                    <img src="{{ asset('assets/images/icons/like.svg') }}" class="w-5 h-5" alt="icon">
                    <span class="font-semibold text-xs">4.8</span>
                </p>
                <button type="button" class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 z-10">
                    <img src="{{ asset('assets/images/icons/video-circle-green-fill.svg') }}"
                        class="flex w-[60px] h-[60px] shrink-0" alt="icon">
                </button>
            </div>
            <div id="course-info" class="flex flex-col justify-center gap-[30px]">
                <div class="flex flex-col gap-[10px]">
                    @if ($course->is_popular)
                        <p id="badge"
                            class="flex items-center bg-custom-gradient gap-[6px] rounded-[14px] py-[6px] px-2 w-fit">
                            <img src="{{ asset('assets/images/icons/cup-white.svg') }}" class="w-5 flex shrink-0"
                                alt="icon">
                            <span class="font-semibold text-xs text-white">This Course is Popular This Year</span>
                        </p>
                    @endif
                    <h1 class="font-bold text-[28px] leading-[42px]">{{ $course->name }}</h1>
                </div>
                <div class="flex flex-col gap-4">
                    <div class="flex gap-4 items-center">
                        <p class="flex items-center gap-[6px]">
                            <img src="{{ asset('assets/images/icons/crown-green.svg') }}" class="w-6 flex shrink-0"
                                alt="icon">
                            <span class="font-semibold text-sm leading-[21px]">
                                {{ $course->category->name }}
                            </span>
                        </p>
                        <p class="flex items-center gap-[6px]">
                            <img src="{{ asset('assets/images/icons/menu-board-green.svg') }}" class="w-6 flex shrink-0"
                                alt="icon">
                            <span class="font-semibold text-sm leading-[21px]">{{ $course->content_count }} Lessons</span>
                        </p>
                    </div>
                    <div class="flex gap-4 items-center">
                        <p class="flex items-center gap-[6px]">
                            <img src="{{ asset('assets/images/icons/briefcase-green.svg') }}" class="w-6 flex shrink-0"
                                alt="icon">
                            <span class="font-semibold text-sm leading-[21px]">Ready to Work</span>
                        </p>
                        <p class="flex items-center gap-[6px]">
                            <img src="{{ asset('assets/images/icons/briefcase-green.svg') }}" class="w-6 flex shrink-0"
                                alt="icon">
                            <span class="font-semibold text-sm leading-[21px]">Beginner Level</span>
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-3">

                    @php
                        $canLearn = $course->is_free || (auth()->check() && auth()->user()->hasActiveSubscription());
                        $startUrl = $canLearn
                            ? route('dashboard.course.join', $course->slug)
                            : route('front.pricing');
                    @endphp
                    <a href="{{ $startUrl }}"
                    class="rounded-full py-[10px] px-5 gap-[10px] bg-obito-green hover:drop-shadow-effect transition-all duration-300">
                        <span class="font-semibold text-white">Start Learning Now</span>
                    </a>
                    <a href="#"
                        class="rounded-full border border-obito-grey py-[10px] px-5 gap-[10px] bg-white hover:border-obito-green transition-all duration-300">
                        <span class="font-semibold">Add to Bookmark</span>
                    </a>
                </div>
            </div>
        </header>
        <section id="details" class="flex flex-col w-full max-w-[1000px] gap-4 mx-auto">
            <h2 class="font-bold text-[22px] leading-[33px]">Upgrade Your Skills</h2>
            <div id="contents" class="flex flex-col gap-5">
                <div id="tabs-container" class="flex items-center gap-3">
                    <button type="button" class="tab-btn group active" data-target="about-content">
                        <p
                            class="rounded-full border border-obito-grey py-2 px-4 hover:border-obito-green bg-white transition-all duration-300 group-[.active]:bg-obito-black">
                            <span class="font-semibold group-[.active]:text-white">About</span>
                        </p>
                    </button>
                    <button type="button" class="tab-btn group" data-target="lessons-content">
                        <p
                            class="rounded-full border border-obito-grey py-2 px-4 hover:border-obito-green bg-white transition-all duration-300 group-[.active]:bg-obito-black">
                            <span class="font-semibold group-[.active]:text-white">Lessons</span>
                        </p>
                    </button>
                    <button type="button" class="tab-btn group" data-target="testimonials-content">
                        <p
                            class="rounded-full border border-obito-grey py-2 px-4 hover:border-obito-green bg-white transition-all duration-300 group-[.active]:bg-obito-black">
                            <span class="font-semibold group-[.active]:text-white">Testimonials</span>
                        </p>
                    </button>
                    <button type="button" class="tab-btn group" data-target="tools-content">
                        <p
                            class="rounded-full border border-obito-grey py-2 px-4 hover:border-obito-green bg-white transition-all duration-300 group-[.active]:bg-obito-black">
                            <span class="font-semibold group-[.active]:text-white">Tools</span>
                        </p>
                    </button>
                    <button type="button" class="tab-btn group" data-target="example">
                        <p
                            class="rounded-full border border-obito-grey py-2 px-4 hover:border-obito-green bg-white transition-all duration-300 group-[.active]:bg-obito-black">
                            <span class="font-semibold group-[.active]:text-white">Resources</span>
                        </p>
                    </button>
                </div>
                <div id="tabs-content-container">
                    <div id="about-content" class="tab-content flex flex-col gap-[30px]">
                        <div id="description" class="flex flex-col gap-4 leading-7 w-full max-w-[844px]">
                            <p>
                                {{ $course->about }}
                            </p>
                        </div>
                        <div id="what-you-learn" class="flex flex-col gap-4">
                            <h3 class="font-semibold text-lg">What Will You Learn</h3>
                            <div class="grid grid-cols-2 gap-x-[30px] gap-y-4 w-full max-w-[700px]">

                                @foreach ($course->benefits as $benefit)
                                    <div class="flex items-center gap-3">
                                        <img src="{{ asset('assets/images/icons/tick-circle-green-fill.svg') }}"
                                            class="w-6 flex shrink-0" alt="icon">
                                        <p>{{ $benefit->name }}</p>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div id="instructors"
                            class="flex flex-col w-full max-w-[900px] rounded-[20px] border border-obito-grey p-5 gap-4 bg-white">
                            <h3 class="font-semibold text-lg">Course Instructors</h3>
                            <div class="grid grid-cols-2 gap-5">

                                @foreach ($course->courseMentors as $mentor)
                                    <div
                                        class="instructors-card flex flex-col rounded-[20px] border border-obito-grey p-5 gap-4 bg-white">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <div class="flex w-[50px] h-[50px] shrink-0 rounded-full overflow-hidden">
                                                    <img src="{{ Storage::url($mentor->mentor->photo) }}"
                                                        class="w-full h-full object-cover" alt="photo">
                                                </div>
                                                <div>
                                                    <p class="font-semibold">
                                                        {{ $mentor->mentor->name }}
                                                    </p>
                                                    <p class="text-sm text-obito-text-secondary">
                                                        {{ $mentor->mentor->occupation }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex items-center">
                                                <img src="{{ asset('assets/images/icons/Star 1.svg') }}"
                                                    class="w-5 flex shrink-0" alt="icon">
                                                <img src="{{ asset('assets/images/icons/Star 1.svg') }}"
                                                    class="w-5 flex shrink-0" alt="icon">
                                                <img src="{{ asset('assets/images/icons/Star 1.svg') }}"
                                                    class="w-5 flex shrink-0" alt="icon">
                                                <img src="{{ asset('assets/images/icons/Star 1.svg') }}"
                                                    class="w-5 flex shrink-0" alt="icon">
                                                <img src="{{ asset('assets/images/icons/Star 1.svg') }}"
                                                    class="w-5 flex shrink-0" alt="icon">
                                            </div>
                                        </div>
                                        <hr class="border-obito-grey">
                                        <p class="leading-7">
                                            {{ $mentor->about }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div id="lessons-content" class="tab-content flex flex-col gap-5 w-full max-w-[650px] hidden">

                        @foreach ($course->courseSections as $section)
                            <div
                                class="accordion flex flex-col gap-4 rounded-[20px] border border-obito-grey p-5 bg-white">
                                <button type="button" id="accordion-btn" data-expand="{{ $section->id }}"
                                    class="flex items-center justify-between">
                                    <p class="font-semibold text-lg">{{ $section->name }}</p>
                                    <img src="{{ asset('assets/images/icons/arrow-circle-down.svg') }}" alt="icon"
                                        class="size-6 shrink-0 transition-all duration-300 -rotate-180" />
                                </button>
                                <div id="{{ $section->id }}" class="">
                                    <div class="flex flex-col gap-4">

                                        @foreach ($section->sectionContents as $content)
                                            <div
                                                class="flex items-center rounded-[50px] gap-[10px] border border-obito-grey py-3 px-4 bg-white">
                                                <img src="{{ asset('assets/images/icons/menu-board.svg') }}"
                                                    class="size-6 flex shrink-0" alt="icon">
                                                <p class="font-semibold">{{ $content->name }}</p>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div id="testimonials-content" class="tab-content grid grid-cols-2 w-full max-w-[860px] gap-5 hidden">

                        @forelse ($course->testimonials as $testimonial)
                            <div
                                class="testimonial-card flex flex-col rounded-[20px] border border-obito-grey p-5 gap-4 bg-white">
                                <div class="flex items-center">
                                    <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="w-5 flex shrink-0"
                                        alt="icon">
                                    <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="w-5 flex shrink-0"
                                        alt="icon">
                                    <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="w-5 flex shrink-0"
                                        alt="icon">
                                    <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="w-5 flex shrink-0"
                                        alt="icon">
                                    <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="w-5 flex shrink-0"
                                        alt="icon">
                                </div>
                                <p class="leading-7">
                                    {{ $testimonial->review }}
                                </p>
                                <div class="flex items-center gap-3">
                                    <div class="flex w-[50px] h-[50px] shrink-0 rounded-full overflow-hidden">
                                        <img src="{{ Storage::url($testimonial->photo) }}"
                                            class="w-full h-full object-cover" alt="photo">
                                    </div>
                                    <div>
                                        <p class="font-semibold">{{ $testimonial->name }}</p>
                                        <p class="text-sm text-obito-text-secondary">{{ $testimonial->occupation }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div
                                class="flex flex-col items-center justify-center p-10 border border-obito-grey rounded-[20px] bg-white text-center text-obito-text-secondary">
                                <img src="{{ asset('assets/images/icons/raising-hands.png') }}" class="w-10 h-10 mb-3"
                                    alt="info">
                                <p class="text-lg font-medium">Belum ada testimonial untuk kursus ini</p>
                                <p class="text-sm">Segera hadir ulasan dari peserta yang sudah mengikuti kursus ini.</p>
                            </div>
                        @endforelse

                        @auth
                            @php
                                $hasActive = auth()->user()->hasActiveSubscription();
                                $alreadyReviewed = $course
                                    ->testimonials()
                                    ->where('name', auth()->user()->name)
                                    ->exists();
                            @endphp

                            @if (!$hasActive)
                                <div
                                    class="mt-6 p-5 border border-obito-grey rounded-[20px] bg-white text-obito-text-secondary">
                                    Kamu perlu subscription aktif untuk memberikan testimonial.
                                </div>
                            @elseif ($alreadyReviewed)
                                <div
                                    class="mt-6 p-5 border border-obito-grey rounded-[20px] bg-white text-obito-text-secondary">
                                    Anda sudah membuat ulasan.
                                </div>
                            @else
                                <form action="{{ route('dashboard.course.testimonial.store', $course) }}" method="POST"
                                    enctype="multipart/form-data"
                                    class="mt-6 flex flex-col gap-4 rounded-[20px] border border-obito-grey p-5 bg-white">
                                    @csrf
                                    <!-- field name/occupation/review/photo seperti sebelumnya -->
                                    {{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="flex flex-col gap-2">
                                            <label class="font-medium">Nama</label>
                                            <input type="text" name="name"
                                                value="{{ old('name', auth()->user()->name) }}"
                                                class="border rounded px-3 py-2" required>
                                            @error('name')
                                                <p class="text-red-500 text-sm">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <label class="font-medium">Pekerjaan (opsional)</label>
                                            <input type="text" name="occupation"
                                                value="{{ old('occupation', auth()->user()->occupation) }}"
                                                class="border rounded px-3 py-2">
                                            @error('occupation')
                                                <p class="text-red-500 text-sm">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div> --}}

                                    <div class="flex flex-col gap-2">
                                        <label class="font-medium">Ulasan</label>
                                        <textarea name="review" rows="5" class="border rounded px-3 py-2" required>{{ old('review') }}</textarea>
                                        @error('review')
                                            <p class="text-red-500 text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- FOTO dengan dukungan old() via temp upload
                                    <div class="flex flex-col gap-2" id="photo-block">
                                        <label class="font-medium">Foto (opsional)</label>

                                        @php $oldTmp = old('photo_tmp'); @endphp

                                        <div id="photo-preview" class="w-[160px] h-[160px] rounded-[12px] overflow-hidden border border-obito-grey {{ $oldTmp ? '' : 'hidden' }}">
                                            @if ($oldTmp)
                                                <img src="{{ Storage::disk('public')->url($oldTmp) }}" alt="preview" class="w-full h-full object-cover" id="photo-preview-img">
                                            @else
                                                <img src="" alt="preview" class="w-full h-full object-cover" id="photo-preview-img">
                                            @endif
                                        </div>

                                        <input type="file" id="photo-input" name="photo" accept="image/*"
                                            class="border rounded px-3 py-2">
                                        <input type="hidden" name="photo_tmp" id="photo-tmp" value="{{ $oldTmp }}">

                                        @error('photo')
                                            <p class="text-red-500 text-sm">{{ $message }}</p>
                                        @enderror
                                        @error('photo_tmp')
                                            <p class="text-red-500 text-sm">{{ $message }}</p>
                                        @enderror

                                        <p class="text-xs text-obito-text-secondary">JPG/PNG/WebP, maks 2MB.</p>
                                    </div> --}}

                                    <div class="flex justify-end">
                                        <button type="submit"
                                            class="rounded-full px-5 py-2 border border-obito-light-green bg-obito-light-green hover:opacity-90 transition">
                                            Kirim Testimonial
                                        </button>
                                    </div>
                                </form>
                            @endif
                        @else
                            <div class="mt-6 p-5 border border-obito-grey rounded-[20px] bg-white text-obito-text-secondary">
                                Silakan <a href="{{ route('login') }}" class="underline">login</a> untuk memberikan
                                testimonial.
                            </div>
                        @endauth

                        {{-- Flash --}}
                        @if (session('success'))
                            <div class="mt-4 p-3 rounded-lg bg-green-50 border border-green-200 text-green-700">
                                {{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="mt-4 p-3 rounded-lg bg-red-50 border border-red-200 text-red-700">
                                {{ session('error') }}</div>
                        @endif


                    </div>
                    <div id="tools-content" class="tab-content grid grid-cols-2 w-full max-w-[860px] gap-5 hidden">
                        @forelse ($course->tools as $tool)
                            <div
                                class="testimonial-card flex flex-col rounded-[20px] border border-obito-grey p-5 gap-4 bg-white">
                                {{-- Bagian atas: logo / foto tool --}}
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex w-[50px] h-[50px] shrink-0 rounded-[12px] overflow-hidden bg-obito-grey">
                                        <img src="{{ Storage::url($tool->logo) }}" class="w-full h-full object-cover"
                                            alt="{{ $tool->name }}">
                                    </div>
                                    <div class="flex flex-col">
                                        <p class="font-semibold leading-6">{{ $tool->name }}</p>
                                        <p class="text-sm text-obito-text-secondary">{{ $tool->category }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div
                                class="flex flex-col items-center justify-center p-10 border border-obito-grey rounded-[20px] bg-white text-center text-obito-text-secondary col-span-2">
                                <img src="{{ asset('assets/images/icons/raising-hands.png') }}" class="w-10 h-10 mb-3"
                                    alt="empty">
                                <p class="text-lg font-medium">Belum ada tools yang ditampilkan</p>
                                <p class="text-sm">Tools untuk kursus ini akan segera kami tambahkan.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('after-styles')
    <style>
        /* Responsive Styles */
        @media (max-width: 768px) {
            /* Main Content Mobile Styles */
            main {
                margin-top: 20px;
                margin-bottom: 80px;
                /* Space for fixed bottom nav */
                gap: 20px;
                padding: 0 20px;
            }

            /* Course Header Mobile Styles */
            header {
                flex-direction: column;
                max-width: 100% !important;
                padding: 20px !important;
                gap: 20px !important;
                margin: 0 !important;
            }

            #thumbnail-container {
                width: 100% !important;
                height: 250px !important;
            }

            #course-info {
                gap: 20px !important;
            }

            #course-info h1 {
                font-size: 24px !important;
                line-height: 32px !important;
            }

            #course-info .flex.flex-col.gap-4 .flex {
                flex-wrap: wrap;
                gap: 12px;
            }

            #course-info .flex.items-center.gap-3 {
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
            }

            #course-info .flex.items-center.gap-3 a {
                text-align: center;
                justify-content: center;
            }

            /* Details Section Mobile Styles */
            #details {
                max-width: 100% !important;
                padding: 0;
            }

            #details h2 {
                font-size: 20px;
                line-height: 28px;
            }

            /* Tabs Mobile Styles */
            #tabs-container {
                overflow-x: auto;
                scrollbar-width: none;
                -ms-overflow-style: none;
                padding-bottom: 5px;
                gap: 8px;
            }

            #tabs-container::-webkit-scrollbar {
                display: none;
            }

            #tabs-container .tab-btn {
                flex-shrink: 0;
            }

            #tabs-container .tab-btn p {
                padding: 8px 16px;
                white-space: nowrap;
                font-size: 14px;
            }

            /* Tab Content Mobile Styles */
            #about-content {
                gap: 20px !important;
            }

            #description {
                max-width: 100% !important;
            }

            #what-you-learn .grid {
                grid-template-columns: 1fr !important;
                max-width: 100% !important;
                gap: 12px;
            }

            #instructors {
                max-width: 100% !important;
                padding: 15px !important;
            }

            #instructors .grid {
                grid-template-columns: 1fr !important;
            }

            .instructors-card {
                padding: 15px !important;
            }

            /* Lessons Content Mobile */
            #lessons-content {
                max-width: 100% !important;
            }

            .accordion {
                padding: 15px !important;
            }

            .accordion button p {
                font-size: 16px;
            }

            /* Testimonials Mobile */
            #testimonials-content {
                grid-template-columns: 1fr !important;
                max-width: 100% !important;
            }

            .testimonial-card {
                padding: 15px !important;
            }

            /* Tools Mobile */
            #tools-content {
                grid-template-columns: 1fr !important;
                max-width: 100% !important;
            }

            /* Form Mobile */
            form .grid {
                grid-template-columns: 1fr !important;
            }
        }

        /* Tablet Styles */
        @media (min-width: 769px) and (max-width: 1024px) {

            main {
                padding: 0 40px;
            }

            #bottom-nav ul {
                padding: 0 40px;
            }

            header {
                max-width: 900px !important;
                padding: 20px !important;
            }

            #thumbnail-container {
                width: 400px !important;
                height: 280px !important;
            }

            #course-info h1 {
                font-size: 26px !important;
                line-height: 36px !important;
            }

            #details {
                max-width: 900px !important;
            }

            #instructors .grid {
                grid-template-columns: 1fr !important;
            }

            #testimonials-content {
                grid-template-columns: 1fr !important;
                max-width: 700px !important;
            }

            #tools-content {
                grid-template-columns: repeat(2, 1fr) !important;
                max-width: 700px !important;
            }
        }

        /* Small Mobile Styles */
        @media (max-width: 480px) {

            #bottom-nav ul {
                padding: 0 15px;
                gap: 6px;
            }

            #bottom-nav li a {
                padding: 6px 10px;
                font-size: 11px;
            }

            #bottom-nav li a span {
                font-size: 11px;
            }

            main {
                padding: 0 15px;
                margin-bottom: 90px;
            }

            header {
                padding: 15px !important;
                gap: 15px !important;
            }

            #thumbnail-container {
                height: 220px !important;
            }

            #course-info h1 {
                font-size: 22px !important;
                line-height: 30px !important;
            }

            #details h2 {
                font-size: 18px;
                line-height: 26px;
            }

            #tabs-container .tab-btn p {
                padding: 6px 12px;
                font-size: 13px;
            }

            .accordion {
                padding: 12px !important;
            }

            .testimonial-card {
                padding: 12px !important;
            }

            #instructors {
                padding: 12px !important;
            }

            .instructors-card {
                padding: 12px !important;
            }
        }

        /* Desktop Styles - Keep Original Layout */
        @media (min-width: 1025px) {

            /* Original desktop styles are preserved */
            #bottom-nav {
                position: static;
                border-bottom: 1px solid #e5e7eb;
                border-top: none;
                padding: 14px 0;
            }

            main {
                margin-bottom: 40px;
                margin-top: 30px;
                padding: 0;
            }

            /* Ensure all original desktop max-widths and paddings remain */
            header {
                max-width: 1000px;
                padding: 20px;
            }

            #details {
                max-width: 1000px;
            }

            #thumbnail-container {
                width: 500px;
                height: 350px;
            }

            #description {
                max-width: 844px;
            }

            #what-you-learn .grid {
                max-width: 700px;
            }

            #instructors {
                max-width: 900px;
            }

            #lessons-content {
                max-width: 650px;
            }

            #testimonials-content {
                max-width: 860px;
            }

            #tools-content {
                max-width: 860px;
            }
        }
    </style>
@endpush


@push('after-scripts')
    <script src="{{ asset('js/dropdown-navbar.js') }}"></script>
    <script src="{{ asset('js/tabs.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/accordion.js') }}"></script>
@endpush
