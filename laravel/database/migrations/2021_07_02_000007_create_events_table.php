<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('organization_id')->nullable()->constrained('organizations');
            $table->string('email')->nullable();
            $table->string('name');
            $table->string('category');
            $table->date('date');
            $table->bigInteger('max_registrations');
            $table->foreignId('location_id')->constrained('locations');
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
};
