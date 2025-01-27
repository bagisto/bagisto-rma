<?php

namespace Webkul\RMA\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Webkul\RMA\Contracts\RMACustomFieldOption as ContractsRMACustomFieldOption;

class RMACustomFieldOption extends Model implements ContractsRMACustomFieldOption
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'custom_rma_option_field';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'additional_rma_field_id',
        'option_name',
        'option_value',
    ];

    /**
     * Get the additional rma field that owns the option.
     */
    public function rmaCustomField(): BelongsTo
    {
        return $this->belongsTo(RMACustomField::class, 'additional_rma_field_id');
    }
}