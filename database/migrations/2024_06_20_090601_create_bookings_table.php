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
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('custmerId')->comment('ลูกค้า');
            $table->integer('carId')->comment('รถ');
            $table->string('contractCode')->nullable()->comment('เลขที่สัญญา');
            $table->string('drivingLicense')->nullable()->comment('ใบขับขี่');
            $table->string('licenseExpire')->nullable()->comment('ใันหมดอายุ');
            $table->string('pickUpLocation')->nullable()->comment('สถานที่ส่งมอบรถ');
            $table->dateTime('pickUpDateTime')->nullable()->comment('วันที่และเวลา');
            $table->string('latitude')->nullable()->comment('ละติจูด');
            $table->string('longitude')->nullable()->comment('ลองจิจูด');
            $table->decimal('rent')->nullable()->comment('ค่าเช่า');
            $table->decimal('deposit')->nullable()->comment('เงินประกัน');
            $table->decimal('reserve')->nullable()->comment('เงินจอง');
            $table->decimal('serviceFee')->nullable()->comment('ค่าบริการรับส่ง');
            $table->decimal('total')->nullable()->comment('รวมยอดเงินทั้งหมด');
            $table->string('note')->nullable()->comment('หมายเหตุ(พนักงาน)');
            $table->string('remark')->nullable()->comment('หมายเหตุ(ท้ายสัญญา)');
            $table->enum('status', ["BOOK", "PAID", "SENT", "RECEIVE", "REFUND_DEPOSIT", "REFUND_BOOKING"])->nullable()->comment('สถานะ');
            $table->string('signature')->nullable();
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
        Schema::dropIfExists('bookings');
    }
};
