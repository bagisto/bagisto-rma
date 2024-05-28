<?php

namespace Webkul\RMA\Repositories;

use Illuminate\Container\Container;
use Webkul\Core\Eloquent\Repository;

class RMAMessagesRepository extends Repository
{
    /**
     * Specify model class name
     *
     * @return string
     */
    public function model()
    {
        return 'Webkul\RMA\Contracts\RMAMessages';
    }

    /**
     * Create a new instance of the repository.
     *
     * @return void
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);
    }
}
