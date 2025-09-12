@extends('front.layouts.app')
@section('title', 'Search Course - Lingkaran Koding Online Learning Platform')
@section('content')
    <x-navigation-auth />

    <x-bottom-nav />

    <main class="flex flex-col gap-10 pb-10 mt-[50px]">
        <div class="flex flex-col items-center gap-[10px] max-w-[500px] w-full mx-auto">
            <p class="flex items-center gap-[6px] w-fit rounded-full py-2 px-[14px] bg-obito-light-green">
                <img src="{{ asset('assets/images/icons/crown-green.svg') }}" class="flex shrink-0 w-5" alt="icon">
                <span class="font-bold text-sm">GROW CAREER</span>
            </p>
            <h1 class="font-bold text-[28px] leading-[42px] text-center">Explore Our Greatest Courses</h1>
            <form method="GET" action="{{ route('dashboard.search.courses') }}" class="relative ">
                <label class="group">
                    <input type="text" name="search" id=""
                        class="appearance-none outline-none ring-1 ring-obito-grey rounded-full w-[550px] py-[14px] px-5 bg-white font-bold placeholder:font-normal placeholder:text-obito-text-secondary group-focus-within:ring-obito-green transition-all duration-300 pr-[50px]"
                        placeholder="Search course by name">
                    <button type="submit"
                        class="absolute right-0 top-0 h-[52px] w-[52px] flex shrink-0 items-center justify-center">
                        <img src="{{ asset('assets/images/icons/search-normal-green-fill.svg') }}" class="flex shrink-0 w-10 h-10"
                            alt="">
                    </button>
                </label>
            </form>
        </div>
        <section id="result" class="flex flex-col w-full max-w-[1280px] px-[75px] gap-5 mx-auto">
            <h2 class="font-bold text-[22px] leading-[33px]">Search Result: JavaScript</h2>
            <div id="result-list" class="tab-content grid grid-cols-4 gap-5">

                @forelse ($courses as $course)
                    <x-course-card :course="$course" />
                @empty
                    <p>No courses available in this keyword.</p>
                @endforelse

            </div>
        </section>
    </main>
@endsection

@push('after-styles')
<style>
/* ============================
   Responsive CSS (Mobile-first overrides)
   — Desktop tetap mengikuti class Tailwind kamu
   — Hanya merapikan di layar kecil
   ============================ */

/* 1) Form & Search Bar */
@media (max-width: 768px) {
  /* pastikan label pembungkus jadi blok & relatif utk tombol submit */
  form.relative > label.group {
    display: block;
    position: relative;
    width: 100%;
  }

  /* input jadi full width */
  form.relative > label.group > input[type="text"] {
    width: 100% !important;          /* override w-[550px] */
    max-width: 100%;
    box-sizing: border-box;
    padding-right: 60px;              /* ruang untuk tombol search */
  }

  /* tombol submit tetap di kanan dengan sedikit inset supaya tidak mentok */
  form.relative > label.group > button[type="submit"] {
    right: 4px;
    top: 4px;
    height: 44px;                     /* sedikit lebih kecil agar proporsional di mobile */
    width: 44px;
    border-radius: 9999px;
  }

  /* judul & badge agar nyaman dibaca di mobile */
  main h1 {
    font-size: 22px;
    line-height: 32px;
  }

  main p > span.font-bold.text-sm {
    font-size: 12px;
  }
}

/* 2) Kontainer Result: padding samping diperkecil di mobile */
@media (max-width: 768px) {
  #result {
    padding-left: 16px !important;   /* override px-[75px] */
    padding-right: 16px !important;
    gap: 16px;
  }

  #result > h2 {
    font-size: 18px;                 /* dari 22px -> 18px agar pas di mobile */
    line-height: 28px;
  }
}

/* 3) Grid Kartu Course (rapi & menyesuaikan layar)
   - <=480px: 1 kolom
   - 481–768px: 2 kolom
   - >768px: tetap 4 kolom (mengikuti Tailwind di HTML)
*/
@media (max-width: 480px) {
  #result-list {
    display: grid;                   /* pastikan grid aktif (menimpa util tailwind) */
    grid-template-columns: 1fr !important;
    gap: 16px !important;
  }
}

@media (min-width: 481px) and (max-width: 768px) {
  #result-list {
    display: grid;
    grid-template-columns: 1fr 1fr !important;
    gap: 18px !important;
  }
}

/* 4) Spasi vertikal & margin main agar tidak “terlalu renggang” di mobile */
@media (max-width: 768px) {
  main.flex.flex-col.gap-10.pb-10.mt-\[50px\] {
    gap: 20px;
    margin-top: 24px; /* sedikit turunkan supaya muat di viewport kecil */
    padding-bottom: 28px;
  }
}

/* 5) Kartu course sering punya shadow/border — kasih proteksi agar tidak overflow */
@media (max-width: 768px) {
  #result-list > * {
    min-width: 0; /* cegah card melebar karena konten panjang */
  }
}

/* 6) Jaga gambar/icon search agar tidak “keluar” */
@media (max-width: 768px) {
  form.relative > label.group > button img {
    width: 28px;
    height: 28px;
  }
}
</style>
@endpush

@push('after-scripts')
    <script src="{{ asset('js/dropdown-navbar.js') }}"></script>
@endpush
