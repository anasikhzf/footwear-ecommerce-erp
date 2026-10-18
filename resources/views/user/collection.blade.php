@extends('layouts.app', ['title' => 'Shoes Collection - Malshoes'])

@section('content')
@include('layouts.navbar_user')

<div class="container my-5">
    <div class="row">
        <!-- Sidebar filters -->
        <div class="col-lg-3 col-md-4 mb-4">
            <div class="card p-3 shadow-sm" style="border-radius: 12px;">
                <h5 class="fw-bold mb-3">Filters</h5>
                
                <!-- Category Filter -->
                <div class="mb-4">
                    <h6 class="fw-bold mb-2">Category</h6>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('user.collection', ['search_query' => $search]) }}" class="list-group-item list-group-item-action border-0 px-0 d-flex justify-content-between align-items-center {{ empty($categoryId) ? 'active fw-bold text-dark' : 'text-muted' }}" style="background: none;">
                            <span>All Categories</span>
                        </a>
                        @foreach ($categories as $cat)
                            <a href="{{ route('user.collection', ['category_id' => $cat->category_id, 'search_query' => $search]) }}" class="list-group-item list-group-item-action border-0 px-0 d-flex justify-content-between align-items-center {{ ($categoryId == $cat->category_id) ? 'active fw-bold text-dark' : 'text-muted' }}" style="background: none;">
                                <span>{{ $cat->category_name }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
                
                <!-- Search Info -->
                @if (!empty($search))
                    <div class="mb-3">
                        <h6 class="fw-bold mb-2">Active Search</h6>
                        <span class="badge bg-secondary p-2 d-flex justify-content-between align-items-center">
                            "{{ $search }}"
                            <a href="{{ route('user.collection', ['category_id' => $categoryId]) }}" class="text-white ms-2"><i class="fa-solid fa-xmark"></i></a>
                        </span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Catalog list -->
        <div class="col-lg-9 col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">Our Collection</h4>
                <span class="text-muted small">{{ $products->count() }} Products found</span>
            </div>

            @if ($products->isEmpty())
                <div class="text-center py-5">
                    <i class="fa-solid fa-shoe-prints fa-3x text-muted mb-3"></i>
                    <h5>No products match your filters.</h5>
                    <p class="text-muted">Try clearing search term or selecting another category.</p>
                    <a href="{{ route('user.collection') }}" class="btn btn-dark mt-2" style="background-color: var(--accent-color); border-color: var(--accent-color);">Clear Filters</a>
                </div>
            @else
                <div class="row g-4">
                    @foreach ($products as $p)
                        <div class="col-lg-4 col-sm-6">
                            <div class="card h-100 shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
                                <img src="{{ asset('assets/produk/' . $p->product_image) }}" class="card-img-top object-fit-cover" alt="{{ $p->product_name }}" style="height: 220px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <span class="text-muted small uppercase">{{ $p->category->category_name ?? 'Shoes' }}</span>
                                        <h5 class="card-title fw-bold mt-1 mb-2">{{ $p->product_name }}</h5>
                                    </div>
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <h6 class="text-danger fw-bold mb-0">Rp. {{ number_format($p->product_price) }}</h6>
                                            <a href="{{ route('user.detail', $p->product_id) }}" class="btn btn-sm btn-dark px-3 rounded-pill" style="background-color: var(--accent-color); border-color: var(--accent-color);">Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
