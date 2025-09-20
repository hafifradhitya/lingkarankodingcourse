@extends('front.layouts.app')
@section('title', 'My Certificates - Lingkaran Koding Online Learning Platform')

@push('after-styles')
  {{-- Font untuk judul neon --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&display=swap" rel="stylesheet">

  <style>
    /* ====== CERT PAGE – THEME HIJAU LK (SCOPED, prefix .slc-) ====== */
    .slc-root{
      --lk-green: #2F6A62;
      --lk-green-2:#3f877d;
      --lk-light: #E0EAE8;
      --border: rgba(47,106,98,.45);
      --text: #e7fffa;
      --muted:#bfe3dc;
      --bg:#0b1211;
      --card: rgba(14, 24, 23, .55);
      --radius:18px;
      --shadow:0 0 24px rgba(47,106,98,.24), inset 0 0 40px rgba(47,106,98,.08);
      --neon: #49d6c3;
      --neon2:#6cd8c7;
    }
    .slc-wrap{ width:min(1150px, 100%); margin:32px auto; padding:0 20px; }
    .slc-title{
      font-family: Orbitron, Poppins, system-ui, sans-serif;
      font-weight:900; letter-spacing:.06em; text-transform:uppercase;
      color:#fff; text-shadow: 0 0 16px rgba(76,190,176,.35);
      display:flex; align-items:center; gap:10px;
    }
    .slc-dot{ width:8px; height:8px; border-radius:2px; background:var(--neon); box-shadow:0 0 14px var(--neon); animation: slc-ping 1.8s infinite; }
    @keyframes slc-ping { 0%{opacity:1;transform:scale(1)}70%{opacity:.1;transform:scale(1.8)}100%{opacity:0;transform:scale(2)} }

    .slc-head{
      display:flex; flex-wrap:wrap; gap:14px 18px; align-items:end; justify-content:space-between;
      margin-top:6px;
    }
    .slc-sub{ color:#cfe9e4; max-width:720px; }
    .slc-stats{
      display:flex; gap:10px; align-items:center; color:#def7f2;
      font:700 12px/1 Orbitron, Poppins, sans-serif; letter-spacing:.12em; text-transform:uppercase;
      background: linear-gradient(90deg, rgba(47,106,98,.10), rgba(96,187,173,.10));
      border:1px solid rgba(47,106,98,.28);
      padding:10px 12px; border-radius:999px;
    }

    .slc-toolbar{
      display:flex; gap:10px; flex-wrap:wrap; align-items:center; margin:18px 0 6px;
    }
    .slc-input, .slc-select{
      background: rgba(255,255,255,.06);
      border:1px solid rgba(255,255,255,.12);
      color:#eafffb; border-radius:12px; padding:10px 12px; outline:none;
      transition:.2s ease; min-height:42px;
    }
    .slc-input::placeholder{ color:#9bc8c1; }
    .slc-input:focus, .slc-select:focus{ box-shadow:0 0 0 2px rgba(76,190,176,.25); border-color:rgba(76,190,176,.55); }

    /* Card */
    .slc-card{
      position:relative; border-radius:var(--radius);
      background: linear-gradient(180deg, rgba(10,18,16,.78), rgba(9,15,14,.58));
      border:1px solid var(--border);
      box-shadow: var(--shadow);
      backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
      overflow:hidden; isolation:isolate; color:#eafffb;
      transition: transform .25s ease, box-shadow .25s ease;
    }
    .slc-card:hover{ transform: translateY(-2px); box-shadow: 0 12px 40px rgba(47,106,98,.28); }
    .slc-card::before,
    .slc-card::after{ content:""; position:absolute; inset:0; pointer-events:none; }
    .slc-card::before{
      background:
        conic-gradient(from 0deg at 0 0, var(--lk-green) 0 25%, transparent 0 100%) top left/110px 110px no-repeat,
        conic-gradient(from 180deg at 100% 100%, var(--lk-green) 0 25%, transparent 0 100%) bottom right/110px 110px no-repeat;
      opacity:.16; filter: drop-shadow(0 0 12px var(--lk-green));
    }
    .slc-topbar{ height:3px; background:linear-gradient(90deg, #10b981, #14b8a6, #22d3ee); }
    .slc-body{ padding:18px; display:grid; gap:12px; }
    .slc-badges{ display:flex; gap:8px; align-items:center; flex-wrap:wrap; }
    .slc-badge{ display:inline-flex; gap:6px; align-items:center; font:700 11px/1 Poppins, sans-serif; letter-spacing:.06em; text-transform:uppercase; padding:7px 10px; border-radius:999px; border:1px solid rgba(255,255,255,.12); background:rgba(255,255,255,.06); color:#dff8f3; }
    .slc-date{ color:#bfe3dc; font-size:12px; }
    .slc-title2{ font:800 clamp(16px, 2vw, 18px)/1.3 Poppins, sans-serif; color:#f0fffd; }
    .slc-mini{
      position:relative; border-radius:14px; overflow:hidden; border:1px solid rgba(255,255,255,.12);
      background: linear-gradient(145deg, rgba(47,106,98,.15), transparent 60%);
    }
    .slc-mini .slc-frame{ position:absolute; inset:0; margin:10px; border-radius:10px; border:1px dashed rgba(255,255,255,.2); }
    .slc-mini .slc-seal{ position:absolute; right:-22px; bottom:-22px; width:120px; height:120px; border-radius:999px; background: conic-gradient(from 0deg, #10b981, #0ea5e9, #10b981); filter: blur(1px); opacity:.18; }
    .slc-mini .slc-center{
      position:absolute; inset:0; display:grid; place-items:center; text-align:center;
    }
    .slc-mini .slc-center .ico{
      height:40px; width:40px; display:grid; place-items:center; border-radius:999px; background:#d1fae5; color:#065f46; margin:0 auto 6px;
    }
    .slc-actions{ display:flex; gap:10px; align-items:center; }
    .slc-btn{
      display:inline-flex; align-items:center; gap:8px; border-radius:12px; padding:10px 14px; font-weight:600; transition:.2s ease; outline:none;
    }
    .slc-btn-primary{ background:#059669; color:#fff; }
    .slc-btn-primary:hover{ background:#047857; }
    .slc-btn-ghost{ background:#ffffff08; color:#eafffb; border:1px solid rgba(255,255,255,.12); }
    .slc-btn-ghost:hover{ background:#ffffff12; }
    .slc-copy{ margin-left:auto; border:1px solid transparent; }
    .slc-copy:hover{ border-color: rgba(255,255,255,.18); background:#ffffff0a; }

    .slc-ribbon{
      font-family: Orbitron, Poppins, sans-serif; font-weight:800; letter-spacing:.12em; text-transform:uppercase; font-size:11px; color: var(--neon);
      background: linear-gradient(90deg, rgba(47,106,98,.10), rgba(96,187,173,.10));
      border-top: 1px solid rgba(47,106,98,.25);
      padding: 12px 16px; display:flex; justify-content:space-between; align-items:center; gap:12px;
    }

    /* Scanline halus */
    .slc-scan::after{
      content:""; position:absolute; inset:0;
      background: repeating-linear-gradient(to bottom, rgba(255,255,255,.06), rgba(255,255,255,.06) 1px, transparent 1px, transparent 3px);
      opacity:.055; mix-blend-mode: overlay; pointer-events:none;
    }

    /* ====== Layout rhythm tanpa Tailwind ====== */
.slc-stack{
  display:flex;
  flex-direction:column;
  row-gap:24px; /* ~ gap-6 */
}
@media (min-width: 768px){ .slc-stack{ row-gap:32px; } }   /* md:gap-8 */
@media (min-width: 1024px){ .slc-stack{ row-gap:40px; } }  /* lg:gap-10 */

/* Padding header card */
.slc-header-pad{ padding:20px; }
@media (min-width: 768px){ .slc-header-pad{ padding:24px; } }
@media (min-width: 1280px){ .slc-header-pad{ padding:28px; } }

/* Divider margin top (pengganti mt-6) */
.slc-divider{ margin-top:24px; }

/* Grid cards responsif */
.slc-grid{
  display:grid;
  grid-template-columns: 1fr;
  gap:20px; /* ~ gap-5 */
}
@media (min-width: 640px){ .slc-grid{ grid-template-columns: repeat(2, 1fr); } } /* sm */
@media (min-width: 1024px){ .slc-grid{ grid-template-columns: repeat(3, 1fr); } } /* lg */
@media (min-width: 768px){ .slc-grid{ gap:24px; } }   /* md:gap-6 */
@media (min-width: 1280px){ .slc-grid{ gap:28px; } }  /* lg:gap-7 */

/* Body card padding lebih nyaman */
@media (min-width: 768px){
  .slc-body{ padding:22px; } /* override dari 18px saat md+ */
}

/* Jarak actions (pengganti mt-3/md:mt-4) */
.slc-actions{ margin-top:12px; }
@media (min-width: 768px){ .slc-actions{ margin-top:16px; } }

/* Opsi: jika mau beri padding atas section (pengganti pt-5) & bawah untuk bottom-nav */
.slc-section{ padding-top:20px; padding-bottom:118px; }
  </style>
@endpush

@section('content')
  <x-navigation-auth />
  <x-bottom-nav />

  <section class="pb-[118px] pt-5 slc-root" x-data="{
    q: '',
    cat: '',
    get cats() {
      const set = new Set();
      @foreach($completedCourses as $c)
        @if($c->category?->name)
          set.add(@js($c->category->name));
        @endif
      @endforeach
      return Array.from(set).sort();
    }
  }">
    <div class="slc-wrap slc-stack">
      {{-- ===== HEADER + TOOLBAR DALAM SATU CARD ===== --}}
      <div class="slc-card slc-scan overflow-hidden">
        <div class="slc-topbar"></div>

        <div class="slc-header-pad">
          {{-- Title + sub + total --}}
          <div class="flex flex-col gap-3 md:gap-4">
            <div class="flex items-center gap-2">
              <span class="slc-dot"></span>
              <h1 class="slc-title m-0">Koleksi Sertifikat</h1>
            </div>

            <p class="slc-sub leading-relaxed">
              Semua sertifikat resmi dari course yang telah kamu selesaikan di Lingkaran Koding.
              Tunjukkan progresmu dan bagikan ke publik.
            </p>

            <div class="flex flex-wrap items-center gap-3">
              <div class="slc-stats">
                <span>Total</span>
                <span>{{ $completedCourses->count() }} Sertifikat</span>
              </div>
            </div>
          </div>

          {{-- Divider tipis --}}
          <div class="slc-divider h-px bg-gradient-to-r from-transparent via-emerald-900/40 to-transparent"></div>
        </div>

        {{-- Ribbon bawah card header --}}
        <div class="slc-ribbon">
          <span>Happy Learning</span>
        </div>
      </div>
      {{-- ===== END HEADER CARD ===== --}}

      {{-- Grid --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6 lg:gap-7">
        @forelse ($completedCourses as $course)
          @php
            $progressForUser = optional($course->studentProgress)->firstWhere('user_id', auth()->id());
            $completedAt = optional($progressForUser)->completed_at;
            $catName = $course->category->name ?? '';
          @endphp

          <div
            class="slc-card slc-scan"
            x-show="(q === '' || '{{ Str::lower($course->name) }}'.includes(q.toLowerCase())) && (cat === '' || '{{ $catName }}' === cat)"
            x-cloak
          >
            <div class="slc-topbar"></div>
            <div class="slc-body p-5 md:p-6">
              <div class="flex items-start justify-between">
                <div class="slc-badges">
                  <span class="slc-badge">
                    {{-- check --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Selesai
                  </span>
                  @if($catName)
                    <span class="slc-badge">{{ $catName }}</span>
                  @endif
                </div>
                @if($completedAt)
                  <span class="slc-date">Selesai {{ \Carbon\Carbon::parse($completedAt)->translatedFormat('d M Y') }}</span>
                @endif
              </div>

              <h3 class="slc-title2">{{ $course->name }}</h3>

              {{-- Mini certificate preview --}}
              <div class="slc-mini aspect-[16/9]">
                <div class="slc-frame"></div>
                <div class="slc-seal"></div>
                <div class="slc-center">
                  <div>
                    <div class="ico">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                      </svg>
                    </div>
                    <p class="text-[11px] tracking-wide text-[#cfe9e4]">Preview Sertifikat</p>
                  </div>
                </div>
              </div>

              {{-- Actions --}}
              <div class="slc-actions mt-3 md:mt-4">
                <a href="{{ route('dashboard.course.certificate', $course->slug) }}" target="_blank" class="slc-btn slc-btn-primary">
                  {{-- eye --}}
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 -ml-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                  </svg>
                  Lihat
                </a>

                <a href="{{ route('dashboard.course.certificate.download', $course->slug) }}" class="slc-btn slc-btn-ghost">
                  {{-- download --}}
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 -ml-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                  </svg>
                  Download
                </a>


              </div>
            </div>

            <div class="slc-ribbon">
              <span>Certificate</span>
              <small>{{ $catName ?: 'Uncategorized' }}</small>
            </div>
          </div>
        @empty
          <div class="col-span-full">
            <div class="relative overflow-hidden rounded-2xl border border-dashed border-gray-300 bg-gradient-to-br from-white to-gray-50">
              <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-emerald-200/40 blur-2xl"></div>
              <div class="absolute -left-6 -bottom-12 h-44 w-44 rounded-full bg-teal-200/40 blur-2xl"></div>

              <div class="relative z-10 px-8 py-16 text-center">
                <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-gray-100 ring-1 ring-inset ring-gray-200">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                  </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">Belum Ada Sertifikat</h3>
                <p class="mt-2 text-gray-600 max-w-xl mx-auto">Selesaikan course pertamamu dan dapatkan sertifikat resmi dari Lingkaran Koding.</p>
                <a href="{{ route('dashboard') }}"
                  class="mt-6 inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-emerald-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 -ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                  </svg>
                  Kembali ke Kursus
                </a>
              </div>
            </div>
          </div>
        @endforelse
      </div>
    </div>
  </section>
@endsection

@push('after-scripts')
  <script src="{{ asset('js/dropdown-navbar.js') }}"></script>
@endpush
