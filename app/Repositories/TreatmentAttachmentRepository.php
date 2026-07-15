<?php

namespace App\Repositories;

use App\Models\TreatmentAttachment;
use App\Repositories\Interfaces\TreatmentAttachmentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Eloquent implementation of TreatmentAttachmentRepositoryInterface.
 * Every query is automatically scoped to the active tenant's database
 * by the DatabaseTenancyBootstrapper from stancl/tenancy.
 */
class TreatmentAttachmentRepository implements TreatmentAttachmentRepositoryInterface
{
    /**
     * Fetch all attachment records for a treatment, ordered by upload time.
     */
    public function getByTreatmentUuid(string $treatmentUuid): Collection
    {
        return TreatmentAttachment::where('treatment_uuid', $treatmentUuid)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    /**
     * Insert a new attachment metadata row and return the model.
     */
    public function create(array $data): TreatmentAttachment
    {
        return TreatmentAttachment::create($data);
    }

    /**
     * Find an attachment by its UUID or throw ModelNotFoundException.
     */
    public function findByUuid(string $uuid): TreatmentAttachment
    {
        return TreatmentAttachment::where('attachment_uuid', $uuid)->firstOrFail();
    }

    /**
     * Delete the database row for an attachment.
     * The physical file must be removed by the caller before invoking this method.
     */
    public function delete(string $uuid): void
    {
        TreatmentAttachment::where('attachment_uuid', $uuid)->delete();
    }

    /**
     * Count attachments for a treatment to enforce the upload cap.
     */
    public function countByTreatmentUuid(string $treatmentUuid): int
    {
        return TreatmentAttachment::where('treatment_uuid', $treatmentUuid)->count();
    }
}
