<?php

namespace Webkul\RMA\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Webkul\RMA\Console\Commands\Install;
use Webkul\RMA\Http\Middleware\Guest;
use Webkul\RMA\Http\Middleware\Rma;

class RMAServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'rma');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'rma');

        Blade::anonymousComponentPath(__DIR__ . '/../Resources/views/components', 'rma');

        /* Breadcrumbs */
        $this->loadRoutesFrom(__DIR__ . '/../Routes/breadcrumbs.php');

        $router->aliasMiddleware('rma', Rma::class);

        $router->aliasMiddleware('guest-rma', Guest::class);

        $this->app->register(ModuleServiceProvider::class);

        $this->app->register(EventServiceProvider::class);

        $this->publishes([
            __DIR__ . '/../Resources/views/shop/layouts/header.blade.php' => __DIR__ . '/../../../Shop/src/Resources/views/components/layouts/header/desktop/top.blade.php',

            __DIR__ . '/../Resources/views/admin/sales/shipments/create.blade.php' => resource_path('/views/vendor/admin/sales/shipments/create.blade.php'),

            __DIR__ . '/../Resources/views/admin/sales/orders/view.blade.php' => resource_path('/views/vendor/admin/sales/orders/view.blade.php'),

            __DIR__ . '/../Resources/views/admin/sales/invoices/create.blade.php' => resource_path('/views/vendor/admin/sales/invoices/create.blade.php'),
        ]);

        app(\Webkul\Core\Core::class);

        if (core()->getConfigData('sales.rma.setting.enable_rma')) {
            $this->mergeConfigFrom(
                dirname(__DIR__) . '/Config/acl.php', 'acl'
            );

            $this->mergeConfigFrom(
                dirname(__DIR__) . '/Config/admin-menu.php',
                'menu.admin'
            );

            $this->mergeConfigFrom(
                dirname(__DIR__) . '/Config/shop-menu.php',
                'menu.customer'
            );
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/system.php',
            'core'
        );

        $this->commands([
            Install::class,
        ]);
    }
}
