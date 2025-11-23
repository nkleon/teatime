@extends('layouts.app')

@section('title', 'New Farm')

@section('content')
    <div class="container">
        <h2>Add New Farm</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('farms.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                @error('name')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Rate</label>
                <input type="rate" name="rate" value="{{ old('rate') }}" class="form-control" required>
                @error('rate')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="owner_id" class="form-label">Owner</label>
                <select name="owner_id" class="form-control">
                    <option value=""> -- Please select farm owner -- </option>
                    @foreach ($owners as $owner)
                        <option value="{{ $owner->id }}" {{ old('owner_id') == $owner->id ? 'selected' : '' }}>
                            {{ $owner->name }}</option>
                    @endforeach
                </select>
                @error('owner_id')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <!-- Add other fields as needed -->
            <button type="submit" class="btn btn-primary">Create Farm</button>
        </form>
    </div>
@endsection
