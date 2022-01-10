<?php

namespace Webkul\RMA\Http\Controllers\Admin;

use Illuminate\Support\Facades\Mail;
use Webkul\RMA\Repositories\RMARepository;
use Webkul\RMA\Mail\CustomerRMAStatusEmail;
use Webkul\RMA\Mail\AdminConversationEmail;
use Webkul\RMA\Http\Controllers\Controller;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\RMA\Repositories\RMAItemsRepository;
use Webkul\RMA\Repositories\RMAImagesRepository;
use Webkul\RMA\Repositories\RMAReasonsRepository;
use Webkul\RMA\Repositories\RMAMessagesRepository;
use Webkul\Sales\Repositories\OrderItemRepository;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\Sales\Repositories\RefundRepository;

class AdminController extends Controller
{
    /**
     * OrderRepository object
     *
     * @var array
     */
    protected $orderRepository;

    /**
     * RMARepository object
     *
     * @var object
     */
    protected $rmaRepository;

    /**
     * RMAItemsRepository object
     *
     * @var object
     */
    protected $rmaItemsRepository;

    /**
     * RMAReasonsRepository object
     *
     * @var object
     */
    protected $rmaReasonRepository;

    /**
     * OrderItemRepository object
     *
     * @var object
     */
    protected $orderItemRepository;

    /**
     * RefundRepository object
     *
     * @var object
     */
    protected $refundRepository;

    /**
     * RMAMessagesRepository object
     *
     * @var object
     */
    protected $rmaMessagesRepository;

    /**
     * RMAImagesRepository object
     *
     * @var object
     */
    protected $rmaImagesRepository;

    /**
     * CustomerRepository object
     *
     * @var object
     */
    protected $customerRepository;

    public function __construct(
        RMARepository $rmaRepository,
        OrderRepository $orderRepository,
        RMAItemsRepository $rmaItemsRepository,
        CustomerRepository $customerRepository,
        OrderItemRepository $orderItemRepository,
        RMAImagesRepository $rmaImagesRepository,
        RMAReasonsRepository $rmaReasonRepository,
        RMAMessagesRepository $rmaMessagesRepository,
        RefundRepository $refundRepository
    ) {
        $this->isGuest = 1;

        if (auth()->guard('customer')->user()) {
            $this->isGuest = 0;
            $this->middleware('customer');
        }

        $this->_config = request('_config');

        $this->rmaRepository = $rmaRepository;
        $this->orderRepository = $orderRepository;
        $this->customerRepository = $customerRepository;
        $this->rmaItemsRepository = $rmaItemsRepository;
        $this->rmaReasonRepository = $rmaReasonRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->rmaImagesRepository = $rmaImagesRepository;
        $this->rmaMessagesRepository = $rmaMessagesRepository;
        $this->refundRepository = $refundRepository;
    }

    public function index()
    {
        return view($this->_config['view']);
    }

