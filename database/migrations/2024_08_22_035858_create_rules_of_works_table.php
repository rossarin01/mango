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
        Schema::create('rules_of_works', function (Blueprint $table) {
            $table->id();
            $table->boolean('late')->nullable();
            $table->boolean('leaving_early')->nullable();
            $table->boolean('not_checking_in')->nullable();
            $table->boolean('not_checking_out')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rules_of_works');
    }
};
