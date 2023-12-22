@extends('layouts.app')

@section('content')
    <h2>Register</h2>

    <form action="{{ url('/api/auth/register') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Register</button>
    </form>
@endsection
