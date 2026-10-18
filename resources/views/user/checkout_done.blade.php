@extends('layouts.app', ['title' => 'Order Successful - Malshoes'])

@section('content')
@include('layouts.navbar_user')

<div class="container my-5 text-center" style="max-width: 650px;">
    <div class="card p-5 shadow-sm border-0" style="border-radius: 15px;">
        <i class="fa-solid fa-circle-check fa-4x text-success mb-4"></i>
        <h2 class="fw-bold mb-2 text-success">Order Successful!</h2>
        <p class="text-muted mb-4">Thank you for your order. Your receipt details are provided below.</p>
        
        <div class="text-start border p-3 mb-4 rounded-3" style="background-color: var(--bg-primary);">
            <h6 class="fw-bold text-uppercase border-bottom pb-2 mb-3">Order #{{ $order->order_id }} Summary</h6>
            
            <div class="mb-3">
                <span class="text-muted d-block small">Recipient Name:</span>
                <span class="fw-medium">{{ $order->billingDetail->name ?? '' }}</span>
            </div>
            
            <div class="mb-3">
                <span class="text-muted d-block small">Shipping Address:</span>
                <span class="fw-medium">{{ $order->billingDetail->address ?? '' }}</span>
            </div>
            
            <div class="mb-3">
                <span class="text-muted d-block small">Phone Number:</span>
                <span class="fw-medium">{{ $order->billingDetail->phone_number ?? '' }}</span>
            </div>

            <div class="border-top pt-3 mt-3">
                <span class="text-muted mb-2 d-block small">Items Ordered:</span>
                @foreach ($items as $item)
                    <div class="d-flex justify-content-between mb-2">
                        <span class="small">{{ $item->product->product_name ?? 'Product' }} (Size: {{ $item->size->size_value ?? '' }}) x {{ $item->quantity }}</span>
                        <span class="fw-bold text-danger small">Rp. {{ number_format($item->product_price * $item->quantity) }}</span>
                    </div>
                @endforeach
            </div>

            <div class="border-top pt-3 mt-3 d-flex justify-content-between">
                <span class="fw-bold">Total Payment (Paid):</span>
                <span class="fw-bold text-danger">Rp. {{ number_format($order->order_total) }}</span>
            </div>
        </div>

        <div class="d-grid gap-2">
            <a href="{{ route('user.dashboard') }}" class="btn btn-dark py-2" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                Back to Home Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
