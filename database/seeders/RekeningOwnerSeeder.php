<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModelRekeningOwner;

class RekeningOwnerSeeder extends Seeder
{
    public function run()
    {
        ModelRekeningOwner::create([
            'email' => 'owner@example.com',
            'bank_name' => 'BCA',
            'account_number' => '1234567890',
            'account_name' => 'NAMA PEMILIK',
            'is_active' => true,
            'is_default' => true
        ]);

        ModelRekeningOwner::create([
            'email' => 'owner@example.com',
            'bank_name' => 'MANDIRI',
            'account_number' => '0987654321',
            'account_name' => 'NAMA PEMILIK',
            'is_active' => true,
            'is_default' => false
        ]);
    }
}
