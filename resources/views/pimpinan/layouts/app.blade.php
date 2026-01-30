<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Pimpinan')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            margin: 0;
            font-family: Inter, Arial, sans-serif;
            background: #f8fafc;
        }
        header {
            background: #1e293b;
            color: white;
            padding: 16px 24px;
        }
        nav a {
            color: #e5e7eb;
            margin-right: 15px;
            text-decoration: none;
        }
        nav a:hover {
            text-decoration: underline;
        }
        main {
            padding: 30px;
        }
        footer {
            text-align: center;
            padding: 15px;
            font-size: 13px;
            color: #64748b;
        }
    </style>
</head>
<body>

<header>
    <h2>Panel Pimpinan</h2>
    <nav>
        <a href="{{ route('pimpinan.dashboard') }}">Dashboard</a>
        <a href="{{ route('pimpinan.logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           Logout
        </a>
    </nav>

    <form id="logout-form" action="{{ route('pimpinan.logout') }}" method="POST" style="display:none;">
        @csrf
    </form>
</header>

<main>
    @yield('content')
</main>

<footer>
    © {{ date('Y') }} Company Profile
</footer>

</body>
</html>
