<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StaffAttendance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances' ,function (Blueprint $table){
            $table->id();
            $table->foreignId('user_id');
            $table->string('name');
            $table->integer('attendance_count');
            $table->integer('regular_day');
            $table->integer('half_day');
            $table->integer('sunday');
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
        Schema::dropIfExists('attendance');
    }
}