<?php

namespace Webkul\RMA\Providers;

use Webkul\Core\Tree;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

use Webkul\RMA\Http\Middleware\Rma;
use Webkul\RMA\Console\Commands\Install;

class RMAServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        include __DIR__ . '/../Http/front-routes.php';
        include __DIR__ . '/../Http/admin-routes.php';

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'rma');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'rma');

        $this->publishes([
            __DIR__ . '/../Resources/views/shop/velocity/customers/account/index.blade.php'
            => resource_path('themes/velocity/views/customers/account/index.blade.php'),

            __DIR__ . '/../Resources/views/shop/velocity/customers/account/partials/sidemenu.blade.php'
            => resource_path('themes/velocity/views/customers/account/partials/sidemenu.blade.php'),

            __DIR__ . '/../Resources/views/shop/default/customers/account/partials/sidemenu.blade.php'
            => resource_path('themes/default/views/customers/account/partials/sidemenu.blade.php'),

            __DIR__ . '/../Resources/views/shop/velocity/UI/header.blade.php'
            => resource_path('themes/velocity/views/UI/header.blade.php'),

            __DIR__ . '/../Resources/views/admin/sales/shipments/create.blade.php'
            => resource_path('/views/vendor/admin/sales/shipments/create.blade.php'),

            __DIR__ . '/../Resources/views/admin/sales/orders/view.blade.php'
            => resource_path('/views/vendor/admin/sales/orders/view.blade.php'),

            __DIR__ . '/../Resources/views/admin/sales/invoices/create.blade.php'
            => resource_path('/views/vendor/admin/sales/invoices/create.blade.php'),
        ]);

        Event::listen('bagisto.shop.layout.head', function ($viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('rma::shop.layouts.style');
        });

        $this->app->register(RepositoryServiceProvider::class);

        $router->aliasMiddleware('rma', Rma::class);

        if ($this->app->runningInConsole()) {
            $this->commands([
                Install::class
            ]);
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
    }

    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/system.php', 'core'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/menu.php', 'menu.customer'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/admin-menu.php', 'menu.admin'
        );
    }
}
