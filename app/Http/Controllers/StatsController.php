<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarRenting;
use App\Models\Client;
use App\Models\Sponser;

class StatsController extends Controller
{
    public function getStats()
    {
        $cars = Car::all();
        $data = [];
        foreach ($cars as $car) {
            $data[] = [
                'name' => $car->name,
                'licence_plate_number' => $car->licence_plate_number,
                'isRented' => $car->isRented
            ];
        }
        return response()->json($data);
    }
    public function carRentDetails(Request $request)
    {
        $rentings = CarRenting::where('car_id', $request->id)->get();
        $data = [];
        foreach ($rentings as $renting) {
            $data[] = [
                'client_name' => Client::where('id', $renting->client_id)->first()->name,
                'sponsor_name' => Sponser::where('id', $renting->sponsor_id)->first()->name ?? null,
                'sponsor_name' => Sponser::where('id', $renting->sponsor_id)->first()->number ?? null,
                'start_date' => $renting->start_date,
                'end_date' => $renting->end_date
            ];
        }
        return response()->json($data);
    }
}
