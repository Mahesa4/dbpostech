<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HaiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellingController;
use App\Http\Controllers\PurchasingController;
use App\Http\Controllers\UserController;


Route::get('/postech/{nik}/{nama}/cek', [HaiController::class, 'index']);

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('dashboard', [DashboardController    ::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::get('user-export', [UserController::class, 'export'])->name('user-export');
    Route::post('user-import', [UserController::class, 'import'])->name('user-import');
    Route::post('sellings-import', [SellingController::class, 'import'])->name('sellings-import');
    Route::get('sellings-export', [SellingController::class, 'export'])->name('sellings-export');
    Route::post('purchasings-import', [PurchasingController::class, 'import'])->name('purchasings-import');
    Route::get('purchasings-export', [PurchasingController::class, 'export'])->name('purchasings-export');

    Route::resource('products', ProductController::class);
    Route::resource('sellings', SellingController::class);
    Route::resource('purchasings', PurchasingController::class);
    Route::get('report/sellings', [SellingController::class, 'report'])->name('sellings-report');
    Route::get('report/sellings/pdf', [SellingController::class, 'reportPdf'])->name('sellings-reportPdf');
    Route::get('report/purchasings', [PurchasingController::class, 'report'])->name('purchasings-report');
    Route::get('report/purchasings/pdf', [PurchasingController::class, 'reportPdf'])->name('purchasings-reportPdf');
});
