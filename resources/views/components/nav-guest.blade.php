<style>
    /* Hamburger Menu Styles */
    .hamburger {
        display: none;
        flex-direction: column;
        cursor: pointer;
        z-index: 50;
    }

    .hamburger span {
        width: 25px;
        height: 3px;
        background-color: #2F6A62;
        margin: 3px 0;
        transition: 0.3s;
        border-radius: 3px;
    }

    /* Hamburger Animation */
    .hamburger.active span:nth-child(1) {
        transform: rotate(-45deg) translate(-5px, 6px);
    }

    .hamburger.active span:nth-child(2) {
        opacity: 0;
    }

    .hamburger.active span:nth-child(3) {
        transform: rotate(45deg) translate(-5px, -6px);
    }

    /* Mobile Menu Overlay */
    .mobile-menu-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 40;
    }

    .mobile-menu-overlay.active {
        display: block;
    }

    /* Mobile Menu Container */
    .mobile-menu {
        position: fixed;
        top: 0;
        right: -100%;
        width: 280px;
        height: 100%;
        background-color: white;
        transition: right 0.3s ease;
        z-index: 45;
        overflow-y: auto;
        box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
    }

    .mobile-menu.active {
        right: 0;
    }

    /* Mobile Menu Header */
    .mobile-menu-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid #EAECEE;
    }

    .close-menu {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border-radius: 50%;
        transition: background-color 0.3s;
    }

    .close-menu:hover {
        background-color: #f0f0f0;
    }

    .close-menu svg {
        width: 20px;
        height: 20px;
    }

    /* Mobile Menu Links */
    .mobile-menu-links {
        padding: 20px;
    }

    .mobile-menu-links ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .mobile-menu-links li {
        margin-bottom: 5px;
    }

    .mobile-menu-links a {
        display: block;
        padding: 12px 15px;
        color: #0A0723;
        text-decoration: none;
        border-radius: 8px;
        transition: background-color 0.3s, color 0.3s;
        font-size: 16px;
    }

    .mobile-menu-links a:hover {
        background-color: #E0EAE8;
        color: #2F6A62;
    }

    .mobile-menu-links a.active {
        background-color: #E0EAE8;
        color: #2F6A62;
        font-weight: 600;
    }

    /* Mobile Menu Actions */
    .mobile-menu-actions {
        padding: 0 20px 20px;
        border-top: 1px solid #EAECEE;
        margin-top: 20px;
        padding-top: 20px;
    }

    .mobile-menu-actions .btn {
        display: block;
        width: 100%;
        padding: 12px 20px;
        text-align: center;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        margin-bottom: 10px;
        border: none;
        cursor: pointer;
    }

    .mobile-menu-actions .btn-outline {
        border: 1px solid #EAECEE;
        color: #0A0723;
        background-color: white;
    }

    .mobile-menu-actions .btn-outline:hover {
        border-color: #2F6A62;
        color: #2F6A62;
    }

    .mobile-menu-actions .btn-primary {
        background-color: #2F6A62;
        color: white;
    }

    .mobile-menu-actions .btn-primary:hover {
        background-color: #245450;
        box-shadow: 0px 12px 30px 0px rgba(47, 106, 98, 0.5);
    }

    /* Desktop Navigation (default) */
    .desktop-nav {
        display: flex;
    }

    /* Navigation Container Responsive */
    #nav-guest>div {
        max-width: 1280px;
        width: 100%;
        padding: 20px 75px;
    }

    /* Logo Image */
    .logo-img {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
    }

    /* Utility Classes */
    .obito-grey {
        color: #EAECEE;
    }

    .obito-green {
        color: #2F6A62;
    }

    .drop-shadow-effect {
        box-shadow: 0px 12px 30px 0px rgba(47, 106, 98, 0.5);
    }

    /* Prevent body scroll when menu is open */
    body.menu-open {
        overflow: hidden;
    }

    /* Responsive Breakpoints */
    @media (max-width: 1280px) {

        /* Container adjustment for smaller screens */
        #nav-guest>div {
            max-width: 100%;
            padding: 20px 50px;
        }
    }

    @media (max-width: 1024px) {

        /* Adjust padding for tablet */
        #nav-guest>div {
            padding: 15px 30px;
        }

        /* Adjust gap between menu items */
        #nav-guest ul {
            gap: 20px;
        }

        /* Reduce gap in navigation items */
        .desktop-nav .flex.items-center.gap-5 {
            gap: 15px;
        }

        /* Smaller logo on tablet */
        .logo-img {
            width: 44px;
            height: 44px;
        }
    }

    @media (max-width: 768px) {

        /* Show hamburger menu */
        .hamburger {
            display: flex;
        }

        /* Hide desktop navigation items */
        .desktop-nav {
            display: none;
        }

        /* Adjust navbar padding for mobile */
        #nav-guest>div {
            padding: 15px 20px;
            justify-content: space-between;
        }

        /* Logo adjustment for mobile */
        .logo-img {
            width: 40px;
            height: 40px;
        }

        /* Ensure logo container is properly sized */
        #nav-guest .flex.items-center.gap-\[50px\] {
            gap: 0;
        }
    }

    @media (max-width: 480px) {

        /* Extra small screens */
        #nav-guest>div {
            padding: 12px 15px;
        }

        /* Even smaller logo for very small screens */
        .logo-img {
            width: 36px;
            height: 36px;
        }

        /* Adjust mobile menu width for small screens */
        .mobile-menu {
            width: 260px;
        }

        /* Adjust mobile menu padding */
        .mobile-menu-header,
        .mobile-menu-links,
        .mobile-menu-actions {
            padding-left: 15px;
            padding-right: 15px;
        }
    }
