<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cash_registers', function (Blueprint $table) {
            $table->id('cash_register_id');
            $table->unsignedBigInteger('outlet_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('initial_cash', 15, 2)->default(0);
            $table->decimal('total_paid_in', 15, 2)->default(0);
            $table->decimal('total_paid_out', 15, 2)->default(0);
            $table->text('description')->nullable();
            $table->date('date');
            $table->timestamps();

            $table->foreign('outlet_id')->references('outlet_id')->on('outlets');
            $table->foreign('user_id')->references('user_id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cash_registers');
    }
};
