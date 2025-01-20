<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'category_name' => 'Smartphone',
                'outlet_id' => 54,
                'user_id' => 59,
                'is_default' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Laptop',
                'outlet_id' => 54,
                'user_id' => 59,
                'is_default' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Aksesoris Komputer',
                'outlet_id' => 54,
                'user_id' => 59,
                'is_default' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Printer & Scanner',
                'outlet_id' => 54,
                'user_id' => 59,
                'is_default' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Gaming',
                'outlet_id' => 54,
                'user_id' => 59,
                'is_default' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Networking',
                'outlet_id' => 54,
                'user_id' => 59,
                'is_default' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Smart Home',
                'outlet_id' => 54,
                'user_id' => 59,
                'is_default' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Audio & Speaker',
                'outlet_id' => 54,
                'user_id' => 59,
                'is_default' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Kamera & CCTV',
                'outlet_id' => 54,
                'user_id' => 59,
                'is_default' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Software & Lisensi',
                'outlet_id' => 54,
                'user_id' => 59,
                'is_default' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
