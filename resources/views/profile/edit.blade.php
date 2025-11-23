@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="card p-4" style="width: 100%; max-width: 450px; border-radius: 10px;">
        <h3 class="text-center mb-4" style="color: var(--primary-bg);">Edit Profile</h3>

        <form method="POST" action="{{ route('profile.update', $user) }}">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                       id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Phone -->
            <div class="mb-3">
                <label for="phone" class="form-label">Phone number</label>
                <input type="phone" class="form-control @error('phone') is-invalid @enderror"
                       id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required>
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">New Password <small>(leave blank to keep current)</small></label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       id="password" name="password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <div class="d-grid">
                <button type="submit" class="btn" style="background: var(--primary-bg); color: var(--primary-text);">
                    Update Profile
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
