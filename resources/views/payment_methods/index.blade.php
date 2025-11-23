@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Payment Methods</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($paymentMethods as $paymentMethod)
            <tr>
                <td>{{ $paymentMethod->id }}</td>
                <td>{{ $paymentMethod->name }}</td>
                <td>{{ $paymentMethod->description }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $paymentMethods->links() }}
</div>
@endsection
