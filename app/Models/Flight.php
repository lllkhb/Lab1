<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $fillable = [
        'departure_airport',
        'arrival_airport',
        'aircraft_model',
        'departure_date',
        'departure_time',
        'arrival_date',
        'arrival_time',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'arrival_date'   => 'date',
    ];
}
