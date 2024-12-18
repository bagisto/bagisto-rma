<?php

namespace Webkul\RMA\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\RMA\Contracts\RMAReasons as RMAReasonsContract;

class RMAReasons extends Model implements RMAReasonsContract
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rma_reasons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'status',
        'position',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reasonResolutions()
    {
        return $this->hasMany(ReasonResolutions::class, 'rma_reason_id');
    }
}