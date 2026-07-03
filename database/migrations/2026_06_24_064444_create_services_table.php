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
        Schema::create('tblservices', function (Blueprint $table) {
            $table->id();
            $table->uuid('service_uuid')->nullable();
            $table->string('service_code')->nullable();
            $table->string('service_name')->nullable();
            $table->string('service_category')->nullable();
            $table->integer('service_price')->default(0);
            $table->text('service_description')->nullable();
            $table->string('service_active')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblservices');
    }
};
