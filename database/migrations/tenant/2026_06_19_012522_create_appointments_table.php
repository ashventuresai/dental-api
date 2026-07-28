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
        Schema::create('tblappointments', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('appointment_uuid')->index();
            $table->string('patient_name', 90)->nullable();
            $table->string('patient_ic_no', 90)->nullable();
            $table->datetime('appointment_datetime');
            $table->string('status', 20)->default('Booked');
            $table->string('notes', 255)->nullable();
            $table->string('reason', 255)->nullable();
            $table->string('patient_medical_problem', 255)->nullable();
            $table->string('patient_disease_history', 255)->nullable();
            $table->uuid('staff_uuid')->nullable();
            $table->uuid('patient_uuid')->nullable();
            $table->uuid('consent_uuid')->nullable();

            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblappointments');
    }
};
