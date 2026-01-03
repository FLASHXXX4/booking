<x-app-layout>
    <div class="bg-gradient-to-br from-blue-50 to-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">My Reservations</h1>
            <p class="text-gray-600">View and manage your hotel bookings</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($reservations->count() > 0)
        <div class="space-y-6">
            @foreach($reservations as $reservation)
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition">
                <div class="p-6">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-2">
                                        <a href="{{ route('hotels.show', $reservation->hotel) }}" class="hover:text-blue-600 transition">
                                            {{ $reservation->hotel->name }}
                                        </a>
                                    </h3>
                                    <div class="flex items-center text-gray-600 mb-4">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span>{{ $reservation->hotel->city }}</span>
                                    </div>
                                </div>
                                <span class="px-4 py-2 rounded-full text-sm font-semibold
                                    @if($reservation->status === 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                                    @elseif($reservation->status === 'confirmed') bg-green-100 text-green-800 border border-green-200
                                    @else bg-red-100 text-red-800 border border-red-200
                                    @endif">
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-xs text-gray-500 mb-1">Check-in</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $reservation->check_in->format('M d, Y') }}</p>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-xs text-gray-500 mb-1">Check-out</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $reservation->check_out->format('M d, Y') }}</p>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-xs text-gray-500 mb-1">Guests</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $reservation->guests }}</p>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-xs text-gray-500 mb-1">Nights</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $reservation->check_in->diffInDays($reservation->check_out) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="lg:text-right lg:border-l lg:border-gray-200 lg:pl-6">
                            <p class="text-3xl font-bold text-blue-600 mb-2">${{ number_format($reservation->total_price, 2) }}</p>
                            <p class="text-sm text-gray-500">Total Price</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="bg-white border border-gray-200 rounded-xl p-12 text-center">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <p class="text-gray-600 text-lg mb-2">No reservations yet</p>
            <p class="text-gray-500 text-sm mb-6">Start exploring our amazing hotels</p>
            <a href="{{ route('hotels.index') }}" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg transition">
                Browse Hotels
            </a>
        </div>
        @endif
    </div>
</x-app-layout>
