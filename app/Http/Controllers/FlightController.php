<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlightRequest;
use App\Models\Flight;
use Illuminate\Http\Request;
class FlightController extends Controller
{
    public function index(Request $request)
    {
        $locale = $request->get('lang', 'uk');

        $flights = Flight::with(['translations' => function($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            ->orderBy('departure_date')
            ->orderBy('departure_time')
            ->paginate(5)
            ->withQueryString();

        return view('flight.index', compact('flights', 'locale'));
    }

    public function create()
    {
        return view('flight.create');
    }

    public function store(FlightRequest $request)
    {
        $flight = Flight::create($request->validated());

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

        return redirect()->route('flight.show', $flight)
            ->with('success', 'Рейс успішно додано.');
    }

    public function show(Request $request, Flight $flight)
    {
        $locale = $request->get('lang', 'uk');

        $flight->load(['translations' => function($query) use ($locale) {
            $query->where('locale', $locale);
        }]);

        return view('flight.show', compact('flight', 'locale'));
    }

    public function edit(Flight $flight)
    {
        $flight->load('translations');

        return view('flight.edit', compact('flight'));
    }

    public function update(FlightRequest $request, Flight $flight)
    {
        $flight->update($request->validated());

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

        return redirect()->route('flight.show', $flight)
            ->with('success', 'Зміни збережено.');
    }

    public function destroy(Flight $flight)
    {
        $flight->delete();

        return redirect()->route('flight.index')
            ->with('success', 'Рейс видалено.');
    }
}
