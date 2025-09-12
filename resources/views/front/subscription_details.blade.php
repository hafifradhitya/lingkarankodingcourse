@extends('front.layouts.app')
@section('title', 'Subscription Details - Lingkaran Koding Online Learning Platform')
@section('content')
    <x-navigation-auth />

    <div id="path" class="flex w-full bg-white border-b border-obito-grey py-[14px]">
        <div class="flex items-center w-full max-w-[1280px] px-[75px] mx-auto gap-5">
            <a href="{{ route('dashboard') }}" class="last-of-type:font-semibold">Dashboard</a>
            <div class="h-10 w-px bg-obito-grey"></div>
            <a href="{{ route('dashboard.subscriptions') }}" class="last-of-type:font-semibold">My Subscriptions</a>
            <span class="text-obito-grey">/</span>
            <a href="#" class="last-of-type:font-semibold">Details Subscription</a>
        </div>
    </div>

    <main class="flex flex-1 items-center justify-center py-5">
        <div class="flex w-[1000px] !h-fit rounded-[20px] border border-obito-grey gap-[40px] bg-white items-center p-5">
            <div id="details" class="w-full flex flex-col gap-5">
                <h1 class="font-bold text-[22px] leading-[33px]">Details Subscription</h1>

                <section id="give-access-to" class="flex flex-col gap-2">
                    <div class="flex items-center justify-between rounded-[20px] border border-obito-grey p-[14px]">
                        <div class="profile flex items-center gap-[14px]">
                            <img src="{{ asset('assets/images/icons/security-user-green-fill.svg') }}" alt="icon" class="size-[50px] shrink-0" />
                            <div class="desc flex flex-col gap-[3px]">
                                <h3 class="text-sm leading-[21px] text-obito-text-secondary">Booking TRX ID</h3>
                                <p class="font-semibold">{{ $transaction->booking_trx_id }}</p>
                            </div>
                        </div>
                        <div class="status flex items-center gap-[14px]">
                            @if($transaction->isActive())
                                <span class="font-bold text-xs text-obito-green badge w-fit rounded-full py-[6px] px-[10px] gap-[6px] bg-obito-light-green">ACTIVE</span>
                            @else
                                <span class="font-bold text-xs text-obito-red badge w-fit rounded-full py-[6px] px-[10px] gap-[6px] bg-obito-light-red">EXPIRED</span>
                            @endif
                        </div>
                    </div>
                </section>

                <section id="transaction-details" class="flex flex-col gap-[12px]">
                    <h2 class="font-semibold">Transaction Details</h2>
                    <div class="flex flex-col gap-[12px]">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('assets/images/icons/note.svg') }}" alt="icon" class="size-5 shrink-0" />
                                <p>Subscription Package</p>
                            </div>
                            <strong class="font-semibold">
                                Rp {{ number_format($transaction->sub_total_amount, 0, '', '.') }}
                            </strong>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('assets/images/icons/note.svg') }}" alt="icon" class="size-5 shrink-0" />
                                <p>Access Duration</p>
                            </div>
                            <strong class="font-semibold">{{ $transaction->pricing->duration }} Months</strong>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('assets/images/icons/note.svg') }}" alt="icon" class="size-5 shrink-0" />
                                <p>Started At</p>
                            </div>
                            <strong class="font-semibold">
                                {{ $transaction->started_at->format('d M, Y') }}
                            </strong>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('assets/images/icons/note.svg') }}" alt="icon" class="size-5 shrink-0" />
                                <p>Ended At</p>
                            </div>
                            <strong class="font-semibold">
                                {{ $transaction->ended_at->format('d M, Y') }}
                            </strong>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('assets/images/icons/note.svg') }}" alt="icon" class="size-5 shrink-0" />
                                <p>PPN 12%</p>
                            </div>
                            <strong class="font-semibold">
                                Rp {{ number_format($transaction->total_tax_amount, 0, '', '.') }}
                            </strong>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('assets/images/icons/note.svg') }}" alt="icon" class="size-5 shrink-0" />
                                <p class="whitespace-nowrap">Grand Total</p>
                            </div>
                            <strong class="font-bold text-obito-green text-[22px] leading-[33px]">
                                Rp {{ number_format($transaction->grand_total_amount, 0, '', '.') }}
                            </strong>
                        </div>
                    </div>
                </section>

                <section id="access given-to" class="flex flex-col gap-2">
                    <h2 class="font-semibold">Access Given to</h2>
                    <div class="profile flex items-center gap-[14px] rounded-[20px] border border-obito-grey p-[14px]">
                        <div class="flex justify-center items-center overflow-hidden size-[50px] rounded-full">
                            <img src="{{ Storage::url($transaction->student->photo) }}" alt="image" class="size-full object-cover" />
                        </div>
                        <div class="desc flex flex-col gap-[3px]">
                            <h3 class="font-semibold">{{ $transaction->student->name }}</h3>
                            <p class="text-sm leading-[21px] text-obito-text-secondary">
                                {{ $transaction->student->occupation }}
                            </p>
                        </div>
                    </div>
                </section>
            </div>

            <div id="benefits" class="bg-[#F8FAF9] rounded-[20px] overflow-hidden shrink-0 w-[420px]">
                <section id="thumbnails" class="relative flex justify-center h-[250px] items-center overflow-hidden rounded-t-[14px] w-full">
                    <img src="{{ asset('assets/images/thumbnails/checkout.png') }}" alt="image" class="size-full object-cover" />
                </section>
                <section id="points" class="pt-[61px] relative flex flex-col gap-4 px-5 pb-5">
                    <div class="card absolute -top-[47px] left-[30px] right-[30px] flex items-center p-4 gap-[14px] border border-obito-grey rounded-[20px] bg-white shadow-[0px_10px_30px_0px_#B8B8B840]">
                        <img src="{{ asset('assets/images/icons/cup-green-fill.svg') }}" alt="icon" class="size-[50px] shrink-0" />
                        <div>
                            <h3 class="font-bold text-[18px] leading-[27px]">Pro Talent</h3>
                            <p class="text-obito-text-secondary">3 months duration</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('assets/images/icons/tick-circle-green-fill.svg') }}" alt="icon" class="size-6 shrink-0" />
                        <p class="font-semibold">Access 1500+ Online Courses</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('assets/images/icons/tick-circle-green-fill.svg') }}" alt="icon" class="size-6 shrink-0" />
                        <p class="font-semibold">Get Premium Certifications</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('assets/images/icons/tick-circle-green-fill.svg') }}" alt="icon" class="size-6 shrink-0" />
                        <p class="font-semibold">High Quality Work Portfolio</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('assets/images/icons/tick-circle-green-fill.svg') }}" alt="icon" class="size-6 shrink-0" />
                        <p class="font-semibold">Career Consultation 2025</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('assets/images/icons/tick-circle-green-fill.svg') }}" alt="icon" class="size-6 shrink-0" />
                        <p class="font-semibold">Support learning 24/7</p>
                    </div>
                </section>
            </div>
        </div>
    </main>
