@extends('layouts.app')
@section('title', 'Рейси')
@section('content')
    <h1>Рейси</h1>
    <p>
        <a href="{{ route('flight.create') }}">Додати рейс</a>
    </p>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Маршрут</th>
            <th>Літак</th>
            <th>Виліт</th>
            <th>Прибуття</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($flights as $flight)
            <tr>
                <td>
                    <a href="{{ route('flight.show', $flight) }}">{{ $flight->id }}</a>
                </td>
                <td>{{ $flight->departure_airport }} → {{ $flight->arrival_airport }}</td>
                <td>{{ $flight->aircraft_model }}</td>
                <td>{{ $flight->departure_date->format('d.m.Y') }} {{ substr($flight->departure_time, 0, 5) }}</td>
                <td>{{ $flight->arrival_date->format('d.m.Y') }} {{ substr($flight->arrival_time, 0, 5) }}</td>
                <td>
                    <a href="{{ route('flight.edit', $flight) }}">Редагувати</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $flights->links() }}
@endsection
