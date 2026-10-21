@extends('layouts.app')
@section('title', 'SkyTicket — Контакти та підтримка')
@section('content')
    <h1>Контакти та служба підтримки SkyTicket</h1>
    <p>Маєте запитання щодо бронювання, зміни паспортних даних, норм багажу або повернення квитка? Наша служба підтримки працює для вас 24/7.</p>

    <div style="margin-bottom: 25px;">
        <h2>Гаряча лінія та онлайн-зв'язок</h2>
        <ul>
            <li><strong>Телефон підтримки (безкоштовно по Україні):</strong> 0 800 500 777</li>
            <li><strong>Міжнародна лінія (для дзвінків із-за кордону):</strong> +380 (44) 290-77-88</li>
            <li><strong>Електронна пошта для клієнтів:</strong> <a href="mailto:support@skyticket.ua">support@skyticket.ua</a></li>
            <li><strong>Корпоративний відділ та партнерство:</strong> <a href="mailto:b2b@skyticket.ua">b2b@skyticket.ua</a></li>
            <li><strong>Месенджери (24/7):</strong> Telegram (<code>@SkyTicketSupport_bot</code>), Viber</li>
        </ul>
    </div>

    <div style="margin-bottom: 25px;">
        <h2>Центральний офіс</h2>
        <p>
            <strong>Адреса:</strong> м. Київ, вул. Велика Васильківська, 100, БЦ «Sky Plaza», 5-й поверх.<br>
            <strong>Графік роботи офісу:</strong> Пн–Пт: 09:00 – 19:00, Сб–Нд: черговий онлайн-режим.
        </p>
    </div>

    <div style="background-color: #f9f9f9; padding: 15px; border-left: 4px solid #0056b3;">
        <h3>Порада для пасажирів</h3>
        <p style="margin: 0;">
            Якщо ви звертаєтеся щодо вже оформленого квитка, будь ласка, вкажіть у листі прізвище пасажира латиницею та контактний Email, який ви вводили під час заповнення <a href="{{ route('entry.form') }}">форми бронювання</a>.
        </p>
    </div>
@endsection
