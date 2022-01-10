<?php

namespace Webkul\RMA\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\RMA\Contracts\RMAMessages as RMAMessagesContract;

class RMAMessages extends Model implements RMAMessagesContract
{
    protected $table = 'rma_messages';
    protected $fillable = [
        'message',
        'rma_id',
        'is_admin',
    ];
}
