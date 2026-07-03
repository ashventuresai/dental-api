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
        Schema::create('tblproducts', function (Blueprint $table) {
            $table->id();
            $table->uuid('product_uuid')->nullable();
            $table->string('product_code')->unique();
            $table->string('barcode')->nullable();
            $table->string('name');
            $table->string('generic_name')->nullable();
            $table->string('brand')->nullable();
            $table->decimal('purchase_price', 10, 2)->default(0);
            $table->decimal('selling_price', 10, 2)->default(0);
            $table->integer('minimum_stock')->default(0);
            $table->integer('current_stock')->default(0);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->string('product_category_uuid')->references('product_category_uuid')->on('tblproduct_categories')->cascadeOnDelete();
            $table->string('product_unit_uuid')->references('product_unit_uuid')->on('tblproduct_units')->cascadeOnDelete();

            $table->index(['name', 'product_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblproducts');
    }
};
