<?php

use Illuminate\Support\Facades\Route;
use Webkul\RMA\Http\Controllers\Customer\CustomerController;

Route::group(['middleware' => ['web', 'theme', 'locale', 'currency', 'rma']], function () {
    /**
     * Guest routes.
     */
    Route::controller(CustomerController::class)->group(function () {

        Route::prefix('guest')->middleware('guest-rma')->group(function () {
            Route::get('login', 'guestLogin')->name('rma.guest.login');

            Route::get('logout', 'guestLogout')->name('rma.guest.logout');

            Route::post('create-login', 'guestLoginCreate')->name('rma.guest.login-create');

            Route::get('all-rma', 'index')->name('shop.guest.all-rma');

            Route::get('new-rma', 'guestRmaCreate')->name('shop.guest.create-rma');

            Route::get('cancel/{id}', 'cancelRMAStatus')->name('rma.guest.cancelRMAStatus');

            Route::get('guest/getOrderProduct/{orderId}', 'getOrderProduct')->name('rma.guest.getOrderProduct');

            Route::get('get-resolution-reason/{resolutionType}', 'getResolutionReason')->name('rma.guest.getResolutionReason');

            Route::post('store', 'storeGuest')->name('rma.guest.store');

            Route::get('rma/id/{id}', 'view')->name('rma.customer.guest-view')->middleware('guest');

            Route::post('save-customer-message', 'guestSendMessage')->name('rma.customer.guest-send-message');

            Route::post('save-rma-status', 'saveStatus')->name('rma.guest.save.rma-status');

            Route::post('save-rma-reopen-status', 'saveReOpenStatus')->name('rma.guest.save.rma-reopen-status');

            Route::get('guest/reopen/{id}', 'reopenRMA')->name('rma.guest.reopen.rma-status');

            Route::get('search-order/{orderId?}', 'searchOrder')->name('rma.guest.search.order');

            Route::get('getOrders/{orderId?}/{resolutionId?}', 'getOrders')->name('rma.guest.get-orders');

            Route::get('get-products/{orderId?}/{resolutionId?}', 'getProducts')->name('rma.guest.get-product');

            Route::get('get-messages', 'getMessages')->name('rma.guest.get-messages');

            Route::post('send-message', 'sendMessage')->name('rma.guest.send-message');
        });

        /**
         * customer routes.
         */
        Route::group(['prefix' => 'customer/account/rma', 'middleware' => 'customer'], function () {
            Route::get('', 'index')->name('rma.customers.all-rma');

            Route::get('view/{id}', 'view')->name('rma.customer.view');

            Route::get('cancel/{id}', 'cancelRMAStatus')->name('rma.customer.cancelRMAStatus');

            Route::get('create', 'create')->name('rma.customers.create');

            Route::get('getOrderProduct/{orderId}', 'getOrderProduct')->name('rma.customers.getOrderProduct');

            Route::get('get-resolution-reason/{resolutionType}', 'getResolutionReason')->name('rma.customers.getResolutionReason');

            Route::post('store', 'store')->name('rma.customers.store');

            Route::get('reopen/{id}', 'reopenRMA')->name('rma.customer.reopen.rma-status');

            Route::post('get-product-by-seller', 'fetchOrderBySellerName')->name('rma.customers.get-product-by-seller');

            Route::get('get-products/{orderId?}/{resolutionId?}', 'getProducts')->name('rma.customers.get-product');

            Route::get('get-messages', 'getMessages')->name('rma.customer.get-messages');

            Route::post('send-message', 'sendMessage')->name('rma.customer.send-message');

            Route::post('save-rma-status', 'saveStatus')->name('rma.customer.save.rma-status');

            Route::post('save-rma-reopen-status', 'saveReOpenStatus')->name('rma.customer.save.rma-reopen-status');

            Route::post('add-new-rma-reason/{orderId?}', 'addReason')->name('rma.customers.reason.create');

            Route::get('search-order/{orderId?}', 'searchOrder')->name('rma.customer.search.order');

            Route::get('getOrders/{orderId?}/{resolutionId?}', 'getOrders')->name('rma.customers.get-orders');
        });
    });
});