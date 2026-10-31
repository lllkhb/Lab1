<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlightRequest;
use App\Models\Flight;

class FlightController extends Controller
{
    public function index()
    {
        $flights = Flight::orderBy('departure_date')
            ->orderBy('departure_time')
            ->paginate(5);

        return view('flight.index', compact('flights'));
    }

    public function create()
    {
        return view('flight.create');
    }

    public function store(FlightRequest $request)
    {
        $flight = Flight::create($request->validated());

        return redirect()->route('flight.show', $flight)
            ->with('success', 'Рейс успішно додано.');
    }

    public function show(Flight $flight)
    {
        return view('flight.show', compact('flight'));
    }

    public function edit(Flight $flight)
    {
        return view('flight.edit', compact('flight'));
    }

    public function update(FlightRequest $request, Flight $flight)
    {
        $flight->update($request->validated());

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
