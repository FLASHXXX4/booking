<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cities = ['Marrakech', 'Casablanca', 'Rabat', 'Tangier', 'Fes', 'Agadir', 'Meknes', 'Ouarzazate'];
        $city = $this->faker->randomElement($cities);
        
        $amenities = [
            ['WiFi', 'Pool', 'Spa', 'Restaurant', 'Parking'],
            ['WiFi', 'Pool', 'Gym', 'Restaurant', 'Bar'],
            ['WiFi', 'Spa', 'Restaurant', 'Room Service', 'Concierge'],
            ['WiFi', 'Pool', 'Beach Access', 'Restaurant', 'WiFi'],
            ['WiFi', 'Gym', 'Restaurant', 'Business Center', 'Parking'],
        ];

        return [
            'name' => $this->faker->company() . ' Hotel',
            'city' => $city,
            'description' => $this->faker->paragraph(3),
            'address' => $this->faker->streetAddress() . ', ' . $city,
            'price_per_night' => $this->faker->randomFloat(2, 50, 500),
            'rating' => $this->faker->randomFloat(1, 3.0, 5.0),
            'image' => 'https://images.unsplash.com/photo-' . $this->faker->numerify('##########') . '?w=800&h=600&fit=crop',
            'amenities' => $this->faker->randomElement($amenities),
        ];
    }
}
