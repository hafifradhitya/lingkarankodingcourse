@extends('front.layouts.app')
@section('title', 'Sign Up - Lingkaran Koding Online Learning Platform')
@section('content')
    <x-nav-guest />

    <main class="signup-container">
        <section class="form-section">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="signup-form">
                @csrf
                <h1 class="font-bold text-[22px] leading-[33px]">Upgrade Your Skills</h1>

                <!-- Photo Upload Section -->
                <div class="photo-upload-container">
                    <button id="upload-photo" type="button" class="photo-upload-btn">
                        <span class="photo-upload-text">
                            Add <br>Photo
                        </span>
                        <img id="photo-preview" src="" class="photo-preview" alt="photo">
                    </button>
                    <button id="delete-photo" type="button" class="delete-photo-btn">DELETE PHOTO</button>
                    <input id="hidden-input" name="photo" type="file" accept="image/*"
                        class="absolute -z-10 opacity-0">
                </div>
                <x-input-error :messages="$errors->get('photo')" class="mt-2" />

                <!-- Complete Name -->
                <div class="form-field">
                    <p>Complete Name</p>
                    <label class="relative group">
                        <input name="name" type="text" class="form-field input" placeholder="Type your complete name">
                        <img src="{{ asset('assets/images/icons/profile.svg') }}" class="input-icon" alt="icon">
                    </label>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Occupation -->
                <div class="form-field">
                    <p>Occupation</p>
                    <label class="relative group">
                        <input name="occupation" type="text" class="form-field input" placeholder="Type your ocupation">
                        <img src="{{ asset('assets/images/icons/briefcase.svg') }}" class="input-icon" alt="icon">
                    </label>
                    <x-input-error :messages="$errors->get('occupation')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="form-field">
                    <p>Email Address</p>
                    <label class="relative group">
                        <input name="email" type="email" class="form-field input"
                            placeholder="Type your valid email address">
                        <img src="{{ asset('assets/images/icons/sms.svg') }}" class="input-icon" alt="icon">
                    </label>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="form-field">
                    <p>Password</p>
                    <label class="relative group">
                        <input name="password" type="password" class="form-field input" placeholder="Type your password">
                        <img src="{{ asset('assets/images/icons/shield-security.svg') }}" class="input-icon" alt="icon">
                    </label>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="form-field">
                    <p>Confirm Password</p>
                    <label class="relative group">
                        <input name="password_confirmation" type="password" class="form-field input"
                            placeholder="Type your password">
                        <img src="{{ asset('assets/images/icons/shield-security.svg') }}" class="input-icon" alt="icon">
                    </label>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <button type="submit"
                    class="flex items-center justify-center gap-[10px] rounded-full py-[14px] px-5 bg-obito-green hover:drop-shadow-effect transition-all duration-300">
                    <span class="font-semibold text-white">Create My Account</span>
                </button>
            </form>
        </section>

        <div class="banner-section">
            <div id="background-banner" class="absolute flex w-full h-full overflow-hidden">
                <img src="{{ asset('assets/images/backgrounds/banner-subscription.png') }}"
                    class="w-full h-full object-cover" alt="banner">
            </div>
        </div>
    </main>
