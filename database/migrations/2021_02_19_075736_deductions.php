<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Deductions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Deductions', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->decimal('SSS_premium')->default(0)->nullable();
            $table->decimal('SSS_loan')->default(0)->nullable();
            $table->decimal('philhealth')->default(0)->nullable();
            $table->decimal('pagibig')->default(0)->nullable();
            $table->decimal('pagibig_loan')->default(0)->nullable();
            $table->decimal('tax')->default(0)->nullable();
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
        Schema::dropIfExists('Deductions');
    }
}
