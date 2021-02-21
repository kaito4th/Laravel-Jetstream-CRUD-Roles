<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Remarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->integer('late')->nullable();
            $table->integer('overtime')->nullable();
            $table->integer('sun_overtime')->nullable();
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
        Schema::dropIfExists('Remarks');
    }
}
