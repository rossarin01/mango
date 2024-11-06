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
        Schema::create('account_balances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bookingId')->comment('รหัส Bookking');
            $table->double('withdrawal')->nullable()->comment('เงินออก');
            $table->double('deposit')->nullable()->comment('เงินเข้า');
            $table->enum('status_booking', ["BOOK", "PAID", "REFUND_DEPOSIT", "REFUND_BOOKING"])->nullable()->comment('BOOK=เงินจอง, PAID=ค่าเช่าและอื่นๆ, REFUND_DEPOSIT=คืนค่าประกัน, REFUND_BOOKING=คืนเงินจอง');
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
        Schema::dropIfExists('account_balances');
    }
};
