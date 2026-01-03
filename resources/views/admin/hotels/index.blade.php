<x-app-layout>
    <div class="bg-gradient-to-br from-blue-50 to-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Manage Hotels</h1>
                    <p class="text-gray-600">View, edit, and delete hotels</p>
                </div>
                <a href="{{ route('admin.hotels.create') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg transition">
                    + Add New Hotel
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hotel</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">City</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price/Night</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($hotels as $hotel)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $hotel->name }}</div>
                                <div class="text-sm text-gray-500 line-clamp-1">{{ Str::limit($hotel->description, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $hotel->city }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">${{ number_format($hotel->price_per_night, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($hotel->rating)
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-yellow-400 fill-current mr-1" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                    <span class="text-sm text-gray-900">{{ number_format($hotel->rating, 1) }}</span>
                                </div>
                                @else
                                <span class="text-sm text-gray-400">N/A</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.hotels.edit', $hotel) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                    <form action="{{ route('admin.hotels.destroy', $hotel) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this hotel?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No hotels found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $hotels->links() }}
            </div>
        </div>
    </div>
</x-app-layout>




