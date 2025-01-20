<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('membership_upgrade_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outlet_id')->constrained('outlets')->onDelete('cascade');
            $table->foreignId('current_membership_id')->constrained('memberships');
            $table->foreignId('requested_membership_id')->constrained('memberships');
            $table->decimal('upgrade_fee', 10, 2);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('notes')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
        });

        // Jika ada status_upgrade di tabel lama, bisa migrasi datanya disini
        if (Schema::hasColumn('outlets', 'status_upgrade')) {
            Schema::table('outlets', function (Blueprint $table) {
                $table->dropColumn('status_upgrade');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('membership_upgrade_requests');
    }
};
