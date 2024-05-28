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
                'rma_reasons.created_at'
            );

        $this->addFilter('status', 'rma_reasons.status');
        $this->addFilter('created_at', 'rma_reasons.created_at');

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
            'type'       => 'boolean',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
            'closure'    => function ($row) {
                if ($row->status) {
                    return '<span class="badge badge-md label-active">' . trans('rma::app.admin.sales.rma.reasons.index.datagrid.enabled') . '</span>';
                }
                   
                return '<span class="badge badge-md label-cancelled">' . trans('rma::app.admin.sales.rma.reasons.index.datagrid.disabled') . '</span>';
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
                'method' => 'POST',
                'url'    => function ($row) {
                    return route('admin.sales.rma.reason.delete', $row->id);
                },
            ]);
        }

        if (bouncer()->hasPermission('rma.reason.mass-delete')) {
            $this->addMassAction([
                'title'  => trans('rma::app.shop.customer-rma-index.delete'),
                'method' => 'POST',
                'url'    => route('admin.sales.rma.reason.mass_delete'),
            ]);
        }

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
    }
}
