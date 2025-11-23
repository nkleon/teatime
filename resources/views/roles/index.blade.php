@extends('layouts.app')

@section('title', 'Roles')

@section('content')
    <div class="container">
        <h1>Roles</h1>

        <div class="card-tools mb-4">
            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Add New Role
            </a>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->description }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    {{-- @can('show', $role) --}}
                                    <a href="{{ route('roles.show', $role->id) }}" class="btn btn-info btn-sm"
                                        title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    {{-- @endcan
                                    @can('update', $role) --}}
                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-sm"
                                        title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    {{-- @endcan
                                    @can('delete', $role) --}}
                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this role?');">
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
        {{ $roles->links('pagination::bootstrap-5') }}
    </div>
@endsection
