@extends('front.layouts.app')
@section('title', 'Setting User - Lingkaran Koding Online Learning Platform')
@section('content')
    <x-navigation-auth />

    <div id="path" class="flex w-full bg-white border-b border-obito-grey py-[14px]">
        <div class="flex items-center w-full max-w-[1280px] px-[75px] mx-auto gap-5">
            <a href="{{ route('dashboard') }}" class="last-of-type:font-semibold">Dashboard</a>
            <div class="h-10 w-px bg-obito-grey"></div>
            <a href="#" class="last-of-type:font-semibold">Settings</a>
        </div>
    </div>

    <main class="flex flex-col gap-10 pb-10 mt-[30px]">
        <div class="flex flex-col w-full max-w-[1000px] mx-auto gap-[30px]">
            <h1 class="font-bold text-[28px] leading-[42px]">User Settings</h1>

            <!-- Status Messages -->
            @if (session('status') === 'profile-updated')
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">Your profile has been updated.</span>
                </div>
            @endif

            @if (session('status') === 'password-updated')
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">Your password has been updated.</span>
                </div>
            @endif

            @if (session('status') === 'password-reset')
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">Your password has been reset to the default password.</span>
                </div>
            @endif

            <!-- Profile Settings Form -->
            <section class="flex flex-col gap-5 p-[30px] rounded-[20px] border border-obito-grey bg-white">
                <h2 class="font-bold text-[22px] leading-[33px]">Profile Settings</h2>
                <form method="POST" action="{{ route('dashboard.settings.update-profile') }}" enctype="multipart/form-data"
                    class="flex flex-col gap-5">
                    @csrf

                    <div class="flex flex-col gap-2">
                        <label for="photo" class="font-semibold">Profile Photo</label>
                        <div class="flex items-center gap-5">
                            <div class="flex shrink-0 w-[100px] h-[100px] rounded-full overflow-hidden bg-obito-grey">
                                <img src="{{ $user->photo ? Storage::url($user->photo) : asset('assets/images/avatars/default.png') }}"
                                    class="w-full h-full object-cover" alt="profile photo">
                            </div>
                            <input type="file" name="photo" id="photo"
                                class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0
                                file:text-sm file:font-semibold file:bg-obito-light-green file:text-obito-green
                                hover:file:bg-obito-light-green">
                        </div>
                        @error('photo')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="name" class="font-semibold">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                            class="appearance-none outline-none ring-1 ring-obito-grey rounded-[14px] py-[14px] px-5 bg-white
                               placeholder:font-normal placeholder:text-obito-text-secondary focus:ring-obito-green transition-all duration-300">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="occupation" class="font-semibold">Occupation</label>
                        <input type="text" name="occupation" id="occupation"
                            value="{{ old('occupation', $user->occupation) }}" required
                            class="appearance-none outline-none ring-1 ring-obito-grey rounded-[14px] py-[14px] px-5 bg-white
                               placeholder:font-normal placeholder:text-obito-text-secondary focus:ring-obito-green transition-all duration-300">
                        @error('occupation')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end mt-5">
                        <button type="submit"
                            class="rounded-full py-3 px-5 bg-obito-green hover:drop-shadow-effect transition-all duration-300">
                            <span class="font-semibold text-white">Save Changes</span>
                        </button>
                    </div>
                </form>
            </section>

            <!-- Password Settings Form -->
            <section class="flex flex-col gap-5 p-[30px] rounded-[20px] border border-obito-grey bg-white">
                <h2 class="font-bold text-[22px] leading-[33px]">Password Settings</h2>
                <form method="POST" action="{{ route('dashboard.settings.update-password') }}" class="flex flex-col gap-5">
                    @csrf

                    <div class="flex flex-col gap-2">
                        <label for="current_password" class="font-semibold">Current Password</label>
                        <input type="password" name="current_password" id="current_password" required
                            class="appearance-none outline-none ring-1 ring-obito-grey rounded-[14px] py-[14px] px-5 bg-white
                               placeholder:font-normal placeholder:text-obito-text-secondary focus:ring-obito-green transition-all duration-300">
                        @error('current_password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="password" class="font-semibold">New Password</label>
                        <input type="password" name="password" id="password" required
                            class="appearance-none outline-none ring-1 ring-obito-grey rounded-[14px] py-[14px] px-5 bg-white
                               placeholder:font-normal placeholder:text-obito-text-secondary focus:ring-obito-green transition-all duration-300">
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="password_confirmation" class="font-semibold">Confirm New Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="appearance-none outline-none ring-1 ring-obito-grey rounded-[14px] py-[14px] px-5 bg-white
                               placeholder:font-normal placeholder:text-obito-text-secondary focus:ring-obito-green transition-all duration-300">
                    </div>

                    <div class="flex justify-end mt-5">
                        <button type="submit"
                            class="rounded-full py-3 px-5 bg-obito-green hover:drop-shadow-effect transition-all duration-300">
                            <span class="font-semibold text-white">Update Password</span>
                        </button>
                    </div>
                </form>
            </section>

            <!-- Reset Password Form -->
            <section class="flex flex-col gap-5 p-[30px] rounded-[20px] border border-obito-grey bg-white">
                <h2 class="font-bold text-[22px] leading-[33px]">Reset Password</h2>
                <p class="text-obito-text-secondary">Reset your password to the default password (123123123).</p>
                <form method="POST" action="{{ route('dashboard.settings.reset-password') }}"
                    class="flex flex-col gap-5">
                    @csrf

                    <div class="flex justify-end mt-5">
                        <button type="submit"
                            class="btn-reset">
                            <span class="font-semibold text-black">Reset Password</span>
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </main>
@endsection
@push('after-styles')
    <style>
        .btn-reset {
            background: #e53935;
            /* merah */
            color: #000;
            /* teks tombol hitam */
            border: none;
            padding: 12px 20px;
            border-radius: 9999px;
            /* rounded-full */
            font-weight: 600;
            cursor: pointer;
            transition: box-shadow .3s ease, filter .3s ease;
        }

        .btn-reset:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, .18);
            /* efek "drop-shadow" */
        }

        .btn-reset span {
            color: #000;
            /* teks di dalam span hitam */
        }
    </style>
@endpush
@push('after-scripts')
    <script src="{{ asset('js/dropdown-navbar.js') }}"></script>
@endpush
