<?php

namespace Webkul\RMA\Repositories;

use Webkul\Core\Eloquent\Repository;
use Webkul\RMA\Contracts\RMARules;

class RMARulesRepository extends Repository
{
    /**
     * Specify model class name
     */
    public function model(): string
    {
        return RMARules::class;
    }
}