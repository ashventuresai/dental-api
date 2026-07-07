
TO RUN APPLICATION
1. composer install

## STEPS

# Start
1. composer create-project laravel/laravel dental-api

## 001 - Setup User Authentication & Authorization (Sanctum SPA session authentication)

1. composer require laravel/sanctum
2. composer require spatie/laravel-permission
3. php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
4. php artisan migrate
5. php artisan install:api
6. php artisan make:controller Api/AuthController
7. php artisan migrate:fresh --seed  

Code

// app/Models/User.php

use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}

## 002 - Setup User Role

1. php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

Code

// app/Models/User.php

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
}

Command 
> php artisan tinker

use Spatie\Permission\Models\Role;

Role::create(['name' => 'admin']);
Role::create(['name' => 'staff']);
Role::create(['name' => 'patient']);

## 003 - Setup API Cors (For Frontend using API Backend Endpoint)
> php artisan config:publish cors 

## 004 - Patient Repository
1.  php artisan make:interface Repositories/Interfaces/PatientRepositoryInterface
2.  php artisan make:class Repositories/PatientRepository
3.  php artisan make:class Services/PatientService
4.  php artisan make:class DTO/Patient/CreatePatientDTO 
4.  php artisan make:class DTO/Patient/UpdatePatientDTO 
5.  php artisan make:provider RepositoryServiceProvider // Important to register repository
6.  php artisan make:migration create_patients_table
7.  php artisan make:controller Api/PatientController 
8.  php artisan make:model Patient
9.  php artisan make:seeder PatientSeeder

## 005 - Appointment Repository
1.  php artisan make:migration create_appointments_table
2.  php artisan make:model Appointment
3.  php artisan make:seeder AppointmentSeeder
2.  php artisan make:request AppointmentRequest
3.  php artisan make:class DTO/Appointment/CreateAppointmentDTO
3.  php artisan make:class DTO/Appointment/UpdateAppointmentDTO
4.  php artisan make:interface Repositories/Interfaces/AppointmentRepositoryInterface
5.  php artisan make:class Repositories/AppointmentRepository
6.  php artisan make:class Services/AppointmentService
7.  php artisan make:provider RepositoryServiceProvider
8.  php artisan make:controller Api/AppointmentController 
9.  Create Enums AppointmentStatus

##  006 - Consent Form Module
1. php artisan make:migration create_consent_forms_table
2. php artisan make:controller Api/ConsentFormController
3. php artisan make:model ConsentForm
4. php artisan make:request ConsentFormRequest
5. php artisan make:class DTO/ConsentFormDTO
6. php artisan storage:link (storage/app/public → public/storage)

##  007 - Staff Module
1. php artisan make:migration create_staff_table
2. php artisan make:model Staff
3. php artisan make:class DTO/Staff/CreateStaffDTO
4. php artisan make:class DTO/Staff/UpdateStaffDTO
5. php artisan make:class Services/StaffService
6. php artisan make:request StoreStaffRequest
7. php artisan make:controller Api/StaffController
8. php artisan make:seeder StaffSeeder

## 008 - Running Number
1. php artisan make:migration create_auto_numbers_table
2. php artisan make:seeder AutoNumberSeeder
3. php artisan db:seed --class=AutoNumberSeeder
4. php artisan make:model AutoNumber
5. php artisan make:class Services/AutoNumberService

## 009 - Service Module
1. php artisan make:migration create_services_table
2. php artisan make:model Services
3. php artisan make:seeder ServicesSeeder
4. php artisan make:class DTO/Services/CreateServicesDTO
4. php artisan make:class DTO/Services/UpdateServicesDTO
5. php artisan make:request ServicesRequest
6. php artisan make:class Services/ServicesService
7. php artisan make:controller Api/ServicesController

## 010 - Treatment Module
1. php artisan make:migration create_treatment_table
2. php artisan make:model Treatment
3. php artisan make:seeder TreatmentSeeder
4. php artisan make:request TreatmentRequest
5. php artisan make:class DTO/Treatment/CreateTreatmentDTO
6. php artisan make:class DTO/Treatment/UpdateTreatmentDTO
7. php artisan make:interface Repositories/Interfaces/TreatmentRepositoryInterface
8. php artisan make:class Repositories/TreatmentRepository
9. php artisan make:class Services/TreatmentService
10.php artisan make:controller Api/TreatmentController
9. Create Enums TreatmentStatus

