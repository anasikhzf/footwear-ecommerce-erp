@extends('layouts.app', ['title' => 'Request Stock - Admin Panel'])

@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    @include('layouts.sidebar_admin')

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.stock') }}" class="text-decoration-none" style="color: var(--accent-color);">Stock Control</a></li>
                <li class="breadcrumb-item active" aria-current="page">Request Stock</li>
            </ol>
        </nav>

        <h3 class="fw-bold mb-4">Request Stock: {{ $product->product_name }}</h3>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card p-4 shadow-sm border-0" style="border-radius: 12px; max-width: 650px;">
            <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                <img src="{{ asset('assets/produk/' . $product->product_image) }}" alt="Shoe" width="90" height="90" class="rounded object-fit-cover shadow-sm me-3 border">
                <div>
                    <h5 class="fw-bold mb-1">{{ $product->product_name }}</h5>
                    <span class="badge bg-secondary">{{ $product->category->category_name ?? 'N/A' }}</span>
                    <span class="text-danger fw-bold ms-2">Rp. {{ number_format($product->product_price) }}</span>
                </div>
            </div>

            <form action="{{ route('admin.request_stock.store', $product->product_id) }}" method="POST">
                @csrf
                <p class="text-muted small mb-4"><i class="fa-solid fa-circle-info me-2 text-primary"></i> Specify the number of pairs to request from the supplier for each size below. Entering 0 will skip requesting that size.</p>

                <div class="row g-3">
                    @foreach ($sizes as $s)
                        <div class="col-md-6 d-flex align-items-center justify-content-between border-bottom pb-2">
                            <label for="ukuran_{{ $s->size_id }}" class="form-label fw-bold mb-0">
                                Size {{ $s->size_value }} <span class="text-muted small font-normal">(Current: {{ $s->stock }})</span>
                            </label>
                            <input type="number" class="form-control text-center" id="ukuran_{{ $s->size_id }}" name="size_value[{{ $s->size_id }}]" value="0" min="0" max="100" style="width: 100px;">
                        </div>
                    @endforeach
                </div>

                <div class="mt-4 pt-3 d-flex justify-content-between">
                    <a href="{{ route('admin.stock') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-dark px-4" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                        <i class="fa-solid fa-paper-plane me-2"></i> Submit Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
