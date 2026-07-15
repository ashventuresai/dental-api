<?php

namespace App\Repositories\Interfaces;

use App\Models\TreatmentAttachment;
use Illuminate\Database\Eloquent\Collection;

/**
 * Contract for TreatmentAttachment persistence operations.
 * All methods operate within the current tenant's database connection.
 */
interface TreatmentAttachmentRepositoryInterface
{
    /**
     * Retrieve all attachments belonging to a treatment, ordered oldest-first.
     */
    public function getByTreatmentUuid(string $treatmentUuid): Collection;

    /**
     * Persist a new attachment metadata record.
     *
     * @param  array{treatment_uuid: string, original_name: string, file_path: string, mime_type: string, file_size: int}  $data
     */
    public function create(array $data): TreatmentAttachment;

    /**
     * Find a single attachment by its UUID; throws ModelNotFoundException if absent.
     */
    public function findByUuid(string $uuid): TreatmentAttachment;

    /**
     * Hard-delete an attachment record from the database (file deletion is
     * handled separately by the service layer before calling this method).
     */
    public function delete(string $uuid): void;

    /**
     * Return the total number of attachments for a given treatment.
     * Used to enforce the per-treatment maximum.
     */
    public function countByTreatmentUuid(string $treatmentUuid): int;
}