    /**
     * store reason
     */
    public function store()
    {
        $data = request()->except('_token');

        $this->rmaReasonRepository->create($data);

        session()->flash('success', trans('rma::app.response.create-success', ['name' => 'Reason']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * edit the data by $id
     */
    public function edit($id)
    {
        $data = $this->rmaReasonRepository->find($id);

        return view($this->_config['view'], compact('data'));
    }

    /**
     * update the data by selected $id
     */
    public function update()
    {
       $data = request()->except('_token');

       $this->rmaReasonRepository->find($data['id'])->update($data);

       session()->flash('success', trans('rma::app.response.update-success', ['name' => 'Reasons']));

       return redirect()->route($this->_config['redirect']);
    }

    /**
     * view the RMA as per as selected $id
     */

    public function view($id)
    {
        $rmaData = $this->rmaRepository->with('orderItem')->findOneWhere([
            'id'=> $id
        ]);

        $canceledRMAItemId = [];
        $invoiceCreateRMAItems = [];
        $shipmentCreatedRMAItems = [];

        $adminRepository = app('Webkul\User\Repositories\AdminRepository');
        $invoiceItemsRepository = app('Webkul\Sales\Repositories\InvoiceItemRepository');
        $shippedItemsRepository = app('Webkul\Sales\Repositories\ShipmentItemRepository');

        $admin = $adminRepository->findOneByField('id', auth()->guard('admin')->user()->id);

        $rma = $this->rmaRepository->find($id);
        $orderDetails = $this->orderRepository->find($rma->order_id);

        $rmaImages = $this->rmaImagesRepository->findWhere(['rma_id' => $id]);
        $orderItems = $this->rmaItemsRepository->with('getReasons')->findWhere(['rma_id' => $id]);

        //check the orders item invoice created or not

        if ($rma) {
            $invoiceCreateRMAItems = $invoiceItemsRepository->findWhereIn('order_item_id', $canceledRMAItemId);
            $shipmentCreatedRMAItems = $shippedItemsRepository->findWhereIn('order_item_id', $canceledRMAItemId);
        }

        //check Invoice is created is or not
        $invoiceCreateRMAItemsId = [];

        if (isset($invoiceCreateRMAItems)) {
            foreach ($invoiceCreateRMAItems as $invoiceCreatedItem) {
                $invoiceCreateRMAItemsId[] = $invoiceCreatedItem->order_item_id;
            }
        }

        //check shipment is created is or not
        $shipmentCreatedRMAItemsId = [];

        if (isset($shipmentCreatedRMAItems)) {
            foreach ($shipmentCreatedRMAItems as $shipmentCreatedItem) {
                $shipmentCreatedRMAItemsId[] = $shipmentCreatedItem->order_item_id;
            }
        }

        $orderItems = $this->orderItemRepository->findWhere(['order_id' => $rma->order_id]);

        foreach ($orderDetails->items as $orderItem) {
            $itemsId[] = $orderItem->id;
        }

        foreach($orderItems as $orderItem) {
            if ($orderItem->type == 'configurable'){
                $skus[] = $orderItem->child;
            } else {
                $skus[] = $orderItem->sku;
            }
        }

        $createdInvoiceItems = $invoiceItemsRepository->findWhereIn('order_item_id', $itemsId)->count();

        $productDetails = $this->rmaItemsRepository->with('getOrderItem')->findWhere(['rma_id' => $id]);

        $adminMessages = $this->rmaMessagesRepository
                        ->where('rma_id', $id)
                        ->orderBy('id','desc')
                        ->paginate(5);

        return view(
            $this->_config['view'], compact(
                'skus',
                'rma',
                'rmaData',
                'rmaImages',
                'orderItems',
                'orderDetails',
                'adminMessages',
                'productDetails',
                'canceledRMAItemId',
                'createdInvoiceItems',
                'invoiceCreateRMAItemsId',
                'shipmentCreatedRMAItemsId'
            )
        );
    }

    /**
     * send the message regarding the RMA
     */
    public function sendmessage()
    {
        $data = request()->all();

        // $rma = $this->rmaRepository->find($data['rma_id']);

        $orderDetails = $this->orderRepository->find($data['order_id']);

        $conversationDetails['message'] = $data['message'];
        $conversationDetails['customerName'] = $orderDetails->customer_first_name . " " . $orderDetails->customer_last_name;
        $conversationDetails['customerEmail'] = $orderDetails->customer_email;

        unset($data['order_id']);

        $storeMessage = $this->rmaMessagesRepository->create($data);

        if ($storeMessage) {

            try {
                Mail::queue(new AdminConversationEmail($conversationDetails));

                session()->flash('success', trans('rma::app.response.send-message', ['name' => 'Message']));
            } catch (\Exception $e) {

                session()->flash('success', trans('rma::app.response.send-message', ['name' => 'Message']));
            }

            return redirect()->back();

        } else {
            session()->flash('error', trans('shop::app.customer.signup-form.failed'));

            return redirect()->back();
        }

        return redirect()->back();
    }

    /**
     * save rma status by admin
     *
     * return $value
     */
    public function savermastatus()
    {
        $status = request()->all();

        $rma = $this->rmaRepository->find($status['rma_id']);
        $orderId = $rma->order_id;

        $order = $this->orderRepository->find($orderId);

        $mailDetails['name'] = $order->customer_first_name . " " . $order->customer_last_name;
        $mailDetails['email'] = $order->customer_email;
        $mailDetails['rma_id'] = $status['rma_id'];
        $mailDetails['rma_status'] = $status['rma_status'];
        
        $updatedRMAOrder = $this->rmaRepository->find($rma->id);

        $rmaItems = $this->rmaItemsRepository
            ->leftJoin('rma', 'rma_items.rma_id', 'rma.id')
            ->where('rma.order_id', $orderId)
            ->get();

        $totalCount = 0;
        foreach ($rmaItems as $rmaItem) {
            $totalCount += $rmaItem->quantity;
        }
        
        if ($rmaItems && $totalCount) {

            if ($status['rma_status'] == 'Item Canceled') {
                foreach ($rmaItems as $key => $rmaItem) {
                    $this->orderItemRepository->where('id', $rmaItem->order_item_id)
                    ->update(['qty_canceled' => "1"]);
                }
            }else {
                foreach ($rmaItems as $key => $rmaItem) {
                    $this->orderItemRepository->where('id', $rmaItem->order_item_id)
                    ->update(['qty_canceled' => "0"]);
                }
            }

            if ($status['rma_status'] == 'Accept') {

                $items = [];

                foreach ($rmaItems as $key => $rmaItem) {

                    $items[$rmaItem->order_item_id] = 1;
                }

                $refundArray = [
                    "refund" =>  [
                        "items" => $items,
                        "shipping" => 0,
                        "adjustment_refund" => "0",
                        "adjustment_fee" => "0",
                    ],
                    "order_id" => $orderId,
                ];

                $this->refundRepository->create($refundArray);

            }else {
                foreach ($rmaItems as $key => $rmaItem) {
                    $this->orderItemRepository->where('id', $rmaItem->order_item_id)
                    ->update(['qty_refunded' => "0"]);
                }
            }

            if (($order->total_qty_ordered == $totalCount)
                && ($status['rma_status'] == 'Item Canceled')
            ) {
                $status['order_status'] = 'Canceled';
                $order->update(['status' => 'canceled']);
            }

            if (($order->total_qty_ordered == $totalCount)
                && ($status['rma_status'] == 'Accept')
            ) {
                $rmastatus = 1;
                $status['order_status'] = 'Closed';
                $order->update(['status' => 'closed']);
                $this->rmaRepository->find($status['rma_id'])->update(['status' => $rmastatus]);
            }
        }

        $updateStatus = $rma->update($status); 

        if ($updateStatus) {
            try {
                Mail::queue(new CustomerRMAStatusEmail($mailDetails));

                session()->flash('success', trans('rma::app.response.update-status', ['name' => 'Status']));
            } catch (\Exception $e) {

                session()->flash('success', trans('rma::app.response.update-status', ['name' => 'Status']));
            }

            return redirect()->back();

        } else {
            session()->flash('error', trans('shop::app.customer.signup-form.failed'));

            return redirect()->back();
        }
    }

    /**
     * Mass updates the products
     *
     * @return response
     */
    public function massUpdate()
    {
        $data = request()->all();

        if (! isset($data['massaction-type']) || !$data['massaction-type'] == 'update') {
            return redirect()->back();
        }

        $reasonIds = explode(',', $data['indexes']);

        foreach ($reasonIds as $reasonId) {
            $rmaReason = $this->rmaReasonRepository->find($reasonId);

            if ($rmaReason) {
                $rmaReason->update([
                    'status' => $data['update-options']
                ]);
            }
        }

        session()->flash('success', trans('rma::app.response.update-success', ['name' => 'Reasons']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * mass delete by Request
     */
    public function massdelete()
    {
        $suppressFlash = false;

        if (request()->all(['massaction-type'])) {
            $indexes = explode(',', request()->input('indexes'));

            foreach ($indexes as $key => $value) {
                try {
                    $this->rmaReasonRepository->delete($value);
                } catch (\Exception $e) {
                    $suppressFlash = true;

                    continue;
                }
            }

            if (! $suppressFlash)
                session()->flash('success', trans('rma::app.response.delete-success', ['name' => 'Reason']));
            else
                session()->flash('error', trans( 'rma::app.response.attribute-reason-error', ['name' => 'Reason']));

            return redirect()->back();
        } else {
            session()->flash('error', trans( 'rma::app.response.attribute-reason-error', ['name' => 'Reason']));

            return redirect()->back();
        }
    }

    /**
     * delete the data by $id
    */
    public function delete($id)
    {
        try {

            $this->rmaReasonRepository->delete($id);

            session()->flash('success', trans('rma::app.response.delete-success', ['name' => 'Reason']));

        } catch (\Exception $e) {

            session()->flash('error', trans( 'rma::app.response.attribute-reason-error', ['name' => 'Reason']));
        }

        return redirect()->back();
    }
}
