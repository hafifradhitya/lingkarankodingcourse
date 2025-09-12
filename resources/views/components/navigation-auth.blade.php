<style>
    .logo-img {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
    }

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
        width: 320px;
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
        font-size: 24px;
        font-weight: bold;
        color: #666;
    }

    .close-menu:hover {
        background-color: #f0f0f0;
    }

    /* Mobile Search Section */
    .mobile-search-section {
        padding: 20px;
        border-bottom: 1px solid #EAECEE;
    }

    .mobile-search-form {
        position: relative;
    }

    .mobile-search-input {
        width: 100%;
        padding: 12px 16px;
        padding-right: 50px;
        border: 1px solid #EAECEE;
        border-radius: 25px;
        outline: none;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    .mobile-search-input:focus {
        border-color: #2F6A62;
    }

    .mobile-search-btn {
        position: absolute;
        right: 5px;
        top: 50%;
        transform: translateY(-50%);
        width: 40px;
        height: 40px;
        background: none;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Mobile Profile Section */
    .mobile-profile-section {
        padding: 20px;
        border-bottom: 1px solid #EAECEE;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .mobile-profile-image {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        background-color: #EAECEE;
    }

    .mobile-profile-info h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
        color: #0A0723;
    }

    .mobile-profile-info p {
        margin: 2px 0 0 0;
        font-size: 14px;
        color: #666;
    }

    /* Mobile Navigation Icons */
    .mobile-nav-icons {
        padding: 20px;
        border-bottom: 1px solid #EAECEE;
    }

    .mobile-nav-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }

    .mobile-nav-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        color: #666;
        padding: 15px 10px;
        border-radius: 8px;
        transition: all 0.3s;
        font-size: 12px;
    }

    .mobile-nav-item:hover {
        background-color: #E0EAE8;
        color: #2F6A62;
    }

    .mobile-nav-item img {
        width: 24px;
        height: 24px;
        margin-bottom: 8px;
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

    .mobile-menu-links a.active {
        background-color: #E0EAE8;
        color: #2F6A62;
        font-weight: 600;
    }

    .mobile-menu-links a:hover {
        background-color: #E0EAE8;
        color: #2F6A62;
    }

    .mobile-menu-links form {
        margin: 0;
    }

    .mobile-menu-links form a {
        display: block;
        width: 100%;
        text-align: left;
        background: none;
        border: none;
        cursor: pointer;
        font-family: inherit;
        font-size: 16px;
    }

    /* Prevent body scroll when menu is open */
    body.menu-open {
        overflow: hidden;
    }

    /* Utility Classes */
    .obito-grey {
        color: #EAECEE;
    }

    .obito-green {
        color: #2F6A62;
    }

    .obito-text-secondary {
        color: #666;
    }

    /* Desktop styles - keep original exactly as is */
    @media (min-width: 769px) {
        /* Original desktop styles remain unchanged */
    }

    /* Responsive Breakpoints */
    @media (max-width: 1280px) {
        #nav-auth>div {
            max-width: 100%;
            padding: 20px 50px;
        }
    }

    @media (max-width: 1024px) {
        #nav-auth>div {
            padding: 15px 30px;
        }

        .desktop-search-form input {
            width: 300px !important;
        }

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

        /* Hide desktop elements */
        .desktop-search-form {
            display: none !important;
        }

        .desktop-actions {
            display: none !important;
        }

        /* Adjust navbar padding for mobile */
        #nav-auth>div {
            padding: 15px 20px !important;
            justify-content: space-between;
        }

        /* Hide the gap container on mobile */
        .desktop-left-section {
            gap: 0 !important;
        }

        /* Logo adjustment for mobile */
        .logo-img {
            width: 40px;
            height: 40px;
        }
    }

    @media (max-width: 480px) {
        #nav-auth>div {
            padding: 12px 15px !important;
        }

        .logo-img {
            width: 36px;
            height: 36px;
        }

        .mobile-menu {
            width: 300px;
        }

        .mobile-menu-header,
        .mobile-search-section,
        .mobile-profile-section,
        .mobile-nav-icons,
        .mobile-menu-links {
            padding-left: 15px;
            padding-right: 15px;
        }
    }
