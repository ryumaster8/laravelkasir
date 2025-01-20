<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSerialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all products with has_serial_number = true
        $products = DB::table('products')
            ->where('has_serial_number', true)
            ->get();

        $serials = [];
        foreach ($products as $product) {
            // Get stock count for this product
            $stock = DB::table('product_stock')
                ->where('product_id', $product->product_id)
                ->where('outlet_id', 54)
                ->value('stock');

            // Generate serials based on stock count
            for ($i = 1; $i <= $stock; $i++) {
                $serials[] = [
                    'product_id' => $product->product_id,
                    'outlet_id' => 54,
                    'serial_number' => sprintf('%s-%04d-%s', 
                        strtoupper(substr($product->product_name, 0, 3)),
                        $product->product_id,
                        str_pad($i, 4, '0', STR_PAD_LEFT)
                    ),
                    'status' => 'tersedia',
                    'user_id' => 60,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert serials
        DB::table('product_serials')->insert($serials);

        // Update product_code to null for products with serial numbers
        DB::table('products')
            ->where('has_serial_number', true)
            ->update(['product_code' => null]);
    }
}
