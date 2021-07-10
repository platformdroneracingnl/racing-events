<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('country')->unsigned()->nullable();
            $table->string('pilot_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phonenumber')->nullable();
            $table->bigInteger('organization_id')->nullable()->unsigned();
            $table->bigInteger('race_team_id')->nullable()->unsigned();
            $table->timestamp('suspended_until')->nullable();
            $table->string('image')->nullable();
            $table->rememberToken();
            $table->bigInteger('settings')->unsigned()->default(0);
            $table->timestamps();

            $table->foreign('country')
                ->references('id')
                ->on('countries');
            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations');
            $table->foreign('race_team_id')
                ->references('id')
                ->on('race_teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
