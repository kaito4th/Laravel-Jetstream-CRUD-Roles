<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TotalGrossPay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Total_gross_pays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->decimal('total_gross', 8,2)->nullable();
            $table->decimal('basic_pay', 8,2)->nullable();
            $table->decimal('total_ot_pay', 8,2)->nullable();
            $table->decimal('total_sot_pay', 8,2)->nullable();
            $table->decimal('total_half_pay', 8,2)->nullable();
            $table->decimal('total_spl_pay', 8,2)->nullable();
            $table->decimal('allowance', 8,2)->nullable();
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
        Schema::dropIfExists('Total_gross_pays');
    }
}
