<x-app-layout>
    <div class="bg-gradient-to-br from-blue-50 to-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Admin Dashboard</h1>
            <p class="text-gray-600">Manage hotels, reservations, and users</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Hotels</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['total_hotels'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Reservations</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['total_reservations'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Pending</p>
                        <p class="text-3xl font-bold text-yellow-600">{{ $stats['pending_reservations'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Users</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Revenue</p>
                        <p class="text-3xl font-bold text-green-600">${{ number_format($stats['total_revenue'], 2) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <a href="{{ route('admin.hotels.create') }}" class="bg-white border-2 border-blue-200 rounded-xl p-6 hover:border-blue-400 hover:shadow-lg transition text-center">
                <svg class="w-12 h-12 text-blue-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Add New Hotel</h3>
                <p class="text-sm text-gray-600">Create a new hotel listing</p>
            </a>

            <a href="{{ route('admin.hotels.index') }}" class="bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-gray-400 hover:shadow-lg transition text-center">
                <svg class="w-12 h-12 text-gray-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Manage Hotels</h3>
                <p class="text-sm text-gray-600">View and edit all hotels</p>
            </a>

            <a href="{{ route('admin.reservations.index') }}" class="bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-gray-400 hover:shadow-lg transition text-center">
                <svg class="w-12 h-12 text-gray-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Manage Reservations</h3>
                <p class="text-sm text-gray-600">View and update reservations</p>
            </a>
        </div>

        <!-- Recent Reservations -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm mb-8">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900">Recent Reservations</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hotel</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-in</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-out</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($recent_reservations as $reservation)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $reservation->hotel->name }}</div>
                                <div class="text-sm text-gray-500">{{ $reservation->hotel->city }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $reservation->user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $reservation->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $reservation->check_in->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $reservation->check_out->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">${{ number_format($reservation->total_price, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full
                                    @if($reservation->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($reservation->status === 'confirmed') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No reservations found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Popular Hotels -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900">Most Popular Hotels</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($popular_hotels as $hotel)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">{{ $hotel->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $hotel->city }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-blue-600">{{ $hotel->reservations_count }} reservations</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500 text-center">No hotels found</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>




