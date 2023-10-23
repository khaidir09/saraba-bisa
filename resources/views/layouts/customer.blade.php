<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        @livewireStyles

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body
        class="font-inter antialiased bg-slate-100 text-slate-600"
    >

        <!-- Page wrapper -->
        <div class="flex">

            <!-- Content area -->
            <div class="relative flex flex-col flex-1">

                <main>
                    {{ $slot }}
                </main>

            </div>

        </div>

        @livewireScripts
    </body>
</html>
