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
                'id' => $car->id,
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
            $sponsor_id = Client::find($renting->client_id)->sponsor_id;
            $sponsor = $sponsor_id ? Sponser::find($sponsor_id)->first() : null;
            $data[] = [
                'client_name' => Client::where('id', $renting->client_id)->first()->name,
                'sponsor_name' => $sponsor->name ?? null,
                'sponsor_number' => $sponsor->number ?? null,
                'start_date' => $renting->start_date,
                'end_date' => $renting->end_date,
                'insurance_video' => $renting->video
            ];
        }
        return response()->json($data);
    }
}
