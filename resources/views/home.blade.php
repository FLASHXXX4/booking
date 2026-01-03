<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-blue-50 to-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-5xl font-bold text-gray-900 mb-6">Discover Amazing Hotels in Morocco</h1>
                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">Explore the beauty of Morocco through our curated selection of premium hotels in the most beautiful cities.</p>
                <a href="{{ route('hotels.index') }}" class="inline-block px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg transition transform hover:scale-105">
                    Browse All Hotels
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Popular Cities -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Popular Destinations</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach($cities as $city)
                <a href="{{ route('hotels.index', ['city' => $city]) }}" class="group">
                    <div class="bg-white border border-gray-200 rounded-xl p-6 text-center hover:shadow-lg hover:border-blue-300 transition">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-200 transition">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition">{{ $city }}</h3>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        <!-- Featured Hotels -->
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Featured Hotels</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredHotels as $hotel)
                <a href="{{ route('hotels.show', $hotel) }}" class="group">
                    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition">
                        @if($hotel->image)
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ $hotel->image }}" alt="{{ $hotel->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                        @else
                        <div class="h-64 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        @endif
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-2">
                                <h3 class="text-xl font-semibold text-gray-900 group-hover:text-blue-600 transition">{{ $hotel->name }}</h3>
                                @if($hotel->rating)
                                <div class="flex items-center bg-blue-50 px-2 py-1 rounded">
                                    <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                    <span class="ml-1 text-sm font-semibold text-gray-700">{{ number_format($hotel->rating, 1) }}</span>
                                </div>
                                @endif
                            </div>
                            <p class="text-gray-600 text-sm mb-4">{{ $hotel->city }}</p>
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-2xl font-bold text-blue-600">${{ number_format($hotel->price_per_night, 2) }}</p>
                                    <p class="text-xs text-gray-500">per night</p>
                                </div>
                                <span class="text-blue-600 font-medium group-hover:translate-x-1 transition">View Details →</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
