@extends('front.layouts.app')
@section('title', 'Checkout - Lingkaran Koding Online Learning Platform')
@section('content')
    <x-navigation-auth />
    <div id="path" class="flex w-full bg-white border-b border-obito-grey py-[14px]">
        <div class="flex items-center w-full max-w-[1280px] px-[75px] mx-auto gap-5 breadcrumb-container">
            <a href="{{ route('front.index') }}" class="last-of-type:font-semibold">Home</a>
            <div class="h-10 w-px bg-obito-grey breadcrumb-divider"></div>
            <a href="{{ route('front.pricing') }}" class="last-of-type:font-semibold">Pricing Packages</a>
            <span class="text-obito-grey">/</span>
            <a href="#" class="last-of-type:font-semibold">Checkout Subscription</a>
        </div>
    </div>
    <main class="flex flex-1 justify-center py-5 items-center main-container">
        <div
            class="flex w-[1000px] !h-fit rounded-[20px] border border-obito-grey gap-[40px] bg-white items-center p-5 checkout-wrapper">
            <form id="checkout-details" method="POST" class="w-full flex flex-col gap-5 checkout-form">
                @csrf
                <input type="text" hidden name="payment_method" value="Midtrans">
                <h1 class="font-bold text-[22px] leading-[33px] checkout-title">Checkout Pro</h1>
                <section id="give-access-to" class="flex flex-col gap-2">
                    <h2 class="font-semibold">Give Access to</h2>
                    <div
                        class="flex items-center justify-between rounded-[20px] border border-obito-grey p-[14px] profile-card">
                        <div class="profile flex items-center gap-[14px]">
                            <div
                                class="flex justify-center items-center overflow-hidden size-[50px] rounded-full profile-image">
                                <img src="{{ Storage::url($user->photo) }}" alt="image" class="size-full object-cover" />
                            </div>
                            <div class="desc flex flex-col gap-[3px]">
                                <h3 class="font-semibold profile-name">{{ $user->name }}</h3>
                                <p class="text-sm leading-[21px] text-obito-text-secondary profile-occupation">
                                    {{ $user->occupation }}</p>
                            </div>
                        </div>
                        <a href="#" class="change-account-link">
                            <p class="text-sm leading-[21px] hover:underline text-obito-green">Change Account</p>
                        </a>
                    </div>
                </section>
                <section id="transaction-details" class="flex flex-col gap-[12px]">
                    <h2 class="font-semibold">Transaction Details</h2>
                    <div class="flex flex-col gap-[12px] transaction-items">
                        <div class="flex items-center justify-between transaction-item">
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('assets/images/icons/note.svg') }}" alt="icon"
                                    class="size-5 shrink-0" />
                                <p>Subscription Package</p>
                            </div>
                            <strong class="font-semibold transaction-value">Rp
                                {{ number_format($pricing->price, 0, '', '.') }}</strong>
                        </div>
                        <div class="flex items-center justify-between transaction-item">
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('assets/images/icons/note.svg') }}" alt="icon"
                                    class="size-5 shrink-0" />
                                <p>Access Duration</p>
                            </div>
                            <strong class="font-semibold transaction-value">{{ $pricing->duration }} Months</strong>
                        </div>
                        <div class="flex items-center justify-between transaction-item">
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('assets/images/icons/note.svg') }}" alt="icon"
                                    class="size-5 shrink-0" />
                                <p>Started At</p>
                            </div>
                            <strong class="font-semibold transaction-value">{{ $started_at->format('d M, Y') }}</strong>
                        </div>
                        <div class="flex items-center justify-between transaction-item">
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('assets/images/icons/note.svg') }}" alt="icon"
                                    class="size-5 shrink-0" />
                                <p>Ended At</p>
                            </div>
                            <strong class="font-semibold transaction-value">{{ $ended_at->format('d M, Y') }}</strong>
                        </div>
                        <div class="flex items-center justify-between transaction-item">
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('assets/images/icons/note.svg') }}" alt="icon"
                                    class="size-5 shrink-0" />
                                <p>PPN 12%</p>
                            </div>
                            <strong class="font-semibold transaction-value">Rp
                                {{ number_format($total_tax_amount, 0, '', '.') }}</strong>
                        </div>
                        <div class="flex items-center justify-between transaction-item grand-total">
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('assets/images/icons/note.svg') }}" alt="icon"
                                    class="size-5 shrink-0" />
                                <p class="whitespace-nowrap">Grand Total</p>
                            </div>
                            <strong class="font-bold text-[22px] leading-[33px] text-obito-green grand-total-amount">Rp
                                {{ number_format($grand_total_amount, 0, '', '.') }}</strong>
                        </div>
                    </div>
                </section>
                <div class="grid grid-cols-2 gap-[14px] action-buttons">
                    <a href="pricing.html" class="cancel-button">
                        <div
                            class="flex border border-obito-grey rounded-full items-center justify-center py-[10px] hover:border-obito-green transition-all duration-300">
                            <p class="font-semibold">Cancel</p>
                        </div>
                    </a>
                    <button id="pay-button" type="button"
                        class="flex text-white bg-obito-green rounded-full items-center justify-center py-[10px] hover:drop-shadow-effect transition-all duration-300 pay-button">
                        <p class="font-semibold">Pay Now</p>
                    </button>
                </div>
                <hr class="border-obito-grey" />
                <p class="text-sm leading-[21px] text-center hover:underline text-obito-text-secondary terms-link">Pahami
                    Terms &
                    Conditions Platform Kami</p>
            </form>
            <div id="benefits" class="bg-[#F8FAF9] rounded-[20px] overflow-hidden shrink-0 w-[420px] benefits-section">
                <section id="thumbnails"
                    class="relative flex justify-center h-[250px] items-center overflow-hidden rounded-t-[14px] w-full benefits-thumbnail">
                    <img src="{{ asset('assets/images/thumbnails/checkout.png') }}" alt="image"
                        class="size-full object-cover" />
                </section>
                <section id="points" class="pt-[61px] relative flex flex-col gap-4 px-5 pb-5 benefits-points">
                    <div
                        class="card absolute -top-[47px] left-[30px] right-[30px] flex items-center p-4 gap-[14px] border border-obito-grey rounded-[20px] bg-white shadow-[0px_10px_30px_0px_#B8B8B840] package-card">
                        <img src="{{ asset('assets/images/icons/cup-green-fill.svg') }}" alt="icon"
                            class="size-[50px] shrink-0" />
                        <div>
                            <h3 class="font-bold text-[18px] leading-[27px] package-name">{{ $pricing->name }}</h3>
                            <p class="text-obito-text-secondary package-duration">{{ $pricing->duration }} months duration
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 benefit-item">
                        <img src="{{ asset('assets/images/icons/tick-circle-green-fill.svg') }}" alt="icon"
                            class="size-6 shrink-0" />
                        <p class="font-semibold">Access 1500+ Online Courses</p>
                    </div>
                    <div class="flex items-center gap-2 benefit-item">
                        <img src="{{ asset('assets/images/icons/tick-circle-green-fill.svg') }}" alt="icon"
                            class="size-6 shrink-0" />
                        <p class="font-semibold">Get Premium Certifications</p>
                    </div>
                    <div class="flex items-center gap-2 benefit-item">
                        <img src="{{ asset('assets/images/icons/tick-circle-green-fill.svg') }}" alt="icon"
                            class="size-6 shrink-0" />
                        <p class="font-semibold">High Quality Work Portfolio</p>
                    </div>
                    <div class="flex items-center gap-2 benefit-item">
                        <img src="{{ asset('assets/images/icons/tick-circle-green-fill.svg') }}" alt="icon"
                            class="size-6 shrink-0" />
                        <p class="font-semibold">Career Consultation 2025</p>
                    </div>
                    <div class="flex items-center gap-2 benefit-item">
                        <img src="{{ asset('assets/images/icons/tick-circle-green-fill.svg') }}" alt="icon"
                            class="size-6 shrink-0" />
                        <p class="font-semibold">Support learning 24/7</p>
                    </div>
                </section>
            </div>
        </div>
    </main>
