@extends('layouts.app')

@section('title', 'Payments')

@section('content')
<div class="container">
    <h1>Payments</h1>

    @can('create', App\Models\Payment::class)
    <div class="card-tools mb-4">
          <a href="{{ route('payments.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add New Payment
          </a>
    </div>
    @endcan

    <div class="table-responsive">
        <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Collection</th>
                <th>Amount</th>
                <th>Method</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($payments as $payment)
            <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->date }}</td>
                <td>{{ $payment->collection->date }} - {{ $payment->collection->picker->name }} - {{ $payment->collection->farm->name }}</td>
                <td>{{ $payment->amount }}</td>
                <td>{{ $payment->payment_method->name }}</td>
                @can('update', $payment)
                <td>
                  <div class="btn-group" role="group">
                    {{--@can('show', $payment)--}}
                      <a href="{{ route('payments.show', $payment->id) }}" 
                       class="btn btn-info btn-sm" 
                       title="View">
                      <i class="bi bi-eye"></i>
                    </a>
                    {{--@endcan
                    @can('update', $payment)--}}
                      <a href="{{ route('payments.edit', $payment->id) }}" 
                       class="btn btn-warning btn-sm" 
                       title="Edit">
                      <i class="bi bi-pencil"></i>
                    </a>
                    {{--@endcan
                    @can('delete', $payment)--}}
                    <form action="{{ route('payments.destroy', $payment->id) }}" 
                            method="POST" 
                            class="d-inline"
                            onsubmit="return confirm('Are you sure you want to delete this payment?');">
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
    {{ $payments->links('pagination::bootstrap-5') }}
</div>
@endsection
