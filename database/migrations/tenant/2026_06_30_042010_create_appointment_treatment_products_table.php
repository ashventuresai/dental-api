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
        Schema::create('tblappointment_treatment_products', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2)->default(0);
            $table->decimal('total_price', 10, 2)->default(0);
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->string('appointment_uuid')->references('appointment_uuid')->on('tblappointments')->cascadeOnDelete();
            $table->string('product_uuid')->references('product_uuid')->on('tblproducts')->cascadeOnDelete();
            $table->index(['appointment_uuid', 'product_uuid'], 'tap_appt_product_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblappointment_treatment_products');
    }
};
