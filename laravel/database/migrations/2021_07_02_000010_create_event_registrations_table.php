<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->string('reg_id')->primary();
            $table->string('payment_id')->nullable();
            // Delete row if specific event is deleted
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('status_id')->constrained('registration_status');
            $table->boolean('failsafe')->default(0);
            $table->boolean('vtx_power')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};
