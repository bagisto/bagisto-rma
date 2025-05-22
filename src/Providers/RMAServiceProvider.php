<?php

namespace Webkul\RMA\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Webkul\Core\Providers\CoreServiceProvider;
use Webkul\RMA\Console\Commands\InstallRMA;
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
        /**
         * Load Route
         */
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');

        /**
         * Load View files
         */
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'rma');

        /**
         * Migrations
         */
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        /**
         * Translations file
         */
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'rma');

        /**
         * Component*
         */
        Blade::anonymousComponentPath(__DIR__ . '/../Resources/views/components', 'rma');

        /**
         * Set Middlewares
         */
        $router->aliasMiddleware('rma', RMA::class);

        $router->aliasMiddleware('guest-rma', Guest::class);

        /**
         * Breadcrumbs
         */
        $this->loadRoutesFrom(__DIR__ . '/../Routes/breadcrumbs.php');

        /**
         * Class Register
         */
        $this->app->register(ModuleServiceProvider::class);

        $this->app->register(EventServiceProvider::class);

        /**
         * Install Command
         */
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallRMA::class,
            ]);
        }

        /**
         * Configure
         */
        if (
            ! $this->app->runningInConsole()  
            && core()->getConfigData('sales.rma.setting.enable_rma')
        ) {
            $this->mergeConfigFrom(
                dirname(__DIR__) . '/Config/admin-acl.php',
                'acl'
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
        
        // Publish Files
        $this->publishFiles();
        
        // Publish Assets
        $this->publishAssets();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(CoreServiceProvider::class);

        $this->app->register(\Konekt\Concord\ConcordServiceProvider::class);

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/system.php',
            'core'
        );

        // Register vite configuration 
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/bagisto-vite.php',
            'bagisto-vite.viters'
        );
    }

    /**
     * Publish files.
     *
     * @return void
     */
    public function publishFiles()
    {
        /**
         * create shipments order
         */
        $this->publishes([
            __DIR__ . '/../Resources/views/admin/sales/shipments/create.blade.php'
            => resource_path('/views/vendor/admin/sales/shipments/create.blade.php'),
        ]);

        /**
         * create invoices order
         */
        $this->publishes([
            __DIR__ . '/../Resources/views/admin/sales/invoices/create.blade.php'
            => resource_path('/views/vendor/admin/sales/invoices/create.blade.php'),
        ]);

        /**
         * create refund order
         */
        $this->publishes([
            __DIR__ . '/../Resources/views/components/admin/sales/refunds/create.blade.php'
            => resource_path('/views/vendor/admin/sales/refunds/create.blade.php'),
        ]);

        /**
         * view order page
         */
        $this->publishes([
            __DIR__ . '/../Resources/views/components/admin/sales/orders/view.blade.php'
            => resource_path('/views/vendor/admin/sales/orders/view.blade.php'),
        ]);

        /**
         * header mobile view
         */
        $this->publishes([
            __DIR__ . '/../Resources/views/components/layouts/header/mobile/index.blade.php'
            => resource_path('themes/default/views/components/layouts/header/mobile/index.blade.php'),
        ]);
        
        /**
         * user order view
         */
        $this->publishes([
            __DIR__ . '/../Resources/views/components/shop/customers/account/orders/view.blade.php'
            => resource_path('themes/default/views/customers/account/orders/view.blade.php'),
        ]);

        /**
         * header mobile view
         */
        $this->publishes([
            __DIR__ . '/../Resources/views/components/admin/configuration/field-type.blade.php'
            => resource_path('/views/vendor/admin/configuration/field-type.blade.php'),
        ]);
    }

    /**
     * Publish the assets.
     *
     * @return void
     */
    protected function publishAssets()
    {
        $this->publishes([
            __DIR__ .'/../../publishable' => public_path('themes/rma')
        ], 'public');
    }
}