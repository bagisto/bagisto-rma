<?php

namespace Webkul\RMA\DataGrids\Admin;

use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class ReasonDataGrid extends DataGrid
{
    /**
     * Prepare query builder.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('rma_reasons')
            ->addSelect(
                'rma_reasons.id',
                'rma_reasons.title',
                'rma_reasons.status',
                'rma_reasons.position',
                'rma_reasons.created_at',
                DB::raw('GROUP_CONCAT(rma_reason_resolutions.resolution_type SEPARATOR ", ") as resolution_types'),
            )
            ->leftJoin('rma_reason_resolutions', 'rma_reasons.id', '=', 'rma_reason_resolutions.rma_reason_id')
            ->groupBy('rma_reasons.id', 'rma_reasons.title', 'rma_reasons.status', 'rma_reasons.created_at');

        $this->addFilter('id', 'rma_reasons.id');
        $this->addFilter('created_at', 'rma_reasons.created_at');
        $this->addFilter('resolution_types', DB::raw('GROUP_CONCAT(rma_reason_resolutions.resolution_type SEPARATOR ", ")'));
        
        return $queryBuilder;
    }

    /**
     * Prepare columns.
     *
     * @return void
     */
    public function prepareColumns()
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('rma::app.admin.sales.rma.reasons.index.datagrid.id'),
            'type'       => 'integer',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'title',
            'label'      => trans('rma::app.admin.sales.rma.reasons.index.datagrid.reason'),
            'type'       => 'string',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'status',
            'label'      => trans('rma::app.admin.sales.rma.reasons.index.datagrid.status'),
            'type'       => 'dropdown',
            'searchable' => false,
            'filterable' => true,
            'sortable'   => true,
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
                    return '<p class="label-active">'.trans('rma::app.admin.sales.rma.reasons.index.datagrid.enabled').'</p>';
                }

                return '<p class="label-canceled">'.trans('rma::app.admin.sales.rma.reasons.index.datagrid.disabled').'</p>';
            },
        ]);

        $this->addColumn([
            'index'      => 'created_at',
            'label'      => trans('rma::app.admin.sales.rma.reasons.index.datagrid.created-at'),
            'type'       => 'date_range',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'resolution_types',
            'label'      => trans('rma::app.admin.configuration.index.sales.rma.resolution-type'),
            'type'       => 'string',
            'searchable' => false,
            'filterable' => false,
            'sortable'   => false,
            'closure'    => function ($row) {
                if ($row->resolution_types) {
                    return ucwords($row->resolution_types);
                }
            },
        ]);

        $this->addColumn([
            'index'      => 'position',
            'label'      => trans('admin::app.catalog.categories.create.position'),
            'type'       => 'string',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);
    }

    /**
     * Prepare actions.
     *
     * @return void
     */
    public function prepareActions()
    {
        if (bouncer()->hasPermission('rma.reason.edit')) {
            $this->addAction([
                'icon'   => 'icon-edit',
                'title'  => trans('rma::app.shop.customer-rma-index.edit'),
                'type'   => 'Edit',
                'method' => 'GET',
                'url'    => function ($row) {
                    return route('admin.sales.rma.reason.edit', $row->id);
                },
            ]);
        }

        if (bouncer()->hasPermission('rma.reason.delete')) {
            $this->addAction([
                'icon'   => 'icon-delete',
                'title'  => trans('rma::app.shop.customer-rma-index.delete'),
                'type'   => 'Delete',
                'method' => 'DELETE',
                'url'    => function ($row) {
                    return route('admin.sales.rma.reason.delete', $row->id);
                },
            ]);
        }
    }

    /**
     * Prepare mass actions.
     *
     * @return void
     */
    public function prepareMassActions()
    {
        if (bouncer()->hasPermission('rma.reason.mass-update')) {
            $this->addMassAction([
                'title'   => trans('rma::app.shop.customer-rma-index.update'),
                'method'  => 'POST',
                'url'     => route('admin.sales.rma.reason.mass_update'),
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
        }

        if (bouncer()->hasPermission('rma.reason.mass-delete')) {
            $this->addMassAction([
                'title'  => trans('rma::app.shop.customer-rma-index.delete'),
                'method' => 'POST',
                'url'    => route('admin.sales.rma.reason.mass_delete'),
            ]);
        }
    }
}