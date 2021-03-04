<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Increase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Increases', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('inc_date');
            $table->string('inc_day');
            $table->decimal('increase', 8,2);
            $table->string('inc_remarks');
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
        Schema::dropIfExists('Increases');
    }
}
