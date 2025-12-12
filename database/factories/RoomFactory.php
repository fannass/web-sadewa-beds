<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $roomTypes = ['VIP', 'VVIP', 'Kelas 1', 'Kelas 2', 'Kelas 3', 'Reguler'];
        $facilities = [
            'AC, TV, Kamar Mandi Dalam, Sofa',
            'AC, TV, Kamar Mandi Dalam',
            'AC, Kamar Mandi Dalam',
            'Kipas Angin, Kamar Mandi Bersama',
        ];

        return [
            'name' => 'Kamar ' . fake()->unique()->numberBetween(101, 399),
            'room_type' => fake()->randomElement($roomTypes),
            'status' => fake()->randomElement(['tersedia', 'terisi', 'dibersihkan']),
            'floor' => fake()->numberBetween(1, 3),
            'bed_count' => fake()->numberBetween(1, 4),
            'facilities' => fake()->randomElement($facilities),
            'notes' => null,
        ];
    }
}
