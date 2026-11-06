<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function translations(): HasMany
    {
        return $this->hasMany(FlightTranslation::class, 'flight_id', 'id');
    }

    public function translate(?string $locale = null, string $fallbackLocale = 'uk'): ?FlightTranslation
    {
        $locale = $locale ?? app()->getLocale();

        // Шукаємо переклад запитуваною мовою
        $translation = $this->translations->firstWhere('locale', $locale);

        // Якщо переклад не знайдено і це не дефолтна мова шукаємо українську
        if (!$translation && $locale !== $fallbackLocale) {
            $translation = $this->translations->firstWhere('locale', $fallbackLocale);
        }

        return $translation;
    }

    public function getTranslatedField(string $field, ?string $locale = null): ?string
    {
        $translation = $this->translate($locale);

        // Якщо знайдено переклад і поле не порожнє повертаємо його
        if ($translation && !empty($translation->{$field})) {
            return $translation->{$field};
        }

        // Якщо перекладу немає взагалі, повертаємо дані з основної таблиці flights
        return $this->{$field};
    }
}
