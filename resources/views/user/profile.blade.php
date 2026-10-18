@extends('layouts.app', ['title' => 'My Profile - Malshoes'])

@section('content')
@include('layouts.navbar_user')

<div class="container my-5" style="max-width: 650px;">
    <h2 class="fw-bold mb-4"><i class="fa-solid fa-user-circle me-2" style="color: var(--accent-color);"></i> My Profile</h2>

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

    <div class="card p-4 shadow-sm border-0" style="border-radius: 15px;">
        <form action="{{ route('user.profile.update') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label fw-medium">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label fw-medium">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-medium">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label fw-medium">New Password <span class="text-muted small fw-normal">(Leave blank to keep current)</span></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password">
            </div>
            
            <button type="submit" class="btn btn-dark py-2 px-4 fw-semibold" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                Save Profile Changes <i class="fa-solid fa-save ms-2"></i>
            </button>
        </form>
    </div>
</div>
@endsection
