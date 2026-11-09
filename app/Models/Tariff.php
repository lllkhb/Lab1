<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tariff extends Model
{
    protected $fillable = ['name', 'class_name', 'baggage'];

    public function flights(): BelongsToMany
    {
        return $this->belongsToMany(Flight::class, 'flight_tariff')
            ->withPivot('price');
    }
}
