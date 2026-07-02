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
        Schema::create('tblinvoices', function (Blueprint $table) {
            $table->id();
            $table->uuid('invoice_uuid')->unique();
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->string('status')->default('unpaid'); // unpaid, partially_paid, paid, void
            $table->timestamp('issued_at')->nullable();
            $table->uuid('appointment_uuid')->references('appointment_uuid')->on('tblappointments')->cascadeOnDelete();
            $table->uuid('patient_uuid')->references('patient_uuid')->on('tblpatients')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblinvoices');
    }
};
