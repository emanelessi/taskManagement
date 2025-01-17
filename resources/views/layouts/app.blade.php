<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased ">
<div class="min-h-screen bg-background">
    @include('layouts.navigation')
    <div class="flex h-screen">
        @include('layouts.sidebar')
        <main class="flex-1 p-6 overflow-auto">
            <h1 class="text-2xl font-bold mb-4 capitalize text-text">
                {{ __(str_replace('.', ' ', Route::currentRouteName())) }}
            </h1>

            {{ $slot }}
        </main>
    </div>
    @include('layouts.footer')
</div>

<script>
    function switchTheme(theme) {
        document.documentElement.className = theme;
        localStorage.setItem('theme', theme);
    }

    function loadTheme() {
        const savedTheme = localStorage.getItem('theme') || 'theme-light';
        document.documentElement.className = savedTheme;
    }

    window.onload = loadTheme;
</script>
</body>
</html>
