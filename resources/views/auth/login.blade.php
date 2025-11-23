@extends('layouts.app') <!-- Assuming your template is saved as layouts/app.blade.php -->

@section('title', 'Login')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger m-3">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
    </div>
@endif

<div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="card p-4" style="width: 100%; max-width: 400px; border-radius: 10px;">
        <h3 class="text-center mb-4" style="color: var(--primary-bg);">Login</h3>

        <form method="POST" action="{{ route('authenticate') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       id="password" name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>

            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn" style="background: var(--primary-bg); color: var(--primary-text);">
                    Login
                </button>
            </div>

            <div class="mt-3 text-center">
                <a href="{{ route('register') }}">Don't have an account? Register</a>
            </div>
        </form>
    </div>
</div>
@endsection
