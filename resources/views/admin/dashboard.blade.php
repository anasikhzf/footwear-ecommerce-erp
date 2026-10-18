@extends('layouts.app', ['title' => 'Admin Dashboard - Malshoes'])

@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    @include('layouts.sidebar_admin')

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
        <!-- Top bar -->
        <div class="card p-3 shadow-sm border-0 mb-4 d-flex flex-row justify-content-between align-items-center" style="border-radius: 12px;">
            <div>
                <span class="text-muted small">Welcome Back,</span>
                <h5 class="fw-bold mb-0 text-capitalize">{{ auth()->user()->name }}</h5>
            </div>
            <div class="text-muted small"><i class="fa-solid fa-calendar-days me-2"></i> {{ date('l, d F Y') }}</div>
        </div>

        <h3 class="fw-bold mb-4">Dashboard Overview</h3>

        @if (session('login'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('login') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Stat Cards Grid -->
        <div class="row g-4 mb-4">
            <!-- Products count -->
            <div class="col-lg-3 col-md-6">
                <div class="card p-3 shadow-sm border-0 h-100 d-flex flex-row justify-content-between align-items-center" style="border-radius: 12px;">
                    <div>
                        <h6 class="text-muted text-uppercase mb-1 small fw-bold">Total Products</h6>
                        <h2 class="fw-bold mb-0">{{ $totalProducts }}</h2>
                        <a href="{{ route('admin.products') }}" class="small text-decoration-none mt-2 d-inline-block" style="color: var(--accent-color);">Manage <i class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>
                    <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-3"><i class="fa-solid fa-shoe-prints fa-2x"></i></div>
                </div>
            </div>
            <!-- Stock count -->
            <div class="col-lg-3 col-md-6">
                <div class="card p-3 shadow-sm border-0 h-100 d-flex flex-row justify-content-between align-items-center" style="border-radius: 12px;">
                    <div>
                        <h6 class="text-muted text-uppercase mb-1 small fw-bold">Total Stock</h6>
                        <h2 class="fw-bold mb-0">{{ $totalStock }}</h2>
                        <a href="{{ route('admin.stock') }}" class="small text-decoration-none mt-2 d-inline-block" style="color: var(--accent-color);">Control <i class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>
                    <div class="p-3 bg-success bg-opacity-10 text-success rounded-3"><i class="fa-solid fa-boxes-stacked fa-2x"></i></div>
                </div>
            </div>
            <!-- Categories count -->
            <div class="col-lg-3 col-md-6">
                <div class="card p-3 shadow-sm border-0 h-100 d-flex flex-row justify-content-between align-items-center" style="border-radius: 12px;">
                    <div>
                        <h6 class="text-muted text-uppercase mb-1 small fw-bold">Categories</h6>
                        <h2 class="fw-bold mb-0">{{ $totalCategories }}</h2>
                        <a href="{{ route('admin.categories') }}" class="small text-decoration-none mt-2 d-inline-block" style="color: var(--accent-color);">Manage <i class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>
                    <div class="p-3 bg-danger bg-opacity-10 text-danger rounded-3"><i class="fa-solid fa-tags fa-2x"></i></div>
                </div>
            </div>
            <!-- Users count -->
            <div class="col-lg-3 col-md-6">
                <div class="card p-3 shadow-sm border-0 h-100 d-flex flex-row justify-content-between align-items-center" style="border-radius: 12px;">
                    <div>
                        <h6 class="text-muted text-uppercase mb-1 small fw-bold">Users List</h6>
                        <h2 class="fw-bold mb-0">{{ $totalUsers }}</h2>
                        <a href="{{ route('admin.users') }}" class="small text-decoration-none mt-2 d-inline-block" style="color: var(--accent-color);">Manage <i class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>
                    <div class="p-3 bg-warning bg-opacity-10 text-warning rounded-3"><i class="fa-solid fa-users fa-2x"></i></div>
                </div>
            </div>
        </div>

        <!-- Financial Summary Grid -->
        <div class="row g-4">
            <!-- Total Revenue -->
            <div class="col-lg-4 col-md-6">
                <div class="card p-3 shadow-sm border-0 h-100 d-flex flex-row justify-content-between align-items-center" style="border-radius: 12px;">
                    <div>
                        <h6 class="text-muted text-uppercase mb-1 small fw-bold">Gross Income</h6>
                        <h3 class="fw-bold text-success mb-0">Rp. {{ number_format($revenue) }}</h3>
                        <a href="{{ route('admin.finance_report') }}" class="small text-decoration-none mt-2 d-inline-block" style="color: var(--accent-color);">Statement <i class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>
                    <div class="p-3 bg-success bg-opacity-10 text-success rounded-3"><i class="fa-solid fa-circle-arrow-up fa-2x"></i></div>
                </div>
            </div>
            <!-- Expenditures -->
            <div class="col-lg-4 col-md-6">
                <div class="card p-3 shadow-sm border-0 h-100 d-flex flex-row justify-content-between align-items-center" style="border-radius: 12px;">
                    <div>
                        <h6 class="text-muted text-uppercase mb-1 small fw-bold">Expenditure</h6>
                        <h3 class="fw-bold text-danger mb-0">Rp. {{ number_format($cost) }}</h3>
                        <a href="{{ route('admin.finance_report') }}" class="small text-decoration-none mt-2 d-inline-block" style="color: var(--accent-color);">Statement <i class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>
                    <div class="p-3 bg-danger bg-opacity-10 text-danger rounded-3"><i class="fa-solid fa-circle-arrow-down fa-2x"></i></div>
                </div>
            </div>
            <!-- Unpaid Supplier Bills -->
            <div class="col-lg-4 col-md-6">
                <div class="card p-3 shadow-sm border-0 h-100 d-flex flex-row justify-content-between align-items-center" style="border-radius: 12px;">
                    <div>
                        <h6 class="text-muted text-uppercase mb-1 small fw-bold">Unpaid Supplier Bills</h6>
                        <h3 class="fw-bold text-warning mb-0">Rp. {{ number_format($unpaidBills) }}</h3>
                        <a href="{{ route('admin.invoices') }}" class="small text-decoration-none mt-2 d-inline-block" style="color: var(--accent-color);">Pay Invoices <i class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>
                    <div class="p-3 bg-warning bg-opacity-10 text-warning rounded-3"><i class="fa-solid fa-file-invoice fa-2x"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
