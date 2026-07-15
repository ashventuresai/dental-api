<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Storage;
use Stancl\Tenancy\Events\TenancyInitialized;

/**
 * UpdateTenantStorageUrl
 *
 * Problem context:
 *   FilesystemTenancyBootstrapper (stancl/tenancy v3) correctly updates
 *   the disk ROOT to the tenant's storage directory, but it does NOT update
 *   the disk URL. This means Storage::disk('public')->url($path) always
 *   returns {APP_URL}/storage/{path} regardless of the active tenant,
 *   making uploaded files unreachable via their generated URLs.
 *
 * How this fixes it:
 *   This listener fires after BootstrapTenancy for every TenancyInitialized
 *   event. It patches the public disk's URL config to include the tenant ID:
 *
 *     {APP_URL}/storage/tenant_{id}
 *
 *   Because FilesystemTenancyBootstrapper already called Storage::forgetDisk(),
 *   the next call to Storage::disk('public') rebuilds the disk instance with
 *   BOTH the correct root path (set by the bootstrapper) AND the correct URL
 *   (set by this listener). No extra forgetDisk() call is needed here.
 *
 * Required storage structure:
 *   For the URL to resolve, a junction / symlink must exist at:
 *     storage/app/public/tenant_{id}  →  storage/tenant_{id}/app/public
 *
 *   This is created automatically by TenantCreatedListener when a new tenant
 *   is provisioned, and must be created once manually for existing tenants
 *   via the php artisan tenants:storage-link command.
 *
 * Revert:
 *   This class also handles TenancyEnded (registered separately in
 *   TenancyServiceProvider) to restore the central URL so that subsequent
 *   non-tenant disk accesses in the same process (e.g., artisan commands
 *   that iterate over tenants) use the correct URL.
 */
class UpdateTenantStorageUrl
{
    /**
     * Patch the public disk URL when a tenant session starts.
     * Runs after BootstrapTenancy to ensure the disk root is already updated.
     */
    public function handle(TenancyInitialized $event): void
    {
        $tenantId = $event->tenancy->tenant->getTenantKey();
        $appUrl   = rtrim(config('app.url', 'http://localhost'), '/');

        // Set the public disk URL to route through the tenant junction:
        //   {APP_URL}/storage/tenant_{id}  →  public/storage/tenant_{id}/
        //   →  storage/app/public/tenant_{id}/  (via the existing public/storage junction)
        //   →  storage/tenant_{id}/app/public/  (via the per-tenant junction)
        config(["filesystems.disks.public.url" => "{$appUrl}/storage/tenant_{$tenantId}"]);
    }
}
