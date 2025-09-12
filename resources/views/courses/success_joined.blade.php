@extends('front.layouts.app')
@php
    // dari controller: $firstSectionId, $firstContentId, $hasContent (opsional)
    $hasContent = $hasContent ?? (!empty($firstSectionId) && !empty($firstContentId));

    $pageTitle = $hasContent
        ? 'Success Joined - Lingkaran Koding Online Learning Platform'
        : 'Class Registered – Content Coming Soon - Lingkaran Koding Online Learning Platform';
@endphp

@section('title', $pageTitle)
@section('content')

    <div class="relative flex justify-center">
        <div id="backgroundImage" class="absolute top-0 left-0 right-0">
            <img src="{{ asset('assets/images/backgrounds/success-join.png') }}" alt="image"
                 class="h-[777px] object-cover object-bottom w-full" />
        </div>

        @php
            // dari controller: $firstSectionId, $firstContentId, $hasContent
            $hasContent = $hasContent ?? (!empty($firstSectionId) && !empty($firstContentId));
        @endphp

        <main class="relative mt-[178px] flex flex-col gap-[30px] p-[30px] w-[560px] rounded-[20px] border bg-white border-obito-grey">
            <img src="{{ asset('assets/images/icons/raising-hands.png') }}" alt="icon" class="size-[60px] shrink-0 mx-auto" />

            <div class="mx-auto flex w-[500px] flex-col gap-[10px] items-center">
                 @if ($hasContent)
                    <h1 class="text-center font-bold text-[28px] leading-[42px]">
                        Welcome to Class,<br>Upgrade Your New Skills
                    </h1>
                @else
                    {{-- Belum ada pelajaran --}}
                    <h1 class="text-center font-bold text-[28px] leading-[42px]">
                        Konten kelas ini belum rilis,<br>Segera Hadir
                    </h1>
                @endif

                @if (! $hasContent)
                    {{-- Gratis atau Premium, tapi belum ada pembelajaran --}}
                    <p class="text-center text-obito-text-secondary leading-[28px]">
                        <strong>Konten segera tersedia.</strong> Kamu sudah terdaftar di kelas ini.
                        Sementara itu, silakan cek ringkasan materi dan informasi kelas pada halaman Overview.
                    </p>
                @else
                    {{-- Default copy (konten sudah tersedia) --}}
                    <p class="text-center text-obito-text-secondary leading-[28px]">
                        Mari kita belajar meningkatkan skills terbaru bersama dengan mentor berpengalaman demi masa depan lebih baik
                    </p>
                @endif
            </div>

            <div id="card" class="flex items-center pt-[10px] pb-[10px] pl-[10px] pr-4 border border-obito-grey rounded-[20px] gap-4">
                <div class="flex justify-center items-center overflow-hidden shrink-0 w-[180px] h-[130px] rounded-[14px]">
                    <img src="{{ Storage::url($course->thumbnail) }}" alt="image" class="w-full h-full object-cover" />
                </div>
                <div class="flex flex-col gap-[10px]">
                    <h2 class="font-bold">{{ $course->name }}</h2>
                    <div class="flex items-center gap-[6px]">
                        <img src="{{ asset('assets/images/icons/crown-green.svg') }}" alt="icon" class="size-5 shrink-0" />
                        <p class="text-sm leading-[21px] text-obito-text-secondary">{{ $course->category->name }}</p>
                    </div>
                    <div class="flex items-center gap-[6px]">
                        <img src="{{ asset('assets/images/icons/menu-board-green.svg') }}" alt="icon" class="size-5 shrink-0" />
                        <p class="text-sm leading-[21px] text-obito-text-secondary">{{ $course->content_count }} Lessons</p>
                    </div>
                </div>
            </div>

            <div class="buttons grid grid-cols-2 gap-[12px]">
                <a href="#"
                   class="border border-obito-grey rounded-full py-[10px] flex justify-center items-center hover:border-obito-green transition-all duration-300"
                   aria-label="Get Guidelines">
                    <span class="font-semibold">Get Guidelines</span>
                </a>

                @if ($hasContent)
                    <a href="{{ route('dashboard.course.learning', [
                            'course' => $course->slug,
                            'courseSection' => $firstSectionId,
                            'sectionContent' => $firstContentId,
                        ]) }}"
                       class="text-white rounded-full py-[10px] flex justify-center items-center bg-obito-green hover:drop-shadow-effect transition-all duration-300"
                       aria-label="Start Learning">
                        <span class="font-semibold">Start Learning</span>
                    </a>
                @else
                    <a href="{{ route('dashboard.course.details', $course->slug) }}"
                       class="text-white rounded-full py-[10px] flex justify-center items-center bg-obito-green hover:drop-shadow-effect transition-all duration-300"
                       aria-label="View Course Overview">
                        <span class="font-semibold">View Course Overview</span>
                    </a>
                @endif
                {{-- @if ($course->is_free && !$hasContent)
                    <p class="col-span-2 text-center text-obito-text-secondary text-sm">
                        Kamu sudah join kelas ini. <strong>Konten akan segera dipublikasikan.</strong> Sambil menunggu, silakan pelajari Overview.
                    </p>
                @elseif (!$course->is_free && !$hasContent)
                    <p class="col-span-2 text-center text-obito-text-secondary text-sm">
                        Terima kasih sudah berlangganan. <strong>Materi akan segera dipublikasikan.</strong> Sambil menunggu,
                        kamu bisa meninjau struktur kelas dan persiapan belajar di halaman Overview.
                    </p>
                @endif --}}
            </div>
        </main>
    </div>

@endsection

@push('after-styles')
<style>
/* (CSS responsifmu tetap – dipertahankan persis seperti sebelumnya) */
@media (max-width: 1024px) {
  #backgroundImage img { height: 540px !important; object-position: center bottom !important; }
  .relative>main { width: 92% !important; max-width: 720px; margin-top: 120px !important; padding: 24px !important; border-radius: 18px !important; gap: 24px !important; }
  .relative>main>div.mx-auto { width: 100% !important; }
}
@media (max-width: 768px) {
  #backgroundImage img { height: 360px !important; object-position: center bottom !important; }
  .relative>main { width: 94% !important; margin-top: 96px !important; padding: 20px !important; border-radius: 16px !important; gap: 20px !important; }
  .relative>main>img.size-\[60px\] { width: 48px !important; height: 48px !important; }
  .relative>main h1 { font-size: 20px !important; line-height: 30px !important; }
  .relative>main p { font-size: 14px !important; line-height: 24px !important; }
  .relative>main>div.mx-auto { width: 100% !important; padding: 0 2px; }
  #card { display: flex; flex-direction: column !important; align-items: stretch !important; gap: 12px !important; padding: 12px !important; }
  #card>div:first-child { width: 100% !important; height: 180px !important; border-radius: 14px !important; }
  #card h2 { font-size: 16px !important; line-height: 24px !important; }
  #card p.text-sm { font-size: 13px !important; line-height: 20px !important; }
  .buttons { display: grid !important; grid-template-columns: 1fr !important; gap: 10px !important; }
  .buttons a { width: 100% !important; padding-top: 10px !important; padding-bottom: 10px !important; border-radius: 9999px !important; }
}
@media (max-width: 360px) {
  .relative>main { margin-top: 84px !important; padding: 16px !important; }
  #backgroundImage img { height: 300px !important; }
  .relative>main h1 { font-size: 18px !important; line-height: 28px !important; }
  #card>div:first-child { height: 165px !important; }
}
</style>
@endpush
