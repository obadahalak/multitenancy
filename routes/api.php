<?php

use App\Models\User;
use App\Facade\Tenant;
use App\Models\MyService;
use Illuminate\Http\Request;

use App\Services\TenantService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Tenants\TanentController;
use App\Http\Controllers\Tenants\TenantServiceController;



// serviceAvilabe
Route::controller(TanentController::class)->group(function () {

    Route::get('/auth', 'login');
});
Route::controller(TenantServiceController::class)->group(function () {

    Route::get('/myServices', 'services')->middleware(['auth:tenant']);
});

Route::middleware('tenant')->group(function () {


    Route::controller(UserController::class)->group(function () {
        Route::post('/store', 'store');
        Route::get('/profile', 'user');
        Route::get('/image','image');
    });



});
