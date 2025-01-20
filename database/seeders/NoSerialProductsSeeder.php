<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NoSerialProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, delete product_stocks entries for products with serial numbers
        $serialProducts = DB::table('products')
            ->where('has_serial_number', true)
            ->pluck('product_id');
        
        DB::table('product_stock')
            ->whereIn('product_id', $serialProducts)
            ->delete();

        // Now insert products without serial numbers
        $products = [
            [
                'outlet_id' => 54,
                'category_id' => 15,
                'supplier_id' => 20,
                'product_name' => 'Screen Protector iPhone 14',
                'product_code' => 'ACC-SCR-IP14',
                'description' => 'Tempered Glass Screen Protector for iPhone 14 Series',
                'brand' => 'Generic',
                'unit' => 'Pcs',
                'has_serial_number' => false,
                'price_modal' => 50000,
                'price_grosir' => 75000,
                'price' => 100000,
                'user_id' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'outlet_id' => 54,
                'category_id' => 15,
                'supplier_id' => 20,
                'product_name' => 'Phone Case Samsung S23',
                'product_code' => 'ACC-CASE-S23',
                'description' => 'Premium Case for Samsung S23 Series',
                'brand' => 'Generic',
                'unit' => 'Pcs',
                'has_serial_number' => false,
                'price_modal' => 75000,
                'price_grosir' => 100000,
                'price' => 150000,
                'user_id' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'outlet_id' => 54,
                'category_id' => 16,
                'supplier_id' => 21,
                'product_name' => 'Laptop Cooling Pad',
                'product_code' => 'ACC-COOL-PAD',
                'description' => 'Laptop Cooling Pad with 5 Fans',
                'brand' => 'Generic',
                'unit' => 'Unit',
                'has_serial_number' => false,
                'price_modal' => 150000,
                'price_grosir' => 200000,
                'price' => 250000,
                'user_id' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'outlet_id' => 54,
                'category_id' => 17,
                'supplier_id' => 22,
                'product_name' => 'Mouse Pad Gaming XL',
                'product_code' => 'ACC-MP-XL',
                'description' => 'Extended Gaming Mouse Pad 90x40cm',
                'brand' => 'Generic',
                'unit' => 'Pcs',
                'has_serial_number' => false,
                'price_modal' => 80000,
                'price_grosir' => 100000,
                'price' => 150000,
                'user_id' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'outlet_id' => 54,
                'category_id' => 18,
                'supplier_id' => 23,
                'product_name' => 'Printer Paper A4',
                'product_code' => 'SUP-PPR-A4',
                'description' => 'A4 Printer Paper 80gsm (500 sheets)',
                'brand' => 'Generic',
                'unit' => 'Rim',
                'has_serial_number' => false,
                'price_modal' => 45000,
                'price_grosir' => 55000,
                'price' => 65000,
                'user_id' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert products
        foreach ($products as $product) {
            $productId = DB::table('products')->insertGetId($product);
            
            // Insert stock for each product
            DB::table('product_stock')->insert([
                'product_id' => $productId,
                'outlet_id' => 54,
                'stock' => rand(50, 100), // Higher stock for non-serial products
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
