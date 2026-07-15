<?php
namespace App\Listeners;

use Illuminate\Support\Facades\Artisan;
use Stancl\Tenancy\Events\TenantCreated;

class TenantCreatedListener
{
    public function handle(TenantCreated $event): void
    {
        $tenant   = $event->tenant;
        $tenantId = $tenant->getTenantKey();

        // =====================================================================
        // 1. Create a storage junction / symlink for this tenant so that its
        //    public files are accessible via HTTP at:
        //      {APP_URL}/storage/tenant_{id}/{path}
        //
        //    Structure created:
        //      storage/app/public/tenant_{id}  →  storage/tenant_{id}/app/public
        //
        //    This works because the default public/storage junction already
        //    points to storage/app/public, so adding a per-tenant junction
        //    inside it creates the full chain:
        //      public/storage/tenant_{id}/  →  storage/tenant_{id}/app/public/
        // =====================================================================
        $this->createTenantStorageLink($tenantId);

        // =====================================================================
        // 2. Run tenant-specific migrations and seeders inside the tenant's DB
        // =====================================================================
        $tenant->run(
            function () {
                Artisan::call('migrate', [
                    '--path'  => 'database/migrations/tenant',
                    '--force' => true,
                ]);

                Artisan::call('db:seed', [
                    '--class' => 'TenantDatabaseSeeder',
                    '--force' => true,
                ]);
            }
        );
    }

    /**
     * Create a directory junction (Windows) or symlink (Unix) so that the
     * tenant's public storage directory is reachable via the web server.
     *
     * On Windows, a junction is used because it does not require elevated
     * privileges (unlike symlinks on Windows without Developer Mode).
     *
     * The target directory is created first if it does not yet exist, since
     * tenancy may not have written any files yet at the point this runs.
     */
    private function createTenantStorageLink(string $tenantId): void
    {
        // Absolute paths — use base_path() to avoid storage_path() being
        // affected by any existing tenancy context
        $targetPath = base_path("storage/tenant_{$tenantId}/app/public");
        $linkPath   = base_path("storage/app/public/tenant_{$tenantId}");

        // Ensure the target directory exists before linking
        if (!is_dir($targetPath)) {
            mkdir($targetPath, 0755, true);
        }

        if (file_exists($linkPath) || is_link($linkPath)) {
            return; // Already linked — nothing to do
        }

        if (PHP_OS_FAMILY === 'Windows') {
            // Use mklink /J (junction) — no admin rights required on Windows
            exec(sprintf('mklink /J "%s" "%s"', $linkPath, $targetPath));
        } else {
            // Relative symlink on Unix/Mac for portability across deployments
            $relativeTarget = $this->getRelativePath($linkPath, $targetPath);
            symlink($relativeTarget, $linkPath);
        }
    }

    /**
     * Compute a relative path from $from to $to.
     * Used to create portable relative symlinks on Unix systems.
     */
    private function getRelativePath(string $from, string $to): string
    {
        $fromParts = explode(DIRECTORY_SEPARATOR, dirname($from));
        $toParts   = explode(DIRECTORY_SEPARATOR, $to);

        while (count($fromParts) && count($toParts) && $fromParts[0] === $toParts[0]) {
            array_shift($fromParts);
            array_shift($toParts);
        }

        return str_repeat('..' . DIRECTORY_SEPARATOR, count($fromParts)) . implode(DIRECTORY_SEPARATOR, $toParts);
    }
}

