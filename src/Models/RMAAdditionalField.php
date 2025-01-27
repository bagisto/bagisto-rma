<?php

namespace Webkul\RMA\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\RMA\Contracts\RMAAdditionalField as RMAAdditionalFieldContracts;

class RMAAdditionalField extends Model implements RMAAdditionalFieldContracts
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'additional_rma_field';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rma_id',
        'field_name',
        'field_value',
    ];
}