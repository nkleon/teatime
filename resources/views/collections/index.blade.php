@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Collections</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Farm</th>
                <th>Picker</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($collections as $collection)
            <tr>
                <td>{{ $collection->id }}</td>
                <td>{{ $collection->date }}</td>
                <td>{{ $collection->farm_id }}</td>
                <td>{{ $collection->picker_id }}</td>
                <td>{{ $collection->quantity }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $collections->links() }}
</div>
@endsection
