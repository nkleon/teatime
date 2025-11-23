@extends('layouts.app')

@section('title', 'New User')

@section('content')
    <div class="container">
        <h2>Add New User</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                @error('name')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                @error('email')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="phone" name="phone" value="{{ old('phone') }}" class="form-control" required>
                @error('phone')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <!--div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div-->
            <div class="mb-3">
                <label for="role_id" class="form-label">Role</label>
                <select name="role_id" class="form-control">
                    <option value=""> -- Please select User Role -- </option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? "selected" : ""}} >{{$role->description}}</option>
                    @endforeach
                </select>
                @error('role_id')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <!-- Add other fields as needed -->
            <button type="submit" class="btn btn-primary">Add User</button>
        </form>
    </div>
@endsection