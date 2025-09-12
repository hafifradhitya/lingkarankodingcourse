@extends('front.layouts.app')
@section('title', 'Lingkaran Koding Learning Platform - Learn Anytime, Anywhere')
@section('content')
    <x-nav-guest />

    <!-- Main Content -->
    <main class="flex flex-1 items-center py-[70px]">
        <div class="w-full flex gap-[77px] justify-between items-center pl-[calc(((100%-1280px)/2)+75px)]">
            <div class="flex flex-col max-w-[500px] gap-[50px]">
                <div class="flex flex-col gap-[30px]">
                    <p class="flex items-center gap-[6px] w-fit rounded-full py-2 px-[14px] bg-obito-light-green">
                        <img src="{{ asset('assets/images/icons/crown-green.svg') }}" class="flex shrink-0 w-5" alt="icon">
                        <span class="font-bold text-sm">TRUSTED BY ASPIRING DEVELOPERS</span>
                    </p>
                    <div>
                        <h1 class="font-extrabold text-[50px] leading-[65px]">Start Small, <br>Grow Together</h1>
                        <p class="leading-7 mt-[10px] text-obito-text-secondary">
                            Lingkaran Koding lahir dari IT Club dan berkembang menjadi wadah belajar, berbagi, serta berkarya di dunia digital.
                        </p>
                    </div>
                    <div class="flex items-center gap-[18px]">
                        <a href="{{ route('register') }}"
                            class="flex items-center rounded-full h-[67px] py-5 px-[30px] gap-[10px] bg-obito-green hover:drop-shadow-effect transition-all duration-300">
                            <span class="text-white font-semibold text-lg">Get Started</span>
                        </a>
                        <a href="#"
                            class="flex items-center rounded-full h-[67px] border border-obito-grey py-5 px-[30px] bg-white gap-[10px] hover:border-obito-green transition-all duration-300">
                            <img src="{{ asset('assets/images/icons/play-circle-fill.svg') }}" class="size-8 flex shrink-0"
                                alt="icon">
                            <span class="font-semibold text-lg">How It Works</span>
                        </a>
                    </div>
                </div>
                <div class="flex items-center gap-[14px]">
                    <div>
                        <div class="flex gap-1 items-center">
                            <div class="flex">
                                <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="flex shrink-0 w-5"
                                    alt="star">
                                <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="flex shrink-0 w-5"
                                    alt="star">
                                <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="flex shrink-0 w-5"
                                    alt="star">
                                <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="flex shrink-0 w-5"
                                    alt="star">
                                <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="flex shrink-0 w-5"
                                    alt="star">
                            </div>
                            <span class="font-bold">5.0</span>
                        </div>
                        <p class="font-bold mt-1">Lingkaran Koding Production</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex shrink-0 h-[590px] w-[666px] justify-end">
            <img src="{{ asset('assets/images/backgrounds/hero-image-lk.png') }}" alt="hero-image-lk">
        </div>
    </main>
@endsection
@push('after-styles')
    <style>
        @media (max-width: 768px) {

            /* Logo adjustment for mobile */
            #nav-guest .logo-img {
                width: 40px;
                height: 40px;
            }

            /* Hero section responsive */
            main {
                flex-direction: column;
                padding: 40px 20px;
            }

            main .w-full.flex {
                padding-left: 0 !important;
            }

            main h1 {
                font-size: 32px;
                line-height: 42px;
            }

            main .flex.items-center.gap-\[18px\] {
                flex-direction: column;
                width: 100%;
            }

            main .flex.items-center.gap-\[18px\] a {
                width: 100%;
                justify-content: center;
            }

            /* Hero image responsive */
            .flex.shrink-0.h-\[590px\].w-\[666px\] {
                width: 100%;
                height: auto;
                max-width: 400px;
                margin: 30px auto 0;
            }

            .flex.shrink-0.h-\[590px\].w-\[666px\] img {
                width: 100%;
                height: auto;
            }
        }

        @media (max-width: 480px) {

            /* Further adjustments for small mobile */
            main h1 {
                font-size: 26px;
                line-height: 36px;
            }

            main p {
                font-size: 14px;
            }

            .mobile-menu {
                width: 100%;
            }
        }
    </style>
@endpush
@push('after-scripts')
    <script>
        function toggleMenu() {
            const hamburger = document.querySelector('.hamburger');
            const mobileMenu = document.querySelector('.mobile-menu');
            const overlay = document.querySelector('.mobile-menu-overlay');
            const body = document.body;

            hamburger.classList.toggle('active');
            mobileMenu.classList.toggle('active');
            overlay.classList.toggle('active');
            body.classList.toggle('menu-open');
        }

        function closeMenu() {
            const hamburger = document.querySelector('.hamburger');
            const mobileMenu = document.querySelector('.mobile-menu');
            const overlay = document.querySelector('.mobile-menu-overlay');
            const body = document.body;

            hamburger.classList.remove('active');
            mobileMenu.classList.remove('active');
            overlay.classList.remove('active');
            body.classList.remove('menu-open');
        }

        // Close menu when clicking on a link
        document.querySelectorAll('.mobile-menu-links a').forEach(link => {
            link.addEventListener('click', closeMenu);
        });

        // Close menu on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeMenu();
            }
        });
    </script>
@endpush
