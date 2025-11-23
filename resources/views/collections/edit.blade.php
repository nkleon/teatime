@extends('layouts.app')

@section('title', 'Edit Collection')

@section('content')
    <div class="container">
        <h2>Edit Collection</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('collections.update', $collection->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="date" class="form-label">Collection Date</label>
                <input type="date" name="date" value="{{ old('date', $collection->date) }}" class="form-control" required>
                @error('date')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="farm_id" class="form-label">Farm</label>
                <select name="farm_id" class="form-control" required>
                    @foreach ($farms as $farm)
                        <option value="{{ $farm->id }}"
                            {{ old('farm_id', $collection->farm_id) == $farm->id ? 'selected' : '' }}>
                            {{ $farm->name }}
                        </option>
                    @endforeach
                </select>
                @error('farm_id')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="picker_id" class="form-label">Picker (User)</label>
                <select name="picker_id" class="form-control" required>
                    @foreach ($pickers as $picker)
                        <option value="{{ $picker->id }}"
                            {{ old('picker_id', $collection->picker_id) == $picker->id ? 'selected' : '' }}>
                            {{ $picker->name }}
                        </option>
                    @endforeach
                </select>
                @error('picker_id')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="quantity" class="form-label" >Quantity Picked</label>
                <input type="number" step="0.01" name="quantity" value="{{ old('quantity', $collection->quantity) }}"
                    class="form-control" required>
                @error('quantity')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" >Update Collection</button>
        </form>
    @endsection
