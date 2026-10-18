@extends('layouts.app', ['title' => 'Sales Report - Admin Panel'])

@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    @include('layouts.sidebar_admin')

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
        <h3 class="fw-bold mb-4">Sales Report</h3>

        <!-- Sales Report Card -->
        <div class="card shadow-sm border-0" style="border-radius: 12px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="py-3 ps-4" style="width: 65px;">Order</th>
                                <th scope="col" class="py-3">Customer</th>
                                <th scope="col" class="py-3">Date</th>
                                <th scope="col" class="py-3">Shoe</th>
                                <th scope="col" class="py-3 text-center">Size</th>
                                <th scope="col" class="py-3 text-center">Qty</th>
                                <th scope="col" class="py-3 text-end">Price</th>
                                <th scope="col" class="py-3 text-end pe-4">Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $grandTotalRevenue = 0; @endphp
                            @foreach ($sales as $order)
                                @foreach ($order->items as $item)
                                    @php
                                        $itemTotal = $item->product_price * $item->quantity;
                                        $grandTotalRevenue += $itemTotal;
                                    @endphp
                                    <tr class="border-bottom">
                                        <td class="ps-4 fw-bold">#{{ $order->order_id }}</td>
                                        <td class="fw-medium">{{ $order->billingDetail->name ?? 'N/A' }}</td>
                                        <td class="small text-muted">{{ $order->created_at ? $order->created_at->format('d M Y, H:i') : '' }}</td>
                                        <td>{{ $item->product->product_name ?? 'N/A' }}</td>
                                        <td class="text-center">{{ $item->size->size_value ?? 'N/A' }}</td>
                                        <td class="text-center fw-medium">{{ $item->quantity }}</td>
                                        <td class="text-end">Rp. {{ number_format($item->product_price) }}</td>
                                        <td class="text-end fw-bold text-danger pe-4">Rp. {{ number_format($itemTotal) }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                        <tfoot class="bg-light">
                            <tr class="fw-bold">
                                <td colspan="7" class="text-end py-3 ps-4 fs-5">Grand Total Revenue:</td>
                                <td class="text-end text-danger py-3 pe-4 fs-5">Rp. {{ number_format($grandTotalRevenue) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
