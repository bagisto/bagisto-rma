<?php

namespace Webkul\RMA\DataGrids\Admin;

use DB;
use Webkul\DataGrid\DataGrid;

class Reasons extends DataGrid
{
    /**
     * @var integer
     */
    protected $index = 'id';
    protected $sortOrder = 'desc'; //asc or desc

    /**
     * Create a new repository instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->invoker = $this;
    }

    /**
     * Prepare query builder.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function prepareQueryBuilder()
    {
        if (auth()->guard('customer')->user()) {
            session()->forget('guestOrderId');
            $customerId = auth()->guard('customer')->user()->id;
        } else {
            $customerId = NULL;
        }

        $queryBuilder = DB::table('rma_reasons')
                        ->addSelect(
                            'rma_reasons.id',
                            'rma_reasons.title',
                            'rma_reasons.status',
                            'rma_reasons.created_at'
                        );

        $this->addFilter('status', 'rma_reasons.status');
                        
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
            'index' => 'id',
            'label' => trans('rma::app.admin.table-heading.id'),
            'type' => 'number',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'title',
            'label' => trans('rma::app.admin.table-heading.reason'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'status',
            'label' => trans('rma::app.admin.table-heading.status'),
            'type' => 'boolean',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
            'wrapper' => function($status) {
                if ($status->status == '0') {
                    echo "Disabled";
                } else {
                    echo "Enabled";
                }
            }
        ]);

        $this->addColumn([
            'index' => 'created_at',
            'label' => trans('rma::app.shop.customer-index-field.date'),
            'type' => 'datetime',
            'sortable' => true,
            'searchable' => false,
            'filterable' => true
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
            'icon' => 'icon-edit',
            'title' => trans('rma::app.shop.customer-rma-index.edit'),
            'type' => 'Edit',
            'method' => 'GET',
            'url'    => function ($row) {
                return route('admin.rma.reason.edit', $row->id);
            },
        ]);
    }

    if (bouncer()->hasPermission('rma.reason.delete')) {
        $this->addAction([
            'icon' => 'icon-delete',
            'title' => trans('rma::app.shop.customer-rma-index.delete'),
            'type' => 'Delete',
            'method' => 'DELETE',
            'route' => 'admin.rma.reason.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'reasons']),
            'url'    => function ($row) {
                return route('admin.rma.reason.delete', $row->id);
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
        if (bouncer()->hasPermission('rma.reason.massdelete')) {
        $this->addMassAction([
            'title'   => trans('rma::app.shop.customer-rma-index.delete'),
            'type'    => 'Delete',
            'label'   => trans('rma::app.admin.action-name.delete'),
            'method'  => 'POST',
            'url'     => route('admin.rma.reason.massdelete'),
        ]);

        if (bouncer()->hasPermission('rma.reason.massupdate')) {
        $this->addMassAction([
            'title'   => trans('rma::app.shop.customer-rma-index.update'),
            'type'    => 'update',
            'label'   => trans('rma::app.admin.action-name.update'),
            'method'  => 'POST',
            'url'     => route('admin.rma.reason.massupdate'),
            'options' => [
                [
                    'label'  => trans('rma::app.admin.action-name.options.enable'),
                    'value' => 1,
                ],
                [
                    'label'  => trans('rma::app.admin.action-name.options.disable'),
                    'value' => 0,
                ],
            ],
        ]);
    }
}
    }
}