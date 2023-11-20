<?php

use Webkul\RMA\Http\Controllers\Admin\AdminController;

Route::group(['middleware' => ['web', 'admin','rma']], function () {
    Route::prefix('admin/rma')->group(function () {
        
        Route::namespace('Webkul\RMA\Http\Controllers\Admin')->group(function () {

            //admin routes for all requests
            Route::get('/requests', [AdminController::class, 'index'])->defaults('_config', [
                'view' => 'rma::admin.allrma.index',
            ])->name('admin.rma.index');

            Route::get('/view/{id}', [AdminController::class, 'view'])->defaults('_config', [
                'view' => 'rma::admin.allrma.view',
            ])->name('admin.rma.view');

            //reasons route
            Route::get('/reasons', [AdminController::class, 'index'])->defaults('_config', [
                'view' => 'rma::admin.reasons.rma-listing',
            ])->name('admin.rma.reason.index');

             //create route
             Route::get('/create', [AdminController::class, 'createRma'])->defaults('_config', [
                 'view' => 'rma::admin.rma.create',
             ])->name('admin.rma.create');

            //create route
            Route::post('/validate', [AdminController::class, 'validateRma'])->defaults('_config', [
                'view' => 'rma::admin.rma.create',
            ])->name('admin.rma.validate');

            Route::get('/reasons/create', [AdminController::class, 'index'])->defaults('_config', [
                'view' => 'rma::admin.reasons.create',
            ])->name('admin.rma.reason.create');

            Route::post('/store', [AdminController::class, 'store'])->defaults('_config', [
                'redirect' => 'admin.rma.reason.index',
            ])->name('admin.rma.reason.store');

            Route::get('/reasons/edit/{id}', [AdminController::class, 'edit'])->defaults('_config', [
                'view' => 'rma::admin.reasons.edit',
            ])->name('admin.rma.reason.edit');

            Route::post('/update', [AdminController::class, 'update'])->defaults('_config', [
                'redirect' => 'admin.rma.reason.index',
            ])->name('admin.rma.reason.update');

            Route::post('/delete/{id}', [AdminController::class, 'delete'])->name('admin.rma.reason.delete');

            Route::post('/massdelete', [AdminController::class, 'massDelete'])->defaults('_config', [
                'redirect' => 'admin.rma.reason.index',
            ])->name('admin.rma.reason.massdelete');

            Route::post('/massupdate', [AdminController::class, 'massUpdate'])->defaults('_config', [
                'redirect' => 'admin.rma.reason.index',
            ])->name('admin.rma.reason.massupdate');

            Route::post('/saveadminrmamessage', [AdminController::class, 'sendMessage'])->defaults('_config', [
                'redirect' => 'admin.rma.reason.index',
            ])->name('admin.rma.sendmessage');

            Route::post('/savermastatus', [AdminController::class, 'saveRmaStatus'])->defaults('_config', [
                'redirect' => 'admin.rma.reason.index',
            ])->name('rma.admin.save.status');

            Route::post('/store-rma', [AdminController::class, 'storeRmaData'])->name('rma.admin.store.rma');
        });
    });
});
