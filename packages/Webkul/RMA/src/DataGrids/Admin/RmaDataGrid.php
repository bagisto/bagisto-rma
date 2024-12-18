<?php

namespace Webkul\RMA\DataGrids\Admin;

use Illuminate\Support\Facades\DB;
use Webkul\Sales\Models\Order;
use Webkul\DataGrid\DataGrid;
use Webkul\RMA\Models\RMAStatus;
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
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function prepareQueryBuilder()
    {
        $customerId = null;

        $guestEmail = session('guestEmail');

        if (auth()->guard('customer')->check()) {
            session()->forget(['guestOrderId', 'guestEmail']);

            $customerId = auth()->guard('customer')->id();
        }

        $query = DB::table('orders');

        if ($guestEmail) {
            $query->where('orders.customer_email', $guestEmail)
                ->where('orders.is_guest', 1);
        } else {
            if ($customerId) {
                if (request()->route()->getName() == 'rma.customers.all-rma') {
                    $query->where('orders.customer_id', $customerId);
                } elseif (
                    auth()->guard('admin')->check()
                    && request()->route()->getName() == 'shop.guest.all-rma'
                ) {
                    $query->where('orders.customer_email', $customerId);
                } else {
                    $query->where('orders.customer_email', $customerId);
                }
            }
        }

        $orderId = [];

        foreach (DB::table('orders')->get() as $order) {
            $orderId[] = $order->id;
        }

        $table_prefix = DB::getTablePrefix();

        $queryBuilder = DB::table('rma')
            ->leftJoin('orders', 'orders.id', '=', 'rma.order_id')
            ->addSelect(
                'rma.id',
                'rma.order_id',
                DB::raw('CONCAT(' . $table_prefix . 'orders.customer_first_name, " ", ' . $table_prefix . 'orders.customer_last_name) as customer_name'),
                'orders.is_guest as is_guest',
                'rma.status',
                'rma.rma_status',
                'rma.order_status as order_status',
                'rma.created_at',
            )
            ->whereIn('order_id', $orderId);

        $this->addFilter('id', 'rma.id');
        $this->addFilter('order_id', 'rma.order_id');
        $this->addFilter('rma_status', 'rma.rma_status');
        $this->addFilter('created_at', 'rma.created_at');
        $this->addFilter('customer_name', DB::raw('CONCAT(' . $table_prefix . 'orders.customer_first_name, " ", ' . $table_prefix . 'orders.customer_last_name)'));

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
            'label'      => trans('rma::app.admin.sales.rma.all-rma.index.datagrid.id'),
            'type'       => 'number',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'order_id',
            'label'      => trans('rma::app.admin.sales.rma.all-rma.index.datagrid.order-ref'),
            'type'       => 'number',
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
                } else {
                    return $row->customer_name;
                }
            },
        ]);

        $this->addColumn([
            'index'      => 'rma_status',
            'label'      => trans('rma::app.admin.sales.rma.all-rma.index.datagrid.rma-status'),
            'type'       => 'dropdown',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
            'options'    => [
                'type' => 'basic',

                'params' => [
                    'options' => array_merge(
                        [
                            [
                                'label' => trans('rma::app.status.status-name.pending'),
                                'value' => RMAStatus::PENDING,
                            ], [
                                'label' => trans('rma::app.status.status-name.received-package'),
                                'value' => RMAStatus::RECEIVED_PACKAGE,
                            ], [
                                'label' => trans('rma::app.status.status-name.declined'),
                                'value' => RMAStatus::DECLINED,
                            ], [
                                'label' => trans('rma::app.status.status-name.item-canceled'),
                                'value' => RMAStatus::ITEM_CANCELED,
                            ], [
                                'label' => trans('rma::app.status.status-name.awaiting'),
                                'value' => RMAStatus::AWAITING,
                            ], [
                                'label' => trans('rma::app.status.status-name.dispatched-package'),
                                'value' => RMAStatus::DISPATCHED_PACKAGE,
                            ], [
                                'label' => trans('rma::app.status.status-name.accept'),
                                'value' => RMAStatus::ACCEPT,
                            ], [
                                'label' => trans('rma::app.status.status-name.solved'),
                                'value' => RMAStatus::SOLVED,
                            ],
                        ],
                        $this->rmaStatusRepository->all(['title as label', 'title as value'])->toArray()
                    ),
                ],
            ],
            'closure'    => function ($row) {
                if ($row->rma_status == self::PENDING || $row->rma_status == self::PENDINGSTATUS) {
    
                    return '<p class="label-pending">' . trans('rma::app.status.status-name.pending') . '</p>';
                } elseif ($row->rma_status == RMAStatus::RECEIVED_PACKAGE) {
                    if ($row->status) {
                        return '<p class="label-active">' . trans('rma::app.status.status-name.solved') . '</p>';
                    }
                
                    return '<p class="label-active">' . trans('rma::app.status.status-name.received-package') . '</p>';
                } elseif ($row->rma_status == RMAStatus::DECLINED) {

                    return '<p class="label-canceled">' . trans('rma::app.status.status-name.declined') . '</p>';
                } elseif ($row->rma_status == RMAStatus::ITEM_CANCELED) {

                    return '<p class="label-canceled">' . trans('rma::app.status.status-name.item-canceled') . '</p>';
                } elseif ($row->rma_status == RMAStatus::CANCELED) {

                    return '<p class="label-canceled">' . trans('rma::app.status.status-name.canceled') . '</p>';
                } elseif ($row->rma_status == RMAStatus::AWAITING) {

                    return '<p class="label-pending">' . trans('rma::app.status.status-name.awaiting') . '</p>';
                } elseif ($row->rma_status == RMAStatus::DISPATCHED_PACKAGE) {

                    return '<p class="label-pending">' . trans('rma::app.status.status-name.dispatched-package') . '</p>';
                } elseif ($row->rma_status == RMAStatus::SOLVED) {

                    return '<p class="label-active">' . trans('rma::app.status.status-name.solved') . '</p>';
                } elseif ($row->rma_status == RMAStatus::ACCEPT) {
                    if ($row->status) {
                        return '<p class="label-active">' . trans('rma::app.status.status-name.solved') . '</p>';
                    }
                
                    return '<p class="label-active">' . trans('rma::app.status.status-name.accept') . '</p>';
                } else {
                    $rmaStatusColor = '';

                    $rmaStatusData = app('Webkul\RMA\Repositories\RMAStatusRepository')
                        ->where('title', $row->rma_status)
                        ->first();
        
                    if ($rmaStatusData) {
                        $rmaStatusColor = $rmaStatusData->color;
                    }

                    return '<p class="label-active" style="background:' . $rmaStatusColor . ';">' . $row->rma_status . '</p>';
                }                
            },
        ]);

        $this->addColumn([
            'index'      => 'order_status',
            'label'      => trans('rma::app.admin.sales.rma.all-rma.index.datagrid.order-status'),
            'type'       => 'dropdown',
            'options'    => [
                'type' => 'basic',

                'params' => [
                    'options' => [
                        [
                            'label' => trans('rma::app.shop.customer.delivered'),
                            'value' => self::ACTIVE,
                        ], [
                            'label' => trans('rma::app.shop.customer.undelivered'),
                            'value' => self::ZERO,
                        ],
                    ],
                ],
            ],
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
            'closure'    => function ($row) {
                if ($row->order_status == self::ACTIVE) {

                   return '<p class="label-active">' . trans('rma::app.shop.customer.delivered') . '</p>';
                }
                
                return '<p class="label-info">' . trans('rma::app.shop.customer.undelivered') . '</p>';
            },
        ]);

        $this->addColumn([
            'index'      => 'created_at',
            'label'      => trans('rma::app.admin.sales.rma.all-rma.index.datagrid.create'),
            'type'       => 'date_range',
            'sortable'   => true,
            'searchable' => true,
            'filterable' => true,
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
            'title'  => trans('rma::app.shop.customer-rma-index.view'),
            'icon'   => 'icon-view',
            'method' => 'GET',
            'url'    => function ($row) {
                return route('admin.sales.rma.view', $row->id);
            },
        ]);
    }
}