<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomType;

class RoomTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Reguler', 'description' => 'Kamar rawat inap standar', 'sort_order' => 1],
            ['name' => 'Kelas 3', 'description' => 'Kamar kelas 3 dengan fasilitas dasar', 'sort_order' => 2],
            ['name' => 'Kelas 2', 'description' => 'Kamar kelas 2 dengan fasilitas menengah', 'sort_order' => 3],
            ['name' => 'Kelas 1', 'description' => 'Kamar kelas 1 dengan fasilitas lengkap', 'sort_order' => 4],
            ['name' => 'VIP', 'description' => 'Kamar VIP dengan fasilitas premium', 'sort_order' => 5],
            ['name' => 'VVIP', 'description' => 'Kamar VVIP dengan fasilitas eksklusif', 'sort_order' => 6],
        ];

        foreach ($types as $type) {
            RoomType::firstOrCreate(
                ['name' => $type['name']],
                $type
            );
        }
    }
}
