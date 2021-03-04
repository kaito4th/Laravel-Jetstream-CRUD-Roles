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
            $table->string('user_id');
            $table->string('deduction_date')->nullable();
            $table->string('deduction_day')->nullable();
            $table->decimal('deduction_value');
            $table->string('deduction_remarks')->nullable();
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
