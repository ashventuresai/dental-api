<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * TreatmentAttachment Model
 *
 * Represents a single file (image, PDF, Word doc) attached to a treatment.
 * Physical files live on the tenant-scoped "public" disk, so each tenant's
 * files are stored in isolation under:
 *   storage/tenant_{id}/app/public/treatments/{treatment_uuid}/
 *
 * The appended `url` attribute generates the public-facing URL at runtime,
 * always relative to the active tenant's storage root.
 */
class TreatmentAttachment extends Model implements Auditable
{
    use AuditableTrait;
    use HasFactory;

    protected $table      = 'tbltreatment_attachments';
    protected $primaryKey = 'attachment_uuid';
    protected $keyType    = 'string';
    public    $incrementing = false;

    protected $fillable = [
        'attachment_uuid',
        'treatment_uuid',
        'original_name',
        'file_path',
        'mime_type',
        'file_size',
    ];

    // Append the computed public URL when the model is serialised to JSON
    protected $appends = ['url'];

    // =========================================================================
    // Boot
    // =========================================================================

    /**
     * Auto-generate a UUID primary key when creating a new record.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (self $model) {
            if (empty($model->attachment_uuid)) {
                $model->attachment_uuid = (string) Str::uuid();
            }
        });
    }

    // =========================================================================
    // Computed attributes
    // =========================================================================

    /**
     * Return the publicly accessible URL for this attachment.
     *
     * Note: This must only be called within an active tenancy context so that
     * Storage::disk('public') resolves to the correct tenant root.
     */
    public function getUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->file_path);
    }

    // =========================================================================
    // Relationships
    // =========================================================================

    public function treatment()
    {
        return $this->belongsTo(Treatment::class, 'treatment_uuid', 'treatment_uuid');
    }
}
