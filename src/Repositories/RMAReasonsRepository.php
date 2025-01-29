<?php

namespace Webkul\RMA\Repositories;

use Webkul\Core\Eloquent\Repository;
use Webkul\RMA\Contracts\RMAReasons;

class RMAReasonsRepository extends Repository
{
    /**
     * Specify model class name
     */
    public function model(): string
    {
        return RMAReasons::class;
    }
}