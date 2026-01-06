<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Book Your Perfect Stay in Morocco</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-white">
        <div class="min-h-screen bg-gradient-to-br from-blue-50 to-white flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            <div class="w-full sm:max-w-md">
                <div class="text-center mb-8">
                    <a href="{{ route('home') }}" class="inline-block">
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Moroccan Hotels</h1>
                        <p class="text-gray-600 text-sm">Book Your Perfect Stay</p>
                    </a>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-8">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
