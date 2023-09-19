<?php

namespace Database\Seeders;

use App\Models\Camp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $camps = [
            [
                'title' => 'Gila Belajar',
                'slug' => 'gila-belajar',
                'price' => 280,
                'created_at' => date('Y:m:d H:i:s'),
                'updated_at' => date('Y:m:d H:i:s'),
            ],
            [
                'title' => 'Baru Mulai',
                'slug' => 'baru-mulai',
                'price' => 140,
                'created_at' => date('Y:m:d H:i:s'),
                'updated_at' => date('Y:m:d H:i:s'),
            ]
        ];

        foreach ($camps as $camp) {
            Camp::create($camp);
        }
    }
}
