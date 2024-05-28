<?php

namespace Webkul\RMA\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    /**
     * Define the models provided by this module
     */
    protected $models = [
        \Webkul\RMA\Models\RMA::class,
        \Webkul\RMA\Models\RMAItems::class,
        \Webkul\RMA\Models\RMAImages::class,
        \Webkul\RMA\Models\RMAReasons::class,
        \Webkul\RMA\Models\RMAMessages::class,
        \Webkul\RMA\Models\RMAStatus::class,
    ];
}
