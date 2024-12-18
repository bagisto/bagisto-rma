<?php

namespace Webkul\RMA\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\RMA\Contracts\RMAImages as RMAImagesContract;

class RMAImages extends Model implements RMAImagesContract
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rma_images';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $guarded = ['_token'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rma_id',
        'path',
    ];
}