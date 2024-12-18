<?php

namespace Webkul\RMA\DataGrids\Shop;

use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;
use Webkul\RMA\Models\RMAStatus;
use Webkul\RMA\Repositories\RMAStatusRepository;

class CustomerRmaDataGrid extends DataGrid
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

        $guestOrderId = session()->get('guestOrderId');

        $orderId = isset($guestOrderId) ? $guestOrderId : null;

        $queryBuilder = DB::table('rma')
            ->join('orders', 'orders.id', '=', 'rma.order_id')
            ->join('rma_items', 'rma_items.rma_id', '=', 'rma.id')
            ->select(
                'rma.id',
                'rma.status',
                'rma.order_id',
                'rma.rma_status',
                'rma.rma_status as rmaStatus',
                'rma.created_at',
                'orders.customer_email',
                DB::raw('SUM(rma_items.quantity) as total_quantity'),
            )->groupBy('rma.id');

        $queryBuilder->where(function ($query) use ($orderId, $customerId, $guestEmail) {
            if (! is_null($orderId)) {
                $query->where('orders.id', $orderId)
                    ->where('orders.customer_email', $guestEmail);
            } elseif ($guestEmail) {
                $query->where('orders.customer_email', $guestEmail)
                    ->where('orders.is_guest', 1);
            } elseif ($customerId) {
                $query->where('orders.customer_id', $customerId);
            }
        });

        $this->addFilter('id', 'rma.id');
        $this->addFilter('order_id', 'rma.order_id');
        $this->addFilter('rma_status', 'rma.rma_status');
        $this->addFilter('customer_email', 'orders.customer_email');
        $this->addFilter('created_at', 'rma.created_at');

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
                return '<span class="text-sm text-blue-500"><a href="' . route('shop.customers.account.orders.view', ['id' => $row->order_id]) . '">' . '#' . $row->order_id . '</a></span>';
            },
        ]);

        $this->addColumn([
            'index'   => 'rma_status',
            'label'   => trans('rma::app.admin.sales.rma.all-rma.index.datagrid.rma-status'),
            'type'    => 'dropdown',
            'options' => [
                'type'   => 'basic',

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
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
            'closure'    => function ($row) {
                if ($row->rma_status == self::PENDING || $row->rma_status == self::PENDINGSTATUS) {
    
                    return '<p class="label-pending">' . trans('rma::app.status.status-name.pending') . '</p>';
                } elseif ($row->rma_status == RMAStatus::RECEIVED_PACKAGE) {

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
            'index'      => 'total_quantity',
            'label'      => trans('rma::app.shop.guest.create.quantity'),
            'type'       => 'string',
            'sortable'   => true,
            'searchable' => false,
            'filterable' => false,
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
        $routeName = request()->route()->getName();

        if (
            auth()->guard('customer')->user()
            && $routeName == 'rma.customers.all-rma'
        ) {
            $route = 'rma.customer.view';

            $cancelRoute = 'rma.customer.cancelRMAStatus';
        } else {
            $route = 'rma.customer.guest-view';

            $cancelRoute = 'rma.guest.cancelRMAStatus';
        }

        $this->addAction([
            'title'  => trans('rma::app.shop.customer-rma-index.view'),
            'icon'   => 'icon-eye',
            'method' => 'GET',
            'url'    => function ($row) use ($route) {
                return route($route, $row->id);
            },
        ]);

        $this->addAction([
            'title'     => trans('rma::app.shop.customer-rma-index.view'),
            'icon'      => 'icon-cancel',
            'method'    => 'GET',
            'condition' => function ($row) {
                if (
                    $row->rmaStatus != 'solved'
                ) {
                    return false;
                }

                return true;
            },
            'url'      => function ($row) use ($cancelRoute) {
                return route($cancelRoute, $row->id);
            },
        ]);
    }
}