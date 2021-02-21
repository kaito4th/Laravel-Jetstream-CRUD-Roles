<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OtherDeductions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Other_deductions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->date('deduction_date');
            $table->string('deduction_day');
            $table->decimal('deduction_value');
            $table->string('deduction_remarks');
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
        Schema::dropIfExists('Other_deductions');
    }
}
