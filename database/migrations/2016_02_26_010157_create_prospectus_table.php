<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProspectusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospectus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prospectus_guid', 36)->unique();
            $table->string('catalog_no', 36);
            $table->string('curriculum', 36);
            $table->string('year', 10);
            $table->string('semester', 10);
            $table->string('type', 10)->nullable();
            $table->string('reference', 36)->nullable();
            $table->timestamps();
            $table->boolean('status')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('prospectus');
    }
}
