<?php

namespace Webkul\RMA\DataGrids\Admin;

use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class CustomFieldRMADataGrid extends DataGrid
{
    /**
     * Prepare query builder.
     *
     * @return void
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('custom_rma_field')
            ->addSelect(
                'id',
                'code',
                'label',
                'type',
                'is_required',
                'position',
                'status',
            );

        $this->addFilter('code', 'custom_rma_field.code');

        return $queryBuilder;
    }

    /**
     * Add columns.
     *
     * @return void
     */
    public function prepareColumns()
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('admin::app.catalog.attributes.index.datagrid.id'),
            'type'       => 'integer',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'code',
            'label'      => trans('admin::app.catalog.attributes.index.datagrid.code'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'label',
            'label'      => trans('admin::app.catalog.attributes.create.label'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'type',
            'label'      => trans('admin::app.catalog.attributes.index.datagrid.type'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'is_required',
            'label'      => trans('admin::app.catalog.attributes.index.datagrid.required'),
            'type'       => 'string',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
            'closure'    => function ($row) {
                if ($row->is_required == 1) {
                    return '<span class="label-active">'.trans('admin::app.catalog.products.edit.types.bundle.update-create.yes').'</span>';
                }

                return '<span class="label-info">'.trans('admin::app.catalog.products.edit.types.bundle.update-create.no').'</span>';
            },
        ]);

        $this->addColumn([
            'index'      => 'status',
            'label'      => trans('rma::app.admin.sales.rma.reasons.index.datagrid.status'),
            'type'       => 'dropdown',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
            'options'    => [
                'type' => 'basic',
        
                'params' => [
                    'options' => [
                        [
                            'label' => trans('rma::app.admin.sales.rma.reasons.index.datagrid.enabled'),
                            'value' => '1',
                        ], [
                            'label' => trans('rma::app.admin.sales.rma.reasons.index.datagrid.disabled'),
                            'value' => '0',
                        ],
                    ],
                ],
            ],
            'closure'    => function ($row) {
                if ($row->status) {
                    return '<span class="label-active">'.trans('admin::app.catalog.categories.index.datagrid.active').'</span>';
                }

                return '<span class="label-info">'.trans('admin::app.catalog.categories.index.datagrid.inactive').'</span>';
            },
        ]);
    }

    /**
     * Prepare actions.
     *
     * @return void
     */
    public function prepareActions()
    {
        $this->addAction([
            'icon'   => 'icon-edit',
            'title'  => trans('admin::app.catalog.categories.index.datagrid.edit'),
            'method' => 'GET',
            'url'    => function ($row) {
                return route('admin.sales.rma.custom-field.edit', $row->id);
            },
        ]);

        $this->addAction([
            'icon'   => 'icon-delete',
            'title'  => trans('admin::app.catalog.categories.index.datagrid.delete'),
            'method' => 'DELETE',
            'url'    => function ($row) {
                return route('admin.sales.rma.custom-field.delete', $row->id);
            },
        ]);
    }

    /**
     * Prepare mass actions.
     *
     * @return void
     */
    public function prepareMassActions()
    {
        $this->addMassAction([
            'title'   => trans('rma::app.shop.customer-rma-index.update'),
            'method'  => 'POST',
            'url'     => route('admin.sales.rma.custom-field.mass-update'),
            'options' => [
                [
                    'label' => trans('rma::app.admin.sales.rma.reasons.index.datagrid.enabled'),
                    'value' => 1,
                ], [
                    'label' => trans('rma::app.admin.sales.rma.reasons.index.datagrid.disabled'),
                    'value' => 0,
                ],
            ],
        ]);

        $this->addMassAction([
            'title'  => trans('rma::app.shop.customer-rma-index.delete'),
            'method' => 'POST',
            'url'    => route('admin.sales.rma.custom-field.mass-delete'),
        ]);
    }
}