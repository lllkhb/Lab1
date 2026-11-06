@extends('layouts.app')
@section('title', ($locale === 'en') ? 'Flights' : 'Рейси')
@section('content')
    <h1>{{ ($locale === 'en') ? 'Flights' : 'Рейси' }}</h1>
    <div class="lang-switcher" style="margin-bottom: 15px;">
        <span>Мова / Language:</span>
        <a href="{{ request()->fullUrlWithQuery(['lang' => 'uk']) }}" style="{{ ($locale ?? 'uk') === 'uk' ? 'font-weight: bold; text-decoration: underline;' : '' }}">UA</a> |
        <a href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}" style="{{ ($locale ?? 'uk') === 'en' ? 'font-weight: bold; text-decoration: underline;' : '' }}">EN</a> |
        <a href="{{ request()->fullUrlWithQuery(['lang' => 'de']) }}" style="{{ ($locale ?? 'uk') === 'de' ? 'font-weight: bold; text-decoration: underline;' : '' }}">DE</a>
    </div>

    <p>
        <a href="{{ route('flight.create', ['lang' => $locale ?? 'uk']) }}" class="btn btn-primary">
            {{ ($locale === 'en') ? 'Add new flight' : 'Додати рейс' }}
        </a>
    </p>

    <table class="hotel-table">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ ($locale === 'en') ? 'Route' : 'Маршрут' }}</th>
            <th>{{ ($locale === 'en') ? 'Aircraft' : 'Літак' }}</th>
            <th>{{ ($locale === 'en') ? 'Departure' : 'Виліт' }}</th>
            <th>{{ ($locale === 'en') ? 'Arrival' : 'Прибуття' }}</th>
            <th>{{ ($locale === 'en') ? 'Actions' : 'Дії' }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($flights as $flight)
            @php
                // Шукаємо переклад для поточної мови, якщо немає — беремо українську (fallback)
                $translation = $flight->translations->where('locale', $locale)->first()
                    ?? $flight->translations->where('locale', 'uk')->first();
            @endphp
            <tr>
                <td>
                    <a href="{{ route('flight.show', ['flight' => $flight, 'lang' => $locale]) }}">
                        {{ $flight->id }}
                    </a>
                </td>
                <td>
                    {{ $translation?->departure_airport ?? $flight->departure_airport }}
                    →
                    {{ $translation?->arrival_airport ?? $flight->arrival_airport }}
                </td>
                <td>{{ $translation?->aircraft_model ?? $flight->aircraft_model }}</td>
                <td>{{ $flight->departure_date->format('d.m.Y') }} {{ substr($flight->departure_time, 0, 5) }}</td>
                <td>{{ $flight->arrival_date->format('d.m.Y') }} {{ substr($flight->arrival_time, 0, 5) }}</td>
                <td>
                    <a href="{{ route('flight.edit', $flight) }}">{{ ($locale === 'en') ? 'Edit' : 'Редагувати' }}</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $flights->links() }}
@endsection
