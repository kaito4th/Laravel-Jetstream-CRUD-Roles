<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StaffPayroll extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->decimal('daily_rate', 8,2);
            $table->decimal('overtime_rate', 8,2);
            $table->decimal('overtime_pay', 8,2);
            $table->decimal('sunday_rate', 8,2);
            $table->decimal('sunday_pay', 8,2)->nullable();
            $table->decimal('sundayOT_rate', 8,2)->nullable();
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
        Schema::dropIfExists('payroll');
    }
}
