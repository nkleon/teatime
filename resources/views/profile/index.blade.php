@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="card p-4" style="width: 100%; max-width: 450px; border-radius: 10px;">
        <h3 class="text-center mb-4" style="color: var(--primary-bg);">My Profile</h3>

        <div class="mb-3">
            <strong>Full Name:</strong>
            <p>{{ $user->name }}</p>
        </div>

        <div class="mb-3">
            <strong>Email:</strong>
            <p>{{ $user->email }}</p>
        </div>

        <div class="mb-3">
            <strong>Phone:</strong>
            <p>{{ $user->phone }}</p>
        </div>

        <div class="mb-3">
            <strong>Role:</strong>
            <p>{{ $user->role->description ?? 'N/A' }}</p>
        </div>

        <div class="mb-3">
            <strong>Active:</strong>
            <p>{{ $user->active ? 'Yes' : 'No' }}</p>
        </div>

        <div class="mb-3">
            <strong>Created at:</strong>
            <p>{{ $user->created_at }}</p>
        </div>

        <div class="d-grid">
            <a href="{{ route('profile.edit', $user) }}" class="btn" style="background: var(--primary-bg); color: var(--primary-text);">
                Edit Profile
            </a>
        </div>
    </div>
</div>
@endsection
