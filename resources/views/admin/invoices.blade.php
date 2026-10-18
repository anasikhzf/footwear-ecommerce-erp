@extends('layouts.app', ['title' => 'Supplier Invoices - Admin Panel'])

@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    @include('layouts.sidebar_admin')

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
        <h3 class="fw-bold mb-4">Supplier Invoices (Bills)</h3>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Bills Table Card -->
        <div class="card shadow-sm border-0" style="border-radius: 12px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="py-3 ps-4" style="width: 80px;">No</th>
                                <th scope="col" class="py-3">Invoice ID</th>
                                <th scope="col" class="py-3">Shoe</th>
                                <th scope="col" class="py-3 text-center">Size</th>
                                <th scope="col" class="py-3 text-center">Qty</th>
                                <th scope="col" class="py-3 text-end">Unit Price</th>
                                <th scope="col" class="py-3 text-end">Total Bill</th>
                                <th scope="col" class="py-3 text-center">Status</th>
                                <th scope="col" class="py-3 text-end pe-4" style="width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bills as $index => $b)
                                <tr class="border-bottom">
                                    <td class="ps-4 fw-medium">{{ $index + 1 }}</td>
                                    <td class="fw-bold">#TC-{{ $b->transaction_id }}</td>
                                    <td>{{ $b->product->product_name ?? 'N/A' }}</td>
                                    <td class="text-center">{{ $b->size->size_value ?? 'N/A' }}</td>
                                    <td class="text-center fw-medium">{{ $b->quantity }}</td>
                                    <td class="text-end text-muted small">Rp. {{ number_format($b->unit_price) }}</td>
                                    <td class="text-end fw-bold text-danger">Rp. {{ number_format($b->total_cost) }}</td>
                                    <td class="text-center">
                                        @if ($b->payment_status === 'paid')
                                            <span class="badge bg-success"><i class="fa-solid fa-circle-check me-1"></i> Paid</span>
                                        @else
                                            <span class="badge bg-warning text-dark"><i class="fa-solid fa-clock me-1"></i> Unpaid</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        @if ($b->payment_status !== 'paid')
                                            <button class="btn btn-sm btn-dark pay-btn" 
                                                    data-id="{{ $b->transaction_id }}" 
                                                    data-cost="{{ $b->total_cost }}" 
                                                    data-bs-toggle="modal" data-bs-target="#payBillModal"
                                                    style="background-color: var(--accent-color); border-color: var(--accent-color);">
                                                <i class="fa-solid fa-money-bill-wave me-1"></i> Pay
                                            </button>
                                        @else
                                            <button class="btn btn-sm btn-outline-secondary" disabled>
                                                <i class="fa-solid fa-check-double"></i> Complete
                                            </button>
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

<!-- Pay Bill Modal -->
<div class="modal fade" id="payBillModal" tabindex="-1" aria-labelledby="payBillLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="payBillLabel">Pay Supplier Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.invoices.pay') }}" method="POST">
                @csrf
                <input type="hidden" name="transaction_id" id="pay_transaction_id">
                <div class="modal-body">
                    <p>Please confirm you are paying the exact total billing amount of <strong class="text-danger" id="pay_bill_label"></strong> for this invoice.</p>
                    <div class="mb-3">
                        <label for="amount" class="form-label fw-semibold">Payment Amount (Nominal)</label>
                        <input type="number" class="form-control" id="amount" name="amount" required placeholder="Enter exact bill amount">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark" style="background-color: var(--accent-color); border-color: var(--accent-color);">Submit Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.pay-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const cost = btn.getAttribute('data-cost');
            document.getElementById('pay_transaction_id').value = btn.getAttribute('data-id');
            document.getElementById('pay_bill_label').textContent = 'Rp. ' + parseFloat(cost).toLocaleString();
            document.getElementById('amount').value = cost;
        });
    });
</script>
@endpush
