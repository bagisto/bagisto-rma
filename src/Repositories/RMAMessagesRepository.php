<?php

namespace Webkul\RMA\Repositories;

use Webkul\Core\Eloquent\Repository;
use Webkul\RMA\Contracts\RMAMessages;

class RMAMessagesRepository extends Repository
{
    /**
     * Specify model class name
     */
    public function model(): string
    {
        return RMAMessages::class;
    }
}
