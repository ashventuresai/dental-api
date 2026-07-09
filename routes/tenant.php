<?php

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

Route::prefix('v1')->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Public Tenant API
        |--------------------------------------------------------------------------
        */
        Route::post('/login',[AuthController::class,'login']);
        Route::post('/public/consent-forms',[ConsentFormController::class,'storeConsent']);

        /*
        |--------------------------------------------------------------------------
        | Protected Tenant API
        |--------------------------------------------------------------------------
        */
        Route::middleware('auth:sanctum')->group(function(){
            // Route::get('/user',function($request){ return request()->user(); });
            Route::get('/user',[AuthController::class,'user']);
            Route::get('/profile',[AuthController::class,'profile']);
            Route::post('/logout',[AuthController::class,'logout']);

            /*
            |--------------------------------------------------------------------------
            | Patients
            |--------------------------------------------------------------------------
            */
            Route::apiResource('patients', PatientController::class)->parameters(['patients'=>'patient_uuid']);

            /*
            |--------------------------------------------------------------------------
            | Appointments
            |--------------------------------------------------------------------------
            */
            Route::prefix('appointments')->group(function(){
                Route::get('/',[AppointmentController::class,'index']);
                Route::post('/',[AppointmentController::class,'store']);
                Route::get('/patient/{patient_uuid}', [AppointmentController::class, 'historyForPatient']);
                Route::get('/{appointment_uuid}',[AppointmentController::class,'show']);
                Route::put('/{uuid}',[AppointmentController::class,'update']);
                Route::delete('/{uuid}',[AppointmentController::class,'cancel']);
                Route::post('/{uuid}/check-in',[AppointmentController::class,'checkIn']);
                Route::post('/{uuid}/start-treatment',[AppointmentController::class,'startTreatment']);
                Route::post('/{uuid}/waiting-payment',[AppointmentController::class,'markWaitingPayment']);
                Route::post('/{uuid}/complete',[AppointmentController::class,'complete']);
            });

            /*
            |--------------------------------------------------------------------------
            | Treatments
            |--------------------------------------------------------------------------
            */
            Route::apiResource('treatments', TreatmentController::class);

            /*
            |--------------------------------------------------------------------------
            | Staff
            |--------------------------------------------------------------------------
            */
            Route::apiResource('staff',StaffController::class);

            /*
            |--------------------------------------------------------------------------
            | Services
            |--------------------------------------------------------------------------
            */
            Route::apiResource('services',ServicesController::class);

            /*
            |--------------------------------------------------------------------------
            | Products
            |--------------------------------------------------------------------------
            */
            Route::prefix('products')->group(function(){

                Route::get('/',[ProductController::class,'index']);
                Route::post('/',[ProductController::class,'store']);
                Route::get('/categories/options',[ProductCategoryController::class,'options']);
                Route::get('/units/options',[ProductUnitController::class,'options']);
                Route::get('/{id}',[ProductController::class,'show']);
                Route::put('/{id}',[ProductController::class,'update']);
                Route::delete('/{id}',[ProductController::class,'destroy']);
            });

            /*
            |--------------------------------------------------------------------------
            | Stock
            |--------------------------------------------------------------------------
            */
            Route::prefix('stock')->group(function(){

                Route::post('/in',[StockController::class,'stockIn']);
                Route::post('/out',[StockController::class,'stockOut']);
                Route::post('/adjustment',[StockController::class,'adjustment']);
                Route::get('/history/{productId}',[StockController::class,'history']);
            });

            /*
            |--------------------------------------------------------------------------
            | Invoice
            |--------------------------------------------------------------------------
            */
            Route::apiResource('invoices',InvoiceController::class)->only([
                'index',
                'store',
                'show'
            ]);

            /*
            |--------------------------------------------------------------------------
            | Payments
            |--------------------------------------------------------------------------
            */
            Route::apiResource('payments',PaymentController::class)->only([
                'index',
                'store',
                'show'
            ]);

        });
});
