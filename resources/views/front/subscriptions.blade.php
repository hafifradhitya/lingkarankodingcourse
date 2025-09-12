@extends('front.layouts.app')
@section('title', 'My Subscriptions - Obito BuildWithAngga')
@section('content')
    <x-navigation-auth />

    <x-bottom-nav />

    <main class="relative flex flex-1 h-full">
        <div id="background-banner" class="absolute flex w-1/2 shrink-0 h-full overflow-hidden right-0">
            <img src="{{ asset ('assets/images/backgrounds/banner-subscription.png') }}" class="w-full h-full object-cover" alt="banner">
        </div>

        <section id="subscriptions-list" class="relative flex flex-col gap-5 mt-[50px] w-full max-w-[1280px] px-[75px] py-5 mx-auto">
            <h1 class="font-bold text-[28px] leading-[42px]">My Subscriptions</h1>

            <div id="list-container" class="flex flex-col gap-5 max-w-[800px] w-full">

                @forelse($transactions as $transaction)
                <div class="subscription-card bg-white border border-obito-grey flex items-center justify-between rounded-[20px] py-5 px-4 gap-8">
                    <div class="flex items-center flex-1 gap-[14px]">
                        <div class="flex shrink-0 size-[50px]">
                            <img src="{{ asset ('assets/images/icons/cup-green-fill.svg') }}" class="flex shrink-0 size-[50px]" alt="icon">
                        </div>
                        <div>
                            <p class="font-bold text-lg">{{ $transaction->pricing->name }}</p>
                            <p class="text-obito-text-secondary">{{ $transaction->pricing->duration }} months duration</p>
                        </div>
                    </div>

                    <div class="flex flex-col w-[100px] shrink-0 gap-1">
                        <div class="flex items-center gap-1">
                            <img src="{{ asset ('assets/images/icons/note.svg') }}" class="flex w-5 shrink-0" alt="icon">
                            <p class="text-sm">Price</p>
                        </div>
                        <p class="font-semibold text-sm">
                            Rp {{ number_format($transaction->sub_total_amount, 0, '', '.') }}
                        </p>
                    </div>

                    <div class="flex flex-col w-[150px] shrink-0 gap-1">
                        <div class="flex items-center gap-1">
                            <img src="{{ asset ('assets/images/icons/note.svg') }}" class="flex w-5 shrink-0" alt="icon">
                            <p class="text-sm">Started At</p>
                        </div>
                        <p class="font-semibold text-sm">{{ $transaction->started_at->format('d M, Y') }}</p>
                    </div>

                    @if($transaction->isActive())
                    <div class="flex items-center justify-center w-[75px] shrink-0">
                        <span class="font-bold text-xs text-obito-green badge w-fit rounded-full py-[6px] px-[10px] gap-[6px] bg-obito-light-green">ACTIVE</span>
                    </div>
                    @else
                    <div class="flex items-center justify-center w-[75px] shrink-0">
                        <span class="font-bold text-xs text-obito-red badge w-fit rounded-full py-[6px] px-[10px] gap-[6px] bg-obito-light-red">EXPIRED</span>
                    </div>
                    @endif

                    <a href="{{ route('dashboard.subscription.details', $transaction) }}" class="rounded-full border border-obito-grey py-[10px] px-5 gap-[10px] bg-white hover:border-obito-green transition-all duration-300">
                        <span class="font-semibold">Details</span>
                    </a>
                </div>
                @empty
                <p>belum ada paket yang dibeli</p>
                @endforelse

            </div>
        </section>
    </main>
@endsection

@push('after-styles')
<style>
/* ============================
   RESPONSIVE (Mobile overrides)
   — Desktop tetap pakai class Tailwind kamu.
   — Hanya mengubah tampilan mobile.
   ============================ */

/* 0) Amankan box sizing */
*,
*::before,
*::after { box-sizing: border-box; }

/* 1) Sembunyikan banner di mobile agar konten fokus & lebar penuh */
@media (max-width: 1024px) {
  #background-banner { display: none !important; }
}

/* 2) Section container: kecilkan padding & top spacing di mobile */
@media (max-width: 768px) {
  #subscriptions-list {
    padding-left: 16px !important;   /* override px-[75px] */
    padding-right: 16px !important;
    padding-top: 16px;
    padding-bottom: 24px;
    margin-top: 24px;                /* override mt-[50px] agar lebih ringkas */
    gap: 16px;
  }

  /* Heading lebih nyaman di layar kecil */
  #subscriptions-list > h1 {
    font-size: 22px;                 /* dari 28px -> 22px */
    line-height: 32px;               /* dari 42px -> 32px */
  }

  /* List container full width di mobile */
  #list-container {
    max-width: 100% !important;
    gap: 16px;
  }
}

/* 3) Kartu subscription jadi layout bertumpuk rapi di mobile */
@media (max-width: 768px) {
  .subscription-card {
    flex-direction: column;          /* dari row -> column */
    align-items: stretch;            /* setiap blok melebar full */
    gap: 12px;                       /* jarak antar blok */
    padding: 16px;                   /* padding lebih “compact” */
    border-radius: 16px;             /* sedikit lebih kecil biar proporsional */
  }

  /* Semua child div melebar penuh */
  .subscription-card > div {
    width: 100% !important;
  }

  /* Blok pertama (icon + nama paket) tetap horizontal dan center */
  .subscription-card > div:first-child {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  /* Kecilkan icon agar pas di HP */
  .subscription-card > div:first-child .size-\[50px\] {
    width: 40px; height: 40px;
  }

  /* Judul paket dan subjudul */
  .subscription-card > div:first-child p.font-bold.text-lg {
    font-size: 16px;                 /* dari ~18-20 -> 16 */
    line-height: 24px;
  }
  .subscription-card > div:first-child .text-obito-text-secondary {
    font-size: 13px;
    line-height: 20px;
  }

  /* Blok Price & Started At: tampilkan sebagai baris label—nilai kanan */
  .subscription-card > div:nth-child(2),
  .subscription-card > div:nth-child(3) {
    display: flex;
    align-items: center;
    justify-content: space-between;  /* label kiri, nilai kanan */
    gap: 8px;
  }

  /* Perkecil ikon label di baris meta */
  .subscription-card > div:nth-child(2) img,
  .subscription-card > div:nth-child(3) img {
    width: 18px; height: 18px;
  }

  /* Status badge: rata kiri agar konsisten dengan baris lain */
  .subscription-card > div:nth-child(4) {
    display: flex;
    align-items: center;
    justify-content: flex-start;
  }
  .subscription-card .badge {
    font-size: 10px;                 /* sedikit diperkecil */
    line-height: 1;
  }

  /* Tombol Details: full width dan center */
  .subscription-card > a {
    display: block;
    width: 100%;
    text-align: center;
  }
}

/* 4) Sedikit rapikan tipografi & wrap angka panjang */
@media (max-width: 768px) {
  .subscription-card p { word-wrap: break-word; overflow-wrap: anywhere; }
}

/* 5) Tablet kecil (769–1024px): masih stacked tapi beri ruang lebih */
@media (min-width: 769px) and (max-width: 1024px) {
  #subscriptions-list {
    padding-left: 32px !important;
    padding-right: 32px !important;
  }
  .subscription-card {
    gap: 16px;
    padding: 18px;
  }
}
</style>
@endpush

@push('after-scripts')
    <script src="{{ asset('js/dropdown-navbar.js') }}"></script>
@endpush
