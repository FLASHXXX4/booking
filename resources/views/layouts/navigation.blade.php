<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-gray-900">Booking</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 ml-10 sm:flex">
                    <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs('home') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-700 hover:text-blue-600' }} transition">
                        Home
                    </a>
                    <a href="{{ route('hotels.index') }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs('hotels.*') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-700 hover:text-blue-600' }} transition">
                        Hotels
                    </a>
                    @auth
                    <a href="{{ route('reservations.index') }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs('reservations.*') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-700 hover:text-blue-600' }} transition">
                        My Reservations
                    </a>
                    @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs('admin.*') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-700 hover:text-blue-600' }} transition">
                        Admin
                    </a>
                    @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none transition">
                            <span class="mr-2">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @else
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900">Login</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition">
                        Sign Up
                    </a>
                </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-gray-900 hover:bg-gray-100 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-gray-200">
        <div class="pt-4 pb-3 space-y-1 px-4">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-base font-medium {{ request()->routeIs('home') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:text-blue-600 hover:bg-gray-50' }} rounded-lg transition">
                Home
            </a>
            <a href="{{ route('hotels.index') }}" class="block px-3 py-2 text-base font-medium {{ request()->routeIs('hotels.*') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:text-blue-600 hover:bg-gray-50' }} rounded-lg transition">
                Hotels
            </a>
            @auth
            <a href="{{ route('reservations.index') }}" class="block px-3 py-2 text-base font-medium {{ request()->routeIs('reservations.*') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:text-blue-600 hover:bg-gray-50' }} rounded-lg transition">
                My Reservations
            </a>
            @if(Auth::user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-base font-medium {{ request()->routeIs('admin.*') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:text-blue-600 hover:bg-gray-50' }} rounded-lg transition">
                Admin Dashboard
            </a>
            @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
        <div class="pt-4 pb-4 border-t border-gray-200">
            <div class="px-4 mb-4">
                <div class="font-semibold text-base text-gray-900">{{ Auth::user()->name }}</div>
                <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="px-4 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition">
                    Profile
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-3 py-2 text-base font-medium text-gray-700 hover:text-red-600 hover:bg-gray-50 rounded-lg transition">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
        @else
        <div class="pt-4 pb-4 border-t border-gray-200">
            <div class="px-4 space-y-2">
                <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition">
                    Login
                </a>
                <a href="{{ route('register') }}" class="block px-3 py-2 text-base font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition text-center">
                    Sign Up
                </a>
            </div>
        </div>
        @endauth
    </div>
</nav>
