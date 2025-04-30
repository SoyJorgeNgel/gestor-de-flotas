<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ ('Trucker Logistic') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .app-background {
            background-image: url('{{ asset('images/background.jpg') }}');
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            }
        </style>
    </head>
    <body class="app-background">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <!-- <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-blue-500" />
                </a> -->
            </div>

            <div class="w-full sm:max-w-3xl mt-6 px-6 py-4 bg-blue-800 shadow-md overflow-hidden sm:rounded-lg">
                <div class="flex items-center justify-center">
                    <div class="text-center pb-4 w-1/6">
                        <img class="mx-auto" src="{{ asset('images/Logo.png') }}" alt="Imagen">
                    </div>
                    <div class="w-4/6 text-center text-4xl font-bold tracking-wide text-white">
                        <h1>Bienvenido</h1>
                    </div>
                    <div class="w-1/6"></div>
                </div>
                
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
