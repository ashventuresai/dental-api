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
        Schema::create('tblstaff', function (Blueprint $table) {
            $table->id();
            $table->uuid('staff_uuid')->index();
            $table->string('staff_id')->unique();
            $table->string('full_name');
            $table->string('position');
            $table->string('ic_no')->unique();
            $table->string('phone_no')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('spouse_ic')->nullable();
            $table->string('spouse_phone_no')->nullable();
            $table->integer('total_independants')->default(0);
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('status')->default('ACTIVE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblstaff');
    }
};
