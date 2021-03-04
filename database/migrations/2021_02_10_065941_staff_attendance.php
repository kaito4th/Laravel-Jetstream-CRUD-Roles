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
            $table->string('user_id');
            $table->integer('attendance_count')->default(0)->nullable();
            $table->integer('regular_day')->default(0)->nullable();
            $table->integer('half_day')->default(0)->nullable();
            $table->integer('sunday')->default(0)->nullable();
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
