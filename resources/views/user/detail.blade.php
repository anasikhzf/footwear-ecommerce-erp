@extends('layouts.app', ['title' => $product->product_name . ' - Malshoes'])

@section('content')
@include('layouts.navbar_user')

<div class="container my-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="text-decoration-none" style="color: var(--accent-color);">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.collection') }}" class="text-decoration-none" style="color: var(--accent-color);">Collection</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->product_name }}</li>
        </ol>
    </nav>

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-5">
        <!-- Image Column -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
                <img src="{{ asset('assets/produk/' . $product->product_image) }}" class="img-fluid w-100 object-fit-cover" alt="{{ $product->product_name }}" style="max-height: 500px;">
            </div>
        </div>

        <!-- Details Column -->
        <div class="col-md-6">
            <span class="badge bg-secondary mb-2 text-uppercase px-3 py-2">{{ $product->category->category_name ?? 'Shoes' }}</span>
            <h1 class="fw-bold mb-3">{{ $product->product_name }}</h1>
            <h2 class="text-danger fw-bold mb-4">Rp. {{ number_format($product->product_price) }}</h2>
            
            <div class="mb-4">
                <h5 class="fw-bold">Description</h5>
                <div class="text-muted leading-relaxed">
                    {!! $product->product_description !!}
                </div>
            </div>

            <form action="{{ route('user.add_to_cart') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                
                <!-- Size Selector -->
                <div class="mb-4">
                    <h5 class="fw-bold mb-3">Select Size</h5>
                    <div class="row g-2">
                        @php $anyStock = false; @endphp
                        @foreach ($sizes as $s)
                            @php
                                $disabled = ($s->stock <= 0) ? 'disabled' : '';
                                if ($s->stock > 0) $anyStock = true;
                            @endphp
                            <div class="col-3 col-sm-2">
                                <input type="radio" class="btn-check" name="size_id" id="size_{{ $s->size_id }}" value="{{ $s->size_id }}" required {{ $disabled }}>
                                <label class="btn btn-outline-dark w-100 py-2 d-flex flex-column align-items-center" for="size_{{ $s->size_id }}" style="border-radius: 8px;">
                                    <span class="fw-bold">{{ $s->size_value }}</span>
                                    <span class="small {{ ($s->stock <= 0) ? 'text-danger' : 'text-success' }}" style="font-size: 0.65rem;">
                                        {{ ($s->stock <= 0) ? 'OOS' : $s->stock . ' Left' }}
                                    </span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Quantity and Add button -->
                <div class="row g-3 align-items-end mb-4">
                    <div class="col-sm-4">
                        <label for="quantity" class="form-label fw-bold">Quantity</label>
                        <input type="number" class="form-control py-2" id="quantity" name="quantity" value="1" min="1" max="10" required {{ !$anyStock ? 'disabled' : '' }}>
                    </div>
                    <div class="col-sm-8">
                        @if ($anyStock)
                            <button type="submit" class="btn btn-dark w-100 py-2 fw-semibold" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                                <i class="fa-solid fa-cart-plus me-2"></i> Add To Cart
                            </button>
                        @else
                            <button type="button" class="btn btn-secondary w-100 py-2 fw-semibold" disabled>
                                <i class="fa-solid fa-triangle-exclamation me-2"></i> Out Of Stock
                            </button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
