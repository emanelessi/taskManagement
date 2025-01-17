<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
              rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-text antialiased">
        <div class="min-h-screen flex flex-col  justify-center items-center pt-6 sm:pt-0 bg-background ">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-text" />
                </a>
            </div>

            <div class="w-full md:max-w-md mt-6 px-6 py-4 bg-component   shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>

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
</html>
