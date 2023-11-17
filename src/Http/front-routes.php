<?php

use Webkul\RMA\Http\Controllers\Customer\CustomerController;
use Webkul\RMA\Http\Controllers\Admin\AdminController;

Route::group(['middleware' => ['web', 'theme', 'locale', 'currency','rma']], function () {

    //for guest user's route
    Route::prefix('guest')->group(function () {
        Route::namespace('Webkul\RMA\Http\Controllers\Customer')->group(function () {

            Route::get('/login', [CustomerController::class, 'guestLogin'])
                ->name('rma.guest.login')
                ->defaults('_config',[
                    'view' => 'rma::shop.guest.account.login',
            ]);

            Route::post('/createlogin', [CustomerController::class, 'guestLoginCreate'])
                ->name('rma.guest.logincreate')
                ->defaults('_config',[
                    'redirect' => 'rma::shop.customers.rma.allrma',
            ]);

            Route::get('/newrma', [CustomerController::class, 'guestRMACreate'])
                ->name('rma.customers.guestcreaterma')
                ->defaults('_config', [
                    'view' => 'rma::shop.guest.account.create',
            ]);

            Route::get('rma/id/{id}', [CustomerController::class, 'view'])
                ->name('rma.customer.guestview')
                ->middleware('guest')
                ->defaults('_config', [
                    'view' => 'rma::shop.guest.account.view',
            ]);

            Route::get('/allrma', [CustomerController::class, 'index'])
                ->name('rma.customers.allrma')
                ->defaults('_config', [
                    'view' => 'rma::shop.guest.account.index',
            ]);
            
            Route::get('/get-products/{orderId?}/{resolutionId?}', [CustomerController::class, 'getProducts'])
                ->name('rma.customers.getproduct')
                ->defaults('_config',[
                    'redirect' => 'account.RMA'
            ]);
            
            Route::get('/create', [CustomerController::class, 'create'])
                ->name('rma.customers.create')
                ->defaults('_config', [
                    'view' => 'rma::shop.customers.rma.create',
            ]);
            
            Route::post('/store', [CustomerController::class, 'store'])
                ->name('rma.customers.store')
                ->defaults('_config', [
                    'redirect' => 'rma.customers.allrma'
            ]);
            
            Route::post('/savecustomerrmamessage', [CustomerController::class, 'sendmessage'])
                ->name('rma.customer.sendmessage')
                ->defaults('_config',[
                    'redirect' => 'account.RMA'
            ]);

            Route::post('/savermastatus', [CustomerController::class, 'savestatus'])
                ->name('rma.customer.save.rma-status')
                ->defaults('_config',[
                    'redirect' => 'account.RMA'
            ]);
            
            Route::get('/search-order/{orderId?}', [CustomerController::class, 'searchOrder'])
            ->name('rma.customer.search.order');
            
            Route::get('/customer/reopen/{id}', [CustomerController::class, 'reopenRMA'])
                ->name('rma.guest.reopen.rma-status')
                ->defaults('_config',[
                    'redirect' => 'rma.customers.allrma'
            ]);

        });
    });

    Route::group(['middleware' => ['customer']], function () {
    
        // CustomerRMA route starts here
        Route::prefix('customer/account/rma')->group(function () {
            Route::namespace('Webkul\RMA\Http\Controllers\Customer')->group(function () {
                
                Route::get('/', [CustomerController::class, 'index'])
                ->middleware('customer')
                ->name('rma.customers.allrma')
                ->defaults('_config', [
                    'view' => 'rma::shop.customers.rma.index',
                ]);

                Route::post('/getproductbyseller', [CustomerController::class, 'fetchOrderBySellerName'])
                    ->name('rma.customers.getproductbyseller')
                    ->defaults('_config', [
                        'redirect' => 'account.RMA'
                ]);

                Route::get('view/{id}',[CustomerController::class, 'view'] )
                    ->name('rma.customer.view')
                    ->defaults('_config', [
                        'view' => 'rma::shop.customers.rma.view',
                ]);

                Route::get('/reopen/{id}',[CustomerController::class, 'reopenRMA'])
                    ->name('rma.customer.reopen.rma-status')
                    ->defaults('_config',[
                        'redirect' => 'rma.customers.allrma'
                ]);

                Route::post('/add-new-rma-reason/{orderId?}', [CustomerController::class, 'addReason'])
                ->name('rma.customers.customercreaterma.addreason')
                ->defaults('_config', [
                    'redirect' => 'rma::shop.customers.rma.create',
                ]);
            });
        });
      
    });

    Route::get('/getOrders/{orderId?}/{resolutionId?}', [CustomerController::class, 'getOrders'])
    ->name('rma.customers.getorders');

    Route::post('/rma/updatesession', [AdminController::class , 'rmaSessionUpdate'])
    ->middleware('admin')
    ->name('rma.remove.session');
});