@extends('layouts.app')

@section('content')
    <form action="{{ route('addCar') }}" method="post">
        @csrf
        <input type="text" name="name" placeholder="name">
        <input type="text" name="license_plate_number" placeholder="license">
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="isRented" id="" value="checkedValue" checked>
                Is rented
            </label>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input id="image" class="form-control-file" type="file" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
