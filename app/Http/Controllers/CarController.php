<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarRenting;
use App\Models\Sponser;
use App\Models\Client;

class CarController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create(Request $request)
    {


        $imagePath = $request->file('image')->store('car_images', 'public');
        $car = new Car([
            'name' => $request->name,
            'isRented' => 0,
            'licence_plate_number' => $request->licence_plate_number,
            'model' => $request->model,
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
            $carData[] = [
                'id' => $car->id,
                'name' => $car->name,
                'model' => $car->model,
                'isRented' => $car->isRented,
                'client_name' => $car->isRented ? Client::find($carRenting->client_id)->name : null,
                'starting_date' => $car->isRented ? $carRenting->start_date : null,
                'ending_date' => $car->isRented ? $carRenting->end_date : null,
            ];
        }
        return response()->json(['carData' => $carData]);
    }
}
