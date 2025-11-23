@extends('layouts.app')

@section('title', 'New Payment')

@section('content')
    <div class="container">
        <h2>Add New Payment</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('payments.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="date" class="form-label">Payment Date</label>
                <input type="date" id="date" name="date" class="form-control"
                    value="{{ old('date', \Carbon\Carbon::today()->toDateString()) }}">
                @error('date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="collection_id" class="form-label">Collection</label>
                <select name="collection_id" class="form-control">
                    <option value=""> -- Please select Collection -- </option>
                    @foreach ($collections as $collection)
                        <option value="{{ $collection->id }}" {{ old('collection') == $collection->id ? 'selected' : '' }}>
                            {{ $collection->picker->name }} - {{ $collection->farm->name }} - {{ $collection->date }}
                        </option>
                    @endforeach
                </select>
                @error('collection_id')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="method_id" class="form-label">Payment method</label>
                <select name="method_id" class="form-control">
                    <option value=""> -- Please select Payment Method -- </option>
                    @foreach ($payment_methods as $payment_method)
                        <option value="{{ $payment_method->id }}"
                            {{ old('method_id') == $payment_method->id ? 'selected' : '' }}>
                            {{ $payment_method->name }}
                        </option>
                    @endforeach
                </select>
                @error('method_id')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            {{-- 
            <div class="mb-3">
                <label class="form-label">Amount</label>
                <input type="amount" name="amount" value="{{ old('amount') }}" class="form-control" required>
                @error('amount')
                    <div>{{ $message }}</div>
                @enderror
            </div>
 --}}
            <!-- Add other fields as needed -->
            <button type="submit" class="btn btn-primary">Create Payment</button>
        </form>
    </div>
@endsection
