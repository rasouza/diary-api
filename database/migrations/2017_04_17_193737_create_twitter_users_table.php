<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTwitterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twitter_users', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('login')->unique();
            $table->text('bio')->nullable();
            $table->string('avatar')->nullable();
            $table->string('token');
            $table->string('token_secret');
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
        Schema::dropIfExists('twitter_users');
    }
}
