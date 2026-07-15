<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Storage;
use Stancl\Tenancy\Events\TenancyEnded;

/**
 * RevertTenantStorageUrl
 *
 * Companion to UpdateTenantStorageUrl.
 *
 * When tenancy ends (e.g., during artisan commands that iterate over multiple
 * tenants), this listener restores the public disk URL back to the standard
 * central URL: {APP_URL}/storage
 *
 * Without this revert, processes that initialise and end tenancy multiple times
 * (like `tenants:migrate`) would leave the URL pointing to the last tenant's
 * storage path for any subsequent central-context disk access.
 */
class RevertTenantStorageUrl
{
    public function handle(TenancyEnded $event): void
    {
        $appUrl = rtrim(config('app.url', 'http://localhost'), '/');

        // Restore the central URL so subsequent central-context operations
        // use the correct standard storage URL
        config(["filesystems.disks.public.url" => "{$appUrl}/storage"]);

        // Forget the disk so the next access rebuilds with the reverted URL
        Storage::forgetDisk('public');
    }
}
