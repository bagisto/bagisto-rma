<?php

use Illuminate\Support\Facades\Route;
use Webkul\RMA\Http\Controllers\Admin\CreateRmaController;
use Webkul\RMA\Http\Controllers\Admin\CustomFieldController;
use Webkul\RMA\Http\Controllers\Admin\ReasonController;
use Webkul\RMA\Http\Controllers\Admin\RmaController;
use Webkul\RMA\Http\Controllers\Admin\RmaRulesController;
use Webkul\RMA\Http\Controllers\Admin\RmaStatusController;

Route::group([
    'middleware' => ['web', 'admin', 'rma'],
    'prefix'     => config('app.admin_url') . '/rma',
], function () {
    /**
     * RMA routes.
     */
    Route::controller(RmaController::class)->group(function () {
        Route::get('all', 'index')->name('admin.sales.rma.index');

        Route::get('get-messages', 'getMessages')->name('admin.sales.rma.get-messages');

        Route::post('send-message', 'sendMessage')->name('admin.sales.rma.send-message');

        Route::get('view/{id}', 'view')->name('admin.sales.rma.view');

        Route::post('save-rma-status', 'saveRmaStatus')->name('admin.sales.rma.save.status');
    });

    /**
     * Reason routes.
     */
    Route::controller(ReasonController::class)->prefix('reasons')->group(function () {
        Route::get('', 'index')->name('admin.sales.rma.reason.index');

        Route::post('store', 'store')->name('admin.sales.rma.reason.store');

        Route::get('edit/{id}', 'edit')->name('admin.sales.rma.reason.edit');

        Route::put('edit/{id}', 'update')->name('admin.sales.rma.reason.update');

        Route::delete('edit/{id}', 'destroy')->name('admin.sales.rma.reason.delete');

        Route::post('mass-update', 'massUpdate')->name('admin.sales.rma.reason.mass_update');

        Route::post('mass-delete', 'massDestroy')->name('admin.sales.rma.reason.mass_delete');
    });

    /**
     * RMA Status routes.
     */
    Route::controller(RmaStatusController::class)->prefix('rma-status')->group(function () {
        Route::get('', 'index')->name('admin.sales.rma.rma-status.index');

        Route::post('store', 'store')->name('admin.sales.rma.rma-status.store');

        Route::get('edit/{id}', 'edit')->name('admin.sales.rma.rma-status.edit');

        Route::put('edit/{id}', 'update')->name('admin.sales.rma.rma-status.update');

        Route::delete('edit/{id}', 'destroy')->name('admin.sales.rma.rma-status.delete');

        Route::post('mass-update', 'massUpdate')->name('admin.sales.rma.rma-status.mass-update');

        Route::post('mass-delete', 'massDestroy')->name('admin.sales.rma.rma-status.mass-delete');
    });

    /**
     * RMA routes.
     */
    Route::controller(CreateRmaController::class)->group(function () {
        Route::get('create', 'create')->name('admin.sales.rma.create');

        Route::post('store', 'store')->name('admin.sales.rma.store');

        Route::get('getOrderProduct/{orderId}', 'getOrderProduct')->name('admin.sales.rma.getOrderProduct');

        Route::get('get-resolution-reason/{resolutionType}', 'getResolutionReason')->name('admin.sales.rma.getResolutionReason');

        Route::post('update-session', 'rmaSessionUpdate')->name('admin.sales.rma.session');

        Route::get('get-resolution-reason/{resolution}', 'getResolutionReason')->name('rma.admin.getResolutionReason');
    });

    /**
     * RMA Rules routes.
     */
    Route::controller(RmaRulesController::class)->prefix('rules')->group(function () {
        Route::get('', 'index')->name('admin.sales.rma.rules.index');

        Route::post('store', 'store')->name('admin.sales.rma.rules.store');

        Route::get('edit/{id}', 'edit')->name('admin.sales.rma.rules.edit');

        Route::put('edit/{id}', 'update')->name('admin.sales.rma.rules.update');

        Route::delete('delete/{id}', 'destroy')->name('admin.sales.rma.rules.delete');

        Route::post('mass-update', 'massUpdate')->name('admin.sales.rma.rules.mass-update');

        Route::post('mass-delete', 'massDestroy')->name('admin.sales.rma.rules.mass-delete');
    });

    /**
     * RMA Rules routes.
     */
    Route::controller(CustomFieldController::class)->prefix('custom-field')->group(function () {
        Route::get('', 'index')->name('admin.sales.rma.custom-field.index');

        Route::get('create', 'create')->name('admin.sales.rma.custom-field.create');

        Route::post('store', 'store')->name('admin.sales.rma.custom-field.store');

        Route::get('edit/{id}', 'edit')->name('admin.sales.rma.custom-field.edit');

        Route::post('update/{id}', 'update')->name('admin.sales.rma.custom-field.update');

        Route::delete('delete/{id}', 'destroy')->name('admin.sales.rma.custom-field.delete');

        Route::post('mass-update', 'massUpdate')->name('admin.sales.rma.custom-field.mass-update');

        Route::post('mass-delete', 'massDestroy')->name('admin.sales.rma.custom-field.mass-delete');
    });
});