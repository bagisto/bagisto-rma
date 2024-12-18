<?php

namespace Webkul\RMA\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\RMA\Contracts\RMARules as ContractsRMARules;

class RMARules extends Model implements ContractsRMARules
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rma_rules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'rule_description',
        'status',
        'exchange_period',
        'return_period',
        'default',
    ];
}