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
        Schema::create('request_checkin_approves', function (Blueprint $table) {
            $table->id();
            $table->integer('checkin_checkout_id')->comment('รหัสเวลาเข้า-ออก');
            $table->integer('employee_id')->comment('รหัสพนักงาน');
            $table->time('morning_shift')->nullable();
            $table->time('morning_end')->nullable();
            $table->time('evening_shift')->nullable();
            $table->time('evening_end')->nullable();
            $table->time('before_morning_shift')->nullable()->comment('ก่อนแก้ไข');
            $table->time('before_morning_end')->nullable()->comment('ก่อนแก้ไข');
            $table->time('before_evening_shift')->nullable()->comment('ก่อนแก้ไข');
            $table->time('before_evening_end')->nullable()->comment('ก่อนแก้ไข');
            $table->text('detail')->nullable()->comment('เหตุผล');
            $table->enum('status', ['REQUEST','APPROVED','UNAPPROVED'])->default('REQUEST');
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
        Schema::dropIfExists('request_checkin_approves');
    }
};
