@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="container">
        <h2>Edit User</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                @error('name')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                @error('email')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="phone" name="phone" value="{{ $user->phone }}" class="form-control" required>
                @error('phone')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="role_id" class="form-label">Role</label>
                <select name="role_id" required class="form-control">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}"
                            {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <input type="checkbox" id="active" name="active" value="1"
                    {{ old('active', $user->active) == 1 ? 'checked' : '' }} class="form-check-input">
                <label for="active" class="form-check-label">Active</label>
                @error('active')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            {{-- 
            <h3>Change Password (Optional)</h3>
            <div>
                <label for="password">New Password</label>
                <input type="password" name="password">
            </div>
            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation">
                @error('password') <span>{{ $message }}</span> @enderror
            </div>
             --}}
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    @endsection
