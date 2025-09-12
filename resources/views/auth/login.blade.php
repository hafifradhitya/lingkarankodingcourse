@extends('front.layouts.app')
@section('title', 'Sign In - Lingkaran Koding Online Learning Platform')
@section('content')
    <x-nav-guest />

    <main class="login-container">
        <section class="form-section">
            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf
                <h1 class="font-bold text-[22px] leading-[33px] mb-5">Welcome Back, <br>Let's Upgrade Skills</h1>
                <div class="flex flex-col gap-2">
                    <p>Email Address</p>
                    <label class="relative group">
                        <input name="email" type="email"
                            class="appearance-none outline-none w-full rounded-full border border-obito-grey py-[14px] px-5 pl-12 font-semibold placeholder:font-normal placeholder:text-obito-text-secondary group-focus-within:border-obito-green transition-all duration-300"
                            placeholder="Type your valid email address">
                        <img src="assets/images/icons/sms.svg"
                            class="absolute size-5 flex shrink-0 transform -translate-y-1/2 top-1/2 left-5" alt="icon">
                    </label>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="flex flex-col gap-3">
                    <p>Password</p>
                    <label class="relative group">
                        <input name="password" type="password"
                            class="appearance-none outline-none w-full rounded-full border border-obito-grey py-[14px] px-5 pl-12 font-semibold placeholder:font-normal placeholder:text-obito-text-secondary group-focus-within:border-obito-green transition-all duration-300"
                            placeholder="Type your password">
                        <img src="assets/images/icons/shield-security.svg"
                            class="absolute size-5 flex shrink-0 transform -translate-y-1/2 top-1/2 left-5" alt="icon">
                    </label>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    <a href="#" class="text-sm text-obito-green hover:underline">Forgot My Password</a>
                </div>
                <button type="submit"
                    class="flex items-center justify-center gap-[10px] rounded-full py-[14px] px-5 bg-obito-green hover:drop-shadow-effect transition-all duration-300">
                    <span class="font-semibold text-white">Sign In to My Account</span>
                </button>
            </form>
        </section>
        <div class="banner-section">
            <div id="background-banner" class="absolute flex w-full h-full overflow-hidden">
                <img src="assets/images/backgrounds/banner-subscription.png" class="w-full h-full object-cover"
                    alt="banner">
            </div>
        </div>
    </main>
@endsection
@push('after-styles')
    <style>
        /* Main content responsive styles */
        .login-container {
            display: flex;
            flex: 1;
            height: 100vh;
        }

        .form-section {
            flex: 1;
            display: flex;
            align-items: center;
            padding: 20px;
            padding-left: calc(((100% - 1280px) / 2) + 75px);
            min-height: 100vh;
        }

        .banner-section {
            position: relative;
            flex: 0 0 50%;
            display: flex;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            height: fit-content;
            width: 510px;
            flex-shrink: 0;
            border-radius: 20px;
            border: 1px solid #EAECEE;
            padding: 20px;
            gap: 20px;
            background-color: white;
        }

        /* Responsive Styles */
        @media (max-width: 1024px) {

            /* Adjust padding for tablet */
            #nav-guest>div {
                padding: 15px 30px;
            }

            /* Adjust gap between menu items */
            #nav-guest ul {
                gap: 20px;
            }

            /* Hide some items if needed */
            .desktop-nav .flex.items-center.gap-5 {
                gap: 15px;
            }

            /* Adjust form section padding for tablet */
            .form-section {
                padding-left: 50px;
                padding-right: 50px;
            }

            /* Reduce form width for tablet */
            .login-form {
                width: 450px;
            }
        }

        @media (max-width: 768px) {

            /* Adjust navbar padding for mobile */
            #nav-guest>div {
                padding: 15px 20px;
            }

            /* Logo adjustment for mobile */
            #nav-guest .logo-img {
                width: 40px;
                height: 40px;
            }

            /* HIDE BANNER SECTION ON MOBILE */
            .banner-section {
                display: none;
            }

            /* Make form section full width on mobile */
            .form-section {
                flex: 1;
                padding: 20px;
                padding-left: 20px;
                justify-content: center;
            }

            /* Adjust form for mobile */
            .login-form {
                width: 100%;
                max-width: 400px;
                margin: 0 auto;
            }

            /* Adjust main container for mobile */
            .login-container {
                min-height: calc(100vh - 80px);
                /* Account for navbar */
            }
        }

        @media (max-width: 480px) {

            /* Extra small screens */
            .form-section {
                padding: 15px;
            }

            .login-form {
                padding: 15px;
                gap: 15px;
            }

            /* Smaller heading on very small screens */
            .login-form h1 {
                font-size: 20px;
                line-height: 1.4;
                margin-bottom: 15px;
            }

            /* Adjust input padding for smaller screens */
            .login-form input {
                padding: 12px 20px;
                padding-left: 45px;
            }

            /* Adjust button padding */
            .login-form button {
                padding: 12px 20px;
            }
        }

        /* Additional utility classes */
        .obito-grey {
            color: #EAECEE;
        }

        .obito-green {
            color: #2F6A62;
        }

        .obito-text-secondary {
            color: #6B7280;
        }

        .drop-shadow-effect {
            box-shadow: 0px 12px 30px 0px rgba(47, 106, 98, 0.5);
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