## 011 - Products / Prescriptions (Together with Stocks)
1. Create Enums ProductType
2. php artisan make:migration create_product_categories_table
3. php artisan make:migration create_product_units_table
4. php artisan make:migration create_products_table
5. php artisan make:model ProductCategory
6. php artisan make:model ProductUnit
7. php artisan make:model Product
8. php artisan make:seeder ProductCategorySeeder
9. php artisan make:seeder ProductUnitSeeder
10. php artisan make:seeder ProductSeeder
11. php artisan make:class DTO/Product/CreateProductDTO
12. php artisan make:class DTO/Product/UpdateProductDTO
13. php artisan make:interface Repositories/Interfaces/ProductRepositoryInterface
14. php artisan make:class Repositories/ProductRepository
15. php artisan make:class Services/ProductService
16. php artisan make:controller Api/ProductController

## 012 - Appointment Treatment Product (Appointment & Product Integration)
1. php artisan make:migration create_appointment_treatment_products_table
2. php artisan make:model AppointmentTreatmentProduct

## 012 - Stocks (Together with Products)
1. Create Enums StockMovementType
2. Create Emums StockReferenceType
3. php artisan make:migration create_stock_movements_table
4. php artisan make:model StockMovement
5. php artisan make:seeder StockMovementSeeder
6. php artisan make:class DTO/Stock/CreateStockDTO
7. php artisan make:class DTO/Stock/UpdateStockDTO
8. php artisan make:interface Repositories/Interfaces/StockRepositoryInterface
9. php artisan make:class Repositories/StockRepository
10. php artisan make:class Services/StockService
11. php artisan make:controller Api/StockController

## 013 - Invoice (Together with Payment and Invoice Item)
1. php artisan make:migration create_tblinvoices_table
2. php artisan make:model Invoice
3. php artisan make:class DTO/Invoice/CreateInvoiceDTO
4. php artisan make:class DTO/Invoice/UpdateInvoiceDTO
5. php artisan make:request InvoiceRequest
6. php artisan make:interface Repositories/Interfaces/InvoiceRepositoryInterface
7. php artisan make:class Repositories/InvoiceRepository
8. php artisan make:class Services/InvoiceService
9. php artisan make:controller Api/InvoiceController
10. php artisan make:resource InvoiceResource

## 014 - Invoice Item (Together with Invoice)
1. php artisan make:migration create_tblinvoice_items_table
2. php artisan make:resource InvoiceItemResource

## 014 - Payment (Together with Invoice)
1. php artisan make:migration create_tblpayments_table
2. php artisan make:model Payment
3. php artisan make:class DTO/Payment/CreatePaymentDTO
4. php artisan make:request PaymentRequest
5. php artisan make:interface Repositories/Interfaces/PaymentRepositoryInterface
6. php artisan make:class Repositories/PaymentRepository
7. php artisan make:class Services/PaymentService
8. php artisan make:controller Api/PaymentController
9. php artisan make:resource PaymentResource


## 015 - Multi Tenant
1. composer require stancl/tenancy
2. php artisan tenancy:install
4. php artisan make:provider EventServiceProvider    
3. php artisan make:listener TenantCreatedListener (to run tenant migration and seeder) 

## API Flow
Controller → Service → Repository → DB
                ↓
              DTO layer


# Architecture

app/
├── Http/Controllers/Api/
├── Services/
├── Repositories/
│   ├── Interfaces/
│   ├── AppointmentRepository.php
│   ├── TreatmentRepository.php
│   ├── BillingRepository.php
├── DTO/
│   ├── AppointmentDTO.php
│   ├── TreatmentDTO.php
│   ├── BillingDTO.php
├── Models/
│   ├── Appointment.php
│   ├── Treatment.php
│   ├── Invoice.php
│   ├── Payment.php


### NOTES

1. Request Validation
✅ Check required fields
✅ Check data types
✅ Check formats
❌ Don't save to database
❌ Don't contain business logic

2. DTO (Data Transfer Object)
✅ Carry data
❌ Business logic
❌ Database queries

3. Service
✅ Business logic
✅ Calculations
✅ Rules
✅ Workflow
❌ Direct HTTP handling

4. Repository
✅ Database queries
✅ CRUD operations
❌ Business rules

5. Repository Service Provider
✅ Tell Laravel which repository implementation to use.

6. Repository Interface
✅ Tell any repository must use specific functions

