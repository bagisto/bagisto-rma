<?php

namespace Webkul\RMA\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\RMA\Contracts\RMAReasons as RMAReasonsContract;

class RMAReasons extends Model implements RMAReasonsContract
{
    protected $table = 'rma_reasons';
    protected $fillable = [
        'title',
        'status',
    ];
}
