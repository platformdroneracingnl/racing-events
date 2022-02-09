<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('organization_id')->unsigned()->nullable();
            $table->string('email')->nullable();
            $table->string('name');
            $table->string('category');
            $table->date('date');
            $table->bigInteger('max_registrations');
            $table->bigInteger('location_id')->unsigned();
            $table->dateTime('start_registration');
            $table->dateTime('end_registration');
            $table->float('price', 5, 2);
            $table->boolean('online');
            $table->boolean('registration');
            $table->boolean('mollie_payments');
            $table->boolean('waitlist');
            $table->boolean('google_calendar');
            $table->longText('description');
            $table->string('docs_link')->nullable();
            $table->string('google_calendar_id')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('location_id')
                ->references('id')
                ->on('locations');
            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
