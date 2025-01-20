<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\SupplierSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductAndStockSeeder;
use Database\Seeders\ProductSerialsSeeder;
use Database\Seeders\NoSerialProductsSeeder;
use Database\Seeders\RekeningOwnerSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        
        $this->call([
            SupplierSeeder::class,
            CategorySeeder::class,
            ProductAndStockSeeder::class,
            ProductSerialsSeeder::class,
            NoSerialProductsSeeder::class,
            RekeningOwnerSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
