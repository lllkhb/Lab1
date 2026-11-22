@extends('layouts.app')
@section('title', ($locale === 'en') ? 'Flights' : 'Рейси')
@section('content')
    <style>
        main h1 {
            font-size: 28px;
            font-weight: 700;
            color: #133b6e;
            margin-bottom: 12px;
        }

        .lang-switcher {
            margin-bottom: 20px;
            font-size: 15px;
            color: #333;
        }

        .lang-switcher a {
            color: #133b6e;
            text-decoration: none;
            padding: 2px 6px;
            border-radius: 4px;
        }

        .lang-switcher a:hover {
            background-color: #e6eef8;
        }

        a[href*="/flight/create"], .btn-add, .btn-primary {
            display: inline-block;
            background-color: #133b6e;
            color: #ffffff !important;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            margin: 10px 0 20px 0;
            transition: background-color 0.2s;
        }

        a[href*="/flight/create"]:hover, .btn-add:hover, .btn-primary:hover {
            background-color: #0d2a50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            margin-bottom: 24px;
        }

        table thead {
            background-color: #133b6e;
            color: #ffffff;
        }

        table th {
            padding: 14px 16px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
        }

        table td {
            padding: 12px 16px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
            color: #1f2937;
            vertical-align: middle;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        table tbody tr:hover {
            background-color: #f0f5ff;
        }

        table td a {
            color: #133b6e;
            font-weight: 500;
            text-decoration: none;
        }

        table td a:hover {
            text-decoration: underline;
        }

        table td a[href*="/edit"], .btn-edit {
            display: inline-block;
            background-color: #eef2ff;
            color: #133b6e !important;
            border: 1px solid #c7d2fe;
            padding: 6px 12px;
            border-radius: 5px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }

        table td a[href*="/edit"]:hover, .btn-edit:hover {
            background-color: #133b6e;
            color: #ffffff !important;
            border-color: #133b6e;
        }
    </style>
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
