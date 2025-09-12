<style>
    /* Responsive Styles */
    @media (max-width: 768px) {

        /* Bottom Navigation Mobile Styles */
        #bottom-nav {
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            border-top: 1px solid #e5e7eb;
            border-bottom: none;
        }

        #bottom-nav ul {
            padding: 0 20px;
            gap: 8px;
            max-width: 100%;
            overflow-x: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        #bottom-nav ul::-webkit-scrollbar {
            display: none;
        }

        #bottom-nav li {
            flex-shrink: 0;
        }

        #bottom-nav li a {
            padding: 8px 12px;
            border-radius: 20px;
            min-width: fit-content;
            font-size: 12px;
            white-space: nowrap;
        }

        #bottom-nav li a span {
            font-size: 12px;
        }
    }
</style>

<nav id="bottom-nav" class="flex w-full bg-white border-b border-obito-grey py-[14px]">
    <ul class="flex w-full max-w-[1280px] px-[75px] mx-auto gap-3">
        <li class="group">
            <a href="{{ route('front.index') }}"
                class="flex items-center gap-2 rounded-full border border-obito-grey py-2 px-[14px] hover:border-obito-green bg-white transition-all duration-300 group-[.active]:bg-obito-light-green group-[.active]:border-obito-light-green">
                <img src="{{ asset('assets/images/icons/home-trend-up.svg') }}" class="flex shrink-0 w-5" alt="icon">
                <span>Overview</span>
            </a>
        </li>
        <li class="group">
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-2 rounded-full border border-obito-grey py-2 px-[14px] hover:border-obito-green bg-white transition-all duration-300 group-[.active]:bg-obito-light-green group-[.active]:border-obito-light-green">
                <img src="{{ asset('assets/images/icons/note-favorite.svg') }}" class="flex shrink-0 w-5"
                    alt="icon">
                <span>Courses</span>
            </a>
        </li>
        <li class="group">
            <a href="#"
                class="flex items-center gap-2 rounded-full border border-obito-grey py-2 px-[14px] hover:border-obito-green bg-white transition-all duration-300 group-[.active]:bg-obito-light-green group-[.active]:border-obito-light-green">
                <img src="{{ asset('assets/images/icons/message-programming.svg') }}" class="flex shrink-0 w-5"
                    alt="icon">
                <span>Quizzess</span>
            </a>
        </li>
        {{-- <li class="group">
            <a href="#"
                class="flex items-center gap-2 rounded-full border border-obito-grey py-2 px-[14px] hover:border-obito-green bg-white transition-all duration-300 group-[.active]:bg-obito-light-green group-[.active]:border-obito-light-green">
                <img src="{{ asset('assets/images/icons/cup.svg') }}" class="flex shrink-0 w-5" alt="icon">
                <span>Certificates</span>
            </a>
        </li> --}}
        <li class="group">
            <a href="{{ route('dashboard.course.portfolio') }}"
                class="flex items-center gap-2 rounded-full border border-obito-grey py-2 px-[14px] hover:border-obito-green bg-white transition-all duration-300 group-[.active]:bg-obito-light-green group-[.active]:border-obito-light-green">
                <img src="{{ asset('assets/images/icons/ruler&pen.svg') }}" class="flex shrink-0 w-5" alt="icon">
                <span>Portfolios</span>
            </a>
        </li>
    </ul>
</nav>
