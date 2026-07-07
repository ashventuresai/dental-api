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
        Schema::create('tblstock_movements', function (Blueprint $table) {
            $table->id();

            $table->uuid('stock_movement_uuid')->nullable();
            $table->string('type'); // in/out/adjustment
            $table->string('reference_type')->nullable();
            $table->uuid('reference_id')->nullable();
            $table->integer('quantity');
            $table->integer('balance_after');
            $table->text('remarks')->nullable();
            $table->foreignId('performed_by')->nullable();

            $table->string('product_uuid')->references('product_uuid')->on('tblproducts')->cascadeOnDelete();
            $table->index(['product_uuid', 'type']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblstock_movements');
    }
};
