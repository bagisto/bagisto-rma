<?php

namespace Webkul\RMA\Repositories;

use Webkul\Core\Eloquent\Repository;
use Webkul\RMA\Contracts\RMACustomFieldOption;

class RmaCustomFieldOptionRepository extends Repository
{
    /**
     * Specify model class name
     *
     * @return string
     */
    public function model()
    {
        return RMACustomFieldOption::class;
    }

    /**
     * @param mixed $dataOptions
     * @param mixed $rmaCustomFieldId
     * 
     * @return void
     */
    public function createOption($dataOptions, $rmaCustomFieldId)
    {
        foreach ($dataOptions['options'] as $key => $option) {
            $rows = [
                'additional_rma_field_id' => $rmaCustomFieldId,
                'option_name'             => $option,
                'option_value'            => $dataOptions['value'][$key],
            ];
        
            $this->model->create($rows);
        }
    }
}