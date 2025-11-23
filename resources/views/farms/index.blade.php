@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Farms</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Owner</th>
                <th>Rate</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($farms as $farm)
            <tr>
                <td>{{ $farm->id }}</td>
                <td>{{ $farm->name }}</td>
                <td>{{ $farm->owner_id }}</td>
                <td>{{ $farm->rate }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $farms->links() }}
</div>
@endsection
