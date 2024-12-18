<?php

namespace Webkul\RMA\Repositories;

use Webkul\Core\Eloquent\Repository;
use Webkul\RMA\Contracts\RMAItems;

class RMAItemsRepository extends Repository
{
    /**
     * Specify model class name
     *
     * @return string
     */
    public function model()
    {
        return RMAItems::class;
    }
}