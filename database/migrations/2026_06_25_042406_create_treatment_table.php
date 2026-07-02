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
        Schema::create('tbltreatment', function (Blueprint $table) {
            $table->id();
            $table->uuid('treatment_uuid')->unique();

            // Clinical data (use TEXT for long medical notes)
            $table->text('chief_complaint')->nullable();
            $table->text('history_of_complaint')->nullable();
            $table->text('past_medical_history')->nullable();
            $table->text('past_dental_history')->nullable();
            $table->text('extra_intra_oral_examination')->nullable();
            $table->text('radiographic_examination')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('treatment')->nullable();
            $table->text('notes')->nullable();

            // Follow-up handling
            $table->boolean('need_follow_up')->default(false);
            $table->date('follow_up_date')->nullable();

            // Status (use enum for controlled workflow)
            $table->enum('status', ['Draft','Ongoing','Completed','Cancelled'])->default('Draft');

            // Foreign UUID references
            $table->uuid('appointment_uuid')->index();
            $table->uuid('patient_uuid')->index();
            $table->uuid('staff_uuid')->index();

            $table->timestamps();
        });

        // Optional: if you later add foreign key constraints
            // $table->foreign('patient_uuid')->references('patient_uuid')->on('patients')->onDelete('cascade');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbltreatment');
    }
};
