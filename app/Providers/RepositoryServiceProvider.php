<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Interfaces\PatientRepositoryInterface;
use App\Repositories\PatientRepository;
use App\Repositories\Interfaces\AppointmentRepositoryInterface;
use App\Repositories\AppointmentRepository;
use App\Repositories\Interfaces\TreatmentRepositoryInterface;
use App\Repositories\TreatmentRepository;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;
use App\Repositories\InvoiceRepository;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\PaymentRepository;
use App\Repositories\Interfaces\TreatmentAttachmentRepositoryInterface;
use App\Repositories\TreatmentAttachmentRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
        $this->app->bind(AppointmentRepositoryInterface::class, AppointmentRepository::class);
        $this->app->bind(TreatmentRepositoryInterface::class, TreatmentRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(InvoiceRepositoryInterface::class, InvoiceRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        // Bind attachment repository for treatment file upload feature
        $this->app->bind(TreatmentAttachmentRepositoryInterface::class, TreatmentAttachmentRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
