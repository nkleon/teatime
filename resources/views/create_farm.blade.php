@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Farm</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif
    <form action="{{ route('farms.store') }}" method="POST">
        @csrf
        <div>
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <div>{{ $message }}</div> @enderror
        </div>
        <!-- Add other fields as needed -->
        <button type="submit">Create Farm</button>
    </form>
</div>
@endsection