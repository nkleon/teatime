@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Payments</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Collection</th>
                <th>Amount</th>
                <th>Method</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($payments as $payment)
            <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->date }}</td>
                <td>{{ $payment->collection_id }}</td>
                <td>{{ $payment->amount }}</td>
                <td>{{ $payment->method_id }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $payments->links() }}
</div>
@endsection
