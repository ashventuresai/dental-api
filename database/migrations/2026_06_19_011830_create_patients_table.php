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
        Schema::create('tblpatients', function (Blueprint $table) {
            $table->increments('ID');

            $table->string('patient_uuid', 50);

            $table->string('firstname', 90);
            $table->string('lastname', 90)->nullable();
            $table->string('middlename', 90)->nullable();

            $table->string('id_type', 90)->comment('1=ic, 2=passport');
            $table->string('ic_no', 12)->nullable();
            $table->string('passport_no', 12)->nullable();

            $table->string('addressline1', 50)->default('');
            $table->string('addressline2', 50)->default('');
            $table->string('postalcode', 50)->default('');
            $table->string('city', 50)->default('');
            $table->string('state', 50)->default('');
            $table->string('country', 50)->default('');

            $table->string('sex', 90)->nullable();
            $table->integer('age')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('contact_no', 90)->nullable();

            $table->string('emergency_name_1', 90)->default('');
            $table->string('emergency_phone_1', 90)->default('');
            $table->string('emergency_relationship_1', 90)->default('');
            $table->string('emergency_name_2', 90)->nullable();
            $table->string('emergency_phone_2', 90)->nullable();
            $table->string('emergency_relationship_2', 90)->nullable();

            $table->string('created_at', 90)->nullable();
            $table->string('updated_at', 90)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblpatients');
    }
};
