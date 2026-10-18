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
            <a href="{{ route('admin.dashboard') }}" class="sidebar-item nav-link {{ request()->routeIs('admin.dashboard') ? 'active-sidebar-item' : '' }}">
                <i class="fa-solid fa-chart-line me-3"></i> Dashboard
            </a>
            
            <div class="text-secondary small fw-bold mt-3 mb-2 px-2 uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">DATA MANAGEMENT</div>
            <a href="{{ route('admin.categories') }}" class="sidebar-item nav-link {{ request()->routeIs('admin.categories*') ? 'active-sidebar-item' : '' }}">
                <i class="fa-solid fa-tags me-3"></i> Categories
            </a>
            <a href="{{ route('admin.products') }}" class="sidebar-item nav-link {{ request()->routeIs('admin.products*') ? 'active-sidebar-item' : '' }}">
                <i class="fa-solid fa-shoe-prints me-3"></i> Products
            </a>
            <a href="{{ route('admin.stock') }}" class="sidebar-item nav-link {{ request()->routeIs('admin.stock*') || request()->routeIs('admin.request_stock*') ? 'active-sidebar-item' : '' }}">
                <i class="fa-solid fa-boxes-stacked me-3"></i> Stock Control
            </a>
            <a href="{{ route('admin.users') }}" class="sidebar-item nav-link {{ request()->routeIs('admin.users*') ? 'active-sidebar-item' : '' }}">
                <i class="fa-solid fa-users me-3"></i> Users List
            </a>

            <div class="text-secondary small fw-bold mt-3 mb-2 px-2 uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">REPORTS & BILLS</div>
            <a href="{{ route('admin.sales_report') }}" class="sidebar-item nav-link {{ request()->routeIs('admin.sales_report') ? 'active-sidebar-item' : '' }}">
                <i class="fa-solid fa-file-invoice-dollar me-3"></i> Sales Report
            </a>
            <a href="{{ route('admin.finance_report') }}" class="sidebar-item nav-link {{ request()->routeIs('admin.finance_report') ? 'active-sidebar-item' : '' }}">
                <i class="fa-solid fa-chart-pie me-3"></i> Financial Report
            </a>
            <a href="{{ route('admin.invoices') }}" class="sidebar-item nav-link {{ request()->routeIs('admin.invoices*') ? 'active-sidebar-item' : '' }}">
                <i class="fa-solid fa-receipt me-3"></i> Supplier Bills
            </a>
        </nav>
    </div>

    <div>
        <hr class="text-secondary">
        <a href="{{ route('admin.profile') }}" class="sidebar-item nav-link mb-2 {{ request()->routeIs('admin.profile') ? 'active-sidebar-item' : '' }}">
            <i class="fa-solid fa-user-gear me-3"></i> My Profile
        </a>
        <a href="{{ route('logout') }}" class="sidebar-item nav-link text-danger">
            <i class="fa-solid fa-right-from-bracket me-3"></i> Sign Out
        </a>
    </div>
</div>
