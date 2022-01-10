<?php

namespace Webkul\RMA\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\RMA\Contracts\RMA as RMAContract;

class RMA extends Model implements RMAContract
{
    protected $table = 'rma';
    protected $fillable = [
        'resolution',
        'information',
        'order_status',
        'rma_status',
        'order_id',
        'status',
    ];

    public function orderItem()
    {
        return $this->hasMany(RMAItemsProxy::modelClass(), 'rma_id');
    }

   /**
     * The images that belong to the RMA.
     */
    public function images()
    {
        return $this->hasMany(RMAImagesProxy::modelClass(), 'rma_id');
    }
}
