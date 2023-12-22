@extends('layouts.app')

@section('content')
    <a href="{{ route('addCar') }}">Add a new car</a>
    @if (!$cars->isEmpty())
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>License Plate number</th>
                    <th>Model year</th>
                    <th>Number of rents</th>
                    <th>Status</th>
                    <th>Client</th>
                    <th>Rental starting date</th>
                    <th>Rental ending date</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($clients as $client)
                    <tr>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>add field!</td>
                        <td>{{ $client->hasRented }}</td>
                        <td>{{ $client->created_at }}</td>
                        <td>
                            <a href="#" class="btn btn-primary">More</a>
                        </td>
                    </tr>
                @endforeach



            </tbody>
        </table>
    @else
        <p>No cars yet!</p>
    @endif

    <form action="{{ route('addCar') }}" method="post">
        @csrf
        <input type="text" name="name" id="">
        <input type="submit" value="submit">
    </form>
@endsection
