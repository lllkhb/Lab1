@extends('layouts.app')
@section('title', 'Дані прийнято')
@section('content')
    <h1>Перевірка даних пасажира</h1>
    <p>Будь ласка, перевірте введені дані перед оплатою авіаквитка:</p>
    <ul>
        <li>
            <strong>Пасажир:</strong>
            {{ strtoupper($last_name) }} {{ strtoupper($first_name) }}
        </li>
        <li>
            <strong>Дата народження:</strong>
            {{ $birth_date }}
        </li>
        <li>
            <strong>Громадянство:</strong>
            {{ $citizenship }}
        </li>
        <li>
            <strong>Паспорт:</strong>
            {{ strtoupper($passport_number) }} (дійсний до {{ $passport_expiry }})
        </li>
        <li>
            <strong>Email для отримання квитка:</strong>
            {{ $email }}
        </li>
        <li>
            <strong>Контактний телефон:</strong>
            {{ $phone }}
        </li>
        <li>
            <strong>Обраний багаж:</strong>
            @if($baggage === 'hand_only')
                Тільки ручна поклажа (до 7 кг)
            @elseif($baggage === 'baggage_20kg')
                Зареєстрований багаж до 20 кг
            @elseif($baggage === 'baggage_32kg')
                Зареєстрований багаж до 32 кг
            @endif
        </li>
        <li>
            <strong>Коментар до замовлення:</strong>
            {{ !empty($comment) ? $comment : 'Немає додаткових побажань' }}
        </li>
    </ul>
    <div style="margin-top: 25px; display: flex; gap: 15px; align-items: center;">
        <form method="GET" action="{{ route('site.say', ['message' => 'Оплата пройшла успішно! Ваш авіаквиток надіслано на ' . $email]) }}">
            <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: #fff; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">
                Перейти до оплати
            </button>
        </form>
    <p>
        <a href="{{ route('entry.form') }}">
            Повернутися до форми
        </a>
    </p>
@endsection
