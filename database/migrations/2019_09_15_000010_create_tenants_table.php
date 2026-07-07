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
            // $table->string('name');
            // $table->string('code')->unique();

            // // Contact Information
            // $table->string('email')->nullable();
            // $table->string('phone')->nullable();

            // // Address
            // $table->text('address')->nullable();
            // $table->string('city')->nullable();
            // $table->string('state')->nullable();
            // $table->string('postcode')->nullable();
            // $table->string('country')->default('Malaysia');

            // Subscription
            // $table->string('plan')->default('trial');
            // $table->timestamp('trial_ends_at')->nullable();
            // $table->timestamp('subscription_ends_at')->nullable();

            // Status
            // $table->boolean('is_active')->default(true);

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
