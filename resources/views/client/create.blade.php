@extends('layouts.app')

@section('content')
    <form action="{{ route('PostAddClient') }}" method="post">

        <input type="text" name="name" placeholder="name" required>
        <input type="text" name="phone" placeholder="phone" required>
        <input type="text" name="address" placeholder="address" required>

        <div class="form-group">
            <label for="image">Front ID image</label>
            <input id="image" class="form-control-file" type="file" name="front_id_image" required>
        </div>
        <div class="form-group">
            <label for="image">Back ID image</label>
            <input id="image" class="form-control-file" type="file" name="back_id_image">
        </div>
        <div class="form-group">
            <label>Sponser option:</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="sponser_status" id="sponser_option1" value="exists"
                    checked>
                <label class="form-check-label" for="sponser_option1">
                    Choose a sponser
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="sponser_status" id="sponser_option2" value="new">
                <label class="form-check-label" for="sponser_option2">
                    New Sponser
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="sponser_status" id="sponser_option3" value="without">
                <label class="form-check-label" for="sponser_option3">
                    No need for a sponser
                </label>
            </div>
        </div>
        <div class="form-group" id="selectContainer" style="display: none;">
            <label for="selectSponsor">Select an option:</label>
            <select class="form-control" id="selectSponsor" name="selectedSponsor">
                <option value="option1">Option 1</option>
                <option value="option2">Option 2</option>
                <option value="option3">Option 3</option>
            </select>
        </div>
        <input type="text" name="sponsor_name" id="">
        <input type="text" name="sponsor_number" id="">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
