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
        Schema::create('approves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employees_id')->nullable();
            $table->date('date')->nullable();
            $table->time('fingerprint_check_in')->nullable();
            $table->time('fingerprint_check_in(edit)')->nullable();
            $table->time('fingerprint_check_out')->nullable();
            $table->time('fingerprint_check_out(edit)')->nullable();
            $table->time('fingerprint_break_start_time')->nullable();
            $table->time('fingerprint_break_start_time(edit)')->nullable();
            $table->time('fingerprint_break_end_time')->nullable();
            $table->time('fingerprint_break_end_time(edit)')->nullable();
            $table->string('action')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approve');
    }
};
