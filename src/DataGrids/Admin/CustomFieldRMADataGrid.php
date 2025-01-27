<?php

namespace Webkul\RMA\DataGrids\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Webkul\DataGrid\DataGrid;

class CustomFieldRMADataGrid extends DataGrid
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
     */
    public function prepareColumns(): void
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
            'index'              => 'is_required',
            'label'              => trans('admin::app.catalog.attributes.index.datagrid.required'),
            'type'               => 'string',
            'searchable'         => false,
            'sortable'           => true,
            'filterable'         => true,
            'filterable_type'    => 'dropdown',
            'filterable_options' => [
                [
                    'label' => trans('admin::app.catalog.products.edit.types.bundle.update-create.yes'),
                    'value' => self::ONE,
                ], [
                    'label' => trans('admin::app.catalog.products.edit.types.bundle.update-create.no'),
                    'value' => self::ZERO,
                ],
            ],
            'closure'            => function ($row) {
                if ($row->is_required == self::ONE) {
                    return '<span class="label-active">'.trans('admin::app.catalog.products.edit.types.bundle.update-create.yes').'</span>';
                }

                return '<span class="label-info">'.trans('admin::app.catalog.products.edit.types.bundle.update-create.no').'</span>';
            },
        ]);

        $this->addColumn([
            'index'              => 'status',
            'label'              => trans('rma::app.admin.sales.rma.reasons.index.datagrid.status'),
            'type'               => 'string',
            'searchable'         => true,
            'sortable'           => true,
            'filterable'         => true,
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
     */
    public function prepareActions(): void
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
     */
    public function prepareMassActions(): void
    {
        $this->addMassAction([
            'title'   => trans('rma::app.shop.customer-rma-index.update'),
            'method'  => 'POST',
            'url'     => route('admin.sales.rma.custom-field.mass-update'),
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
            'url'    => route('admin.sales.rma.custom-field.mass-delete'),
        ]);
    }
}