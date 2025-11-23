@extends('layouts.app')

@section('title', 'Collections')

@section('content')
<div class="container">
    <h1>Collections</h1>

    @can('create', App\Models\Collection::class)
      <div class="card-tools mb-4">
          <a href="{{ route('collections.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add New Collection
          </a>
    </div>
    @endcan

    <div class="table-responsive">
          <table class="table">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>Date</th>
                  <th>Farm</th>
                  <th>Picker</th>
                  <th>Quantity</th>
                  <th>Actions</th>
              </tr>
          </thead>
          <tbody>
          @foreach ($collections as $collection)
              <tr>
                  <td>{{ $collection->id }}</td>
                  <td>{{ $collection->date }}</td>
                  <td>{{ $collection->farm->name }}</td>
                  <td>{{ $collection->picker->name }}</td>
                  <td>{{ $collection->quantity }}</td>
                  @can('update', $collection)
                    <td>
                    <div class="btn-group" role="group">
                      {{--@can('show', $collection)--}}
                        <a href="{{ route('collections.show', $collection->id) }}" 
                        class="btn btn-info btn-sm" 
                        title="View">
                        <i class="bi bi-eye"></i>
                      </a>
                      {{--@endcan
                      @can('update', $collection)--}}
                        <a href="{{ route('collections.edit', $collection->id) }}" 
                        class="btn btn-warning btn-sm" 
                        title="Edit">
                        <i class="bi bi-pencil"></i>
                      </a>
                      {{--@endcan
                      @can('delete', $collection)--}}
                      <form action="{{ route('collections.destroy', $collection->id) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete this collection?');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                            <i class="bi bi-trash"></i>
                          </button>
                        </form>
                      {{--@endcan--}}
                    </div>
                    </td>
                  @endcan                  
              </tr>
          @endforeach
          </tbody>
      </table>
    </div>
    
    {{ $collections->links('pagination::bootstrap-5') }}
</div>
@endsection
