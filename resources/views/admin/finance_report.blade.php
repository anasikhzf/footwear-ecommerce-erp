@extends('layouts.app', ['title' => 'Financial Report - Admin Panel'])

@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    @include('layouts.sidebar_admin')

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
        <h3 class="fw-bold mb-4">Financial Profit Report</h3>

        <!-- Summary Profit Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card p-3 shadow-sm border-0 h-100" style="border-radius: 12px;">
                    <h6 class="text-muted text-uppercase mb-2 small fw-bold">Gross Revenue</h6>
                    <h3 class="fw-bold text-success">Rp. {{ number_format($revenue) }}</h3>
                    <p class="text-muted small mb-0">Calculated from completed customer order checkouts.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 shadow-sm border-0 h-100" style="border-radius: 12px;">
                    <h6 class="text-muted text-uppercase mb-2 small fw-bold">Total Supplier Costs</h6>
                    <h3 class="fw-bold text-danger">Rp. {{ number_format($cost) }}</h3>
                    <p class="text-muted small mb-0">Calculated from paid supplier invoices.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 shadow-sm border-0 h-100 {{ ($netProfit >= 0) ? 'bg-success bg-opacity-10' : 'bg-danger bg-opacity-10' }}" style="border-radius: 12px;">
                    <h6 class="text-muted text-uppercase mb-2 small fw-bold">Net Profit</h6>
                    <h3 class="fw-bold {{ ($netProfit >= 0) ? 'text-success' : 'text-danger' }}">
                        Rp. {{ number_format($netProfit) }}
                    </h3>
                    <p class="text-muted small mb-0">Gross Revenue minus Supplier Costs.</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Revenue stream (Customer orders) -->
            <div class="col-lg-6">
                <h5 class="fw-bold mb-3">Revenue Streams (Customer Orders)</h5>
                <div class="card shadow-sm border-0" style="border-radius: 12px;">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 small">
                            <thead class="table-dark">
                                <tr>
                                    <th class="ps-3 py-2">OrderID</th>
                                    <th class="py-2">Date</th>
                                    <th class="py-2 text-end pe-3">Paid Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $o)
                                    <tr class="border-bottom">
                                        <td class="ps-3 py-2 fw-bold">#{{ $o->order_id }}</td>
                                        <td class="py-2 text-muted">{{ $o->created_at ? $o->created_at->format('d M Y') : '' }}</td>
                                        <td class="py-2 text-end text-success fw-bold pe-3">Rp. {{ number_format($o->order_total) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Expense stream (Supplier payments) -->
            <div class="col-lg-6">
                <h5 class="fw-bold mb-3">Expenditures (Supplier Purchases)</h5>
                <div class="card shadow-sm border-0" style="border-radius: 12px;">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 small">
                            <thead class="table-dark">
                                <tr>
                                    <th class="ps-3 py-2">Invoice</th>
                                    <th class="py-2">Status</th>
                                    <th class="py-2 text-end pe-3">Paid Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $p)
                                    <tr class="border-bottom">
                                        <td class="ps-3 py-2 fw-bold">#{{ $p->transaction_id }}</td>
                                        <td class="py-2">
                                            <span class="badge {{ ($p->payment_status === 'paid') ? 'bg-success' : 'bg-warning text-dark' }}">
                                                {{ ucwords($p->payment_status) }}
                                            </span>
                                        </td>
                                        <td class="py-2 text-end text-danger fw-bold pe-3">
                                            @if ($p->payment_status === 'paid')
                                                Rp. {{ number_format($p->total_cost) }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
