<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->string('id')->primary();

            // Clinic Information
            $table->string('clinic_name')->default('');
            $table->string('clinic_legal_name')->nullable()->default('');
            $table->string('clinic_registration_no')->nullable()->default('');
            $table->string('clinic_code')->nullable()->default('');

            // // Contact Information
            $table->string('clinic_email')->nullable()->default('');
            $table->string('clinic_phone')->nullable()->default('');
            $table->string('clinic_website')->nullable()->default('');

            // // Address
            $table->text('clinic_address1')->nullable();
            $table->text('clinic_address2')->nullable();
            $table->text('clinic_address3')->nullable();

            //
            $table->text('clinic_receipt_footer')->nullable();
            $table->text('clinic_invoice_footer')->nullable();


            // Subscription
            // $table->string('plan')->default('trial');
            // $table->timestamp('trial_ends_at')->nullable();
            // $table->timestamp('subscription_ends_at')->nullable();

            // Status
            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->json('data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
}
