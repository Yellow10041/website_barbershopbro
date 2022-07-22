<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Departments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->integer('city_id');
            $table->string('name');
            $table->char('first_work_day', 30);
            $table->char('last_work_day', 30);
            $table->integer('first_hour_work');
            $table->integer('first_minutes_work');
            $table->integer('last_hour_work');
            $table->integer('last_minutes_work');
            $table->string('phone_num');
            $table->string('address');
            $table->integer('map');
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
        //
    }
}
