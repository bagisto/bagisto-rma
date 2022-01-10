<?php
Route::group(['middleware' => ['web', 'theme', 'locale', 'currency','rma']], function () {

    //for guest user's route
    Route::prefix('guest')->group(function () {
        Route::namespace('Webkul\RMA\Http\Controllers\Customer')->group(function () {
            Route::get('/login', 'CustomerController@guestLogin')
                ->name('rma.guest.login')
                ->defaults('_config',[
                    'view' => 'rma::shop.guest.account.login',
                ]);

            Route::post('/createlogin', 'CustomerController@guestLoginCreate')
                ->name('rma.guest.logincreate')
                ->defaults('_config',[
                    'redirect' => 'rma::shop.customers.rma.allrma',
                ]);

            Route::get('/newrma', 'CustomerController@guestRMACreate')
                ->name('rma.customers.guestcreaterma')
                ->defaults('_config', [
                    'view' => 'rma::shop.customers.rma.create',
                ]);

            Route::get('rma/id/{id}', 'CustomerController@view')
                ->name('rma.customer.guestview')
                ->defaults('_config', [
                    'view' => 'rma::shop.customers.rma.view',
                ]);

            Route::get('/allrma', 'CustomerController@index')
                ->name('rma.customers.guestallrma')
                ->defaults('_config', [
                    'view' => 'rma::shop.customers.rma.index',
                ]);
            
            Route::get('/get-products/{orderId?}/{resolutionId?}', 'CustomerController@getProducts')
                ->name('rma.customers.getproduct')
                ->defaults('_config',[
                    'redirect' => 'account.RMA'
                ]);
            
            Route::get('/create', 'CustomerController@create')
                ->name('rma.customers.create')
                ->defaults('_config', [
                    'view' => 'rma::shop.customers.rma.create',
                ]);
            
            Route::post('/store', 'CustomerController@store')
                ->name('rma.customers.store')
                ->defaults('_config', [
                    'redirect' => 'rma.customers.allrma'
                ]);
            
            Route::post('/savecustomerrmamessage', 'CustomerController@sendmessage')
                ->name('rma.customer.sendmessage')
                ->defaults('_config',[
                    'redirect' => 'account.RMA'
                ]);

            Route::post('/savermastatus','CustomerController@savestatus')
                ->name('rma.customer.save.rma-status')
                ->defaults('_config',[
                    'redirect' => 'account.RMA'
                ]);
            
            Route::get('/search-order/{orderId?}','CustomerController@searchOrder')
                ->name('rma.customer.search.order');

            Route::get('/guest/reopen/{id}','CustomerController@reopenRMA')
                ->name('rma.guest.reopen.rma-status')
                ->defaults('_config',[
                    'redirect' => 'rma.customers.guestallrma'
                ]);
        });
    });

    Route::group(['middleware' => ['customer']], function () {
    
        // CustomerRMA route starts here
        Route::prefix('customer/account/rma')->group(function () {
            Route::namespace('Webkul\RMA\Http\Controllers\Customer')->group(function () {
                Route::get('/', 'CustomerController@index')
                    ->middleware('customer')
                    ->name('rma.customers.allrma')
                    ->defaults('_config', [
                        'view' => 'rma::shop.customers.rma.index',
                    ]);

                Route::post('/getproductbyseller', 'CustomerController@fetchOrderBySellerName')
                    ->name('rma.customers.getproductbyseller')
                    ->defaults('_config', [
                        'redirect' => 'account.RMA'
                    ]);

                Route::get('view/{id}', 'CustomerController@view')
                    ->name('rma.customer.view')
                    ->defaults('_config', [
                        'view' => 'rma::shop.customers.rma.view',
                    ]);

                Route::get('/reopen/{id}','CustomerController@reopenRMA')
                    ->name('rma.customer.reopen.rma-status')
                    ->defaults('_config',[
                        'redirect' => 'rma.customers.allrma'
                    ]);
            });
        });
    });
});
