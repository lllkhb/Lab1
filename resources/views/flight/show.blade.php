@extends('layouts.app')
@section('title', 'Рейс ' . $flight->id)
@section('content')
    <h1>Рейс {{ $flight->id }}</h1>
    <p><strong>Аеропорт вильоту:</strong> {{ $flight->departure_airport }}</p>
    <p><strong>Аеропорт прибуття:</strong> {{ $flight->arrival_airport }}</p>
    <p><strong>Літак:</strong> {{ $flight->aircraft_model }}</p>
    <p>
        <strong>Виліт:</strong>
        {{ $flight->departure_date->format('d.m.Y') }} о {{ substr($flight->departure_time, 0, 5) }}
    </p>
    <p>
        <strong>Прибуття:</strong>
        {{ $flight->arrival_date->format('d.m.Y') }} о {{ substr($flight->arrival_time, 0, 5) }}
    </p>

    <p><a href="{{ route('flight.edit', $flight) }}">Редагувати</a></p>
    <p><a href="{{ route('flight.index') }}">Повернутися до списку</a></p>
    <form method="POST" action="{{ route('flight.destroy', $flight) }}"
          onsubmit="return confirm('Видалити цей рейс?')">
        @csrf
        @method('DELETE')
        <button type="submit">Видалити</button>
    </form>
@endsection
