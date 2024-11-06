<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('calculate_salary_details', function (Blueprint $table) {
            $table->id();
            $table->integer('calculate_salary_id')->comment('Id Roster');
            $table->integer('employee_id')->comment('รหัสพนักงาน');
            $table->date('date');
            $table->time('morning_shift')->nullable();
            $table->time('morning_end')->nullable();
            $table->time('evening_shift')->nullable();
            $table->time('evening_end')->nullable();
            $table->decimal('working_hours')->nullable()->comment('ชั่วโมงทำงาน');
            $table->enum('is_active', ['Y','N'])->default('Y');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calculate_salary_details');
    }
};
