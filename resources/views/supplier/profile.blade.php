@extends('layouts.app', ['title' => 'Supplier Profile - Malshoes'])

@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    @include('layouts.sidebar_supplier')

    <!-- Main Content -->
    <div class="main-content flex-grow-1" style="max-width: 900px;">
        <h3 class="fw-bold mb-4">My Supplier Profile</h3>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card p-4 shadow-sm border-0" style="border-radius: 12px; max-width: 600px;">
            <form action="{{ route('supplier.profile.update') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Partner (Full) Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label fw-semibold">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold">New Password <span class="text-muted small fw-normal">(Leave blank to keep current)</span></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password">
                </div>
                
                <button type="submit" class="btn btn-dark px-4 py-2" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                    <i class="fa-solid fa-save me-2"></i> Save Changes
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
