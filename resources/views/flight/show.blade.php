@extends('layouts.app')

@section('title', (($locale ?? 'uk') === 'en') ? 'Flight Details' : 'Деталі рейсу')

@section('content')
    @php
        $translation = $flight->translations->first();
        $depAirport  = $translation->departure_airport ?? $flight->departure_airport;
        $arrAirport  = $translation->arrival_airport ?? $flight->arrival_airport;
        $aircraft    = $translation->aircraft_model ?? $flight->aircraft_model;
    @endphp

    <h1>{{ (($locale ?? 'uk') === 'en') ? 'Flight Details:' : 'Деталі рейсу:' }} {{ $flight->id }}</h1>

    <div class="lang-switcher">
        <span>Мова / Language:</span>
        <a href="{{ request()->fullUrlWithQuery(['lang' => 'uk']) }}" style="{{ ($locale ?? 'uk') === 'uk' ? 'font-weight: bold; text-decoration: underline;' : '' }}">UA</a> |
        <a href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}" style="{{ ($locale ?? 'uk') === 'en' ? 'font-weight: bold; text-decoration: underline;' : '' }}">EN</a> |
        <a href="{{ request()->fullUrlWithQuery(['lang' => 'de']) }}" style="{{ ($locale ?? 'uk') === 'de' ? 'font-weight: bold; text-decoration: underline;' : '' }}">DE</a>
    </div>

    <div style="background: #fff; padding: 24px 28px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); max-width: 760px;">
        <p><strong>Аеропорт вильоту:</strong> {{ $depAirport }}</p>
        <p><strong>Аеропорт прибуття:</strong> {{ $arrAirport }}</p>
        <p><strong>Літак:</strong> {{ $aircraft }}</p>
        <p><strong>Виліт:</strong> {{ \Carbon\Carbon::parse($flight->departure_date)->format('d.m.Y') }} о {{ \Carbon\Carbon::parse($flight->departure_time)->format('H:i') }}</p>
        <p><strong>Прибуття:</strong> {{ \Carbon\Carbon::parse($flight->arrival_date)->format('d.m.Y') }} о {{ \Carbon\Carbon::parse($flight->arrival_time)->format('H:i') }}</p>

        <h3>Тарифи</h3>
        @if($flight->tariffs && $flight->tariffs->count())
            <table>
                <thead>
                <tr>
                    <th>Назва тарифу</th>
                    <th>Клас</th>
                    <th>Багаж</th>
                    <th>Ціна</th>
                </tr>
                </thead>
                <tbody>
                @foreach($flight->tariffs as $tariff)
                    <tr>
                        <td>{{ $tariff->name }}</td>
                        <td>{{ $tariff->class_name }}</td>
                        <td>{{ $tariff->baggage ? 'Так' : 'Ні' }}</td>
                        <td><strong>{{ number_format($tariff->pivot->price, 2, '.', ' ') }} грн</strong></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p style="color: #64748b; font-style: italic;">Тарифи не призначені.</p>
        @endif

        <div style="margin-top: 24px; padding-top: 16px; border-top: 1px solid #e1e8f0; display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
            <a href="{{ route('flight.edit', $flight) }}" style="margin: 0;">Редагувати</a>
            <a href="{{ route('flight.index') }}" style="margin: 0;">Повернутися до списку</a>

            <form action="{{ route('flight.destroy', $flight) }}" method="POST" style="margin: 0; margin-left: auto;" onsubmit="return confirm('Ви впевнені, що хочете видалити цей рейс?');">
                @csrf
                @method('DELETE')
                <button type="submit">Видалити</button>
            </form>
        </div>
    </div>
@endsection
