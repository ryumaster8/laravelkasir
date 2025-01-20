<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerpajakanSeeder extends Seeder
{
    public function run()
    {
        DB::table('perpajakan')->insert([
            'user_id' => 60,
            'outlet_id' => 54,
            'pajak' => 15.00,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
