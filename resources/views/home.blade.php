@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        Clients count: {{ $clientsCount }}<br>
                        Cars count: {{ $carsCount }} <br>
                        Expanses: {{ $expanses }} <br>
                        Income: {{ $income }} <br>
                    </div>
                    <a href="{{ route('actions') }}">To actions page</a>
                </div>
            </div>
        </div>
    </div>
@endsection
