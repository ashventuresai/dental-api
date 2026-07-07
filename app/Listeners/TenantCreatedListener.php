<?php
namespace App\Listeners;

use Stancl\Tenancy\Events\TenantCreated;
use Illuminate\Support\Facades\Artisan;

class TenantCreatedListener
{
    public function handle(TenantCreated $event)
    {
        $tenant = $event->tenant;

        $tenant->run(function () {

            Artisan::call('migrate', [
                '--path'=>'database/migrations/tenant',
                '--force'=>true
            ]);

            Artisan::call('db:seed', [
                '--class'=>'TenantDatabaseSeeder',
                '--force'=>true
            ]);

        });

    }
}
