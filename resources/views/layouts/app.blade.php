<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Система продажу авіаквитків')</title>

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f6fa;
            color: #222;
        }

        /* Верхнє меню */
        header {
            background-color: #123b63;
            padding: 20px 40px;
            color: white;
        }

        .header-content {
            max-width: 1100px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
        }

        header nav a {
            color: white;
            text-decoration: none;
            margin-left: 25px;
        }

        header nav a:hover {
            text-decoration: underline;
        }

        /* Основна частина */
        main {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
            min-height: 400px;
        }

        /* Заголовки сторінок */
        main h1 {
            font-size: 26px;
            font-weight: bold;
            color: #123b63;
            margin-top: 0;
            margin-bottom: 14px;
        }

        /* Перемикач мови */
        .lang-switcher {
            margin-bottom: 18px;
            font-size: 14px;
        }

        .lang-switcher a {
            color: #123b63;
            text-decoration: none;
            padding: 2px 6px;
            border-radius: 4px;
        }

        .lang-switcher a:hover {
            background-color: #e8eff6;
        }

        /* Кнопка "Додати рейс" та інші основні кнопки-посилання */
        a[href*="/flight/create"], .btn-add, .btn-primary {
            display: inline-block;
            background-color: #123b63;
            color: #ffffff !important;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            margin: 6px 0 18px 0;
            transition: background-color 0.2s;
        }

        a[href*="/flight/create"]:hover, .btn-add:hover, .btn-primary:hover {
            background-color: #0d2a47;
        }

        /* Таблиця рейсів */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }

        table thead {
            background-color: #123b63;
            color: #ffffff;
        }

        table th {
            padding: 12px 16px;
            text-align: left;
            font-weight: bold;
            font-size: 14px;
        }

        table td {
            padding: 12px 16px;
            border-bottom: 1px solid #e1e8f0;
            font-size: 14px;
            color: #222;
            vertical-align: middle;
        }

        table tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        table tbody tr:hover {
            background-color: #eef4fa;
        }

        table td a {
            color: #123b63;
            font-weight: bold;
            text-decoration: none;
        }

        table td a:hover {
            text-decoration: underline;
        }

        /* Кнопка "Редагувати" у таблиці */
        table td a[href*="/edit"], .btn-edit {
            display: inline-block;
            background-color: #e8eff6;
            color: #123b63 !important;
            border: 1px solid #c5d3e0;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: bold;
            text-decoration: none;
            transition: all 0.2s;
        }

        table td a[href*="/edit"]:hover, .btn-edit:hover {
            background-color: #123b63;
            color: #ffffff !important;
            border-color: #123b63;
        }

        /* Форми створення та редагування (create / edit) */
        main form {
            background-color: #ffffff;
            padding: 28px 32px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            max-width: 760px;
            margin-top: 16px;
            margin-bottom: 30px;
        }

        /* Якщо це маленька форма видалення всередині таблиці чи сторінки show */
        form[action*="destroy"] {
            background: transparent;
            padding: 0;
            box-shadow: none;
            margin: 10px 0;
            display: inline-block;
        }

        fieldset {
            border: 1px solid #c5d3e0;
            border-radius: 6px;
            padding: 18px 22px 10px 22px;
            margin-bottom: 20px;
            background-color: #f8fafc;
        }

        legend {
            font-weight: bold;
            color: #123b63;
            padding: 0 8px;
            font-size: 15px;
        }

        form div, form p {
            margin-bottom: 14px;
        }

        label {
            display: block;
            font-weight: bold;
            font-size: 14px;
            color: #222;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            max-width: 100%;
            padding: 9px 12px;
            border: 1px solid #c5d3e0;
            border-radius: 5px;
            font-size: 14px;
            color: #222;
            background-color: #ffffff;
            box-sizing: border-box;
            margin-top: 4px;
            margin-bottom: 10px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #123b63;
            box-shadow: 0 0 0 3px rgba(18, 59, 99, 0.15);
        }

        input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #123b63;
            vertical-align: middle;
            margin-right: 6px;
            cursor: pointer;
        }

        /* Кнопки відправки форми ("Зберегти зміни", "Створити") */
        button[type="submit"],
        input[type="submit"],
        form button {
            display: inline-block;
            background-color: #123b63;
            color: #ffffff;
            font-weight: bold;
            font-size: 14px;
            padding: 10px 22px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 8px;
            transition: background-color 0.2s;
        }

        button[type="submit"]:hover,
        form button:hover {
            background-color: #0d2a47;
        }

        /* Червона кнопка видалення */
        form[action*="destroy"] button {
            background-color: #dc2626;
        }

        form[action*="destroy"] button:hover {
            background-color: #b91c1c;
        }

        /* Повідомлення про помилки валідації */
        .error, .text-danger, .invalid-feedback {
            color: #dc2626;
            font-size: 13px;
            margin-top: -6px;
            margin-bottom: 10px;
        }

        /* Пагінація */
        .pagination {
            display: flex;
            gap: 4px;
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }

        .pagination li a,
        .pagination li span {
            display: block;
            padding: 4px 10px;
            font-size: 14px;
            border: 1px solid #c5d3e0;
            border-radius: 4px;
            background: #fff;
            color: #123b63;
            text-decoration: none;
        }

        .pagination li a:hover {
            background: #e8eff6;
        }

        .pagination li.active span {
            background: #123b63;
            border-color: #123b63;
            color: #fff;
        }

        .pagination li.disabled span {
            color: #9aa9b8;
            background: #f2f6fa;
        }

        /* Footer */
        footer {
            background-color: #123b63;
            color: white;
            text-align: center;
            padding: 25px;
            margin-top: 40px;
        }

        .footer-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .footer-text {
            color: #cbd9e6;
            font-size: 14px;
        }

        main h2, main h3 {
            font-size: 20px;
            color: #123b63;
            margin-top: 24px;
            margin-bottom: 12px;
            border-bottom: 2px solid #e1e8f0;
            padding-bottom: 6px;
            max-width: 760px;
        }

        main p, main ul {
            font-size: 15px;
            line-height: 1.6;
            margin: 8px 0;
            max-width: 760px;
        }

        /* Список тарифів на сторінці деталей */
        main ul {
            background: #ffffff;
            padding: 16px 20px 16px 36px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border: 1px solid #e1e8f0;
        }

        main ul li {
            margin-bottom: 6px;
        }

        main a[href*="/edit"] {
            display: inline-block;
            background-color: #123b63;
            color: #ffffff !important;
            padding: 9px 18px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            margin-top: 14px;
            margin-right: 10px;
            transition: background-color 0.2s;
        }

        main a[href*="/edit"]:hover {
            background-color: #0d2a47;
        }

        main a[href$="/flight"] {
            display: inline-block;
            background-color: #e8eff6;
            color: #123b63 !important;
            border: 1px solid #c5d3e0;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            margin-top: 14px;
            margin-right: 10px;
            transition: background-color 0.2s;
        }

        main a[href$="/flight"]:hover {
            background-color: #d5e3f0;
        }

        main form:has(input[value="DELETE"]) {
            background: transparent;
            padding: 0;
            box-shadow: none;
            margin: 14px 0 0 0;
            display: inline-block;
            max-width: none;
        }

        main form:has(input[value="DELETE"]) button {
            background-color: #dc2626;
            margin-top: 0;
            padding: 9px 18px;
        }

        main form:has(input[value="DELETE"]) button:hover {
            background-color: #b91c1c;
        }
    </style>
</head>

<body>

<header>
<div class="header-content">

    <div class="logo">
        ✈ SkyTicket
    </div>

    <nav>
        <a href="{{ url('/') }}">Головна</a>
        <a href="{{ route('flight.index') }}">Рейси</a>
        <a href="{{ url('/about') }}">Про застосунок</a>
        <a href="{{ url('/contact') }}">Контакти</a>
        <a href="{{ route('stats.pages') }}">Статистика</a>
        <a href="{{ route('stats.flights') }}">Популярні рейси</a>
    </nav>

</div>
</header>


<main>
@if (session('success'))
    <p style="background:#d4edda; color:#155724; padding:10px; border-radius:5px;">
        {{ session('success') }}
    </p>
@endif
@yield('content')
</main>


<footer>

<div class="footer-title">
    ✈ SkyTicket
</div>

<div class="footer-text">
    Система продажу авіаквитків
</div>

<div class="footer-text">
    Виконала Сидорук Оля, РС-31
</div>

</footer>
@stack('scripts')
</body>
</html>
