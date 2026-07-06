<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\ConsentFormController;
use App\Http\Controllers\Api\StaffController;
use App\Http\Controllers\Api\ServicesController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\TreatmentController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductCategoryController;
use App\Http\Controllers\Api\ProductUnitController;
use App\Http\Controllers\Api\StockController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\PaymentController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/public/consent-forms', [ConsentFormController::class, 'storeConsent']);

    Route::middleware('auth:sanctum')->group(function () {

        // Users
        Route::get('/user', function (Request $request) { return $request->user(); });
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::post('/logout', [AuthController::class, 'logout']);

         // Admin only
        Route::middleware('role:admin')->group(function () {
            Route::post('/admin/users', [AuthController::class, 'createUser']);
        });

        // Patients
        Route::get('/patients', [PatientController::class, 'index']);
        Route::post('/patients', [PatientController::class, 'store']);
        Route::put('/patients/{patient_uuid}', [PatientController::class, 'update']);
        Route::delete('/patients/{patient_uuid}', [PatientController::class, 'destroy']);

        Route::prefix('appointments')->group(function () {
            Route::get('/', [AppointmentController::class, 'index']);// Done
            Route::post('/', [AppointmentController::class, 'store']); // Done
            Route::get('/patient/{patient_uuid}', [AppointmentController::class, 'historyForPatient']);
            Route::get('/{appointment_uuid}', [AppointmentController::class, 'show']); // Done
            Route::put('/{uuid}', [AppointmentController::class, 'update']); // Done
            Route::delete('/{uuid}', [AppointmentController::class, 'cancel']);

            Route::post('/{uuid}/check-in', [AppointmentController::class, 'checkIn']);
            Route::post('/{uuid}/start-treatment', [AppointmentController::class, 'startTreatment']);
            Route::post('/{uuid}/waiting-payment', [AppointmentController::class, 'markWaitingPayment']);
            Route::post('/{uuid}/complete', [AppointmentController::class, 'complete']);
        });

        Route::prefix('treatments')->group(function () {
            Route::get('/', [TreatmentController::class, 'index']);
            Route::post('/', [TreatmentController::class, 'store']); // Done
            Route::get('/{uuid}', [TreatmentController::class, 'show']);
            Route::put('/{uuid}', [TreatmentController::class, 'update']); // Done
            Route::delete('/{uuid}', [TreatmentController::class, 'destroy']);
        });

        Route::prefix('staff')->group(function () {
            Route::get('/', [StaffController::class, 'index']);
            Route::get('/{uuid}', [StaffController::class, 'show']);
            Route::post('/', [StaffController::class, 'store']);
            Route::put('/{uuid}', [StaffController::class, 'update']);
            Route::delete('/{uuid}', [StaffController::class, 'destroy']);
        });

        Route::prefix('services')->group(function () {
            Route::get('/',[ServicesController::class,'index']);
            Route::get('/{uuid}',[ServicesController::class,'show']);
            Route::post('/',[ServicesController::class,'store']);
            Route::put('/{uuid}',[ServicesController::class,'update']);
            Route::delete('/{uuid}',[ServicesController::class,'destroy']);
        });

        Route::prefix('products')->group(function () {
            Route::get('/', [ProductController::class, 'index']);
            Route::post('/', [ProductController::class, 'store']);
            Route::get('/categories/options', [ProductCategoryController::class, 'options']);
            Route::get('/units/options', [ProductUnitController::class, 'options']);
            Route::get('/{id}', [ProductController::class, 'show']);
            Route::put('/{id}', [ProductController::class, 'update']);
            Route::delete('/{id}', [ProductController::class, 'destroy']);
        });

        Route::prefix('stock')->group(function () {
            Route::post('/in', [StockController::class, 'stockIn']);
            Route::post('/out', [StockController::class, 'stockOut']);
            Route::post('/adjustment', [StockController::class, 'adjustment']);
            Route::get('/history/{productId}', [StockController::class, 'history']);
        });

        Route::prefix('invoices')->group(function () {
            Route::get('/', [InvoiceController::class, 'index']);
            Route::post('/', [InvoiceController::class, 'store']);
            Route::get('/{invoice_uuid}', [InvoiceController::class, 'show']);
        });

        Route::prefix('payments')->group(function () {
            Route::get('/', [PaymentController::class, 'index']);
            Route::post('/', [PaymentController::class, 'store']);
            Route::get('/{payment_uuid}', [PaymentController::class, 'show']);
        });

    });

});
