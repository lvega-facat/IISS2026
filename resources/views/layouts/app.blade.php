
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mi App')</title>
</head>
<body>

    <header>
        <h1>Mi sistema</h1>
    </header>

    <nav>
        Menú aquí
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        © 2026
    </footer>

</body>
</html>
