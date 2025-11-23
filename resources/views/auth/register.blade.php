@extends('layouts.app')

@section('title', 'Register')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger m-3">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
    </div>
@endif

<div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="card p-4" style="width: 100%; max-width: 450px; border-radius: 10px;">
        <h3 class="text-center mb-4" style="color: var(--primary-bg);">Register</h3>

        <form method="POST" action="{{ route('onboard') }}">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                       id="name" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="phone" class="form-label">Phone number</label>
                <input type="phone" class="form-control @error('phone') is-invalid @enderror"
                       id="phone" name="phone" value="{{ old('phone') }}" required>
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Role -->
            <div class="mb-3">
                <label for="role_id" class="form-label">Role</label>
                <select name="role_id" class="form-control">
                    <option value=""> -- Please select User Role -- </option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? "selected" : ""}} >{{$role->description}}</option>
                    @endforeach
                </select>
                @error('role_id')
                    <div>{{ $message }}</div>
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

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>

            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn" style="background: var(--primary-bg); color: var(--primary-text);">
                    Register
                </button>
            </div>

            <div class="mt-3 text-center">
                <a href="{{ route('login') }}">Already have an account? Login</a>
            </div>
        </form>
    </div>
</div>
@endsection
