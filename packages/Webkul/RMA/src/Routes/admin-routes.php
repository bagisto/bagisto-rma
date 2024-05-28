<?php

use Illuminate\Support\Facades\Route;
use Webkul\RMA\Http\Controllers\Admin\CreateRmaController;
use Webkul\RMA\Http\Controllers\Admin\ReasonController;
use Webkul\RMA\Http\Controllers\Admin\RmaController;

/**
 * RMA routes.
 */
Route::group(['middleware' => ['web', 'admin', 'rma'], 'prefix' => config('app.admin_url')], function () {
    Route::prefix('rma')->group(function () {
        Route::controller(RmaController::class)->group(function () {
            Route::get('', 'index')->name('admin.sales.rma.index');

            Route::get('view/{id}', 'view')->name('admin.sales.rma.view');

            Route::post('save-admin-rma-message', 'sendMessage')->name('admin.sales.rma.send_message');

            Route::post('save-rma-status', 'saveRmaStatus')->name('admin.sales.rma.save.status');
        });

        /**
         * Reason routes.
         */
        Route::controller(ReasonController::class)->group(function () {
            Route::get('reasons', 'index')->name('admin.sales.rma.reason.index');

            Route::post('destroy/{id}', 'destroy')->name('admin.sales.rma.reason.delete');

            Route::get('reason/create', 'create')->name('admin.sales.rma.reason.create');

            Route::post('reason/store', 'store')->name('admin.sales.rma.reason.store');

            Route::get('reasons/edit/{id}', 'edit')->name('admin.sales.rma.reason.edit');

            Route::post('update', 'update')->name('admin.sales.rma.reason.update');

            Route::post('mass-update', 'massUpdate')->name('admin.sales.rma.reason.mass_update');

            Route::post('mass-delete', 'massDestroy')->name('admin.sales.rma.reason.mass_delete');
        });

        /**
         * RMA routes.
         */
        Route::controller(CreateRmaController::class)->group(function () {
            Route::get('create', 'create')->name('admin.sales.rma.create');

            Route::post('store', 'store')->name('admin.sales.rma.store');

            Route::post('update-session', 'rmaSessionUpdate')->name('admin.sales.rma.session');

            Route::post('validate', 'validateRma')->name('admin.sales.rma.validate');
        });
    });
});
