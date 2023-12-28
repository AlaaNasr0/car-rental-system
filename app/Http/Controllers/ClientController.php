<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Sponser;
use App\Models\CarRenting;
use App\Models\Car;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $sponsors = Sponser::all();
        return response()->json(['sponsors' => $sponsors]);
    }
    public function create(Request $request)
    {
        //name
        //phone
        //address
        //front_id_image
        //back_id_image
        //sponsor_status
        //selectedSponsor_id
        //new_sponsor_name
        //new_sponsor_number
        $sponsor_id = null;
        if ($request->sponsor_status == 'new') {
            $new_sponsor = new Sponser([
                'name' => $request->sponsor_name,
                'number' => $request->sponsor_number,
            ]);
            $new_sponsor->save();
            $sponsor_id = $new_sponsor->id;
        } elseif ($request->sponsor_status == 'exists') {
            $sponsor_id = $request->sponsor_id;
        } else {
            $sponsor_id = null;
        }

        $ID1Path = $request->file('front_id_image')->store('id_images', 'public');
        $ID2Path = $request->file('back_id_image') ? $request->file('back_id_image')->store('id_images', 'public') : null;

        $client = new Client([
            'name' => $request->name,
            'phone' => $request->phone,
            'hasRented' => false,
            'sponsor_id' => $sponsor_id,
            'front_id_image' => $ID1Path,
            'back_id_image' => $ID2Path,
            'address' => $request->address,
        ]);

        $client->save();
        if ($request->sponsor_status != 'without') {
            Sponser::find($sponsor_id)->update(['client_id' => $client->id]);
        }


        return redirect()->route('home');
    }
    public function view(Request $request)
    {
        $cars = Client::all();
        if ($request->expectsJson()) {
            return response()->json(['cars' => $cars]);
        }
        return view('client.view', $cars);
    }
    public function getDetails(Request $request)
    {
        $client = Client::where('id', $request->id)->first();
        $sponsor = Sponser::where('client_id', $client->id)->first() ?? null;
        $current_renting = CarRenting::where('client_id', $request->id)->where('renting_finished', 0)->latest()->first() ?? null;
        $car = $current_renting ? Car::find($current_renting->car_id) : null;
        $clientData = [
            'id' => $client->id,
            'name' => $client->name,
            'phone' => $client->phone,
            'address' => $client->address,
            'hasRented' => $client->hasRented,
            'sponsor_name' => $sponsor->name ?? null,
            'sponsor_number' => $sponsor->number ?? null,
            'front_id_image' => $client->front_id_image,
            'back_id_image' => $client->back_id_image ?? null,
            'current_rented_car_name' => $current_renting ? $car->name : null,
            'renting_start_date' => $current_renting->start_date ?? null,
            'renting_end_date' => $current_renting->end_date ?? null,
        ];
        return response()->json(['clientDetails' => $clientData]);
    }
}
