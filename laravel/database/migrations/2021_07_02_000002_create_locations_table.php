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
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('house_number')->nullable();
            $table->string('street');
            $table->string('zip_code');
            $table->string('city');
            $table->string('province');
            $table->bigInteger('country')->unsigned();
            $table->string('category');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();

            $table->foreign('country')
                ->references('id')
                ->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
};
