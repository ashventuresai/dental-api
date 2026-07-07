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
        Schema::create('tblpayments', function (Blueprint $table) {
            $table->id();
            $table->uuid('payment_uuid')->unique();
            $table->decimal('amount', 10, 2);
            $table->string('method'); // cash, card, online_transfer, insurance
            $table->string('status')->default('success');// success, failed, pending
            $table->string('reference_no')->nullable();
            $table->timestamp('paid_at');
            $table->uuid('invoice_uuid')->references('invoice_uuid')->on('tblinvoices')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblpayments');
    }
};
