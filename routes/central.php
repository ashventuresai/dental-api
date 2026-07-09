<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Central\TenantController;

Route::prefix('v1')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Public Central API
    |--------------------------------------------------------------------------
    */
    // Route::post('/register',[AuthController::class,'register']);
    // Route::post('/login',[AuthController::class,'login']);

    /*
    |--------------------------------------------------------------------------
    | Authenticated Central User
    |--------------------------------------------------------------------------
    */
    // Route::middleware('auth:sanctum')->group(function(){
    //     Route::post('/logout',[AuthController::class,'logout']);
    //     Route::get('/profile',[AuthController::class,'profile']);
    // });

    /*
    |--------------------------------------------------------------------------
    | Tenant Management
    |--------------------------------------------------------------------------
    */
    Route::post('/tenants',[TenantController::class,'store']);
    Route::get('/tenant',[TenantController::class,'show']);

});
