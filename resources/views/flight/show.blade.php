@extends('layouts.app')
@section('title', ($locale === 'en' ? 'Flight Details: ' : 'Деталі рейсу: ') . $flight->id)
@section('content')
    @php
        $locale = request('lang', 'uk');
        $translation = $flight->translations->where('locale', $locale)->first()
            ?? $flight->translations->where('locale', 'uk')->first();
    @endphp

    <h1>{{ ($locale === 'en' ? 'Flight Details: ' : 'Деталі рейсу: ') }} {{ $flight->id }}</h1>

    <div style="margin-bottom: 15px;">
        <a href="{{ request()->fullUrlWithQuery(['lang' => 'uk']) }}" style="{{ $locale === 'uk' ? 'font-weight: bold; text-decoration: underline;' : '' }}">UA</a> |
        <a href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}" style="{{ $locale === 'en' ? 'font-weight: bold; text-decoration: underline;' : '' }}">EN</a> |
        <a href="{{ request()->fullUrlWithQuery(['lang' => 'de']) }}" style="{{ $locale === 'de' ? 'font-weight: bold; text-decoration: underline;' : '' }}">DE</a>
    </div>

    <p><strong>{{ ($locale === 'en' ? 'Departure Airport: ' : 'Аеропорт вильоту: ') }}</strong> {{ $translation?->departure_airport ?? $flight->departure_airport }}</p>
    <p><strong>{{ ($locale === 'en' ? 'Arrival Airport: ' : 'Аеропорт прибуття: ') }}</strong> {{ $translation?->arrival_airport ?? $flight->arrival_airport }}</p>
    <p><strong>{{ ($locale === 'en' ? 'Aircraft: ' : 'Літак: ') }}</strong> {{ $translation?->aircraft_model ?? $flight->aircraft_model }}</p>
    <p>
        <strong>{{ ($locale === 'en' ? 'Departure: ' : 'Виліт: ') }}</strong>
        {{ $flight->departure_date->format('d.m.Y') }} о {{ substr($flight->departure_time, 0, 5) }}
    </p>
    <p>
        <strong>{{ ($locale === 'en' ? 'Arrival: ' : 'Прибуття: ') }}</strong>
        {{ $flight->arrival_date->format('d.m.Y') }} о {{ substr($flight->arrival_time, 0, 5) }}
    </p>

    <p><a href="{{ route('flight.edit', $flight) }}">{{ ($locale === 'en' ? 'Edit' : 'Редагувати') }}</a></p>
    <p><a href="{{ route('flight.index', ['lang' => $locale]) }}">{{ ($locale === 'en' ? 'Back to list' : 'Повернутися до списку') }}</a></p>

    <form method="POST" action="{{ route('flight.destroy', $flight) }}" onsubmit="return confirm('Видалити цей рейс?')">
        @csrf
        @method('DELETE')
        <button type="submit">{{ ($locale === 'en' ? 'Delete' : 'Видалити') }}</button>
    </form>
@endsection
