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
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name', 255)->nullable()->comment('ชื่อบริษัท');
            $table->string('first_name', 255)->nullable()->comment('ชื่อ');
            $table->string('last_name', 255)->nullable()->comment('นามสกุล');
            $table->text('address')->nullable()->comment('ที่อยู่');
            $table->integer('province_id')->nullable()->comment('จังหวัด');
            $table->integer('district_id')->nullable()->comment('อำเภอ');
            $table->string('postcode', 10)->nullable()->comment('รหัสไปรษณีย์');
            $table->string('phone', 100)->nullable()->comment('เบอร์โทรศัพท์');
            $table->string('email', 255)->nullable()->comment('อีเมล');
            $table->string('image', 300)->nullable()->comment('รูปบัตรประชาชน');
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
        Schema::dropIfExists('customers');
    }
};
