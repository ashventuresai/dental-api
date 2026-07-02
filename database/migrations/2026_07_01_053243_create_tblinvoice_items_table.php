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
        Schema::create('tblinvoice_items', function (Blueprint $table) {
            $table->id();
            $table->string('item_type'); // procedure, medicine, consultation
            $table->string('description');
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->uuid('invoice_uuid')->references('invoice_uuid')->on('tblinvoices')->cascadeOnDelete();
            $table->uuid('appointment_uuid')->references('appointment_uuid')->on('tblappointments')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblinvoice_items');
    }
};
