@extends('layouts.app')

@section('title', 'New Payment Method')

@section('content')
    <div class="container">
        <h2>Add New Payment Method</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('payment-methods.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                @error('name')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <input type="description" name="description" value="{{ old('description') }}" class="form-control" required>
                @error('description')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <!-- Add other fields as needed -->
            <button type="submit" class="btn btn-primary">Create Payment Method</button>
        </form>
    </div>
@endsection
