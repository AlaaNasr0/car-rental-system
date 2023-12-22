<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarRenting;
use App\Models\Sponser;

class CarController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'licence_plate_number' => 'required|string|unique:cars,licence_plate_number',
            'model' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $imagePath = $request->file('image')->store('car_images', 'public');
        $car = new Car([
            'name' => $validatedData['name'],
            'isRented' => 0,
            'licence_plate_number' => $validatedData['licence_plate_number'],
            'model' => $validatedData['model'],
            'image' => $imagePath,
        ]);
        $car->save();
        return redirect()->route('showCars');
    }
    public function view(Request $request)
    {
        $cars = Car::all();
        $carData = [];
        foreach ($cars as $car) {
            $carRenting = CarRenting::where('car_id', $car->id)->latest()->first();
            $sponsor = Sponser::where('car_id', $car->id)->first();
            $carData[] = [
                'name' => $car->name,
                'model' => $car->model,
                'isRented' => $car->isRented,
                'sponsor' => $sponsor ? $sponsor->id : 'No sponsor',
                'starting_date' => $car->isRented ? $carRenting->start_date : null,
                'ending_date' => $car->isRented ? $carRenting->end_date : null,
            ];
        }
        if ($request->expectsJson()) {
            return response()->json(['carData' => $carData]);
        }
    }
}
