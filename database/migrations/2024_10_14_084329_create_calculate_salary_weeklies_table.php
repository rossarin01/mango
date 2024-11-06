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
        Schema::create('calculate_salary_weeklies', function (Blueprint $table) {
            $table->id();
            $table->integer('calculate_salary_id')->comment('Id Roster');
            $table->integer('employee_id')->comment('รหัสพนักงาน');
            $table->decimal('total_hours')->nullable()->comment('ชั่วโมงทำงาน รายสัปดาห์');
            $table->decimal('weekday_hours')->nullable()->comment('ชั่วโมงทำงาน จ-ศ');
            $table->decimal('weekend_hours')->nullable()->comment('ชั่วโมงทำงาน ส-อา');
            $table->decimal('weekday_rate')->nullable()->comment('เรทรายได้ จ-ศ');
            $table->decimal('weekend_rate')->nullable()->comment('เรทรายได้ ส-อา');
            $table->decimal('payment')->nullable()->comment('จ่าย');
            $table->decimal('diff')->nullable()->comment('ส่วนต่าง');
            $table->decimal('surcharge')->nullable()->comment('ค่าธรรมเนียมเพิ่มเติม');
            $table->decimal('total')->nullable()->comment('จ่ายรวม');
            $table->decimal('cash_payment')->nullable()->comment('เงินสด');
            $table->decimal('transfer_payment')->nullable()->comment('โอนเงิน');
            $table->decimal('payroll_transfer')->nullable()->comment('การโอนเงินเดือน');
            $table->decimal('tax')->nullable()->comment('ภาษี');
            $table->decimal('super')->nullable();
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
        Schema::dropIfExists('calculate_salary_weeklies');
    }
};
