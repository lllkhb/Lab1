@extends('layouts.app')
@section('title', ($locale === 'en') ? 'Flights admin' : 'Адміністрування рейсів')
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

        table th a {
            color: #fff;
            text-decoration: none;
        }

        table th a:hover {
            text-decoration: underline;
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

        .filter-form {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: flex-end;
            max-width: none;
            padding: 16px 20px;
        }

        .filter-form > div {
            margin: 0;
            flex: 1 1 150px;
        }

        .filter-form input,
        .filter-form select {
            margin-bottom: 0;
        }

        .filter-form .btn-reset {
            color: #133b6e;
            font-size: 14px;
            margin-left: 6px;
        }
    </style>

    @php
        $en = $locale === 'en';

        $sortRaw   = request('sort', 'departure');
        $sortDesc  = str_starts_with($sortRaw, '-');
        $sortField = ltrim($sortRaw, '-');

        $sortUrl = fn (string $col) => request()->fullUrlWithQuery([
            'sort' => ($sortField === $col && !$sortDesc) ? '-' . $col : $col,
            'page' => null,
        ]);

        $arrow = fn (string $col) => $sortField === $col ? ($sortDesc ? ' ▼' : ' ▲') : '';
    @endphp

    <h1>{{ $en ? 'Flights admin' : 'Адміністування рейсів' }}</h1>

    <div class="lang-switcher" style="margin-bottom: 15px;">
        <span>Мова / Language:</span>
        <a href="{{ request()->fullUrlWithQuery(['lang' => 'uk', 'page' => null]) }}" style="{{ $locale === 'uk' ? 'font-weight: bold; text-decoration: underline;' : '' }}">UA</a> |
        <a href="{{ request()->fullUrlWithQuery(['lang' => 'en', 'page' => null]) }}" style="{{ $locale === 'en' ? 'font-weight: bold; text-decoration: underline;' : '' }}">EN</a> |
        <a href="{{ request()->fullUrlWithQuery(['lang' => 'de', 'page' => null]) }}" style="{{ $locale === 'de' ? 'font-weight: bold; text-decoration: underline;' : '' }}">DE</a>
    </div>

    <p>
        <a href="{{ route('flight.create', ['lang' => $locale]) }}" class="btn btn-primary">
            {{ $en ? 'Add new flight' : 'Додати рейс' }}
        </a>
    </p>

    @if ($errors->any())
        <p class="text-danger">{{ $errors->first() }}</p>
    @endif

    <form method="GET" action="{{ route('flight.admin') }}" class="filter-form">
        <input type="hidden" name="lang" value="{{ $locale }}">
        <input type="hidden" name="sort" value="{{ request('sort') }}">

        <div>
            <label for="search">{{ $en ? 'Search' : 'Пошук' }}</label>
            <input type="text" id="search" name="search" value="{{ request('search') }}"
                   placeholder="{{ $en ? 'Airport, aircraft, tariff…' : 'Аеропорт, літак, тариф…' }}">
        </div>

        <div style="flex: 0 1 110px;">
            <label for="number">{{ $en ? 'Flight #' : 'Номер' }}</label>
            <input type="number" id="number" name="number" min="1" value="{{ request('number') }}">
        </div>

        <div>
            <label for="from">{{ $en ? 'From' : 'Звідки' }}</label>
            <select id="from" name="from">
                <option value="">{{ $en ? 'Any' : 'Будь-який' }}</option>
                @foreach ($departureAirports as $airport)
                    <option value="{{ $airport }}" @selected(request('from') === $airport)>{{ $airport }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="to">{{ $en ? 'To' : 'Куди' }}</label>
            <select id="to" name="to">
                <option value="">{{ $en ? 'Any' : 'Будь-який' }}</option>
                @foreach ($arrivalAirports as $airport)
                    <option value="{{ $airport }}" @selected(request('to') === $airport)>{{ $airport }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="tariff_id">{{ $en ? 'Tariff' : 'Тариф' }}</label>
            <select id="tariff_id" name="tariff_id">
                <option value="">{{ $en ? 'All tariffs' : 'Усі тарифи' }}</option>
                @foreach ($tariffs as $id => $name)
                    <option value="{{ $id }}" @selected((int) request('tariff_id') === $id)>{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="dep_from">{{ $en ? 'Departure from' : 'Виліт від' }}</label>
            <input type="date" id="dep_from" name="dep_from" value="{{ request('dep_from') }}">
        </div>

        <div>
            <label for="dep_to">{{ $en ? 'Departure to' : 'Виліт до' }}</label>
            <input type="date" id="dep_to" name="dep_to" value="{{ request('dep_to') }}">
        </div>

        <div>
            <label for="arr_from">{{ $en ? 'Arrival from' : 'Прибуття від' }}</label>
            <input type="date" id="arr_from" name="arr_from" value="{{ request('arr_from') }}">
        </div>

        <div>
            <label for="arr_to">{{ $en ? 'Arrival to' : 'Прибуття до' }}</label>
            <input type="date" id="arr_to" name="arr_to" value="{{ request('arr_to') }}">
        </div>

        <div style="flex: 0 0 auto;">
            <button type="submit">{{ $en ? 'Apply' : 'Застосувати' }}</button>
            <a class="btn-reset" href="{{ route('flight.admin', ['lang' => $locale]) }}">{{ $en ? 'Reset' : 'Скинути' }}</a>
        </div>
    </form>

    <table class="hotel-table">
        <thead>
        <tr>
            <th><a href="{{ $sortUrl('id') }}">#{{ $arrow('id') }}</a></th>
            <th><a href="{{ $sortUrl('route') }}">{{ $en ? 'Route' : 'Маршрут' }}{{ $arrow('route') }}</a></th>
            <th>{{ $en ? 'Aircraft' : 'Літак' }}</th>
            <th><a href="{{ $sortUrl('departure') }}">{{ $en ? 'Departure' : 'Виліт' }}{{ $arrow('departure') }}</a></th>
            <th><a href="{{ $sortUrl('arrival') }}">{{ $en ? 'Arrival' : 'Прибуття' }}{{ $arrow('arrival') }}</a></th>
            <th><a href="{{ $sortUrl('tariffs_count') }}">{{ $en ? 'Tariffs' : 'Тарифи' }}{{ $arrow('tariffs_count') }}</a></th>
            <th><a href="{{ $sortUrl('min_price') }}">{{ $en ? 'From' : 'Від' }}{{ $arrow('min_price') }}</a></th>
            <th>{{ $en ? 'Actions' : 'Дії' }}</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($flights as $flight)
            @php
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
                    {{ $flight->tariffs_count }}
                    @if ($flight->tariffs_count)
                        <small>({{ $flight->tariffs->pluck('name')->join(', ') }})</small>
                    @endif
                </td>
                <td>{{ $flight->min_price !== null ? number_format($flight->min_price, 2, '.', ' ') : '—' }}</td>
                <td>
                    <a href="{{ route('flight.edit', $flight) }}">{{ $en ? 'Edit' : 'Редагувати' }}</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8">{{ $en ? 'No flights found.' : 'Рейсів за вказаними умовами не знайдено.' }}</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $flights->links() }}
@endsection
