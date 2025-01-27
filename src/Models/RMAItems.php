<?php

namespace Webkul\RMA\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Webkul\Sales\Models\OrderItemProxy;
use Webkul\Product\Models\ProductProxy;
use Webkul\Product\Models\Product;
use Webkul\RMA\Contracts\RMAItems as RMAItemsContract;

class RMAItems extends Model implements RMAItemsContract
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rma_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rma_id',
        'quantity',
        'order_item_id',
        'resolution',
        'rma_reason_id',
        'variant_id',
    ];

    /**
     * Get Product Details
     *
     * @return object
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, 'id', 'variant_id');
    }

    /**
     * Get the order item related to the rma item.
     */
    public function getOrderItem(): HasMany
    {
        return $this->hasMany(OrderItemProxy::modelClass(), 'id', 'order_item_id');
    }

    /**
     * Get the reasons related to the rma item.
     */
    public function getReasons(): HasOne
    {
        return $this->hasOne(RMAReasonsProxy::modelClass(), 'id', 'rma_reason_id');
    }

    /**
     * Get the product related to the order item.
     */
    public function getItemSellerName(): BelongsToMany
    {
        return $this->belongsToMany(ProductProxy::modelClass(), 'product_id', 'product_id');
    }
}