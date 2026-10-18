<nav class="navbar navbar-expand-lg custom-navbar py-3">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('user.dashboard') }}">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="35" height="35" class="me-2">
            <span>.MALSHOES</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarUser" aria-controls="navbarUser" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarUser">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.collection') ? 'active' : '' }}" href="{{ route('user.collection') }}">Collection</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#aboutUsModal">About Us</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.profile') ? 'active' : '' }}" href="{{ route('user.profile') }}">Profile</a>
                    </li>
                @endauth
            </ul>
            
            <div class="d-flex align-items-center gap-3">
                <!-- Search Form -->
                <form action="{{ route('user.collection') }}" method="GET" class="d-flex">
                    <div class="input-group">
                        <input class="form-control form-control-sm" type="search" name="search_query" placeholder="Search shoes..." aria-label="Search" value="{{ request('search_query') }}">
                        <button class="btn btn-dark btn-sm" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>

                <!-- Theme Switcher Toggle Button (Icon Only) -->
                <button class="btn btn-outline-secondary btn-sm" id="themeToggleBtn" type="button" title="Toggle Light/Dark Theme">
                    <i class="fa-solid fa-moon"></i>
                </button>

                <!-- Shopping Cart Link -->
                <a href="{{ route('user.cart') }}" class="btn btn-outline-dark btn-sm position-relative" style="border-color: var(--border-color); color: var(--text-color);">
                    <i class="fa-solid fa-cart-shopping"></i>
                    @auth
                        @php
                            $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count();
                        @endphp
                        @if ($cartCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $cartCount }}
                            </span>
                        @endif
                    @else
                        <span id="guestCartBadge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none">0</span>
                    @endauth
                </a>

                <!-- Auth Check -->
                @auth
                    <div class="dropdown">
                        <button class="btn btn-dark btn-sm dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                            <i class="fa-solid fa-user me-1"></i> {{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                            @if(auth()->user()->role === 'admin')
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-chart-line me-2"></i> Admin Panel</a></li>
                            @elseif(auth()->user()->role === 'supplier')
                                <li><a class="dropdown-item" href="{{ route('supplier.dashboard') }}"><i class="fa-solid fa-truck me-2"></i> Supplier Panel</a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="fa-solid fa-user-circle me-2"></i> Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-dark btn-sm" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                        <i class="fa-solid fa-right-to-bracket me-1"></i> Sign In
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- About Us Modal -->
<div class="modal fade" id="aboutUsModal" tabindex="-1" aria-labelledby="aboutUsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="aboutUsModalLabel">About .MALSHOES</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Welcome to <strong>.MALSHOES</strong>, your number one source for premium-quality footwear. We are dedicated to giving you the absolute best style, design, durability, and comfort.</p>
                <p>Founded in 2024, our store offers premium Sports, Casual, and Formal shoes tailored for your daily comfort. We strive to provide excellent customer service and premium products.</p>
                <p class="mb-0"><strong>Contact Us:</strong> info@malshoes.com | Sidoarjo, Jawa Timur</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
