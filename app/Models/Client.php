<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'address',
        'hasRented',
        'number_of_rents',
        'sponsor_id',
        'front_id_image',
        'back_id_image'
    ];
}
