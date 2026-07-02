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
        Schema::create('tblautonumbers', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // e.g. STAFF, INVOICE
            $table->string('prefix')->nullable(); // e.g. ST, INV
            $table->bigInteger('current_value')->default(0);
            $table->integer('pad_length')->default(5);
            $table->integer('increment')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auto_numbers');
    }
};
