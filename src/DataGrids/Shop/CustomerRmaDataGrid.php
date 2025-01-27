<?php

namespace Webkul\RMA\DataGrids\Shop;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Webkul\DataGrid\DataGrid;
use Webkul\RMA\Models\RMAStatus;
use Webkul\RMA\Repositories\RMAStatusRepository;

class CustomerRmaDataGrid extends DataGrid
{
    /**
     * @var string
     */
    public const PENDING = 'Pending';

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
     */
    public function prepareQueryBuilder(): Builder
    {
        $customerId = null;

        $guestEmail = session('guestEmail');

        if (auth()->guard('customer')->check()) {
            session()->forget(['guestOrderId', 'guestEmail']);

            $customerId = auth()->guard('customer')->id();
        }
        
        $orderId = session()->get('guestOrderId') ?? null;

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
                return '<span class="text-sm text-blue-500"><a href="' . route('shop.customers.account.orders.view', ['id' => $row->order_id]) . '">' . '#' . $row->order_id . '</a></span>';
            },
        ]);

        $this->addColumn([
            'index'              => 'rma_status',
            'label'              => trans('rma::app.admin.sales.rma.all-rma.index.datagrid.rma-status'),
            'type'               => 'string',
            'filterable_type'    => 'dropdown',
            'searchable'         => true,
            'sortable'           => true,
            'filterable'         => true,
            'filterable_options' => $this->rmaStatusRepository->all(['title as label', 'title as value'])->toArray(),
            'closure'            => function ($row) {
                $rmaStatusData = app('Webkul\RMA\Repositories\RMAStatusRepository')
                    ->where('title', $row->rma_status)
                    ->first();
                    
                return '<p class="label-active" style="background:' . $rmaStatusData?->color . ';">' . $row->rma_status . '</p>';      
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
        $route = 'rma.customer.guest-view';

        $cancelRoute = 'rma.guest.cancelRMAStatus';

        if (
            auth()->guard('customer')->user()
            && request()->route()->getName() == 'rma.customers.all-rma'
        ) {
            $route = 'rma.customer.view';

            $cancelRoute = 'rma.customer.cancelRMAStatus';
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