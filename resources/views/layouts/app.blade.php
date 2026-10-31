<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Система продажу авіаквитків')</title>

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

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 25px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        /* Основна частина */
        main {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
            min-height: 400px;
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

        .pagination {
            display: flex;
            gap: 4px;
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }
        /* Пагінація */
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
        &copy; {{ date('Y') }} КПІ ім. Ігоря Сікорського, РС-31, Сидорук Оля
    </div>

</footer>

</body>
</html>
