<?php

namespace Webkul\RMA\Repositories;

use Webkul\Core\Eloquent\Repository;
use Webkul\RMA\Contracts\ReasonResolutions;

class ReasonResolutionsRepository extends Repository
{
    /**
     * Specify model class name
     */
    public function model(): string
    {
        return ReasonResolutions::class;
    }
}