@endsection

@push('after-styles')
<style>
/* ============================
   RESPONSIVE (Mobile-first overrides)
   — Desktop tetap mengikuti Tailwind di HTML.
   — Hanya mengatur tampilan mobile/tablet.
   ============================ */

*,
*::before,
*::after { box-sizing: border-box; }

/* 1) Breadcrumb container: kecilkan padding samping di mobile */
@media (max-width: 768px) {
  #path > div {
    padding-left: 16px !important;   /* override px-[75px] */
    padding-right: 16px !important;
    gap: 10px !important;
  }
}

/* 2) Main wrapper: ringkas spacing di mobile */
@media (max-width: 768px) {
  main.flex.flex-1.items-center.justify-center.py-5 {
    padding-top: 16px;
    padding-bottom: 16px;
    justify-content: flex-start;     /* biar konten mulai dari atas */
  }
}

/* 3) Panel utama (yang lebar 1000px) jadi full-width & bertumpuk */
@media (max-width: 1024px) {
  /* selektor aman tanpa mengubah HTML */
  main > div[class*="w-[1000px]"] {
    width: 100% !important;
    max-width: 100%;
    flex-direction: column;          /* dari row -> column */
    align-items: stretch !important;
    gap: 20px !important;            /* override gap-[40px] */
    padding: 16px !important;        /* override p-5 */
    border-radius: 16px;
  }

  /* panel kanan (benefits) melebar penuh */
  #benefits {
    width: 100% !important;
    max-width: 100%;
    order: 2;                        /* pastikan berada di bawah detail */
  }

  /* tinggi thumbnail disesuaikan agar tidak terlalu tinggi di HP */
  #thumbnails { height: 200px !important; }
}

