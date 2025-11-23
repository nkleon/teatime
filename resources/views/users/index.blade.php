@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="container">
        <h1>Users</h1>

        <div class="card-tools">
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Add New User
            </a>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Active</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->active ? 'Yes' : 'No' }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    {{-- @can('show', $user) --}}
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm"
                                        title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    {{-- @endcan
                                    @can('update', $user) --}}
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm"
                                        title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    {{-- @endcan
                                    @can('delete', $user) --}}
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    {{-- @endcan --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $users->links('pagination::bootstrap-5') }}
    </div>
@endsection
