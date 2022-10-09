<?php

use App\Http\Controllers\Admin\DashboarAdminController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Tripay\CallbackPaymentController;
use App\Http\Controllers\TunnelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPasswordProfileController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', HomeController::class)->name('home');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::controller(CreditController::class)->group(function () {
        Route::get('credit/create', 'create')->name('credit.create');
        Route::post('credit/create', 'store')->name('credit.store');
    });

    Route::controller(InvoiceController::class)->group(function () {
        Route::get('topup/transaksi', 'create')->name('topup.create');
        Route::post('topup/transaksi', 'store')->name('topup.store');
        Route::get('topup/{reference}/detail', 'show')->name('topup.show');
    });

    Route::controller(TunnelController::class)->group(function () {
        Route::get('tunnels/create', 'create')->name('tunnels.create');
        Route::post('tunnels/create', 'store')->name('tunnels.store');
        Route::get('tunnels', 'index')->name('tunnels.index');
        Route::get('tunnels/details/{tunnel:username}', 'show')->name('tunnels.show');
        Route::patch('tunnels/details/{tunnel:username}', 'update')->name('tunnels.update');
        Route::delete('tunnels/details/{tunnel}', 'destroy')->name('tunnels.delete');
    });


    Route::controller(UserProfileController::class)->group(function () {
        Route::get('profile/{user:phone}', 'edit')->name('profile.edit');
        Route::put('profile/{user:phone}', 'update')->name('profile.edit');
        Route::patch('profile/{user:phone}', 'updatePassword')->name('profilePassword.update');
    });

    Route::controller(RoleController::class)->middleware('only.admin')->group(function () {
        Route::post('roles/assign/{user}', 'assign')->name('roles.assign');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('users', 'index');
        Route::get('/account/edit', 'edit')->name('users.edit');
        Route::put('/account/edit', 'update')->name('users.update');
        Route::get('/{user}', [UserController::class, 'show'])
            ->name('users.show')
            ->withoutMiddleware('auth');
    });

    // admin
    Route::get('admin/dashboard', DashboarAdminController::class)->name('admin.dashboard');
});



Route::post('confirm-payment', [CallbackPaymentController::class, 'handle']);
