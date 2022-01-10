<?php

namespace Webkul\RMA\DataGrids\Admin;

use DB;
use Webkul\Ui\DataGrid\DataGrid;

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
                        
        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
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

    public function prepareActions()
    {
        $this->addAction([
            'title' => trans('rma::app.shop.customer-rma-index.edit'),
            'type' => 'Edit',
            'method' => 'GET',
            'route' => 'admin.rma.reason.edit',
            'icon' => 'icon pencil-lg-icon'
        ]);

        $this->addAction([
            'title' => trans('rma::app.shop.customer-rma-index.delete'),
            'type' => 'Delete',
            'method' => 'GET',
            'route' => 'admin.rma.reason.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'reasons']),
            'icon' => 'icon trash-icon'
        ]);
    }

    public function prepareMassActions()
    {
        $this->addMassAction([
            'title' => trans('rma::app.shop.customer-rma-index.delete'),
            'type' => 'delete',
            'label' => trans('rma::app.admin.action-name.delete'),
            'action' => route('admin.rma.reason.massdelete'),
            'method' => 'POST'
        ]);

        $this->addMassAction([
            'title' => trans('rma::app.shop.customer-rma-index.update'),
            'type' => 'update',
            'label' => trans('rma::app.admin.action-name.update'),
            'action' => route('admin.rma.reason.massupdate'),
            'method' => 'POST',
            'options' => [
                trans('rma::app.admin.action-name.options.enable') => 1,
                trans('rma::app.admin.action-name.options.disable') => 0
            ]
        ]);
    }
}