<div class="sidebar d-flex flex-column justify-content-between">
    <div>
        <div class="d-flex align-items-center mb-4 mt-2 justify-content-between">
            <div class="d-flex align-items-center">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="35" height="35" class="me-2">
                <h5 class="mb-0 text-white font-weight-bold">.MALSHOES</h5>
            </div>
            <button class="btn btn-outline-light btn-sm rounded-circle px-2" id="themeToggleBtn" type="button" title="Toggle Theme">
                <i class="fa-solid fa-moon"></i>
            </button>
        </div>

        <hr class="text-secondary">

        <nav class="nav flex-column">
            <a href="{{ route('supplier.dashboard') }}" class="sidebar-item nav-link {{ request()->routeIs('supplier.dashboard') ? 'active-sidebar-item' : '' }}">
                <i class="fa-solid fa-chart-line me-3"></i> Dashboard
            </a>
            
            <div class="text-secondary small fw-bold mt-3 mb-2 px-2 uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">OPERATIONS</div>
            <a href="{{ route('supplier.stock_requests') }}" class="sidebar-item nav-link {{ request()->routeIs('supplier.stock_requests') ? 'active-sidebar-item' : '' }}">
                <i class="fa-solid fa-truck-ramp-box me-3"></i> Pending Requests
            </a>
            <a href="{{ route('supplier.history') }}" class="sidebar-item nav-link {{ request()->routeIs('supplier.history') ? 'active-sidebar-item' : '' }}">
                <i class="fa-solid fa-history me-3"></i> Request History
            </a>
        </nav>
    </div>

    <div>
        <hr class="text-secondary">
        <a href="{{ route('supplier.profile') }}" class="sidebar-item nav-link mb-2 {{ request()->routeIs('supplier.profile') ? 'active-sidebar-item' : '' }}">
            <i class="fa-solid fa-user-gear me-3"></i> My Profile
        </a>
        <a href="{{ route('logout') }}" class="sidebar-item nav-link text-danger">
            <i class="fa-solid fa-right-from-bracket me-3"></i> Sign Out
        </a>
    </div>
</div>