@endsection
@push('after-styles')
    <style>
        /* Desktop styles - keep original exactly as is */
        .obito-grey {
            color: #EAECEE;
        }

        .obito-green {
            color: #2F6A62;
        }

        .obito-text-secondary {
            color: #666;
        }

        .drop-shadow-effect {
            box-shadow: 0px 12px 30px 0px rgba(47, 106, 98, 0.5);
        }

        /* Responsive breakpoints */
        @media (max-width: 1280px) {

            /* Container adjustments for smaller desktop screens */
            .breadcrumb-container {
                max-width: 100%;
                padding-left: 50px;
                padding-right: 50px;
            }

            .main-container {
                padding-left: 50px;
                padding-right: 50px;
            }

            .checkout-wrapper {
                max-width: 100%;
                margin: 0 20px;
            }
        }

        @media (max-width: 1024px) {

            /* Tablet adjustments */
            .breadcrumb-container {
                padding-left: 30px;
                padding-right: 30px;
            }

            .main-container {
                padding-left: 30px;
                padding-right: 30px;
            }

            .checkout-wrapper {
                width: 100%;
                max-width: 900px;
                gap: 30px;
                margin: 0 15px;
            }

            .benefits-section {
                width: 380px;
            }

            .benefits-thumbnail {
                height: 200px;
            }

            .checkout-title {
                font-size: 20px;
                line-height: 30px;
            }

            .grand-total-amount {
                font-size: 20px;
                line-height: 30px;
            }
        }

        @media (max-width: 768px) {

            /* Mobile layout */
            .breadcrumb-container {
                padding-left: 20px;
                padding-right: 20px;
                flex-wrap: wrap;
                gap: 8px;
            }

            .breadcrumb-divider {
                display: none;
            }

            .main-container {
                padding: 15px 20px;
                align-items: flex-start;
            }

            .checkout-wrapper {
                flex-direction: column;
                width: 100%;
                gap: 20px;
                padding: 20px;
                margin: 0;
                align-items: stretch;
            }

            .checkout-form {
                order: 1;
            }

            .benefits-section {
                order: 2;
                width: 100%;
                margin-top: 20px;
            }

            .benefits-thumbnail {
                height: 180px;
            }

            .package-card {
                left: 20px;
                right: 20px;
                gap: 10px;
                padding: 12px;
            }

            .package-card img {
                width: 40px;
                height: 40px;
            }

            .package-name {
                font-size: 16px;
                line-height: 24px;
            }

            .benefits-points {
                padding-top: 50px;
                padding-left: 20px;
                padding-right: 20px;
            }

            .profile-card {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
                padding: 16px;
            }

            .profile {
                width: 100%;
            }

            .change-account-link {
                align-self: flex-end;
            }

            .transaction-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
                padding: 12px 0;
                border-bottom: 1px solid #f0f0f0;
            }

            .transaction-item:last-child {
                border-bottom: none;
            }

            .grand-total {
                background-color: #f8faf9;
                border-radius: 12px;
                padding: 16px !important;
                margin-top: 8px;
            }

            .grand-total-amount {
                font-size: 18px;
                line-height: 27px;
            }

            .action-buttons {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .cancel-button {
                order: 2;
            }

            .pay-button {
                order: 1;
                padding: 14px;
            }

            .checkout-title {
                font-size: 18px;
                line-height: 27px;
                text-align: center;
            }

            .terms-link {
                padding: 0 10px;
            }
        }

        @media (max-width: 480px) {

            /* Extra small mobile adjustments */
            .breadcrumb-container {
                padding-left: 15px;
                padding-right: 15px;
            }

            .main-container {
                padding: 10px 15px;
            }

            .checkout-wrapper {
                padding: 15px;
                border-radius: 15px;
            }

            .profile-image {
                width: 40px;
                height: 40px;
            }

            .profile-name {
                font-size: 14px;
            }

            .profile-occupation {
                font-size: 12px;
            }

            .transaction-item {
                padding: 10px 0;
            }

            .transaction-item div:first-child img {
                width: 16px;
                height: 16px;
            }

            .transaction-item p {
                font-size: 14px;
            }

            .transaction-value {
                font-size: 14px;
            }

            .grand-total-amount {
                font-size: 16px;
                line-height: 24px;
            }

            .benefits-points {
                padding-left: 15px;
                padding-right: 15px;
                gap: 12px;
            }

            .package-card {
                left: 15px;
                right: 15px;
                padding: 10px;
            }

            .benefit-item {
                gap: 8px;
            }

            .benefit-item img {
                width: 20px;
                height: 20px;
            }

            .benefit-item p {
                font-size: 14px;
            }

            .action-buttons button,
            .action-buttons a div {
                padding: 12px;
            }
        }

        @media (max-width: 360px) {

            /* Very small screens */
            .checkout-wrapper {
                border-radius: 12px;
                padding: 12px;
            }

            .benefits-thumbnail {
                height: 150px;
            }

            .package-card {
                flex-direction: column;
                text-align: center;
                gap: 8px;
                padding: 12px 8px;
            }

            .package-card img {
                width: 32px;
                height: 32px;
            }

            .package-name {
                font-size: 14px;
                line-height: 21px;
            }

            .package-duration {
                font-size: 12px;
            }

            .benefit-item p {
                font-size: 13px;
                line-height: 18px;
            }

            .grand-total {
                padding: 12px !important;
            }

            .grand-total-amount {
                font-size: 15px;
                line-height: 22px;
            }
        }

        /* Utility adjustments for very long text on mobile */
        @media (max-width: 768px) {
            .transaction-item p {
                word-break: break-word;
                hyphens: auto;
            }

            .profile-name {
                word-break: break-word;
            }

            .profile-occupation {
                word-break: break-word;
            }

            .terms-link {
                word-break: break-word;
                text-align: center;
                line-height: 1.5;
            }
        }

        /* Print media query for better printing experience */
        @media print {
            .main-container {
                padding: 0;
            }

            .checkout-wrapper {
                box-shadow: none;
                border: 1px solid #ccc;
            }

            .benefits-section {
                page-break-inside: avoid;
            }

            .action-buttons {
                display: none;
            }

            .terms-link {
                display: none;
            }
        }
    </style>
