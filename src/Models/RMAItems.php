<?php

namespace Webkul\RMA\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\RMA\Contracts\RMAItems as RMAItemsContract;
use \Webkul\Sales\Models\OrderItemProxy as SalesOrderItems;

class RMAItems extends Model implements RMAItemsContract
{
    protected $table = 'rma_items';
    protected $fillable = [
        'rma_id',
        'quantity',
        'order_item_id',
        'rma_reason_id',
    ];

    public function orderRMA()
    {
        return $this->belongsTo(OrderItem::modelClass(), 'id');
    }

    /**
     * get order items name by rma_id
     */

    public function getOrderItem()
    {
        return $this->hasMany(SalesOrderItems::modelClass(), 'id','order_item_id');
    }

    /**
     * get reasons
     */
    public function getReasons()
    {
        return $this->hasOne('\Webkul\RMA\Models\RMAReasons','id','rma_reason_id');
    }

    /**
     * get the product by $order_id
     */
    public function getItemSellerName()
    {
        return $this->belongsToMany('\Webkul\Models\Product','product_id','product_id');
    }
}
