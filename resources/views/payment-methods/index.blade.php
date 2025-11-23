@extends('layouts.app')

@section('title', 'Payment Methods')

@section('content')
<div class="container">
    <h1>Payment Methods</h1>

    <div class="card-tools mb-4">
          <a href="{{ route('payment-methods.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add New Payment Method
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
        @foreach ($paymentMethods as $paymentMethod)
            <tr>
                <td>{{ $paymentMethod->id }}</td>
                <td>{{ $paymentMethod->name }}</td>
                <td>{{ $paymentMethod->description }}</td>
                <td>
                  <div class="btn-group" role="group">
                    {{--@can('show', $paymentMethod)--}}
                      <a href="{{ route('payment-methods.show', $paymentMethod->id) }}" 
                       class="btn btn-info btn-sm" 
                       title="View">
                      <i class="bi bi-eye"></i>
                    </a>
                    {{--@endcan
                    @can('update', $role)--}}
                      <a href="{{ route('payment-methods.edit', $paymentMethod->id) }}" 
                       class="btn btn-warning btn-sm" 
                       title="Edit">
                      <i class="bi bi-pencil"></i>
                    </a>
                    {{--@endcan
                    @can('delete', $role)--}}
                    <form action="{{ route('payment-methods.destroy', $paymentMethod->id) }}" 
                            method="POST" 
                            class="d-inline"
                            onsubmit="return confirm('Are you sure you want to delete this payment method?');">
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
    {{ $paymentMethods->links('pagination::bootstrap-5') }}
</div>
@endsection
