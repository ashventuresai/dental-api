<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TreatmentAttachmentService;
use Illuminate\Http\Request;

/**
 * TreatmentAttachmentController
 *
 * Handles file uploads, listing, and deletion for treatment attachments.
 * All routes are protected by auth:sanctum and scoped to the active tenant.
 *
 * Routes (nested under /treatments/{treatment_uuid}/attachments):
 *   GET    /                       → index   (list all attachments)
 *   POST   /                       → store   (upload 1-N files)
 *   DELETE /{attachment_uuid}       → destroy (delete one attachment)
 */
class TreatmentAttachmentController extends Controller
{
    public function __construct(
        protected TreatmentAttachmentService $treatmentAttachmentService
    ) {}

    // =========================================================================
    // List
    // =========================================================================

    /**
     * Return all attachments for a given treatment, ordered by upload date.
     * Each attachment includes a tenant-scoped `url` for the frontend to display.
     */
    public function index(string $treatmentUuid)
    {
        $attachments = $this->treatmentAttachmentService->getByTreatmentUuid($treatmentUuid);

        return response()->json([
            'data' => $attachments,
        ]);
    }

    // =========================================================================
    // Upload
    // =========================================================================

    /**
     * Upload one or more files for a treatment.
     *
     * Accepts multipart/form-data with the field name `files[]`.
     * Validation rules (two layers):
     *   1. Laravel validation: extension allowlist + 10 MB cap per file.
     *   2. Service layer: MIME-type allowlist (strips any extension-spoofing).
     *
     * Allowed:   JPEG, PNG, GIF, WebP, PDF, DOC, DOCX
     * Rejected:  all video types, executables, archives, etc.
     * Max files: 20 total per treatment (enforced in service)
     * Max size:  10 MB per file (10240 KB)
     */
    public function store(Request $request, string $treatmentUuid)
    {
        $request->validate([
            // At least 1 file, at most 20 per single request
            'files'   => ['required', 'array', 'min:1', 'max:20'],

            // Per-file rules:
            //   mimes:  extension + basic MIME check (rejects videos by allowlist)
            //   max:    10 240 KB = 10 MB hard server-side limit
            'files.*' => [
                'required',
                'file',
                'max:10240',
                'mimes:jpeg,jpg,png,gif,webp,pdf,doc,docx',
            ],
        ]);

        $uploaded = [];

        foreach ($request->file('files') as $file) {
            try {
                $uploaded[] = $this->treatmentAttachmentService->upload($treatmentUuid, $file);
            } catch (\RuntimeException $e) {
                // Per-treatment attachment cap reached – abort remaining files
                return response()->json(['message' => $e->getMessage()], 422);
            } catch (\InvalidArgumentException $e) {
                // Disallowed MIME type detected at service level
                return response()->json(['message' => $e->getMessage()], 422);
            }
        }

        return response()->json([
            'message' => 'File(s) uploaded successfully.',
            'data'    => $uploaded,
        ], 201);
    }

    // =========================================================================
    // Delete
    // =========================================================================

    /**
     * Delete a single attachment (removes both the physical file and DB record).
     * The {treatmentUuid} path segment is available for additional ownership
     * checks if needed in the future.
     */
    public function destroy(string $treatmentUuid, string $attachmentUuid)
    {
        $this->treatmentAttachmentService->delete($attachmentUuid);

        return response()->json([
            'message' => 'Attachment deleted successfully.',
        ]);
    }
}
