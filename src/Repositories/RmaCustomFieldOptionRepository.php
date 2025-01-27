<?php

namespace Webkul\RMA\Repositories;

use Webkul\Core\Eloquent\Repository;
use Webkul\RMA\Contracts\RMACustomFieldOption;

class RmaCustomFieldOptionRepository extends Repository
{
    /**
     * Specify model class name
     */
    public function model(): string
    {
        return RMACustomFieldOption::class;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createOption(array $dataOptions, int $rmaCustomFieldId): void
    {
        foreach ($dataOptions['options'] as $key => $option) {
            $this->model->create([
                'additional_rma_field_id' => $rmaCustomFieldId,
                'option_name'             => $option,
                'option_value'            => $dataOptions['value'][$key],
            ]);
        }
    }
}