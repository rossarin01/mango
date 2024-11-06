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
        Schema::create('partners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname')->nullable()->comment('ชื่อ');
            $table->string('lastname')->nullable()->comment('นามสกุล');
            $table->string('address')->nullable()->comment('ที่อยู่');
            $table->integer('provinceId')->nullable()->comment('จัวหวัด');
            $table->integer('districtId')->nullable()->comment('อำเภอ');
            $table->string('phonenumber')->nullable()->comment('เบอร์โทร');
            $table->string('email')->nullable()->comment('อีเมล');
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
        Schema::dropIfExists('partners');
    }
};