/* 4) Judul & typografi agar pas di HP */
@media (max-width: 768px) {
  #details > h1 {
    font-size: 20px;                 /* dari 22px -> 20px */
    line-height: 30px;
  }
}

/* 5) Kartu Booking TRX ID (profile + status) ditumpuk rapi */
@media (max-width: 768px) {
  #give-access-to > div {
    flex-direction: column;          /* stack */
    align-items: stretch;
    gap: 10px;
    padding: 12px !important;        /* compact */
  }

  #give-access-to .profile img.size-\[50px\] { width: 42px; height: 42px; }
  #give-access-to .status {
    justify-content: flex-start;     /* badge rata kiri */
  }
  #give-access-to .badge {
    font-size: 10px;
    line-height: 1;
  }
}

/* 6) Baris Transaction Details tetap terbaca: label kiri, nilai kanan
      — jika ruang sempit, baris akan wrap dengan jarak nyaman */
@media (max-width: 768px) {
  #transaction-details .flex.flex-col > .flex.items-center.justify-between {
    gap: 8px;
    flex-wrap: wrap;                 /* izinkan turun baris */
  }
  #transaction-details img.size-5 { width: 18px; height: 18px; }
  #transaction-details strong { font-size: 14px; }
  #transaction-details strong.text-\[22px\] { font-size: 18px !important; line-height: 26px !important; }
}

/* 7) Panel “Access Given to”: avatar & teks sedikit diperkecil */
@media (max-width: 768px) {
  #access\ given-to .profile { padding: 12px !important; }
  #access\ given-to .size-\[50px\] { width: 44px; height: 44px; }
}

/* 8) Panel “Benefits”: kartu overlay & spacing agar tidak mepet pinggir */
@media (max-width: 768px) {
  #benefits #points { padding-left: 16px !important; padding-right: 16px !important; }
  #benefits #points .card {
    left: 16px !important;
    right: 16px !important;
    top: auto;
    transform: translateY(-36px);    /* ganti dari absolute -top untuk stabilitas */
  }
  #benefits #points .card img.size-\[50px\] { width: 42px; height: 42px; }
  #benefits #points h3 { font-size: 16px; line-height: 24px; }
  #benefits #points p { font-size: 13px; line-height: 20px; }
}

/* 9) Umum: gambar jangan overflow */
@media (max-width: 768px) {
  img { max-width: 100%; height: auto; }
}

/* 10) Tablet kecil (769–1024px): beri ruang ekstra tapi tetap stacked */
@media (min-width: 769px) and (max-width: 1024px) {
  #path > div { padding-left: 32px !important; padding-right: 32px !important; }
  main > div[class*="w-[1000px]"] { gap: 24px !important; padding: 18px !important; }
  #thumbnails { height: 220px !important; }
}
</style>
@endpush

@push('after-scripts')
    <script src="{{ asset('js/dropdown-navbar.js') }}"></script>
@endpush
