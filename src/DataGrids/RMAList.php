<?php

namespace Webkul\RMA\DataGrids;

use DB;
use Webkul\Ui\DataGrid\DataGrid;

class RMAList extends DataGrid
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
        $orderId = $customerId = NULL;

        $guestEmailId ='';

        if (auth()->guard('customer')->user()) {
            session()->forget('guestOrderId');
            session()->forget('guestEmailId');

            $customerId = auth()->guard('customer')->user()->id;
        }

        // get the guest orderId for the data filteration
        if (request()->route()->getName() != 'admin.rma.index') {
            $guestEmailId = session()->get('guestEmailId');
        }

        $orders = DB::table('orders')
                ->where(function($query) use ($guestEmailId, $customerId)  {
                    if ($guestEmailId) {
                        $query->where('orders.customer_email', $guestEmailId);
                        $query->where('orders.is_guest', 1);
                    } else {
                        if ($customerId) {
                            if (request()->route()->getName() == 'rma.customers.allrma') {
                                $query->where('orders.customer_id', $customerId);
                            }
                        } else if (auth()->guard('admin')->user()) {
                            if (request()->route()->getName() == 'rma.customers.guestallrma') {
                                $query->where('orders.customer_email', $customerId);
                            }
                        } else {
                            $query->where('orders.customer_email', $customerId);
                        }
                    }
                });

        $orderId = [];
        foreach ($orders->get() as $order) {
            $orderId[] = $order->id;
        }

        $queryBuilder = DB::table('rma')
                        ->addSelect(
                            'rma.id',
                            'rma.status',
                            'rma.order_id',
                            'rma.rma_status',
                            'rma.created_at'
                        )
                        ->whereIn('order_id', $orderId);

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
        $this->addColumn([
            'index' =>  'id',
            'label' => trans('rma::app.shop.customer-index-field.id'),
            'type' => 'number',
            'searchable' => false,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'order_id',
            'label' => trans('rma::app.shop.customer-index-field.order-ref'),
            'type' => 'number',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
            'wrapper' => function($rma) {
                $routeName = request()->route()->getName();

                if ($routeName == 'admin.rma.index' && auth()->guard('admin')->user()) {
                    $route = route('admin.sales.orders.view', ['id' => $rma->order_id]);

                    echo '<a href="' . $route . '">'.'#'.$rma->order_id.'</a>';
                } else if ($routeName == 'rma.customers.allrma' && auth()->guard('customer')->user()) {
                    $route = route('customer.orders.view', ['id' => $rma->order_id]);

                    echo '<a href="' . $route . '">'.'#'.$rma->order_id.'</a>';
                } else if (session()->get('guestEmailId')) {
                    echo "#{$rma->order_id}";
                }
            }
        ]);

        $this->addColumn([
            'index' => 'rma_status',
            'label' => trans('rma::app.shop.customer-index-field.status'),
            'type' => 'string',
            'sortable' => true,
            'searchable' => false,
            'filterable' => false,
            'wrapper' => function($rma) {
                $rmaStatus = $rma->rma_status;

                if ($rmaStatus == NULL || $rmaStatus == 'Pending') {
                    if ($rma->status != 1) {
                        echo "Pending";
                    } else {
                        echo "Solved";
                    }
                } else if($rmaStatus == 'Received Package') {
                    if ($rma->status != 1) {
                        echo 'Received Package';
                    } else {
                        echo "Solved";
                    }
                } else if ($rmaStatus == 'Declined') {
                    echo $rmaStatus;
                } else if($rmaStatus == 'Item Canceled') {
                    echo "Item Canceled";
                } else if ($rmaStatus == 'Not Receive Package yet') {
                    echo 'Not Receive Package yet';
                } else if ($rmaStatus == 'Dispatched Package') {
                    echo 'Dispatched Package';
                } else if($rmaStatus == 'Accept') {
                    if ($rma->status != 1) {
                        echo 'Accept';
                    } else {
                        echo "Solved";
                    }
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
        $routeName = request()->route()->getName();

        if ($routeName == 'admin.rma.index' && auth()->guard('admin')->user()) {
            $route = 'admin.rma.view';
        } else if ($routeName == 'rma.customers.allrma' && auth()->guard('customer')->user()) {
           $route = 'rma.customer.view';
        } else {
           $route = 'rma.customer.guestview';
        }

        $this->addAction([
            'title' => trans('rma::app.shop.customer-rma-index.view'),
            'type' => 'View',
            'method' => 'GET',
            'route' => $route,
            'icon' => 'icon eye-icon'
        ],true);
    }
}
