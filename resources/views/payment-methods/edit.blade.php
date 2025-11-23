@extends('layouts.app')

@section('title', 'Edit Payment Method')

@section('content')
    <div class="container">
        <h2>Edit Payment Method</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('payment-methods.update', $paymentMethod->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{ $paymentMethod->name }}" class="form-control" required>
                @error('name')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <input type="description" name="description" value="{{ $paymentMethod->description }}" class="form-control"
                    required>
                @error('description')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <!-- Add other fields as needed -->
            <button type="submit" class="btn btn-primary">Update Payment Method</button>
        </form>
    </div>
@endsection
