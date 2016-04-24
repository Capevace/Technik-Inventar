<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_rental');
            $table->string('name');
            $table->text('description');
            $table->string('recipent');
            $table->integer('leader')->unsigned();
            $table->timestamp('time_start');
            $table->timestamp('time_end');
            $table->timestamps();
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->foreign('leader')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jobs');
    }
}
