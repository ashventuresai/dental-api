<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Stancl\Tenancy\Events\TenantCreated;
use App\Listeners\TenantCreatedListener;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        TenantCreated::class => [
            // Creates the per-tenant storage junction and runs tenant migrations/seeding
            TenantCreatedListener::class,
        ],
    ];
}
