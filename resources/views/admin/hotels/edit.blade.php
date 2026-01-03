<x-app-layout>
    <div class="bg-gradient-to-br from-blue-50 to-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Edit Hotel</h1>
            <p class="text-gray-600">Update hotel information</p>
        </div>
    </div>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-8">
            <form method="POST" action="{{ route('admin.hotels.update', $hotel) }}">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Hotel Name *</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $hotel->name) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="city" class="block text-sm font-semibold text-gray-700 mb-2">City *</label>
                        <input type="text" name="city" id="city" value="{{ old('city', $hotel->city) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        @error('city')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description *</label>
                        <textarea name="description" id="description" rows="4" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">{{ old('description', $hotel->description) }}</textarea>
                        @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Address *</label>
                        <input type="text" name="address" id="address" value="{{ old('address', $hotel->address) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="price_per_night" class="block text-sm font-semibold text-gray-700 mb-2">Price per Night *</label>
                            <input type="number" name="price_per_night" id="price_per_night" value="{{ old('price_per_night', $hotel->price_per_night) }}" step="0.01" min="0" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                            @error('price_per_night')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="rating" class="block text-sm font-semibold text-gray-700 mb-2">Rating (0-5)</label>
                            <input type="number" name="rating" id="rating" value="{{ old('rating', $hotel->rating) }}" step="0.1" min="0" max="5"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                            @error('rating')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Image URL</label>
                        <input type="url" name="image" id="image" value="{{ old('image', $hotel->image) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Amenities</label>
                        <div class="grid grid-cols-3 gap-2">
                            @php
                            $commonAmenities = ['WiFi', 'Pool', 'Spa', 'Restaurant', 'Bar', 'Gym', 'Parking', 'Room Service', 'Concierge', 'Beach Access'];
                            $currentAmenities = old('amenities', $hotel->amenities ?? []);
                            @endphp
                            @foreach($commonAmenities as $amenity)
                            <label class="flex items-center">
                                <input type="checkbox" name="amenities[]" value="{{ $amenity }}" 
                                    {{ in_array($amenity, $currentAmenities) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">{{ $amenity }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-end space-x-4">
                    <a href="{{ route('admin.hotels.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg transition">
                        Update Hotel
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>




