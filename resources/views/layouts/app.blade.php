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
        <div class="min-h-screen bg-white">
            @include('layouts.navigation')

            <!-- Flash Messages -->
            @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-green-50 border-l-4 border-green-400 text-green-700 px-4 py-3 rounded shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-red-50 border-l-4 border-red-400 text-red-700 px-4 py-3 rounded shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            </div>
            @endif

            <!-- Page Content -->
            <main class="bg-white">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 mt-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Moroccan Hotels</h3>
                            <p class="text-gray-600 text-sm">Discover the best hotels across Morocco. Book your perfect stay with us.</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900 mb-4">Quick Links</h4>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li><a href="{{ route('home') }}" class="hover:text-gray-900">Home</a></li>
                                <li><a href="{{ route('hotels.index') }}" class="hover:text-gray-900">Browse Hotels</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900 mb-4">Popular Cities</h4>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li><a href="{{ route('hotels.index', ['city' => 'Marrakech']) }}" class="hover:text-gray-900">Marrakech</a></li>
                                <li><a href="{{ route('hotels.index', ['city' => 'Casablanca']) }}" class="hover:text-gray-900">Casablanca</a></li>
                                <li><a href="{{ route('hotels.index', ['city' => 'Rabat']) }}" class="hover:text-gray-900">Rabat</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900 mb-4">Account</h4>
                            <ul class="space-y-2 text-sm text-gray-600">
                                @auth
                                <li><a href="{{ route('reservations.index') }}" class="hover:text-gray-900">My Reservations</a></li>
                                <li><a href="{{ route('profile.edit') }}" class="hover:text-gray-900">Profile</a></li>
                                @else
                                <li><a href="{{ route('login') }}" class="hover:text-gray-900">Login</a></li>
                                <li><a href="{{ route('register') }}" class="hover:text-gray-900">Register</a></li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                    <div class="mt-8 pt-8 border-t border-gray-200 text-center text-sm text-gray-600">
                        <p>&copy; {{ date('Y') }} Moroccan Hotels. All rights reserved.</p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
