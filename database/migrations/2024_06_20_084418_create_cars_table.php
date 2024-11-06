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
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('segmentId')->comment('ประเภทรถ');
            $table->integer('brandId')->comment('ยี่ห้อ');
            $table->integer('model')->comment('รุ่น');
            $table->integer('partner')->comment('พันธมิตร');
            $table->string('year')->nullable()->comment('ปี');
            $table->string('engineCapacity')->nullable()->comment('ขนาดซีซี');
            $table->string('carId')->nullable()->comment('ทะเบียนรถ');
            $table->decimal('currentPrice')->nullable()->comment('ราคาปัจจุบัน');
            $table->string('image')->nullable()->comment('รูปภาพ');
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
        Schema::dropIfExists('cars');
    }
};