@endpush
@push('after-scripts')
    <script src="{{ asset('js/dropdown-navbar.js') }}"></script>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
        const payButton = document.getElementById('pay-button');
        if (!payButton) return;

        // Hindari double-binding saat view re-render
        if (payButton.dataset.bound === 'true') return;
        payButton.dataset.bound = 'true';

        let isPaying = false;

        payButton.addEventListener('click', async (e) => {
                e.preventDefault();

                if (isPaying) return; // guard: cegah multiple call
                isPaying = true;
                payButton.disabled = true;

                try {
                    const resp = await fetch('{{ route('front.payment_store_midtrans') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify({})
                    });

                    const data = await resp.json();
                    if (!data.snap_token) throw new Error(data.error || 'Snap token kosong');

                    snap.pay(data.snap_token, {
                        onSuccess: function() {
                            window.location.href = "{{ route('front.checkout.success') }}";
                        },
                        onPending: function() {
                            alert('Payment pending!');
                            window.location.href = "{{ route('front.index') }}";
                        },
                        onError: function(result) {
                            console.log('onError:', result);
                            alert('Payment failed: ' + (result?.status_message ||
                                'Unknown error'));
                            if (typeof isPaying !== 'undefined') isPaying = false;
                            if (typeof payButton !== 'undefined') payButton.disabled =
                            false;
                            const reason = encodeURIComponent(result?.status_message ||
                                result?.status || 'onError');
                            window.location.href =
                                "{{ route('front.checkout.failed') }}?reason=" + reason;
                        },
                        onClose: function() {
                            alert('Payment popup closed');
                            if (typeof isPaying !== 'undefined') isPaying = false;
                            if (typeof payButton !== 'undefined') payButton.disabled =
                            false;
                            window.location.href =
                                "{{ route('front.checkout.failed') }}?reason=popup%20closed";
                        }
                    });
                } catch (err) {
                    console.error(err);
                    alert('Terjadi kesalahan saat memulai pembayaran.');
                    isPaying = false;
                    payButton.disabled = false;
                }
        }, {
        passive: false
        });
        });
    </script>
@endpush
