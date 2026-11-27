<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlightRequest;
use App\Models\Flight;
use App\Models\Tariff;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Queries\FlightsFilter;

class FlightController extends Controller
{
    public function index(Request $request)
    {
        $locale = $request->query('lang', 'uk');

        $flights = Flight::with([
            'translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            },
            'tariffs',
        ])
            ->orderBy('departure_date')
            ->orderBy('departure_time')
            ->paginate(5)
            ->withQueryString();

        return view('flight.index', compact('flights', 'locale'));
    }

    public function create()
    {
        $tariffs = Tariff::orderBy('name')->get();

        return view('flight.create', compact('tariffs'));
    }

    public function store(FlightRequest $request)
    {
        $flightData = Arr::except($request->validated(), [
            'tariffs',
            'prices',
            'departure_airport_en',
            'arrival_airport_en',
            'aircraft_model_en',
        ]);

        $flight = Flight::create($flightData);

        $flight->translations()->create([
            'locale'            => 'uk',
            'departure_airport' => $flight->departure_airport,
            'arrival_airport'   => $flight->arrival_airport,
            'aircraft_model'    => $flight->aircraft_model,
        ]);

        if ($request->filled('departure_airport_en') && $request->filled('arrival_airport_en')) {
            $flight->translations()->create([
                'locale'            => 'en',
                'departure_airport' => $request->input('departure_airport_en'),
                'arrival_airport'   => $request->input('arrival_airport_en'),
                'aircraft_model'    => $request->input('aircraft_model_en') ?: $flight->aircraft_model,
            ]);
        }

        $this->syncTariffs($flight, $request);

        return redirect()->route('flight.show', $flight)
            ->with('success', 'Рейс успішно додано.');
    }

    public function show(Request $request, Flight $flight)
    {
        $locale = $request->query('lang', 'uk');

        $flight->load([
            'translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            },
            'tariffs',
        ]);

        return view('flight.show', compact('flight', 'locale'));
    }

    public function edit(Flight $flight)
    {
        $flight->load(['translations', 'tariffs']);
        $tariffs = Tariff::orderBy('name')->get();

        return view('flight.edit', compact('flight', 'tariffs'));
    }

    public function update(FlightRequest $request, Flight $flight)
    {
        $flightData = Arr::except($request->validated(), [
            'tariffs',
            'prices',
            'departure_airport_en',
            'arrival_airport_en',
            'aircraft_model_en',
        ]);

        $flight->update($flightData);

        $flight->translations()->updateOrCreate(
            ['locale' => 'uk'],
            [
                'departure_airport' => $flight->departure_airport,
                'arrival_airport'   => $flight->arrival_airport,
                'aircraft_model'    => $flight->aircraft_model,
            ]
        );

        if ($request->filled('departure_airport_en') && $request->filled('arrival_airport_en')) {
            $flight->translations()->updateOrCreate(
                ['locale' => 'en'],
                [
                    'departure_airport' => $request->input('departure_airport_en'),
                    'arrival_airport'   => $request->input('arrival_airport_en'),
                    'aircraft_model'    => $request->input('aircraft_model_en') ?: $flight->aircraft_model,
                ]
            );
        }

        $this->syncTariffs($flight, $request);

        return redirect()->route('flight.show', $flight)
            ->with('success', 'Зміни збережено.');
    }

    public function destroy(Flight $flight)
    {
        $flight->delete();

        return redirect()->route('flight.index')
            ->with('success', 'Рейс видалено.');
    }
    public function admin(Request $request, FlightsFilter $query)
    {
        $input = $request->validate([
            'search'    => ['nullable', 'string', 'max:200'],
            'number'    => ['nullable', 'integer', 'min:1'],
            'from'      => ['nullable', 'string', 'max:150'],
            'to'        => ['nullable', 'string', 'max:150'],
            'tariff_id' => ['nullable', 'integer', 'exists:tariffs,id'],
            'dep_from'  => ['nullable', 'date_format:Y-m-d'],
            'dep_to'    => ['nullable', 'date_format:Y-m-d', 'after_or_equal:dep_from'],
            'arr_from'  => ['nullable', 'date_format:Y-m-d'],
            'arr_to'    => ['nullable', 'date_format:Y-m-d', 'after_or_equal:arr_from'],
            'sort'      => ['nullable', 'string', 'max:30'],
            'lang'      => ['nullable', 'in:uk,en,de'],
        ]);

        $flights = $query->apply($input)
            ->paginate(10)
            ->withQueryString();

        return view('flight.admin', [
            'flights'           => $flights,
            'locale'            => $input['lang'] ?? 'uk',
            'tariffs'           => Tariff::orderBy('name')->pluck('name', 'id'),
            'departureAirports' => $query->departureAirports(),
            'arrivalAirports'   => $query->arrivalAirports(),
        ]);
    }
    private function syncTariffs(Flight $flight, Request $request): void
    {
        $data = [];

        foreach ((array) $request->input('tariffs', []) as $tariffId) {
            $data[$tariffId] = [
                'price' => $request->input("prices.$tariffId"),
            ];
        }

        $flight->tariffs()->sync($data);
    }
}