@endsection
@push('after-styles')
    <style>
        /* Main content responsive styles */
        .signup-container {
            display: flex;
            flex: 1;
            min-height: 100vh;
        }

        .form-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            padding-left: calc(((100% - 1280px) / 2) + 75px);
            min-height: 100vh;
        }

        .banner-section {
            position: relative;
            flex: 0 0 50%;
            display: flex;
        }

        .signup-form {
            display: flex;
            flex-direction: column;
            height: fit-content;
            width: 510px;
            flex-shrink: 0;
            border-radius: 20px;
            border: 1px solid #EAECEE;
            padding: 20px;
            gap: 16px;
            background-color: white;
            margin: 20px 0;
        }

        /* Photo upload styles */
        .photo-upload-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .photo-upload-btn {
            position: relative;
            width: 90px;
            height: 90px;
            display: flex;
            border-radius: 50%;
            overflow: hidden;
            border: 1px solid #EAECEE;
            cursor: pointer;
            transition: all 0.3s;
        }

        .photo-upload-btn:focus {
            outline: 2px solid #2F6A62;
        }

        .photo-upload-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-weight: 600;
            font-size: 12px;
            text-align: center;
            line-height: 1.2;
        }

        .photo-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }

        .delete-photo-btn {
            border-radius: 20px;
            width: fit-content;
            padding: 6px 10px;
            background-color: #FEE2E2;
            font-weight: bold;
            font-size: 10px;
            color: #DC2626;
            border: none;
            cursor: pointer;
            display: none;
        }

        /* Responsive Styles */
        @media (max-width: 1024px) {

            /* Adjust form section padding for tablet */
            .form-section {
                padding-left: 50px;
                padding-right: 50px;
            }

            /* Reduce form width for tablet */
            .signup-form {
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
            .signup-form {
                width: 100%;
                max-width: 400px;
                margin: 0 auto;
            }

            /* Adjust main container for mobile */
            .signup-container {
                min-height: calc(100vh - 80px);
                /* Account for navbar */
            }

            /* Adjust photo upload for mobile */
            .photo-upload-container {
                flex-direction: column;
                align-items: center;
                gap: 8px;
            }

            .photo-upload-btn {
                width: 80px;
                height: 80px;
            }
        }

        @media (max-width: 480px) {

            /* Extra small screens */
            .form-section {
                padding: 15px;
            }

            .signup-form {
                padding: 15px;
                gap: 12px;
            }

            /* Smaller heading on very small screens */
            .signup-form h1 {
                font-size: 20px;
                line-height: 1.4;
                margin-bottom: 10px;
            }

            /* Adjust input padding for smaller screens */
            .signup-form input {
                padding: 12px 20px;
                padding-left: 45px;
            }

            /* Adjust button padding */
            .signup-form button[type="submit"] {
                padding: 12px 20px;
            }

            /* Smaller photo upload for very small screens */
            .photo-upload-btn {
                width: 70px;
                height: 70px;
            }

            .photo-upload-text {
                font-size: 11px;
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

        .obito-light-red {
            background-color: #FEE2E2;
        }

        .obito-red {
            color: #DC2626;
        }

        .drop-shadow-effect {
            box-shadow: 0px 12px 30px 0px rgba(47, 106, 98, 0.5);
        }

        /* Form field styles */
        .form-field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-field label {
            position: relative;
        }

        .form-field input {
            appearance: none;
            outline: none;
            width: 100%;
            border-radius: 25px;
            border: 1px solid #EAECEE;
            padding: 14px 20px;
            padding-left: 48px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .form-field input::placeholder {
            font-weight: normal;
            color: #6B7280;
        }

        .form-field input:focus {
            border-color: #2F6A62;
        }

        .form-field .input-icon {
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
        }
    </style>
@endpush
@push('after-scripts')
    <script>
        // Photo upload functionality
        document.getElementById('upload-photo').addEventListener('click', function() {
            document.getElementById('hidden-input').click();
        });

        document.getElementById('hidden-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('photo-preview');
                    const text = document.querySelector('.photo-upload-text');
                    const deleteBtn = document.getElementById('delete-photo');

                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    text.style.display = 'none';
                    deleteBtn.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('delete-photo').addEventListener('click', function() {
            const preview = document.getElementById('photo-preview');
            const text = document.querySelector('.photo-upload-text');
            const deleteBtn = document.getElementById('delete-photo');
            const input = document.getElementById('hidden-input');

            preview.style.display = 'none';
            text.style.display = 'block';
            deleteBtn.style.display = 'none';
            input.value = '';
        });

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
