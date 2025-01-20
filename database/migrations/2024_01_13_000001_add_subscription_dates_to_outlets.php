<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('outlets', function (Blueprint $table) {
            $table->date('membership_started_at')->nullable();
            $table->date('membership_expires_at')->nullable();
            $table->boolean('auto_renewal')->default(false);
            $table->enum('subscription_status', ['active', 'expiring_soon', 'expired'])->default('active');
        });
    }

    public function down()
    {
        Schema::table('outlets', function (Blueprint $table) {
            $table->dropColumn([
                'membership_started_at',
                'membership_expires_at',
                'auto_renewal',
                'subscription_status'
            ]);
        });
    }
};
