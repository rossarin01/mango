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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employees_id')->nullable();
            $table->string('name')->nullable();
            $table->string('department')->nullable();
            $table->string('week')->nullable();
            $table->date('start_date')->nullable();
            $table->date('last_date')->nullable();
            $table->date('payment_date')->nullable();
            $table->decimal('total_amount', 8, 2)->nullable();
            $table->string('payment_receipt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
