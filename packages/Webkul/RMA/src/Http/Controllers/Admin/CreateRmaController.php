<?php

namespace Webkul\RMA\Http\Controllers\Admin;

use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\RMA\Repositories\CreateRmaRepository;
use Webkul\RMA\Repositories\RMAImagesRepository;
use Webkul\RMA\Repositories\RMAItemsRepository;
use Webkul\RMA\Repositories\RMAMessagesRepository;
use Webkul\RMA\Repositories\RMAReasonsRepository;
use Webkul\RMA\Repositories\RMARepository;
use Webkul\Sales\Repositories\OrderItemRepository;
use Webkul\Sales\Repositories\OrderRepository;

class CreateRmaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected CustomerRepository $customerRepository,
        protected OrderRepository $orderRepository,
        protected OrderItemRepository $orderItemRepository,
        protected RMARepository $rmaRepository,
        protected RMAReasonsRepository $rmaReasonRepository,
        protected CreateRmaRepository $createRmaRepository,
        protected RMAItemsRepository $rmaItemsRepository,
        protected RMAMessagesRepository $rmaMessagesRepository,
        protected RMAImagesRepository $rmaImagesRepository,
    ) {
    }

    /**
     * Display the RMA creation form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $show = false;

        $rmaData = [];

        return view('rma::admin.sales.rma.create.rma-create', compact('show', 'rmaData'));
    }

    /**
     * Validate the RMA data.
     *
     * @return \Illuminate\View\View
     */
    public function validateRma()
    {
        $requestData = request()->input();

        if (! $this->checkValidOrder($requestData['orderId'])) {
            session()->flash('error', trans('rma::app.admin.sales.rma.create-rma.invalid-order-id'));

            return redirect()->back();
        }

        $result = $this->createRmaRepository->validateRmaData($requestData);

        if (is_array($result)) {
            return view('rma::admin.sales.rma.create.rma-create', $result);
        } else {
            return $result;
        }
    }

    /**
     * Check if the order is valid for creating an RMA.
     *
     * @param  int  $orderId
     * @return bool
     */
    public function checkValidOrder($orderId)
    {
        $order = $this->orderRepository->find($orderId);

        if (empty($order)
            || $order->status == 'canceled') {
            return false;
        }

        $rma = $this->rmaRepository->findWhere(['order_id' => $orderId]);

        return empty($rma->items);
    }

    /**
     * Store RMA created by admin.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $requestData = request()->only([
            'order_id',
            'order_item_id',
            'qty',
            'reason',
            'information',
            'images',
        ]);

        $items = [];

        // Remove empty items from the request data
        foreach ($requestData['qty'] as $key => $itemQty) {
            if (empty($itemQty)) {
                unset($requestData['qty'][$key]);

                unset($items[$key]);
            }
        }

        // Check if necessary data is present
        if (empty($requestData['order_item_id'])
            || empty($requestData['qty'])) {
            session()->flash('error', trans('rma::app.admin.create-rma.select-item'));

            return redirect()->route('admin.sales.rma.validate');
        }

        // Store RMA data
        $this->createRmaRepository->storeData($requestData);

        return redirect()->route('admin.sales.rma.index');
    }
}
