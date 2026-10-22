@extends('layouts.app')
@section('title', 'Довідник країн')
@section('content')
    <h1>Довідник країн</h1>
    <p>
        <a href="{{ route('country.create') }}">
            Додати країну
        </a>
    </p>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Код</th>
            <th>Назва</th>
            <th>Населення</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($countries as $i => $country)
            <tr>
                <td>
                    {{ $countries->firstItem() + $i }}
                </td>
                <td>{{ $country->code }}
                </td>
                <td>
                    <a href="{{ route('country.show', $country) }}">
                        {{ $country->name }}
                    </a>
                </td>
                <td>
                    {{
                    number_format($country->population, 0, ',', ' ')
                    }}
                </td>
                <td>
                    <a href="{{ route('country.edit', $country) }}">
                        Редагувати
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $countries->links() }}
@endsection
