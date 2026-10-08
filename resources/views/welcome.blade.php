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
            <a href="{{ url('/about') }}">Про застосунок</a>
            <a href="{{ url('/contact') }}">Контакти</a>
        </nav>

    </div>
</header>


<main>
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
        &copy; {{ date('Y') }} КПІ ім. Ігоря Сікорського
    </div>

</footer>

</body>
</html>
