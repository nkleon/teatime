@extends('layouts.app')

@section('title', 'New Collection')

@section('content')
    <div class="container">
        <h2>Add New Collection</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('collections.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="date" class="form-label">Collection Date</label>
                <input type="date" id="date" name="date" class="form-control"
                    value="{{ old('date', \Carbon\Carbon::today()->toDateString()) }}">
                @error('date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="farm_id" class="form-label">Farm</label>
                <select name="farm_id" class="form-control">
                    <option value=""> -- Please select Farm -- </option>
                    @foreach ($farms as $farm)
                        <option value="{{ $farm->id }}" {{ old('farm_id') == $farm->id ? 'selected' : '' }}>
                            {{ $farm->name }}</option>
                    @endforeach
                </select>
                @error('farm_id')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="picker_id" class="form-label">Picker (User)</label>
                <select name="picker_id" class="form-control">
                    <option value=""> -- Please select Tea picker -- </option>
                    @foreach ($pickers as $picker)
                        <option value="{{ $picker->id }}" {{ old('picker_id') == $picker->id ? 'selected' : '' }}>
                            {{ $picker->name }}</option>
                    @endforeach
                </select>
                @error('picker_id')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Quantity Picked</label>
                <input type="quantity" name="quantity" value="{{ old('quantity') }}" class="form-control" required>
                @error('quantity')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            {{--
            <div class="mb-3">
                <label for="farm_id" class="form-label">Farm</label>
                <select id="farm_id" name="farm_id" class="form-control select2">
                    <option value="">-- Select Farm --</option>
                    @foreach ($farms as $farm)
                        <option value="{{ $farm->id }}" {{ old('farm_id') == $farm->id ? 'selected' : '' }}>
                            {{ $farm->name }}
                        </option>
                    @endforeach
                </select>

                @error('farm_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="picker_id" class="form-label">Picker</label>
                <select id="picker_id" name="picker_id" class="form-control select2">
                    <option value="">-- Select Picker --</option>
                    @foreach ($pickers as $picker)
                        <option value="{{ $picker->id }}" 
                            {{ old('picker_id') == $picker->id ? 'selected' : ''}}>
                            {{ $picker->name }}
                        </option>
                    @endforeach
                </select>

                @error('picker_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
 --}}

            <!--
                <script>
                    $(document).ready(function() {
                        $('.select2').select2({
                            placeholder: 'Select an option',
                            allowClear: true,
                            width: '100%'
                        });
                    });
                </script>
                -->
            <!-- Add other fields as needed -->
            <button type="submit" class="btn btn-primary">Create Collection</button>
        </form>
    </div>

@endsection
