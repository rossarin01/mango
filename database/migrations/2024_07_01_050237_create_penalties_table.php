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
        Schema::create('penalties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bookingId')->comment('รหัส Bookking');
            $table->string('penalty_name',300)->nullable()->comment('รายละเอียดค่าปรับ');
            $table->double('penalty_amount')->nullable()->comment('ยอดค่าปรับ');
            $table->string('penalty_image')->nullable()->comment('รูปภาพ');
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
        Schema::dropIfExists('penalties');
    }
};
