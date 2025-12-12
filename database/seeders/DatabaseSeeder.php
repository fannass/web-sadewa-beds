<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user (petugas RS)
        User::factory()->create([
            'name' => 'Admin RSKIA Sadewa',
            'username' => 'admin',
            'email' => 'admin@rskiasadewa.com',
            'password' => bcrypt('Admin123!'),
            'role' => 'admin',
        ]);

        // Create sample rooms for Rawat Inap Ibu & Anak
        $rooms = [
            // Lantai 1 - Kelas 3 dan Reguler
            ['name' => 'Kamar Melati 101', 'room_type' => 'Kelas 3', 'floor' => 1, 'bed_count' => 4, 'facilities' => 'Kipas Angin, Kamar Mandi Bersama, Lemari'],
            ['name' => 'Kamar Melati 102', 'room_type' => 'Kelas 3', 'floor' => 1, 'bed_count' => 4, 'facilities' => 'Kipas Angin, Kamar Mandi Bersama, Lemari'],
            ['name' => 'Kamar Melati 103', 'room_type' => 'Reguler', 'floor' => 1, 'bed_count' => 2, 'facilities' => 'AC, Kamar Mandi Bersama'],

            // Lantai 2 - Kelas 1 dan 2
            ['name' => 'Kamar Mawar 201', 'room_type' => 'Kelas 2', 'floor' => 2, 'bed_count' => 2, 'facilities' => 'AC, TV, Kamar Mandi Dalam'],
            ['name' => 'Kamar Mawar 202', 'room_type' => 'Kelas 2', 'floor' => 2, 'bed_count' => 2, 'facilities' => 'AC, TV, Kamar Mandi Dalam'],
            ['name' => 'Kamar Mawar 203', 'room_type' => 'Kelas 1', 'floor' => 2, 'bed_count' => 1, 'facilities' => 'AC, TV, Kamar Mandi Dalam, Sofa, Kulkas'],
            ['name' => 'Kamar Mawar 204', 'room_type' => 'Kelas 1', 'floor' => 2, 'bed_count' => 1, 'facilities' => 'AC, TV, Kamar Mandi Dalam, Sofa, Kulkas'],

            // Lantai 3 - VIP dan VVIP
            ['name' => 'Kamar Anggrek 301', 'room_type' => 'VIP', 'floor' => 3, 'bed_count' => 1, 'facilities' => 'AC, TV, Kamar Mandi Dalam, Sofa Bed, Kulkas, Microwave'],
            ['name' => 'Kamar Anggrek 302', 'room_type' => 'VIP', 'floor' => 3, 'bed_count' => 1, 'facilities' => 'AC, TV, Kamar Mandi Dalam, Sofa Bed, Kulkas, Microwave'],
            ['name' => 'Suite Dahlia 303', 'room_type' => 'VVIP', 'floor' => 3, 'bed_count' => 1, 'facilities' => 'AC, Smart TV, Kamar Mandi Dalam, Ruang Tamu, Kulkas, Microwave, Water Heater'],
        ];

        $statuses = ['tersedia', 'terisi', 'dibersihkan'];

        foreach ($rooms as $room) {
            Room::create([
                'name' => $room['name'],
                'room_type' => $room['room_type'],
                'status' => $statuses[array_rand($statuses)],
                'floor' => $room['floor'],
                'bed_count' => $room['bed_count'],
                'facilities' => $room['facilities'],
                'notes' => null,
            ]);
        }
    }
}
