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
        Schema::create('tblconsentforms', function (Blueprint $table) {
            $table->id();
            $table->uuid('consent_uuid')->index();
            $table->string('consent_type')->default('Consent');
            $table->string('patient_name', 90)->nullable();
            $table->string('patient_ic_no', 90)->nullable();
            $table->string('patient_dob', 90)->nullable();
            $table->string('patient_occupation', 90)->nullable();
            $table->string('patient_status', 90)->nullable();
            $table->string('patient_sex', 90)->nullable();
            $table->string('patient_address_line1', 255)->nullable();
            $table->string('patient_address_line2', 255)->nullable();
            $table->string('patient_address_postcode', 90)->nullable();
            $table->string('patient_address_city', 90)->nullable();
            $table->string('patient_address_state', 90)->nullable();
            $table->string('patient_address_country', 90)->nullable();
            $table->string('patient_contact_no', 90)->nullable();
            $table->string('patient_relative_contact_no', 90)->nullable();
            $table->string('patient_home_contact_no', 90)->nullable();
            $table->string('patient_office_contact_no', 90)->nullable();
            $table->string('patient_medical_problem', 255)->nullable();
            $table->string('patient_disease_history', 255)->nullable();
            $table->string('signature_path');
            $table->timestamp('signed_at')->nullable();
            $table->timestamps();

            // $table->json('form_data'); // ALL MALAY FORM DATA HERE
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consent_forms');
    }
};
