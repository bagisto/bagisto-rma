<?php

namespace Webkul\RMA\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\RMA\Contracts\RMAMessages as RMAMessagesContract;

class RMAMessages extends Model implements RMAMessagesContract
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rma_messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message',
        'rma_id',
        'is_admin',
        'attachment_path',
        'attachment',
    ];
}