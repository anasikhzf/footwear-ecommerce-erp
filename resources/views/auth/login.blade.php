@extends('layouts.app', ['title' => 'Sign In - Malshoes'])

@section('content')
<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow-lg p-4" style="width: 420px; border-radius: 15px;">
        <div class="text-center mb-4">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="70" class="mb-2">
            <h3 class="fw-bold">Welcome Back!</h3>
            <p class="text-muted small">Sign in to access your Malshoes account</p>
        </div>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('login'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('login') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('logout_success'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-info me-2"></i> Logged out successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label fw-medium">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" placeholder="Enter username" required autofocus>
                </div>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label fw-medium">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                </div>
            </div>
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-dark py-2" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                    <i class="fa-solid fa-right-to-bracket me-2"></i> Sign In
                </button>
            </div>
        </form>

        <div class="text-center mt-3">
            <p class="small text-muted mb-0">Don't have an account? <a href="{{ route('register') }}" class="fw-bold text-decoration-none" style="color: var(--accent-color);">Sign Up</a></p>
            <div class="mt-3">
                <a href="{{ route('user.dashboard') }}" class="small text-decoration-none text-muted"><i class="fa-solid fa-arrow-left me-1"></i> Back to Homepage</a>
            </div>
        </div>
    </div>
</div>
@endsection
