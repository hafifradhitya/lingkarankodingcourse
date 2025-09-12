@extends('front.layouts.app')
@section('title', 'Features - Lingkaran Koding Online Learning Platform')
@section('content')
    <x-nav-guest />

    <!-- Hero Section -->
    <section class="py-[70px] px-[75px] bg-gradient-to-b from-white to-[#F8FAF9]">
        <div class="max-w-[1280px] mx-auto">
            <div class="text-center mb-[50px]">
                <p class="flex items-center justify-center gap-[6px] w-fit rounded-full py-2 px-[14px] bg-obito-light-green mx-auto mb-[30px] transition-all duration-300 hover:scale-105">
                    <img src="{{ asset('assets/images/icons/crown-green.svg') }}" class="flex shrink-0 w-5" alt="icon">
                    <span class="font-bold text-sm">COMPREHENSIVE LEARNING FEATURES</span>
                </p>
                <h1 class="font-extrabold text-[50px] leading-[65px] mb-[10px] bg-gradient-to-r from-[#2C3E50] to-[#4A90E2] bg-clip-text text-transparent">Fitur Unggulan<br>Platform Kami</h1>
                <p class="leading-7 text-obito-text-secondary max-w-[650px] mx-auto">
                    Dapatkan pengalaman belajar terbaik dengan berbagai fitur canggih yang dirancang khusus untuk mendukung perjalanan coding Anda dari pemula hingga expert.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Features Grid -->
    <section class="pb-[66px] px-[75px]">
        <div class="max-w-[1280px] mx-auto">
            <div class="grid grid-cols-2 gap-[40px] mb-[50px]">
                <!-- Interactive Learning -->
                <div class="bg-white rounded-[20px] p-[30px] shadow-[0px_10px_30px_0px_#B8B8B840] transition-all duration-300 hover:shadow-[0px_20px_40px_0px_#B8B8B860] hover:-translate-y-1 group">
                    <div class="flex items-center gap-[20px] mb-[20px]">
                        <div class="size-[60px] rounded-full bg-gradient-to-br from-obito-light-green to-obito-green flex items-center justify-center transition-all duration-300 group-hover:scale-110">
                            <img src="{{ asset('assets/images/icons/play-circle-fill.svg') }}" class="size-8" alt="icon">
                        </div>
                        <h3 class="font-bold text-[22px] leading-[33px] group-hover:text-obito-green transition-colors duration-300">Interactive Learning</h3>
                    </div>
                    <p class="text-obito-text-secondary leading-7 mb-[20px]">
                        Belajar dengan metode interaktif melalui video pembelajaran, quiz, dan coding challenge yang menarik dan mudah dipahami.
                    </p>
                    <ul class="space-y-[10px]">
                        <li class="flex items-center gap-[10px] transition-all duration-300 hover:translate-x-1">
                            <div class="size-2 bg-obito-green rounded-full"></div>
                            <span class="text-sm">Video HD berkualitas tinggi</span>
                        </li>
                        <li class="flex items-center gap-[10px] transition-all duration-300 hover:translate-x-1">
                            <div class="size-2 bg-obito-green rounded-full"></div>
                            <span class="text-sm">Interactive coding exercises</span>
                        </li>
                        <li class="flex items-center gap-[10px] transition-all duration-300 hover:translate-x-1">
                            <div class="size-2 bg-obito-green rounded-full"></div>
                            <span class="text-sm">Real-time code feedback</span>
                        </li>
                    </ul>
                </div>

                <!-- Progress Tracking -->
                <div class="bg-white rounded-[20px] p-[30px] shadow-[0px_10px_30px_0px_#B8B8B840] transition-all duration-300 hover:shadow-[0px_20px_40px_0px_#B8B8B860] hover:-translate-y-1 group">
                    <div class="flex items-center gap-[20px] mb-[20px]">
                        <div class="size-[60px] rounded-full bg-gradient-to-br from-obito-light-green to-obito-green flex items-center justify-center transition-all duration-300 group-hover:scale-110">
                            <img src="{{ asset('assets/images/icons/crown-green.svg') }}" class="size-8" alt="icon">
                        </div>
                        <h3 class="font-bold text-[22px] leading-[33px] group-hover:text-obito-green transition-colors duration-300">Progress Tracking</h3>
                    </div>
                    <p class="text-obito-text-secondary leading-7 mb-[20px]">
                        Pantau perkembangan belajar Anda dengan sistem tracking yang komprehensif dan analytics yang detail.
                    </p>
                    <ul class="space-y-[10px]">
                        <li class="flex items-center gap-[10px] transition-all duration-300 hover:translate-x-1">
                            <div class="size-2 bg-obito-green rounded-full"></div>
                            <span class="text-sm">Personal learning dashboard</span>
                        </li>
                        <li class="flex items-center gap-[10px] transition-all duration-300 hover:translate-x-1">
                            <div class="size-2 bg-obito-green rounded-full"></div>
                            <span class="text-sm">Detailed progress analytics</span>
                        </li>
                        <li class="flex items-center gap-[10px] transition-all duration-300 hover:translate-x-1">
                            <div class="size-2 bg-obito-green rounded-full"></div>
                            <span class="text-sm">Achievement badges</span>
                        </li>
                    </ul>
                </div>

                <!-- Expert Mentorship -->
                <div class="bg-white rounded-[20px] p-[30px] shadow-[0px_10px_30px_0px_#B8B8B840] transition-all duration-300 hover:shadow-[0px_20px_40px_0px_#B8B8B860] hover:-translate-y-1 group">
                    <div class="flex items-center gap-[20px] mb-[20px]">
                        <div class="size-[60px] rounded-full bg-gradient-to-br from-obito-light-green to-obito-green flex items-center justify-center transition-all duration-300 group-hover:scale-110">
                            <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="size-8" alt="icon">
                        </div>
                        <h3 class="font-bold text-[22px] leading-[33px] group-hover:text-obito-green transition-colors duration-300">Expert Mentorship</h3>
                    </div>
                    <p class="text-obito-text-secondary leading-7 mb-[20px]">
                        Dapatkan bimbingan langsung dari mentor berpengalaman yang siap membantu perjalanan coding Anda.
                    </p>
                    <ul class="space-y-[10px]">
                        <li class="flex items-center gap-[10px] transition-all duration-300 hover:translate-x-1">
                            <div class="size-2 bg-obito-green rounded-full"></div>
                            <span class="text-sm">1-on-1 mentoring sessions</span>
                        </li>
                        <li class="flex items-center gap-[10px] transition-all duration-300 hover:translate-x-1">
                            <div class="size-2 bg-obito-green rounded-full"></div>
                            <span class="text-sm">Code review & feedback</span>
                        </li>
                        <li class="flex items-center gap-[10px] transition-all duration-300 hover:translate-x-1">
                            <div class="size-2 bg-obito-green rounded-full"></div>
                            <span class="text-sm">Career guidance</span>
                        </li>
                    </ul>
                </div>

                <!-- Community Support -->
                <div class="bg-white rounded-[20px] p-[30px] shadow-[0px_10px_30px_0px_#B8B8B840] transition-all duration-300 hover:shadow-[0px_20px_40px_0px_#B8B8B860] hover:-translate-y-1 group">
                    <div class="flex items-center gap-[20px] mb-[20px]">
                        <div class="size-[60px] rounded-full bg-gradient-to-br from-obito-light-green to-obito-green flex items-center justify-center transition-all duration-300 group-hover:scale-110">
                            <img src="{{ asset('assets/images/icons/play-circle-fill.svg') }}" class="size-8" alt="icon">
                        </div>
                        <h3 class="font-bold text-[22px] leading-[33px] group-hover:text-obito-green transition-colors duration-300">Community Support</h3>
                    </div>
                    <p class="text-obito-text-secondary leading-7 mb-[20px]">
                        Bergabung dengan komunitas developer yang solid dan saling mendukung dalam perjalanan belajar coding.
                    </p>
                    <ul class="space-y-[10px]">
                        <li class="flex items-center gap-[10px] transition-all duration-300 hover:translate-x-1">
                            <div class="size-2 bg-obito-green rounded-full"></div>
                            <span class="text-sm">Active discussion forums</span>
                        </li>
                        <li class="flex items-center gap-[10px] transition-all duration-300 hover:translate-x-1">
                            <div class="size-2 bg-obito-green rounded-full"></div>
                            <span class="text-sm">Peer-to-peer learning</span>
                        </li>
                        <li class="flex items-center gap-[10px] transition-all duration-300 hover:translate-x-1">
                            <div class="size-2 bg-obito-green rounded-full"></div>
                            <span class="text-sm">Networking opportunities</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Features -->
    <section class="pb-[66px] px-[75px] bg-gradient-to-b from-[#F8FAF9] to-white">
        <div class="max-w-[1280px] mx-auto">
            <div class="text-center mb-[50px]">
                <h2 class="font-extrabold text-[40px] leading-[48px] mb-[10px] bg-gradient-to-r from-[#2C3E50] to-[#4A90E2] bg-clip-text text-transparent">Fitur Tambahan</h2>
                <p class="leading-7 text-obito-text-secondary max-w-[600px] mx-auto">
                    Nikmati berbagai fitur pendukung yang membuat pengalaman belajar Anda semakin optimal dan menyenangkan.
                </p>
            </div>

            <div class="grid grid-cols-4 gap-[30px]">
                <!-- Mobile Learning -->
                <div class="bg-white rounded-[14px] p-[20px] text-center shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="size-[50px] rounded-full bg-gradient-to-br from-obito-light-green to-obito-green flex items-center justify-center mx-auto mb-[15px] transition-all duration-300 hover:scale-110">
                        <img src="{{ asset('assets/images/icons/crown-green.svg') }}" class="size-6" alt="icon">
                    </div>
                    <h4 class="font-bold text-[18px] mb-[8px] transition-colors duration-300 hover:text-obito-green">Mobile Learning</h4>
                    <p class="text-sm text-obito-text-secondary">Belajar kapan saja, dimana saja dengan aplikasi mobile kami</p>
                </div>

                <!-- Offline Access -->
                <div class="bg-white rounded-[14px] p-[20px] text-center shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="size-[50px] rounded-full bg-gradient-to-br from-obito-light-green to-obito-green flex items-center justify-center mx-auto mb-[15px] transition-all duration-300 hover:scale-110">
                        <img src="{{ asset('assets/images/icons/play-circle-fill.svg') }}" class="size-6" alt="icon">
                    </div>
                    <h4 class="font-bold text-[18px] mb-[8px] transition-colors duration-300 hover:text-obito-green">Offline Access</h4>
                    <p class="text-sm text-obito-text-secondary">Download materi dan lanjutkan belajar tanpa koneksi internet</p>
                </div>

                <!-- Multi-Language -->
                <div class="bg-white rounded-[14px] p-[20px] text-center shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="size-[50px] rounded-full bg-gradient-to-br from-obito-light-green to-obito-green flex items-center justify-center mx-auto mb-[15px] transition-all duration-300 hover:scale-110">
                        <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="size-6" alt="icon">
                    </div>
                    <h4 class="font-bold text-[18px] mb-[8px] transition-colors duration-300 hover:text-obito-green">Multi-Language</h4>
                    <p class="text-sm text-obito-text-secondary">Pelajari berbagai bahasa pemrograman dalam satu platform</p>
                </div>

                <!-- Certification -->
                <div class="bg-white rounded-[14px] p-[20px] text-center shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="size-[50px] rounded-full bg-gradient-to-br from-obito-light-green to-obito-green flex items-center justify-center mx-auto mb-[15px] transition-all duration-300 hover:scale-110">
                        <img src="{{ asset('assets/images/icons/crown-green.svg') }}" class="size-6" alt="icon">
                    </div>
                    <h4 class="font-bold text-[18px] mb-[8px] transition-colors duration-300 hover:text-obito-green">Certification</h4>
                    <p class="text-sm text-obito-text-secondary">Dapatkan sertifikat resmi setelah menyelesaikan course</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-[66px] px-[75px] bg-gradient-to-b from-white to-[#F8FAF9]">
        <div class="max-w-[1280px] mx-auto">
            <div class="flex gap-[77px] items-center">
                <div class="flex-1">
                    <p class="flex items-center gap-[6px] w-fit rounded-full py-2 px-[14px] bg-obito-light-green mb-[30px] transition-all duration-300 hover:scale-105">
                        <img src="{{ asset('assets/images/icons/crown-green.svg') }}" class="flex shrink-0 w-5" alt="icon">
                        <span class="font-bold text-sm">WHY CHOOSE US</span>
                    </p>
                    <h2 class="font-extrabold text-[40px] leading-[48px] mb-[20px] bg-gradient-to-r from-[#2C3E50] to-[#4A90E2] bg-clip-text text-transparent">Kenapa Lingkaran Koding?</h2>
                    <p class="leading-7 text-obito-text-secondary mb-[30px]">
                        Kami memahami tantangan dalam belajar programming. Oleh karena itu, kami menciptakan platform yang tidak hanya mengajarkan coding, tetapi juga membangun mindset developer yang kuat.
                    </p>

                    <div class="space-y-[20px]">
                        <div class="flex items-start gap-[15px] transition-all duration-300 hover:translate-x-1">
                            <div class="size-6 rounded-full bg-obito-green flex items-center justify-center mt-1 transition-all duration-300 hover:scale-110">
                                <div class="size-2 bg-white rounded-full"></div>
                            </div>
                            <div>
                                <h4 class="font-semibold text-[18px] mb-[5px] transition-colors duration-300 hover:text-obito-green">Kurikulum Terupdate</h4>
                                <p class="text-obito-text-secondary text-sm">Materi pembelajaran selalu mengikuti tren teknologi terbaru dan kebutuhan industri.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-[15px] transition-all duration-300 hover:translate-x-1">
                            <div class="size-6 rounded-full bg-obito-green flex items-center justify-center mt-1 transition-all duration-300 hover:scale-110">
                                <div class="size-2 bg-white rounded-full"></div>
                            </div>
                            <div>
                                <h4 class="font-semibold text-[18px] mb-[5px] transition-colors duration-300 hover:text-obito-green">Praktik Langsung</h4>
                                <p class="text-obito-text-secondary text-sm">Setiap teori langsung dipraktikkan dengan project nyata yang relevan dengan dunia kerja.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-[15px] transition-all duration-300 hover:translate-x-1">
                            <div class="size-6 rounded-full bg-obito-green flex items-center justify-center mt-1 transition-all duration-300 hover:scale-110">
                                <div class="size-2 bg-white rounded-full"></div>
                            </div>
                            <div>
                                <h4 class="font-semibold text-[18px] mb-[5px] transition-colors duration-300 hover:text-obito-green">Support 24/7</h4>
                                <p class="text-obito-text-secondary text-sm">Tim support kami siap membantu Anda kapan saja melalui berbagai channel komunikasi.</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-[18px] mt-[30px]">
                        <a href="{{ route('register') }}"
                            class="flex items-center rounded-full h-[67px] py-5 px-[30px] gap-[10px] bg-gradient-to-r from-obito-green to-[#3A9B3A] text-white font-semibold text-lg transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 group">
                            <span>Mulai Belajar</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="#"
                            class="flex items-center rounded-full h-[67px] border border-obito-grey py-5 px-[30px] bg-white gap-[10px] transition-all duration-300 hover:border-obito-green hover:shadow-lg hover:-translate-y-0.5">
                            <span class="font-semibold text-lg">Lihat Paket</span>
                        </a>
                    </div>
                </div>

                <div class="flex shrink-0 w-[500px] transition-all duration-500 hover:scale-105">
                    <img src="{{ asset('assets/images/backgrounds/hero-image-lk.png') }}" alt="why choose us" class="w-full h-auto">
                </div>
            </div>
        </div>
    </section>
@endsection

@push('after-styles')
    <style>
        /* Custom animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        /* Staggered animation for feature items */
        .feature-item:nth-child(1) { animation-delay: 0.1s; }
        .feature-item:nth-child(2) { animation-delay: 0.2s; }
        .feature-item:nth-child(3) { animation-delay: 0.3s; }
        .feature-item:nth-child(4) { animation-delay: 0.4s; }

        @media (max-width: 768px) {
            /* Mobile responsive adjustments */
            section {
                padding-left: 20px !important;
                padding-right: 20px !important;
            }

            .grid-cols-2 {
                grid-template-columns: 1fr;
            }

            .grid-cols-4 {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }

            .text-\[50px\] {
                font-size: 32px;
                line-height: 42px;
            }

            .text-\[40px\] {
                font-size: 28px;
                line-height: 38px;
            }

            .flex.gap-\[77px\] {
                flex-direction: column;
                gap: 40px;
            }

            .w-\[500px\] {
                width: 100%;
                max-width: 400px;
                margin: 0 auto;
            }

            .gap-\[40px\] {
                gap: 20px;
            }

            .p-\[30px\] {
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            .grid-cols-4 {
                grid-template-columns: 1fr;
            }

            .text-\[22px\] {
                font-size: 18px;
            }

            .gap-\[20px\] {
                gap: 15px;
            }

            .flex.items-center.gap-\[18px\] {
                flex-direction: column;
                gap: 15px;
            }

            .flex.items-center.gap-\[18px\] a {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endpush

@push('after-scripts')
    <script>
        // Add animations when scrolling into view
        document.addEventListener('DOMContentLoaded', function() {
            const featureItems = document.querySelectorAll('.bg-white.rounded-\\[20px\\]');
            featureItems.forEach((item, index) => {
                item.classList.add('feature-item', 'animate-fadeInUp');
                item.style.opacity = '0';
            });

            // Animate on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                    }
                });
            }, observerOptions);

            featureItems.forEach(item => {
                observer.observe(item);
            });
        });
    </script>
@endpush
