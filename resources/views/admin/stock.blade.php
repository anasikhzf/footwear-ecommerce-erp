@extends('layouts.app', ['title' => 'Stock Control - Admin Panel'])

@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    @include('layouts.sidebar_admin')

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
        <h3 class="fw-bold mb-4">Stock Control</h3>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Stock levels table card -->
        <div class="card shadow-sm border-0" style="border-radius: 12px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="py-3 ps-4" style="width: 60px;">No</th>
                                <th scope="col" class="py-3">Image</th>
                                <th scope="col" class="py-3">Product Name</th>
                                <th scope="col" class="py-3">Sizes Stock Breakdown</th>
                                <th scope="col" class="py-3 text-center" style="width: 150px;">Total Stock</th>
                                <th scope="col" class="py-3 text-end pe-4" style="width: 200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index => $p)
                                @php
                                    $sizes = \App\Models\ProductSize::where('product_id', $p->product_id)
                                        ->join('sizes', 'product_sizes.size_id', '=', 'sizes.size_id')
                                        ->orderBy('sizes.size_value', 'asc')
                                        ->select('product_sizes.stock', 'sizes.size_value')
                                        ->get();
                                    $totalStock = $sizes->sum('stock');
                                @endphp
                                <tr class="border-bottom">
                                    <td class="ps-4 fw-medium">{{ $index + 1 }}</td>
                                    <td>
                                        <img src="{{ asset('assets/produk/' . $p->product_image) }}" alt="{{ $p->product_name }}" width="60" height="60" class="rounded object-fit-cover shadow-sm">
                                    </td>
                                    <td class="fw-semibold">{{ $p->product_name }}</td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach ($sizes as $s)
                                                @php
                                                    $bgClass = ($s->stock <= 0) ? 'bg-danger' : (($s->stock < 5) ? 'bg-warning text-dark' : 'bg-success');
                                                @endphp
                                                <span class="badge {{ $bgClass }}" style="font-size: 0.8rem;">
                                                    Size {{ $s->size_value }}: <strong>{{ $s->stock }}</strong>
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="text-center fw-bold fs-5 {{ ($totalStock == 0) ? 'text-danger' : (($totalStock < 15) ? 'text-warning' : 'text-success') }}">
                                        {{ $totalStock }}
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('admin.request_stock', $p->product_id) }}" class="btn btn-sm btn-dark" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                                            <i class="fa-solid fa-truck-ramp-box me-1"></i> Request Stock
                                        </a>
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
@endsection
