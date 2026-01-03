<x-app-layout>
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Hotel Details -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl overflow-hidden border border-gray-200 mb-6">
                        @if($hotel->image)
                        <div class="relative h-96 overflow-hidden">
                            <img src="{{ $hotel->image }}" alt="{{ $hotel->name }}" class="w-full h-full object-cover">
                        </div>
                        @else
                        <div class="h-96 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        @endif
                        <div class="p-8">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $hotel->name }}</h1>
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span class="mr-4">{{ $hotel->city }}</span>
                                        @if($hotel->rating)
                                        <div class="flex items-center bg-blue-50 px-3 py-1 rounded">
                                            <svg class="w-4 h-4 text-yellow-400 fill-current mr-1" viewBox="0 0 20 20">
                                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                            </svg>
                                            <span class="text-sm font-semibold text-gray-700">{{ number_format($hotel->rating, 1) }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <p class="text-gray-700 leading-relaxed mb-6">{{ $hotel->description }}</p>
                            
                            <div class="border-t border-gray-200 pt-6 mb-6">
                                <h3 class="text-sm font-semibold text-gray-900 mb-2">Address</h3>
                                <p class="text-gray-600">{{ $hotel->address }}</p>
                            </div>
                            
                            @if($hotel->amenities && count($hotel->amenities) > 0)
                            <div class="border-t border-gray-200 pt-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Amenities</h3>
                                <div class="flex flex-wrap gap-3">
                                    @foreach($hotel->amenities as $amenity)
                                    <span class="px-4 py-2 bg-blue-50 text-blue-700 rounded-lg text-sm font-medium border border-blue-100">
                                        {{ $amenity }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Booking Form -->
                <div class="lg:col-span-1">
                    <div class="bg-white border-2 border-gray-200 rounded-xl p-6 sticky top-24 shadow-sm">
                        <div class="mb-6 pb-6 border-b border-gray-200">
                            <p class="text-4xl font-bold text-blue-600 mb-1">${{ number_format($hotel->price_per_night, 2) }}</p>
                            <p class="text-sm text-gray-600">per night</p>
                        </div>

                        @auth
                        <form method="POST" action="{{ route('reservations.store', $hotel) }}">
                            @csrf
                            
                            <div class="mb-4">
                                <label for="check_in" class="block text-sm font-semibold text-gray-700 mb-2">Check-in Date</label>
                                <input 
                                    id="check_in" 
                                    type="date" 
                                    name="check_in" 
                                    value="{{ old('check_in') }}" 
                                    required 
                                    min="{{ date('Y-m-d') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                />
                                @error('check_in')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="check_out" class="block text-sm font-semibold text-gray-700 mb-2">Check-out Date</label>
                                <input 
                                    id="check_out" 
                                    type="date" 
                                    name="check_out" 
                                    value="{{ old('check_out') }}" 
                                    required 
                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                />
                                @error('check_out')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="guests" class="block text-sm font-semibold text-gray-700 mb-2">Number of Guests</label>
                                <input 
                                    id="guests" 
                                    type="number" 
                                    name="guests" 
                                    value="{{ old('guests', 1) }}" 
                                    required 
                                    min="1" 
                                    max="10"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                />
                                @error('guests')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="w-full px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg transition transform hover:scale-105">
                                Book Now
                            </button>
                        </form>
                        @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <p class="text-gray-600 mb-6">Please login to make a reservation</p>
                            <a href="{{ route('login') }}" class="inline-block w-full px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg transition text-center">
                                Login to Book
                            </a>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
