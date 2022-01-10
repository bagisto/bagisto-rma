<?php
Route::group(['middleware' => ['web', 'admin','rma']], function () {
    Route::prefix('admin/rma')->group(function () {
        Route::namespace('Webkul\RMA\Http\Controllers\Admin')->group(function () {
            //admin routes for all requests
            Route::get('/requests', 'AdminController@index')->defaults('_config', [
                'view' => 'rma::admin.allrma.index',
            ])->name('admin.rma.index');

            Route::get('/view/{id}', 'AdminController@view')
                ->defaults('_config', [
                    'view' => 'rma::admin.allrma.view',
                ])
                ->name('admin.rma.view');

            //reasons route
            Route::get('/reasons', 'AdminController@index')
                ->defaults('_config', [
                    'view' => 'rma::admin.reasons.rma-listing',
                ])
                ->name('admin.rma.reason.index');

            Route::get('/reasons/create', 'AdminController@index')
                ->defaults('_config', [
                    'view' => 'rma::admin.reasons.create',
                ])
                ->name('admin.rma.reason.create');

            Route::post('/store', 'AdminController@store')
                ->defaults('_config', [
                    'redirect' => 'admin.rma.reason.index',
                ])
                ->name('admin.rma.reason.store');

            Route::get('/reasons/edit/{id}', 'AdminController@edit')
                ->defaults('_config', [
                    'view' => 'rma::admin.reasons.edit',
                ])
                ->name('admin.rma.reason.edit');

            Route::post('/update', 'AdminController@update')
                ->defaults('_config', [
                    'redirect' => 'admin.rma.reason.index',
                ])
                ->name('admin.rma.reason.update');

            Route::get('/delete/{id}', 'AdminController@delete')
                ->name('admin.rma.reason.delete');

            Route::post('/massdelete', 'AdminController@massdelete')
                ->defaults('_config', [
                    'redirect' => 'admin.rma.reason.index',
                ])
                ->name('admin.rma.reason.massdelete');

            Route::post('/massupdate', 'AdminController@massUpdate')
                ->defaults('_config', [
                    'redirect' => 'admin.rma.reason.index',
                ])
                ->name('admin.rma.reason.massupdate');

            Route::post('/saveadminrmamessage', 'AdminController@sendmessage')
                ->defaults('_config', [
                    'redirect' => 'admin.rma.reason.index',
                ])
                ->name('admin.rma.sendmessage');

            Route::post('/savermastatus', 'AdminController@savermastatus')
                ->defaults('_config', [
                    'redirect' => 'admin.rma.reason.index',
                ])
                ->name('rma.admin.save.status');
        });
    });
});
