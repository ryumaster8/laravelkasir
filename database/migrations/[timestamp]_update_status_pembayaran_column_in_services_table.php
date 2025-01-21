<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->enum('status_pembayaran', ['Lunas', 'Belum Lunas', 'Uang Muka', 'Dibatalkan'])
                  ->default('Belum Lunas')
                  ->change();
        });
    }

    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('status_pembayaran')->change();
        });
    }
};
