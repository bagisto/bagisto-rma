<?php

use Illuminate\Support\Facades\Route;
use Webkul\RMA\Http\Controllers\Customer\CustomerController;

/**
 * Guest routes.
 */
Route::group(['middleware' => ['web', 'theme', 'locale', 'currency', 'rma']], function () {
    Route::controller(CustomerController::class)->group(function () {
        Route::prefix('guest')->group(function () {
            Route::get('login', 'guestLogin')->name('rma.guest.login');

            Route::post('createlogin', 'guestLoginCreate')->name('rma.guest.login_create');

            Route::get('allrma', 'index')->name('shop.guest.allrma');

            Route::get('newrma', 'guestRmaCreate')->name('shop.guest.create_rma');

            Route::get('rma/id/{id}', 'view')->name('rma.customer.guestview')->middleware('guest');

            Route::post('save-customer-message', 'sendMessage')->name('rma.customer.send_message');

            Route::post('save-rma-status', 'savestatus')->name('rma.customer.save.rma_status');

            Route::get('guest/reopen/{id}', 'reopenRMA')->name('rma.guest.reopen.rma_status');
        });

        /**
         * customer routes.
         */
        Route::group(['middleware' => ['customer']], function () {
            Route::prefix('customer/account/rma')->group(function () {
                Route::get('/', 'index')->name('rma.customers.allrma');

                Route::get('view/{id}', 'view')->name('rma.customer.view');

                Route::get('create', 'create')->name('rma.customers.customer_create_rma');

                Route::get('reopen/{id}', 'reopenRMA')->name('rma.customer.reopen.rma_status');

                Route::post('getproductbyseller', 'fetchOrderBySellerName')->name('rma.customers.get_product_by_seller');
            });
        });

        Route::get('get-products/{orderId?}/{resolutionId?}', 'getProducts')->name('rma.customers.get_product');

        Route::post('store', 'store')->name('rma.customers.store');

        Route::post('add-new-rma-reason/{orderId?}', 'addReason')->name('rma.customers.customer_create_rma.add_reason');

        Route::get('search-order/{orderId?}', 'searchOrder')->name('rma.customer.search.order');

        Route::get('getOrders/{orderId?}/{resolutionId?}', 'getOrders')->name('rma.customers.get_orders');
    });
});
