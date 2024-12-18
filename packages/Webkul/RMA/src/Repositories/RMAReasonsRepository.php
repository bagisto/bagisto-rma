<?php

namespace Webkul\RMA\Repositories;

use Webkul\Core\Eloquent\Repository;
use Webkul\RMA\Contracts\RMAReasons;

class RMAReasonsRepository extends Repository
{
    /**
     * Specify model class name
     *
     * @return string
     */
    public function model()
    {
        return RMAReasons::class;
    }
}