<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Program Management Sehatin: kelola data program kesehatan yang tersimpan di database.">
    <title>@yield('title', 'Program Management') &mdash; Sehatin</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/Sehatin.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body class="font-sans bg-slate-50 text-slate-800 leading-relaxed text-[15px] antialiased">
    <header class="bg-white border-b border-slate-200"><div class="max-w-[1200px] mx-auto px-6 py-4 flex items-center justify-between">
        <a href="{{ route('programs.index') }}" class="flex items-center gap-3"><img src="{{ asset('assets/Sehatin.svg') }}" alt="" class="w-10 h-10"><span class="text-xl font-bold tracking-tight text-slate-900">Sehatin</span></a>
        <a href="{{ config('sehatin.site_url') }}" class="text-sm font-semibold text-[#007789] hover:text-[#005a69]">Halaman utama</a>
    </div></header>
    <main><section class="py-16 sm:py-20 bg-white"><div class="max-w-[1200px] mx-auto px-6">
        <div class="text-center max-w-[700px] mx-auto mb-12 space-y-3">
            <span class="inline-flex items-center gap-1.5 text-xs font-bold px-3.5 py-1.5 rounded-full bg-teal-100 text-[#007789] uppercase tracking-wider">Program Sehatin</span>
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight">@yield('heading')</h1>
            <p class="text-base text-slate-500 leading-relaxed">@yield('subheading')</p>
        </div>

        @if (session('success'))
            <p class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-center text-sm text-emerald-700" role="status">{{ session('success') }}</p>
        @endif

        @yield('content')
    </div></section></main>
    <footer class="bg-slate-900 text-slate-400 py-8"><div class="max-w-[1200px] mx-auto px-6 text-center text-xs">&copy; {{ date('Y') }} Sehatin</div></footer>
    @stack('scripts')
</body>
</html>
