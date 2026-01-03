<x-app-layout>
    <div class="bg-gradient-to-br from-blue-50 to-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Manage Reservations</h1>
            <p class="text-gray-600">View and manage all hotel reservations</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hotel</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-in</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-out</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guests</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($reservations as $reservation)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $reservation->hotel->name }}</div>
                                <div class="text-sm text-gray-500">{{ $reservation->hotel->city }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $reservation->user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $reservation->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $reservation->check_in->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $reservation->check_out->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $reservation->guests }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">${{ number_format($reservation->total_price, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('admin.reservations.update-status', $reservation) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" 
                                        class="text-xs font-semibold rounded-full px-3 py-1 border-0
                                        @if($reservation->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($reservation->status === 'confirmed') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        <option value="pending" {{ $reservation->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $reservation->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="cancelled" {{ $reservation->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this reservation?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">No reservations found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $reservations->links() }}
            </div>
        </div>
    </div>
</x-app-layout>




