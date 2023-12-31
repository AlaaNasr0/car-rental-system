<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarRenting extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'car_id',
        'renting_finished',
        'sponsor_id',
        'start_date',
        'end_date',
        'video'
    ];
}
