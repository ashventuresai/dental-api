<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Treatment Attachments
 *
 * Creates a per-tenant table that stores metadata for files (X-rays, photos,
 * PDFs, Word documents) uploaded against a treatment record.
 *
 * Physical files are stored on the tenant-scoped "public" disk managed by
 * FilesystemTenancyBootstrapper, so each tenant's files are completely isolated
 * under  storage/tenant_{id}/app/public/treatments/{treatment_uuid}/
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbltreatment_attachments', function (Blueprint $table) {
            $table->id();

            // Unique public identifier exposed to the API
            $table->uuid('attachment_uuid')->unique();

            // Parent treatment (within the same tenant database)
            $table->uuid('treatment_uuid')->index();

            // Human-readable filename as uploaded by the user
            $table->string('original_name');

            // Relative path on the tenant's public disk
            // e.g. "treatments/{treatment_uuid}/randomname.jpg"
            $table->string('file_path');

            // Validated MIME type recorded at upload time
            // Only images, PDFs, and Word documents are allowed (no videos)
            $table->string('mime_type', 100);

            // File size in bytes (post-compression for images)
            $table->unsignedBigInteger('file_size');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbltreatment_attachments');
    }
};
