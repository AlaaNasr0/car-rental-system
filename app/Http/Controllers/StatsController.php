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
        $sponsor_id = Client::find($rentings[0]->client_id)->sponsor_id;
        $sponsor = Sponser::find($sponsor_id)->first();
        foreach ($rentings as $renting) {

            $data[] = [
                'client_name' => Client::where('id', $renting->client_id)->first()->name,
                'sponsor_name' => $sponsor->name ?? null,
                'sponsor_number' => $sponsor->number ?? null,
                'start_date' => $renting->start_date,
                'end_date' => $renting->end_date
            ];
        }
        return response()->json($data);
    }
}