</style>

<nav id="nav-guest" class="flex w-full bg-white border-b border-obito-grey">
    <div class="flex w-[1280px] px-[75px] py-5 items-center justify-between mx-auto">
        <!-- Logo -->
        <div class="flex items-center gap-[50px]">
            <a href="{{ route('front.index') }}" class="flex shrink-0">
                <img src="{{ asset('assets/images/logos/logo-lingkarankoding.jpeg') }}" class="logo-img" alt="logo">
            </a>

            <!-- Desktop Navigation -->
            <div class="desktop-nav items-center gap-[50px]">
                <ul class="flex items-center gap-10">
                    <li
                        class="{{ request()->routeIs('front.index') ? 'font-semibold' : '' }} hover:font-semibold transition-all duration-300">
                        <a href="{{ route('front.index') }}">Home</a>
                    </li>
                    <li
                        class="{{ request()->routeIs('front.pricing') ? 'font-semibold' : '' }} hover:font-semibold transition-all duration-300">
                        <a href="{{ route('front.pricing') }}">Pricing</a>
                    </li>
                    <li class="{{ request()->routeIs('front.features') ? 'font-semibold' : '' }} hover:font-semibold transition-all duration-300">
                        <a href="{{ route('front.features') }}"">Features</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Desktop Actions -->
        <div class="desktop-nav items-center gap-5 justify-end">
            <a href="#" class="flex shrink-0">
                <img src="{{ asset('assets/images/icons/device-message.svg') }}" class="flex shrink-0" alt="icon">
            </a>
            <div class="h-[50px] flex shrink-0 bg-obito-grey w-px"></div>
            <div class="flex items-center gap-3">
                <a href="{{ route('register') }}"
                    class="rounded-full border border-obito-grey py-3 px-5 gap-[10px] bg-white hover:border-obito-green transition-all duration-300">
                    <span class="font-semibold">Sign Up</span>
                </a>
                <a href="{{ route('login') }}"
                    class="rounded-full py-3 px-5 gap-[10px] bg-obito-green hover:drop-shadow-effect transition-all duration-300">
                    <span class="font-semibold text-white">My Account</span>
                </a>
            </div>
        </div>

        <!-- Hamburger Menu Button -->
        <div class="hamburger" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</nav>

<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay" onclick="closeMenu()"></div>

<!-- Mobile Menu -->
<div class="mobile-menu">
    <div class="mobile-menu-header">
        <a href="{{ route('front.index') }}" class="flex shrink-0">
            <img src="{{ asset('assets/images/logos/logo-64.png') }}"
                style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;" alt="logo">
        </a>
        <div class="close-menu" onclick="closeMenu()"></div>
    </div>

    <div class="mobile-menu-links">
        <ul>
            <li>
                <a href="{{ route('front.index') }}" class="{{ request()->routeIs('front.index') ? 'active' : '' }}">
                    Home
                </a>
            </li>
            <li>
                <a href="{{ route('front.pricing') }}"
                    class="{{ request()->routeIs('front.pricing') ? 'active' : '' }}">
                    Pricing
                </a>
            </li>
            <li>
                <a href="{{ route('front.features') }}" class="{{ request()->is('features*') ? 'active' : '' }}">
                    Features
                </a>
            </li>
        </ul>
    </div>

    <div class="mobile-menu-actions">
        <a href="#" class="btn btn-outline" style="margin-bottom: 15px;">
            <span style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2v10z" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Contact Support
            </span>
        </a>
        <a href="{{ route('register') }}" class="btn btn-outline">Sign Up</a>
        <a href="{{ route('login') }}" class="btn btn-primary">My Account</a>
    </div>
</div>


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

    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
        const mobileMenu = document.querySelector('.mobile-menu');
        const hamburger = document.querySelector('.hamburger');

        if (mobileMenu.classList.contains('active') &&
            !mobileMenu.contains(e.target) &&
            !hamburger.contains(e.target)) {
            closeMenu();
        }
    });
</script>
