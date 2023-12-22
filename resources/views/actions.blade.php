@extends('layouts.app')
@section('content')
    @if (!$clients->isEmpty())
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>Client name</th>
                    <th>Phone</th>
                    <th>Number of rents</th>
                    <th>Renting now?</th>
                    <th>Created at</th>
                    <th></th>
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
        <p>No cleints yet!</p>
    @endif
    <a href="{{ route('showCars') }}">Car Management</a>
    {{-- <a href="{{route('addClient')}}"></a> --}}
@endsection
