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
        Schema::create('work_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employees_id')->nullable();
            $table->string('name')->nullable();
            $table->date('date_work')->nullable();
            $table->time('morning_shift')->nullable();
            $table->time('break_time')->nullable();
            $table->time('evening_shift')->nullable();
            $table->decimal('total_moneys')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_schedules');
    }
};