</style>
<nav id="nav-auth" class="flex w-full bg-white border-b border-obito-grey">
    <div class="flex w-[1280px] px-[75px] py-5 items-center justify-between mx-auto">
        <div class="flex items-center gap-[30px] desktop-left-section">
            <a href="index.html" class="flex shrink-0">
                <img src="{{ asset('assets/images/logos/logo-lingkarankoding.jpeg') }}" class="logo-img" alt="logo">
            </a>
            <form method="GET" action="{{ route('dashboard.search.courses') }}" class="relative desktop-search-form">
                <label class="group">
                    <input type="text" name="search" id=""
                        class="appearance-none outline-none ring-1 ring-obito-grey rounded-full w-[400px]  py-[14px] px-5 bg-white font-bold placeholder:font-normal placeholder:text-obito-text-secondary group-focus-within:ring-obito-green transition-all duration-300 pr-[50px]"
                        placeholder="Search course by name">
                    <button type="submit"
                        class="absolute right-0 top-0 h-[52px] w-[52px] flex shrink-0 items-center justify-center">
                        <img src="{{ asset('assets/images/icons/search-normal-green-fill.svg') }}"
                            class="flex shrink-0 w-10 h-10" alt="">
                    </button>
                </label>
            </form>
        </div>
        <div class="flex items-center gap-5 justify-end desktop-actions">
            <a href="#" class="flex shrink-0">
                <img src="{{ asset('assets/images/icons/device-message.svg') }}" class="flex shrink-0" alt="icon">
            </a>
            <a href="catalog-v2.html" class="flex shrink-0">
                <img src="{{ asset('assets/images/icons/category.svg') }}" class="flex shrink-0" alt="icon">
            </a>
            <a href="#" class="flex shrink-0">
                <img src="{{ asset('assets/images/icons/notification.svg') }}" class="flex shrink-0" alt="icon">
            </a>
            <div class="h-[50px] flex shrink-0 bg-obito-grey w-px"></div>
            <div id="profile-dropdown" class="relative flex items-center gap-[14px]">
                <div class="flex shrink-0 w-[50px] h-[50px] rounded-full overflow-hidden bg-obito-grey">
                    <img src="{{ Storage::url($user->photo) }}" class="w-full h-full object-cover" alt="photo">
                </div>
                <div>
                    <p class="font-semibold text-lg">{{ $user->name }}</p>
                    <p class="text-sm text-obito-text-secondary">{{ $user->occupation }}</p>
                </div>
                <button id="dropdown-opener" class="flex shrink-0 w-6 h-6">
                    <img src="{{ asset('assets/images/icons/arrow-circle-down.svg') }}" class="w-6 h-6" alt="icon">
                </button>
                <div id="dropdown"
                    class="absolute top-full right-0 mt-[7px] w-[170px] h-fit bg-white rounded-xl border border-obito-grey py-4 px-5 shadow-[0px_10px_30px_0px_#B8B8B840] z-10 hidden">
                    <ul class="flex flex-col gap-[14px]">
                        <li class="hover:text-obito-green transition-all duration-300">
                            <a href="{{ route('dashboard') }}">My Courses</a>
                        </li>
                        <li class="hover:text-obito-green transition-all duration-300">
                            <a href="#">Certificates</a>
                        </li>
                        <li class="hover:text-obito-green transition-all duration-300">
                            <a href="{{ route('dashboard.subscriptions') }}">Subscriptions</a>
                        </li>
                        <li class="hover:text-obito-green transition-all duration-300">
                            <a href="{{ route('dashboard.settings') }}">Settings</a>
                        </li>
                        <li class="hover:text-obito-green transition-all duration-300">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Hamburger Menu Button (Mobile Only) -->
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
        <a href="index.html" class="flex shrink-0">
            <img src="{{ asset('assets/images/logos/logo-64.svg') }}" class="logo-img" alt="logo">
        </a>
    </div>

    <!-- Mobile Search -->
    <div class="mobile-search-section">
        <form method="GET" action="{{ route('dashboard.search.courses') }}" class="mobile-search-form">
            <input type="text" name="search" class="mobile-search-input" placeholder="Search course by name"
                value="{{ request('search') }}">
            <button type="submit" class="mobile-search-btn">
                <img src="{{ asset('assets/images/icons/search-normal-green-fill.svg') }}"
                    style="width: 20px; height: 20px;" alt="search">
            </button>
        </form>
    </div>

    <!-- Mobile Profile -->
    <div class="mobile-profile-section">
        <img src="{{ Storage::url($user->photo) }}" class="mobile-profile-image" alt="photo">
        <div class="mobile-profile-info">
            <h3>{{ $user->name }}</h3>
            <p>{{ $user->occupation }}</p>
        </div>
    </div>

    <!-- Mobile Navigation Icons -->
    <div class="mobile-nav-icons">
        <div class="mobile-nav-grid">
            <a href="#" class="mobile-nav-item">
                <img src="{{ asset('assets/images/icons/device-message.svg') }}" alt="Messages">
                <span>Messages</span>
            </a>
            <a href="catalog-v2.html" class="mobile-nav-item">
                <img src="{{ asset('assets/images/icons/category.svg') }}" alt="Catalog">
                <span>Catalog</span>
            </a>
            <a href="#" class="mobile-nav-item">
                <img src="{{ asset('assets/images/icons/notification.svg') }}" alt="Notifications">
                <span>Notifications</span>
            </a>
        </div>
    </div>

    <!-- Mobile Menu Links -->
    <div class="mobile-menu-links">
        <ul>
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    My Courses
                </a>
            </li>
            <li>
                <a href="#" class="{{ request()->is('certificates*') ? 'active' : '' }}">
                    Certificates
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.subscriptions') }}"
                    class="{{ request()->routeIs('dashboard.subscriptions') ? 'active' : '' }}">
                    Subscriptions
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.settings') }}" class="{{ request()->routeIs('dashboard.settings') ? 'active' : '' }}">
                    Settings
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                        Logout
                    </a>
                </form>
            </li>
        </ul>
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

    // Close mobile menu when clicking on a link
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
