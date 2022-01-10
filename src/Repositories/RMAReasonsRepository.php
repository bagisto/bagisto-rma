<?php

namespace Webkul\RMA\Repositories;

use Illuminate\Container\Container;
use Webkul\Core\Eloquent\Repository;

class RMAReasonsRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return 'Webkul\RMA\Contracts\RMAReasons';
    }

    public function __construct(
        Container $container
    ) {
        parent::__construct($container);
    }
}