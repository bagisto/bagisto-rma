<?php

namespace Webkul\RMA\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\RMA\Contracts\RMAImages as RMAImagesContract;

class RMAImages extends Model implements RMAImagesContract
{
    protected $table = 'rma_images';
    protected $fillable = [
        'rma_id',
        'path',
    ];
}
