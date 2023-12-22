<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\CarRenting;
use App\Models\Client;
use App\Models\Car;

class RentController extends Controller
{
    public function show(Request $request)
    {
        $client = Client::where('id', $request->id)->first();
        $clientData = [
            'client_id' => $client->id,
            'front_id_image' => $client->front_id_image,
            'back_id_image' => $client->back_id_image ?? null
        ];
        if ($request->expectsJson()) {
            return response()->json(['clientDetails' => $clientData]);
        }
    }
    public function newRent(Request $request)
    {
        $client_id = $request->id;
        $car_id = $request->car_id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $videoPath = $request->file('video')->store('insurence_videos', 'public');
        if (Client::find($client_id)->hasRented) {
            return response()->json(['error' => "Client has already rented the car!"]);
        }
        if (Client::find($car_id)->isRented) {
            return response()->json(['error' => "Car already rented!"]);
        }
        Client::find($client_id)->update(['hasRented' => true]);
        Car::find($car_id)->update(['isRented' => true]);
        $rent = new CarRenting([
            'client_id' => $client_id,
            'car_id' => $car_id,
            'renting_finished' => false,
            'start_date' => Carbon::createFromFormat('d/m/Y', $start_date)->format('Y-m-d H:i:s'),
            'end_date' => Carbon::createFromFormat('d/m/Y', $end_date)->format('Y-m-d H:i:s'),
            'video' => $videoPath,
        ]);
        $rent->save();
        return redirect()->route('home');
    }
}
