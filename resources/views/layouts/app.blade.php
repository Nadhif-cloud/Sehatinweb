<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Kelola Program Sehatin') — Sehatin</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/Sehatin.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/programs.css') }}">
</head>
<body>
    <header class="site-header">
        <div class="header-inner">
            <a class="brand" href="{{ asset('sehatin.html#hero') }}" aria-label="Sehatin, kembali ke beranda">
                <span class="brand-mark">
                    <img src="{{ asset('assets/Sehatin.svg') }}" alt="" width="24" height="24">
                </span>
                <span class="brand-name">Sehatin</span>
            </a>

            <nav class="primary-nav" aria-label="Navigasi utama">
                <a href="{{ asset('sehatin.html#hero') }}">Beranda</a>
                <a href="{{ asset('sehatin.html#fitur') }}">Fitur Utama</a>
                <a href="{{ asset('sehatin.html#kalkulator') }}">Kalkulator</a>
                <a href="{{ asset('sehatin.html#statistik') }}">Statistik</a>
                <a href="{{ asset('sehatin.html#agenda') }}">Menu Sehat</a>
                <a href="{{ asset('sehatin.html#tentang') }}">Tentang</a>
            </nav>

            <a class="header-action" href="{{ route('programs.index') }}" aria-current="page">Kelola Program</a>
        </div>
    </header>
    <main class="container">
        @yield('content')
    </main>
    @stack('scripts')
</body>
</html>
