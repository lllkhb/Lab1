<?php

namespace App\Queries;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class FlightsFilter
{
    private const SORTABLE = [
        'id'            => ['flights.id'],
        'route'         => ['flights.departure_airport', 'flights.arrival_airport'],
        'departure'     => ['flights.departure_date', 'flights.departure_time'],
        'arrival'       => ['flights.arrival_date', 'flights.arrival_time'],
        'tariffs_count' => ['tariffs_count'],
        'min_price'     => ['min_price'],
    ];

    public function apply(array $input): Builder
    {
        $locale = $input['lang'] ?? 'uk';

        $query = Flight::query()
            ->with([
                'translations' => fn (Builder|\Illuminate\Database\Eloquent\Relations\Relation $q) =>
                $q->whereIn('locale', [$locale, 'uk']),
                'tariffs',
            ])
            ->withCount('tariffs')
            ->withMin('tariffs as min_price', 'flight_tariff.price');

        $query->when(
            trim((string) ($input['search'] ?? '')) !== '' ? trim($input['search']) : null,
            function (Builder $q, $value) {
                $like = '%' . addcslashes($value, '%_\\') . '%';

                $q->where(function (Builder $w) use ($like) {
                    $w->where('flights.departure_airport', 'like', $like)
                        ->orWhere('flights.arrival_airport', 'like', $like)
                        ->orWhere('flights.aircraft_model', 'like', $like)
                        ->orWhereHas('translations', fn ($t) => $t
                            ->where('departure_airport', 'like', $like)
                            ->orWhere('arrival_airport', 'like', $like))
                        ->orWhereHas('tariffs', fn ($t) => $t->where('tariffs.name', 'like', $like));
                });
            }
        );

        $query->when(
            $input['tariff_id'] ?? null,
            fn (Builder $q, $value) =>
            $q->whereHas('tariffs', fn (Builder|\Illuminate\Database\Eloquent\Relations\Relation $related) =>
            $related->whereKey($value))
        );

        $query->when(
            $input['number'] ?? null,
            fn (Builder $q, $value) => $q->where('flights.id', (int) $value)
        );

        $query->when(
            $input['from'] ?? null,
            fn (Builder $q, $value) => $q->where('flights.departure_airport', $value)
        );
        $query->when(
            $input['to'] ?? null,
            fn (Builder $q, $value) => $q->where('flights.arrival_airport', $value)
        );

        $query->when(
            $this->date($input['dep_from'] ?? null),
            fn (Builder $q, $value) => $q->where('flights.departure_date', '>=', $value)
        );
        $query->when(
            $this->date($input['dep_to'] ?? null),
            fn (Builder $q, $value) => $q->where('flights.departure_date', '<=', $value)
        );

        $query->when(
            $this->date($input['arr_from'] ?? null),
            fn (Builder $q, $value) => $q->where('flights.arrival_date', '>=', $value)
        );
        $query->when(
            $this->date($input['arr_to'] ?? null),
            fn (Builder $q, $value) => $q->where('flights.arrival_date', '<=', $value)
        );

        return $this->sort($query, $input['sort'] ?? null);
    }

    private function sort(Builder $query, ?string $sort): Builder
    {
        $desc  = str_starts_with($sort ?? '', '-');
        $field = $desc ? substr($sort, 1) : ($sort ?? '');

        if (!isset(self::SORTABLE[$field])) {
            return $query->orderBy('flights.departure_date')
                ->orderBy('flights.departure_time')
                ->orderBy('flights.id');
        }

        foreach (self::SORTABLE[$field] as $column) {
            $query->orderBy($column, $desc ? 'desc' : 'asc');
        }

        return $query->orderBy('flights.id');
    }

    private function date(mixed $value): ?string
    {
        if (!is_string($value) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
            return null;
        }

        return strtotime($value) !== false ? $value : null;
    }

    public function departureAirports(): Collection
    {
        return Flight::query()->distinct()->orderBy('departure_airport')->pluck('departure_airport');
    }

    public function arrivalAirports(): Collection
    {
        return Flight::query()->distinct()->orderBy('arrival_airport')->pluck('arrival_airport');
    }
}
