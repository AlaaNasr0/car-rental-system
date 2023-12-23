<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Car;
use App\Models\FundTransaction;
use App\Models\CarRenting;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clientData = [];
        $clients = Client::all();
        $clientsCount = Client::count();
        $carsCount = Car::count();
        $expenses = FundTransaction::where('type', 0)->sum('amount');
        $income = FundTransaction::where('type', 1)->sum('amount');
        $rentings = CarRenting::where('renting_finished', false)->get();

        foreach ($rentings as $renting) {
            if ($renting->end_date && strtotime($renting->end_date) <= strtotime(now())) {
                CarRenting::find($renting->id)->update(['renting_finished' => true]);
                Client::find($renting->client_id)->update(['hasRented' => false]);
                Car::find($renting->car_id)->update(['isRented' => false]);
            }
        }

        foreach ($clients as $client) {
            $clientData[] = [
                'client_id' => $client->id,
                'clientName' => $client->name,
                'clientNumber' => $client->phone,
                'rentingCount' => CarRenting::where('client_id', $client->id)->count(),
                'rentingNow' => $client->hasRented,
                'created_at' => $client->created_at
            ];
        }
        $data = [
            'clientsCount' => $clientsCount,
            'carsCount' => $carsCount,
            'expenses' => $expenses,
            'income' => $income,
            'clients' => $clientData
        ];

        return response()->json($data);
    }
}
