@extends('layouts.app')

@section('title', 'Edit Farm')

@section('content')
    <div class="container">
        <h2>Edit Farm</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('farms.update', $farm->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{ $farm->name }}" class="form-control" required>
                @error('name')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Rate</label>
                <input type="rate" name="rate" value="{{ $farm->rate }}" class="form-control" required>
                @error('rate')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="owner_id" class="form-label">Owner</label>
                <select name="owner_id" class="form-control">
                    @foreach ($owners as $owner)
                        <option value="{{ $owner->id }}"
                            {{ old('owner_id', $farm->owner_id) == $owner->id ? 'selected' : '' }}>{{ $owner->name }}
                        </option>
                    @endforeach
                </select>
                @error('owner_id')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check">
                <input type="checkbox" id="active" name="active" value="1"
                    {{ old('active', $farm->active) == 1 ? 'checked' : '' }} class="form-check-input">
                <label for="active" class="form-check-label">Farm is Active</label>
                @error('active')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <!-- Add other fields as needed -->
            <button type="submit" class="btn btn-primary">Update Farm</button>
        </form>
    </div>
@endsection
