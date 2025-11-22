@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Payment</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif
    <form action="{{ route('payments.store') }}" method="POST">
        @csrf
        <div>
            <label>Amount</label>
            <input type="number" name="amount" value="{{ old('amount') }}" required>
            @error('amount') <div>{{ $message }}</div> @enderror
        </div>
        <!-- Add other fields as needed -->
        <button type="submit">Create Payment</button>
    </form>
</div>
@endsection