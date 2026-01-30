{{-- resources/views/pimpinan/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Pimpinan')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- FONT INTER --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* RESET & BASE */
        * { margin:0; padding:0; box-sizing: border-box; }
        body {
            font-family: 'Inter', Arial, sans-serif;
            background: #f8fafc;
            color: #1e293b;
        }

        a { text-decoration: none; }

        /* HEADER */
        header {
            background: #1e293b;
            color: #fff;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        header h2 {
            font-size: 24px;
            font-weight: 700;
        }

        nav a {
            color: #e5e7eb;
            margin-left: 20px;
            font-weight: 500;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #0ea5e9;
        }

        /* MAIN CONTENT */
        main {
            padding: 30px 20px;
            max-width: 1200px;
            margin: auto;
        }

        /* FOOTER */
        footer {
            text-align: center;
            padding: 15px;
            font-size: 13px;
            color: #64748b;
            margin-top: 40px;
        }

        /* LOGOUT BUTTON MOBILE RESPONSIVE */
        @media(max-width:768px) {
            header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            nav a { margin-left: 0; margin-right: 15px; }
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
