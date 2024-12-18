<?php

namespace Webkul\RMA\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (core()->getConfigData('sales.rma.setting.enable_rma')) {
            Event::listen('bagisto.shop.components.layouts.header.desktop.bottom.profile.after', function ($viewRenderEventManager) {
                $viewRenderEventManager->addTemplate('rma::shop.layouts.desktop.header');
            });

            Event::listen('bagisto.admin.catalog.product.edit.form.settings.after', function ($viewRenderEventManager) {
                $viewRenderEventManager->addTemplate('rma::admin.product.edit-product');
            });

            Event::listen(
                'catalog.product.update.after',
                'Webkul\RMA\Listeners\AllowRMA@afterProductCreatedUpdated'
            );
        }

        Event::listen('bagisto.shop.layout.head', function ($viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('rma::style.index');
        });

        Event::listen('bagisto.admin.layout.head', function ($viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('rma::style.index');
        });

        Event::listen('bagisto.shop.layout.rma.guest.login.before', function ($viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('rma::style.index');
        });
    }
}