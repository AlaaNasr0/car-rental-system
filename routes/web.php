<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    //Get home screen (done)
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //Post add car (done)
    Route::post('/addCar', [App\Http\Controllers\CarController::class, 'create'])->name('addCar');
    //Get show cars (done)
    Route::get('/showCars', [App\Http\Controllers\CarController::class, 'view'])->name('showCars');
    //Get add client (done)
    Route::get('/addClient', [App\Http\Controllers\ClientController::class, 'index'])->name('addClient');
    //Post add client (done)
    Route::post('/addClient', [App\Http\Controllers\ClientController::class, 'create'])->name('PostAddClient');
    //Get client info (clientID) (done)
    Route::get('/clientDetails/{id}', [App\Http\Controllers\ClientController::class, 'getDetails'])->name('clientDetails');
    //Get rent form (clientID) (done)
    Route::get('/rentForm/{id}', [App\Http\Controllers\RentController::class, 'show'])->name('rentForm');
    //Post new rent (done)
    Route::post('/newRent', [App\Http\Controllers\RentController::class, 'newRent'])->name('newRent');
    //Get expanses (done)
    Route::get('/expenses', [App\Http\Controllers\ExpensesController::class, 'index'])->name('expenses');
    //Post expanses (done)
    Route::post('/addTransaction', [App\Http\Controllers\ExpensesController::class, 'addTransaction'])->name('addTransaction');
    //Get renting stats (done)
    Route::get('/stats', [App\Http\Controllers\StatsController::class, 'getStats'])->name('stats');
    //Get renting details (carID) (done)
    Route::get('/details/{id}', [App\Http\Controllers\StatsController::class, 'carRentDetails'])->name('carRentDetails');
});
