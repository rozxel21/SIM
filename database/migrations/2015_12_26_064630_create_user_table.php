<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_guid', 36)->unique();
            $table->string('firstname', 30);
            $table->string('middlename', 30);
            $table->string('lastname', 30);
            $table->string('username', 30)->unique();
            $table->string('email', 30)->unique();
            $table->string('password', 120);
            $table->string('credential', 20);
            $table->boolean('status')->default(true);
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
        Schema::drop('users');
    }
}
