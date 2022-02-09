<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->string('reg_id')->primary();
            $table->string('payment_id')->nullable();
            $table->bigInteger('event_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('status_id')->unsigned();
            $table->boolean('failsafe')->default(0);
            $table->boolean('vtx_power')->default(0);
            $table->timestamps();

            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                // Delete row if specific event is deleted
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('status_id')
                ->references('id')
                ->on('registration_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_registrations');
    }
}
