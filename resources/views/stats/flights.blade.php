@extends('layouts.app')
@section('title', 'Популярні рейси')
@section('content')
    <h1>Найпопулярніші рейси</h1>
    <table>
        <thead>
        <tr>
            <th>Рейс</th>
            <th>Дата вильоту</th>
            <th>Переглядів</th>
            <th>Останній перегляд</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($flights as $f)
            <tr>
                <td>
                    <a href="{{ route('flight.show', $f->id) }}">
                        {{ $f->departure_airport }} → {{ $f->arrival_airport }}
                    </a>
                </td>
                <td>{{ \Carbon\Carbon::parse($f->departure_date)->format('d.m.Y') }}</td>
                <td>{{ $f->views }}</td>
                <td>{{ $f->last_view }}</td>
            </tr>
        @empty
            <tr><td colspan="4">Даних ще немає.</td></tr>
        @endforelse
        </tbody>
    </table>

    <h2>Відвідування за типом пристрою</h2>
    <table>
        <thead>
        <tr><th>Пристрій</th><th>Звернень</th></tr>
        </thead>
        <tbody>
        @foreach ($devices as $d)
            <tr><td>{{ $d->device }}</td><td>{{ $d->hits }}</td></tr>
        @endforeach
        </tbody>
    </table>
@endsection
