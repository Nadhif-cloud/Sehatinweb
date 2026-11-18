<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Kelola Program Sehatin') — Sehatin</title>
    <link rel="stylesheet" href="{{ asset('css/programs.css') }}">
</head>
<body>
    <header class="site-header">
        <a class="brand" href="{{ route('programs.index') }}">Sehatin <span>Program Kesehatan</span></a>
        <a class="header-link" href="{{ asset('sehatin.html') }}">Halaman utama</a>
    </header>
    <main class="container">
        @yield('content')
    </main>
</body>
</html>
