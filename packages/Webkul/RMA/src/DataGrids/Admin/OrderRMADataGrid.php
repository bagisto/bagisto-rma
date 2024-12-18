<?php

namespace Webkul\RMA\DataGrids\Admin;

use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;
use Webkul\Sales\Models\Order;
use Webkul\Sales\Models\OrderPayment;

class OrderRMADataGrid extends DataGrid
{
    /**
     * @var string
     */
    public const COMPLETE = 'complete';

    /**
     * Prepare query builder.
     *
     * @return void
     */
    public function prepareQueryBuilder()
    {
        $table_prefix = DB::getTablePrefix();

        $queryBuilder = DB::table('orders')
            ->addSelect(
                'orders.id as id',
                'orders.increment_id as increment_id',
                'orders.status as status',
                'orders.created_at as created_at',
                'orders.grand_total as grand_total',
                DB::raw('CONCAT(' . $table_prefix . 'orders.customer_first_name, " ", ' . $table_prefix . 'orders.customer_last_name) as customer_name'),
                'orders.is_guest as is_guest',
                'orders.order_currency_code as order_currency_code',
                'order_payment.method_title as method_title',
                DB::raw('SUM(order_items.qty_ordered) as total_qty_ordered'),
                DB::raw('IFNULL(SUM(rma_items_aggregated.total_rma_qty), 0) as total_rma_qty')
            )
            ->leftJoin('order_payment', 'orders.id', '=', 'order_payment.order_id')
            ->leftJoin('order_items', 'orders.id', '=', 'order_items.order_id')
            ->leftJoin('rma', 'orders.id', '=', 'rma.order_id')
            ->leftJoin(
                DB::raw('(SELECT order_item_id, SUM(quantity) as total_rma_qty
                         FROM rma_items
                         GROUP BY order_item_id) as rma_items_aggregated'),
                'order_items.id',
                '=',
                'rma_items_aggregated.order_item_id'
            )
            ->whereNotIn('orders.status', [
                Order::STATUS_CANCELED,
                Order::STATUS_CLOSED,
                Order::STATUS_FRAUD,
                Order::STATUS_PENDING_PAYMENT
            ])
            ->groupBy('orders.id')
            ->havingRaw('SUM(order_items.qty_ordered) > IFNULL(SUM(rma_items_aggregated.total_rma_qty), 0)');

        if (core()->getConfigData('sales.rma.setting.select-allowed-order-status') == self::COMPLETE) {
            $queryBuilder->where('orders.status', [
                Order::STATUS_COMPLETED,
            ]);
        }

        $this->addFilter('id', 'orders.id');
        $this->addFilter('status', 'orders.status');
        $this->addFilter('grand_total', 'orders.grand_total');
        $this->addFilter('method_title', 'order_payment.method_title');
        $this->addFilter('customer_name', DB::raw('CONCAT(' . $table_prefix . 'orders.customer_first_name, " ", ' . $table_prefix . 'orders.customer_last_name)'));
        $this->addFilter('created_at', 'orders.created_at');

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
            'index'      => 'increment_id',
            'label'      => trans('shop::app.customers.account.orders.order-id'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
            'closure'    => function ($row) {
                return '<span class="text-sm text-blue-500"><a href="' . route('admin.sales.orders.view', ['id' => $row->increment_id]) . '">' . '#' . $row->increment_id . '</a></span>';
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
                } else {
                    return $row->customer_name;
                }
            },
        ]);

        $this->addColumn([
            'index'      => 'created_at',
            'label'      => trans('shop::app.customers.account.orders.order-date'),
            'type'       => 'date_range',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
            'closure'    => function ($row) {
                return '<span class="text-sm">' . $row->created_at . '</span>';
            },
        ]);

        $this->addColumn([
            'index'      => 'grand_total',
            'label'      => trans('shop::app.customers.account.orders.total'),
            'type'       => 'integer',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
            'closure'    => function ($row) {
                return '<span class="text-sm">' . core()->formatPrice($row->grand_total, $row->order_currency_code) . '</span>';
            },
        ]);

        $this->addColumn([
            'index'      => 'method_title',
            'label'      => trans('admin::app.sales.orders.index.datagrid.pay-via'),
            'type'       => 'dropdown',
            'options'    => [
                'type' => 'basic',

                'params' => [
                    'options' => OrderPayment::distinct()
                        ->get(['method_title'])
                        ->map(function ($item) {
                            return [
                                'label' => $item->method_title,
                                'value' => $item->method_title,
                            ];
                        })
                        ->toArray(),
                ],
            ],
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
            'closure'    => function ($row) {
                return '<span class="text-sm">' . trans('admin::app.sales.orders.index.datagrid.pay-by', ['method' => '']) . $row->method_title . '</span>';
            },
        ]);

        $this->addColumn([
            'index'      => 'status',
            'label'      => trans('shop::app.customers.account.orders.status.title'),
            'type'       => 'dropdown',
            'options'    => [
                'type' => 'basic',

                'params' => [
                    'options' => [
                        [
                            'label'  => trans('rma::app.shop.customer.delivered'),
                            'value'  => Order::STATUS_COMPLETED,
                        ], [
                            'label'  => trans('rma::app.shop.customer.undelivered') . '(' . trans('shop::app.customers.account.orders.status.options.processing') . ')',
                            'value'  => Order::STATUS_PROCESSING,
                        ], [
                            'label'  => trans('rma::app.shop.customer.undelivered') . '(' . trans('shop::app.customers.account.orders.status.options.pending') . ')',
                            'value'  => Order::STATUS_PENDING,
                        ],
                    ],
                ],
            ],
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
            'closure'    => function ($row) {
                if ($row->status == Order::STATUS_COMPLETED) {
                    return '<span class="label-active py-1 px-2">' . trans('rma::app.shop.customer.delivered') . '</span>';
                } elseif ($row->status == Order::STATUS_PROCESSING) {
                    return '<span class="label-pending py-1 px-2">' . trans('rma::app.shop.customer.undelivered') . '(' . trans('shop::app.customers.account.orders.status.options.processing') . ')' . '</span>';
                }

                return '<span class="label-pending py-1 px-2">' . trans('rma::app.shop.customer.undelivered') . '(' . trans('shop::app.customers.account.orders.status.options.pending') . ')' . '</span>';
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
            'icon'   => 'icon-eye',
            'title'  => trans('shop::app.customers.account.orders.action-view'),
            'method' => 'GET',
            'url'    => function ($row) {
                return route('shop.customers.account.orders.view', $row->id);
            },
        ]);
    }
}