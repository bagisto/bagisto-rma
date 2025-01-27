<?php

namespace Webkul\RMA\DataGrids\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Webkul\DataGrid\DataGrid;
use Webkul\RMA\Repositories\RMAStatusRepository;

class RmaDataGrid extends DataGrid
{
    /**
     * @var string
     */
    public const PENDING = 'pending';

    /**
     * @var string
     */
    public const PENDINGSTATUS = 'Pending';

    /**
     * @var int
     */
    public const ZERO = 0;

    /**
     * @var int
     */
    public const ACTIVE = 1;

    /**
     * Constructor for the class.
     *
     * @return void
     */
    public function __construct(
        protected RMAStatusRepository $rmaStatusRepository,
    ) {
    }

    /**
     * Prepare query builder.
     */
    public function prepareQueryBuilder(): Builder
    {
        $table_prefix = DB::getTablePrefix();

        $queryBuilder = DB::table('rma')
            ->leftJoin('orders', 'orders.id', '=', 'rma.order_id')
            ->addSelect(
                'rma.id',
                'rma.order_id',
                'orders.is_guest as is_guest',
                DB::raw('CONCAT(' . $table_prefix . 'orders.customer_first_name, " ", ' . $table_prefix . 'orders.customer_last_name) as customer_name'),
                'rma.status',
                'rma.rma_status',
                'rma.order_status as order_status',
                'rma.created_at',
            )
            ->whereIn('order_id', DB::table('orders')->pluck('id')?->toArray());
                
        $this->addFilter('id', 'rma.id');
        $this->addFilter('order_id', 'rma.order_id');
        $this->addFilter('rma_status', 'rma.rma_status');
        $this->addFilter('created_at', 'rma.created_at');
        $this->addFilter('customer_name', DB::raw('CONCAT(' . $table_prefix . 'orders.customer_first_name, " ", ' . $table_prefix . 'orders.customer_last_name)'));      

        return $queryBuilder;
    }

    /**
     * Prepare columns.
     */
    public function prepareColumns(): void
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('rma::app.admin.sales.rma.all-rma.index.datagrid.id'),
            'type'       => 'integer',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'order_id',
            'label'      => trans('rma::app.admin.sales.rma.all-rma.index.datagrid.order-ref'),
            'type'       => 'integer',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
            'closure'    => function ($row) {
                $routeName = request()->route()->getName();

                if (
                    $routeName == 'admin.sales.rma.index'
                    && auth()->guard('admin')->check()
                ) {
                    $route = route('admin.sales.orders.view', ['id' => $row->order_id]);
                } elseif (
                    $routeName == 'rma.customers.all-rma'
                    && auth()->guard('customer')->check()
                ) {
                    $route = route('rma.customers.all-rma', ['id' => $row->order_id]);
                } else {
                    return "<span class='text-blue-600'>#{$row->order_id}</span>";
                }

                return '<a href="' . $route . '">' . "<span class='text-blue-600'>#" . $row->order_id . '</span></a>';
            },
        ]);

        $this->addColumn([
            'index'      => 'customer_name',
            'label'      => trans('rma::app.admin.sales.rma.all-rma.index.datagrid.customer-name'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
            'closure'    => function ($row) {
                if (! empty($row->is_guest)) {
                    return '<span>' . $row->customer_name .'('. trans('rma::app.shop.view-customer-rma.guest') .')'. '</span>';
                } 

                return $row->customer_name;
            },
        ]);

        $this->addColumn([
            'index'              => 'rma_status',
            'label'              => trans('rma::app.admin.sales.rma.all-rma.index.datagrid.rma-status'),
            'type'               => 'string',
            'searchable'         => true,
            'sortable'           => true,
            'filterable'         => true,
            'filterable_type'    => 'dropdown',
            'filterable_options' => $this->rmaStatusRepository->all(['title as label', 'title as value'])->toArray(),
            'closure'            => function ($row) {
                $rmaStatusData = app('Webkul\RMA\Repositories\RMAStatusRepository')
                    ->where('title', $row->rma_status)
                    ->first();  

                return '<p class="label-active" style="background:' . $rmaStatusData?->color . ';">' . $row->rma_status . '</p>';      
            },
        ]);

        $this->addColumn([
            'index'              => 'order_status',
            'label'              => trans('rma::app.admin.sales.rma.all-rma.index.datagrid.order-status'),
            'type'               => 'string',
            'filterable_type'    => 'dropdown',
            'searchable'         => true,
            'filterable'         => true,
            'sortable'           => true,
            'filterable_options' => [
                [
                    'label' => trans('rma::app.shop.customer.delivered'),
                    'value' => self::ACTIVE,
                ], [
                    'label' => trans('rma::app.shop.customer.undelivered'),
                    'value' => self::ZERO,
                ],
            ],
            'closure'            => function ($row) {
                if ($row->order_status == self::ACTIVE) {
                   return '<p class="label-active">' . trans('rma::app.shop.customer.delivered') . '</p>';
                }
                
                return '<p class="label-info">' . trans('rma::app.shop.customer.undelivered') . '</p>';
            },
        ]);

        $this->addColumn([
            'index'           => 'created_at',
            'label'           => trans('rma::app.admin.sales.rma.all-rma.index.datagrid.create'),
            'type'            => 'date',
            'sortable'        => true,
            'searchable'      => true,
            'filterable'      => true,
            'filterable_type' => 'date_range',
        ]);
    }

    /**
     * Prepare actions.
     */
    public function prepareActions(): void
    {
        $this->addAction([
            'title'  => trans('rma::app.shop.customer-rma-index.view'),
            'icon'   => 'icon-view',
            'method' => 'GET',
            'url'    => function ($row) {
                return route('admin.sales.rma.view', $row->id);
            },
        ]);
    }
}