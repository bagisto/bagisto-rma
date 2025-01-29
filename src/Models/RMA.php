<?php

namespace Webkul\RMA\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Webkul\Sales\Models\OrderProxy;
use Webkul\RMA\Contracts\RMA as RMAContract;

class RMA extends Model implements RMAContract
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rma';

    /**
     * Pending Order
     */
    public const STATUS_PENDING = 'pending';

    /**
     * Payment is in pending
     */
    public const RECEIVED_PACKAGE = 'received_package';

    /**
     * Order in processing
     */
    public const DECLINED = 'declined';

    /**
     * Complete Order
     */
    public const ITEM_CANCELED = 'item_canceled';

    /**
     * Canceled Order
     */
    public const NOT_RECEIVE_PACKAGE_YET = 'not_receive_package_yet';

    /**
     * Closed Order
     */
    public const DISPATCHED_PACKAGE = 'Dispatched_Package';

    /**
     * Fraud Order
     */
    public const ACCEPT = 'accept';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'information',
        'order_status',
        'rma_status',
        'order_id',
        'status',
        'package_condition',
        'return_pickup_address',
        'return_pickup_time',
    ];

    /**
     * RMA Status
     */
    protected $statusLabel = [
        self::STATUS_PENDING          => 'Pending',
        self::RECEIVED_PACKAGE        => 'Received Package',
        self::ITEM_CANCELED           => 'Item Canceled',
        self::DECLINED                => 'Declined',
        self::NOT_RECEIVE_PACKAGE_YET => 'Awaiting',
        self::DISPATCHED_PACKAGE      => 'Dispatched Package',
        self::ACCEPT                  => 'Accept',
    ];

    /**
     * RMA Package
     */
    public function getStatusLabelRMA(): string
    {
        return $this->statusLabel[$this->rma_status];
    }

    /**
     * Define a one-to-many relationship with the rma items.
     */
    public function orderItem(): HasMany
    {
        return $this->hasMany(RMAItemsProxy::modelClass(), 'rma_id');
    }

    /**
     * Define a one-to-many relationship with the rma images.
     */
    public function images(): HasMany
    {
        return $this->hasMany(RMAImagesProxy::modelClass(), 'rma_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(OrderProxy::modelClass(), 'order_id');
    }
}