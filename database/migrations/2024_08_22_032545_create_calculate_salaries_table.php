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
        Schema::create('calculate_salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employees_id')->nullable();
            $table->string('name')->nullable();
            $table->string('department')->nullable();
            $table->decimal('total_hours', 8, 2)->nullable();
            $table->decimal('hourly_rate', 8, 2)->nullable();
            $table->decimal('tax', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calculate_salaries');
    }
};
