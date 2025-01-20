<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'outlet_id' => 54,
                'supplier_name' => 'PT Elektronik Maju',
                'contact_info' => '081234567890',
                'address' => 'Jl. Elektronik No. 123, Jakarta',
                'is_default' => true,
                'user_id' => 59,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'outlet_id' => 54,
                'supplier_name' => 'CV Komputer Sejahtera',
                'contact_info' => '081234567891',
                'address' => 'Jl. Komputer No. 456, Bandung',
                'is_default' => false,
                'user_id' => 59,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'outlet_id' => 54,
                'supplier_name' => 'UD Gadget Berkah',
                'contact_info' => '081234567892',
                'address' => 'Jl. Gadget No. 789, Surabaya',
                'is_default' => false,
                'user_id' => 59,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'outlet_id' => 54,
                'supplier_name' => 'PT Network Solutions',
                'contact_info' => '081234567893',
                'address' => 'Jl. Network No. 321, Medan',
                'is_default' => false,
                'user_id' => 59,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'outlet_id' => 54,
                'supplier_name' => 'CV Print & Scan',
                'contact_info' => '081234567894',
                'address' => 'Jl. Printer No. 654, Semarang',
                'is_default' => false,
                'user_id' => 59,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'outlet_id' => 54,
                'supplier_name' => 'UD Gaming Pro',
                'contact_info' => '081234567895',
                'address' => 'Jl. Gaming No. 987, Yogyakarta',
                'is_default' => false,
                'user_id' => 59,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'outlet_id' => 54,
                'supplier_name' => 'PT Software House',
                'contact_info' => '081234567896',
                'address' => 'Jl. Software No. 147, Malang',
                'is_default' => false,
                'user_id' => 59,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'outlet_id' => 54,
                'supplier_name' => 'CV Security System',
                'contact_info' => '081234567897',
                'address' => 'Jl. Security No. 258, Palembang',
                'is_default' => false,
                'user_id' => 59,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'outlet_id' => 54,
                'supplier_name' => 'UD Smart Home',
                'contact_info' => '081234567898',
                'address' => 'Jl. Smart Home No. 369, Makassar',
                'is_default' => false,
                'user_id' => 59,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'outlet_id' => 54,
                'supplier_name' => 'PT Audio Visual',
                'contact_info' => '081234567899',
                'address' => 'Jl. Audio Visual No. 741, Denpasar',
                'is_default' => false,
                'user_id' => 59,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('suppliers')->insert($suppliers);
    }
}
