@extends('layouts.app', ['title' => 'Supplier Dashboard - Malshoes'])

@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    @include('layouts.sidebar_supplier')

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
        <!-- Top bar -->
        <div class="card p-3 shadow-sm border-0 mb-4 d-flex flex-row justify-content-between align-items-center" style="border-radius: 12px;">
            <div>
                <span class="text-muted small">Welcome Back, Partner</span>
                <h5 class="fw-bold mb-0 text-capitalize">{{ auth()->user()->name }}</h5>
            </div>
            <div class="text-muted small"><i class="fa-solid fa-calendar-days me-2"></i> {{ date('l, d F Y') }}</div>
        </div>

        <h3 class="fw-bold mb-4">Supplier Dashboard Overview</h3>

        @if (session('login'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('login') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Stat Cards Grid -->
        <div class="row g-4 mb-4">
            <!-- Total Revenue -->
            <div class="col-lg-6 col-md-12">
                <div class="card p-3 shadow-sm border-0 h-100 d-flex flex-row justify-content-between align-items-center" style="border-radius: 12px;">
                    <div>
                        <h6 class="text-muted text-uppercase mb-1 small fw-bold">Total Earnings Received</h6>
                        <h3 class="fw-bold text-success mb-0">Rp. {{ number_format($totalPaid) }}</h3>
                        <p class="text-muted small mt-2 mb-0">Earnings received from paid admin stock requests.</p>
                    </div>
                    <div class="p-3 bg-success bg-opacity-10 text-success rounded-3"><i class="fa-solid fa-wallet fa-2x"></i></div>
                </div>
            </div>
            <!-- Total Requests count -->
            <div class="col-lg-6 col-md-12">
                <div class="card p-3 shadow-sm border-0 h-100 d-flex flex-row justify-content-between align-items-center" style="border-radius: 12px;">
                    <div>
                        <h6 class="text-muted text-uppercase mb-1 small fw-bold">Total Stock Demands</h6>
                        <h3 class="fw-bold mb-0">{{ $totalRequests }}</h3>
                        <a href="{{ route('supplier.stock_requests') }}" class="small text-decoration-none mt-2 d-inline-block" style="color: var(--accent-color);">Manage Pending <i class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>
                    <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-3"><i class="fa-solid fa-truck-ramp-box fa-2x"></i></div>
                </div>
            </div>
        </div>

        <!-- Breakdown Grid -->
        <div class="row g-4">
            <div class="col-md-3 col-sm-6">
                <div class="card p-3 shadow-sm border-0 h-100" style="border-radius: 12px;">
                    <h6 class="text-muted text-uppercase mb-1 small fw-bold">Completed Requests</h6>
                    <h4 class="fw-bold text-success mb-0">{{ $completedRequests }}</h4>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card p-3 shadow-sm border-0 h-100" style="border-radius: 12px;">
                    <h6 class="text-muted text-uppercase mb-1 small fw-bold">Pending Requests</h6>
                    <h4 class="fw-bold text-warning mb-0">{{ $pendingRequests }}</h4>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card p-3 shadow-sm border-0 h-100" style="border-radius: 12px;">
                    <h6 class="text-muted text-uppercase mb-1 small fw-bold">Paid Invoices</h6>
                    <h4 class="fw-bold text-success mb-0">{{ $paidCount }}</h4>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card p-3 shadow-sm border-0 h-100" style="border-radius: 12px;">
                    <h6 class="text-muted text-uppercase mb-1 small fw-bold">Unpaid Invoices</h6>
                    <h4 class="fw-bold text-danger mb-0">{{ $unpaidCount }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
