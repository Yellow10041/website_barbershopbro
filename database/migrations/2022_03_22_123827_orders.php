<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('city_id');
            $table->integer('department_id');
            $table->integer('user_id');
            $table->date('date');
            $table->integer('service');
            $table->integer('start_minutes');
            $table->integer('end_minutes');
            $table->integer('employee_id');
            $table->integer('status')->default(1);
            $table->integer('rating')->nullable();
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
