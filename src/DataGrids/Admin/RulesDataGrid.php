<?php

namespace Webkul\RMA\DataGrids\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Webkul\DataGrid\DataGrid;

class RulesDataGrid extends DataGrid
{
    /**
     * @var int
     */
    public const ONE = 1;

    /**
     * @var int
     */
    public const ZERO = 0;

    /**
     * Prepare query builder.
     */
    public function prepareQueryBuilder(): Builder
    {
        $queryBuilder = DB::table('rma_rules');

        $this->addFilter('id', 'rma_rules.id');
        
        return $queryBuilder;
    }

    /**
     * Prepare columns.
     */
    public function prepareColumns(): void
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
            'label'      => trans('rma::app.admin.sales.rma.rules.create.rules-title'),
            'type'       => 'string',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'              => 'status',
            'label'              => trans('rma::app.admin.sales.rma.reasons.index.datagrid.status'),
            'type'               => 'string',
            'searchable'         => false,
            'filterable'         => true,
            'sortable'           => true,
            'filterable_type'    => 'dropdown',
            'filterable_options' => [
                [
                    'label' => trans('rma::app.admin.sales.rma.reasons.index.datagrid.enabled'),
                    'value' => self::ONE,
                ], [
                    'label' => trans('rma::app.admin.sales.rma.reasons.index.datagrid.disabled'),
                    'value' => self::ZERO,
                ],
            ],
            'closure'            => function ($row) {
                if ($row->status) {
                    return '<p class="label-active">'.trans('rma::app.admin.sales.rma.reasons.index.datagrid.enabled').'</p>';
                }

                return '<p class="label-canceled">'.trans('rma::app.admin.sales.rma.reasons.index.datagrid.disabled').'</p>';
            },
        ]);

        $this->addColumn([
            'index'      => 'exchange_period',
            'label'      => trans('rma::app.admin.sales.rma.rules.index.datagrid.exchange-period'),
            'type'       => 'string',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'return_period',
            'label'      => trans('rma::app.admin.sales.rma.rules.index.datagrid.return-period'),
            'type'       => 'string',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);
    }

    /**
     * Prepare actions.
     */
    public function prepareActions(): void
    {
        if (bouncer()->hasPermission('rma.reason.edit')) {
            $this->addAction([
                'icon'   => 'icon-edit',
                'title'  => trans('rma::app.shop.customer-rma-index.edit'),
                'type'   => 'Edit',
                'method' => 'GET',
                'url'    => function ($row) {
                    return route('admin.sales.rma.rules.edit', $row->id);
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
                    return route('admin.sales.rma.rules.delete', $row->id);
                },
            ]);
        }
    }

    /**
     * Prepare mass actions.
     */
    public function prepareMassActions(): void
    {
        $this->addMassAction([
            'title'   => trans('rma::app.shop.customer-rma-index.update'),
            'method'  => 'POST',
            'url'     => route('admin.sales.rma.rules.mass-update'),
            'options' => [
                [
                    'label' => trans('rma::app.admin.sales.rma.reasons.index.datagrid.enabled'),
                    'value' => self::ONE,
                ], [
                    'label' => trans('rma::app.admin.sales.rma.reasons.index.datagrid.disabled'),
                    'value' => self::ZERO,
                ],
            ],
        ]);

        $this->addMassAction([
            'title'  => trans('rma::app.shop.customer-rma-index.delete'),
            'method' => 'POST',
            'url'    => route('admin.sales.rma.rules.mass-delete'),
        ]);
    }
}