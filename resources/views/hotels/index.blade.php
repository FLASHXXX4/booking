<x-app-layout>
    <div class="bg-gradient-to-br from-blue-50 to-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Hotels in Morocco</h1>
            <p class="text-gray-600">Find your perfect stay in beautiful Moroccan cities</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Filters -->
        <div class="bg-white border border-gray-200 rounded-xl p-6 mb-8 shadow-sm">
            <form method="GET" action="{{ route('hotels.index') }}" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search Hotels</label>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Search by hotel name..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                    />
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                    <select name="city" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        <option value="">All Cities</option>
                        @foreach($cities as $city)
                        <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                        Search
                    </button>
                    @if(request('search') || request('city'))
                    <a href="{{ route('hotels.index') }}" class="px-6 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">
                        Clear
                    </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Hotels Grid -->
        @if($hotels->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($hotels as $hotel)
            <a href="{{ route('hotels.show', $hotel) }}" class="group">
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition">
                    @if($hotel->image)
                    <div class="relative h-56 overflow-hidden">
                        <img src="{{ $hotel->image }}" alt="{{ $hotel->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    @else
                    <div class="h-56 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    @endif
                    <div class="p-5">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition line-clamp-1">{{ $hotel->name }}</h3>
                            @if($hotel->rating)
                            <div class="flex items-center bg-blue-50 px-2 py-1 rounded flex-shrink-0 ml-2">
                                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                                <span class="ml-1 text-xs font-semibold text-gray-700">{{ number_format($hotel->rating, 1) }}</span>
                            </div>
                            @endif
                        </div>
                        <p class="text-gray-600 text-sm mb-3">{{ $hotel->city }}</p>
                        <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ Str::limit($hotel->description, 80) }}</p>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div>
                                <p class="text-xl font-bold text-blue-600">${{ number_format($hotel->price_per_night, 2) }}</p>
                                <p class="text-xs text-gray-500">per night</p>
                            </div>
                            <span class="text-blue-600 text-sm font-medium group-hover:translate-x-1 transition inline-block">View →</span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $hotels->links() }}
        </div>
        @else
        <div class="bg-white border border-gray-200 rounded-xl p-12 text-center">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-gray-600 text-lg mb-2">No hotels found</p>
            <p class="text-gray-500 text-sm">Try adjusting your search criteria</p>
        </div>
        @endif
    </div>
</x-app-layout>
