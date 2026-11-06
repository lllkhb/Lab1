<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FlightTranslation extends Model
{
    // Вмикаємо/вимикаємо мітки часу. Оскільки в таблиці перекладів вони не потрібні, ставимо false.
    public $timestamps = false;

    protected $fillable = [
        'flight_id',
        'locale',
        'departure_airport',
        'arrival_airport',
        'aircraft_model',
    ];

    // один переклад належить до конкретного рейсу
    public function flight(): BelongsTo
    {
        return $this->belongsTo(Flight::class, 'flight_id', 'id');
    }
}
