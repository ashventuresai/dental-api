<?php

namespace App\Services;

use App\Models\Treatment;
use App\Repositories\Interfaces\TreatmentAttachmentRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * TreatmentAttachmentService
 *
 * Orchestrates file storage and database persistence for treatment attachments.
 *
 * Tenant isolation:
 *   Storage::disk('public') is automatically scoped to the active tenant by
 *   FilesystemTenancyBootstrapper, so files are stored under:
 *     storage/tenant_{id}/app/public/treatments/{treatment_uuid}/
 *   No explicit tenant prefix is needed in file paths.
 *
 * Compression:
 *   Image downsizing/compression is delegated to the client (frontend) before
 *   upload to keep server processing lightweight. The backend enforces a 10 MB
 *   per-file hard limit as a safety net.
 */
class TreatmentAttachmentService
{
    /** Maximum number of attachments allowed per treatment record. */
    public const MAX_ATTACHMENTS = 20;

    /**
     * Explicitly allowed MIME types.
     * Videos are excluded entirely to conserve storage.
     * Only images, PDFs, and Word documents are permitted.
     */
    private const ALLOWED_MIME_TYPES = [
        'image/jpeg',
        'image/jpg',
        'image/png',
        'image/gif',
        'image/webp',
        'application/pdf',
        'application/msword',                                                    // .doc
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // .docx
    ];

    public function __construct(
        protected TreatmentAttachmentRepositoryInterface $repository
    ) {}

    // =========================================================================
    // Query
    // =========================================================================

    /**
     * Return all attachment records for a treatment (ordered by upload time).
     */
    public function getByTreatmentUuid(string $treatmentUuid)
    {
        return $this->repository->getByTreatmentUuid($treatmentUuid);
    }

    // =========================================================================
    // Upload
    // =========================================================================

    /**
     * Validate and persist a single uploaded file for a treatment.
     *
     * Steps:
     *   1. Confirm the parent treatment exists in this tenant's DB.
     *   2. Enforce the 20-file per-treatment cap.
     *   3. Validate MIME type against the allowlist (blocks videos).
     *   4. Store the file on the tenant-scoped public disk.
     *   5. Insert the metadata row.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException     If treatment not found.
     * @throws \RuntimeException                                        If attachment cap is reached.
     * @throws \InvalidArgumentException                                If MIME type is disallowed.
     */
    public function upload(string $treatmentUuid, UploadedFile $file)
    {
        // Step 1: Confirm the parent treatment belongs to this tenant's database
        Treatment::where('treatment_uuid', $treatmentUuid)->firstOrFail();

        // Step 2: Enforce maximum attachments per treatment
        $currentCount = $this->repository->countByTreatmentUuid($treatmentUuid);

        if ($currentCount >= self::MAX_ATTACHMENTS) {
            throw new \RuntimeException(
                'Maximum of ' . self::MAX_ATTACHMENTS . ' attachments allowed per treatment.'
            );
        }

        // Step 3: Validate MIME type – block videos and other disallowed types
        $mimeType = $file->getMimeType() ?? '';

        if (!in_array($mimeType, self::ALLOWED_MIME_TYPES, true)) {
            throw new \InvalidArgumentException(
                "File type \"{$mimeType}\" is not allowed. " .
                'Only images (JPEG, PNG, GIF, WebP), PDFs, and Word documents are permitted. ' .
                'Videos and other file types are not accepted.'
            );
        }

        // Step 4: Store the file under a treatment-specific subdirectory.
        // Storage::disk('public') automatically resolves to the tenant root.
        // Laravel generates a unique random filename to prevent collisions.
        $storedPath = $file->store("treatments/{$treatmentUuid}", 'public');

        // Step 5: Persist file metadata in the tenant database
        return $this->repository->create([
            'treatment_uuid' => $treatmentUuid,
            'original_name'  => $file->getClientOriginalName(),
            'file_path'      => $storedPath,
            'mime_type'      => $mimeType,
            'file_size'      => $file->getSize(),
        ]);
    }

    // =========================================================================
    // Delete
    // =========================================================================

    /**
     * Remove both the physical file from storage and the database record.
     *
     * The method is intentionally forgiving about missing physical files:
     * if the file was already removed from disk, the DB record is still deleted.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException  If attachment not found.
     */
    public function delete(string $attachmentUuid): void
    {
        $attachment = $this->repository->findByUuid($attachmentUuid);

        // Remove the physical file from the tenant's public disk
        if (Storage::disk('public')->exists($attachment->file_path)) {
            Storage::disk('public')->delete($attachment->file_path);
        }

        // Remove the metadata row from the database
        $this->repository->delete($attachmentUuid);
    }
}
