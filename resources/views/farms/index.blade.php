@extends('layouts.app')

@section('title', 'Farms')

@section('content')
<div class="container">
    <h1>Farms</h1>

    <div class="card-tools">
          <a href="{{ route('farms.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add New Farm
          </a>
    </div>

    <div class="table-responsive">
            <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Owner</th>
                    <th>Rate</th>
                    <th>Active</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($farms as $farm)
                <tr>
                    <td>{{ $farm->id }}</td>
                    <td>{{ $farm->name }}</td>
                    <td>{{ $farm->owner->name }}</td>
                    <td>{{ $farm->rate }}</td>
                    <td>{{ $farm->active ? 'Yes' : 'No' }}</td>
                    <td>
                      <div class="btn-group" role="group">
                        {{--@can('show', $farm)--}}
                          <a href="{{ route('farms.show', $farm->id) }}" 
                          class="btn btn-info btn-sm" 
                          title="View">
                          <i class="bi bi-eye"></i>
                        </a>
                        {{--@endcan
                        @can('update', $farm)--}}
                          <a href="{{ route('farms.edit', $farm->id) }}" 
                          class="btn btn-warning btn-sm" 
                          title="Edit">
                          <i class="bi bi-pencil"></i>
                        </a>
                        {{--@endcan
                        @can('delete', $farm)--}}
                        <form action="{{ route('farms.destroy', $farm->id) }}" 
                                method="POST" 
                                class="d-inline"
                                onsubmit="return confirm('Are you sure you want to delete this farm?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                              <i class="bi bi-trash"></i>
                            </button>
                          </form>
                        {{--@endcan--}}
                      </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $farms->links('pagination::bootstrap-5') }}
</div>
@endsection
