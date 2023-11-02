<?php

namespace Webkul\RMA\Http\Controllers\Admin;

use Illuminate\Support\Facades\Mail;
use Webkul\RMA\Repositories\{RMARepository, RMAItemsRepository, RMAReasonsRepository, RMAImagesRepository, RMAMessagesRepository};
use Webkul\RMA\Mail\{CustomerRMAStatusEmail, AdminConversationEmail, CustomerRmaCreationEmail};
use Webkul\Sales\Repositories\{OrderRepository, OrderItemRepository, RefundRepository};
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\RMA\DataGrids\RMAList;
use Webkul\RMA\Http\Controllers\Controller;
use Webkul\RMA\DataGrids\Admin\Reasons;
use Cookie;
use Webkul\RMA\Models\RMAReasons;

class AdminController extends Controller
{   
    /**
     * Is Guest User
     *
     * @var bool  
     */
    protected $isGuest;

    /**
     * For view file
     *
     * @var string
     */
    protected $_config;
    /**
     * Constructor
     *
     * @param RMARepository $rmaRepository
     * @param OrderRepository $orderRepository
     * @param RMAItemsRepository $rmaItemsRepository
     * @param RMAImagesRepository $rmaImagesRepository
     * @param RMAReasonsRepository $rmaReasonRepository
     * @param RMAMessagesRepository $rmaMessagesRepository
     * @param CustomerRepository $customerRepository
     * @param OrderItemRepository $orderItemRepository
     * @param RefundRepository $refundRepository
     */
    public function __construct(
        protected RMARepository $rmaRepository,
        protected OrderRepository $orderRepository,
        protected RMAItemsRepository $rmaItemsRepository,
        protected RMAImagesRepository $rmaImagesRepository,
        protected RMAReasonsRepository $rmaReasonRepository,
        protected RMAMessagesRepository $rmaMessagesRepository,
        protected CustomerRepository $customerRepository,
        protected OrderItemRepository $orderItemRepository,
        protected RefundRepository $refundRepository
    )
    {
        if (auth()->guard('customer')->user()) {
            $this->isGuest = 0;
            $this->middleware('customer');
        }

        $this->_config = request('_config');
    }

    /**
     * RMA list
     */
    public function index()
    {
        $path = request()->path();

        if (request()->ajax() && $path == "admin/rma/requests") {
            return app(RMAList::class)->toJson();
        } else if (request()->ajax() && $path == "admin/rma/reasons") {
            return app(Reasons::class)->toJson();
        }

        return view($this->_config['view']);
    }

    /**
     * Store reason
     */
    public function store()
    {
        request()->merge([
            'is_admin' => 1
        ]);
        $data = request()->except('_token');
      
        $this->rmaReasonRepository->create($data);

        session()->flash('success', trans('rma::app.response.create-success', ['name' => 'Reason']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Edit the data by $id
     */
    public function edit($id)
    {
        $data = $this->rmaReasonRepository->find($id);

        return view($this->_config['view'], compact('data'));
    }

    /**
     * Update the data by selected $id
     */
    public function update()
    {
       $data = request()->except('_token');

       $this->rmaReasonRepository->find($data['id'])->update($data);

       session()->flash('success', trans('rma::app.response.update-success', ['name' => 'Reasons']));

       return redirect()->route($this->_config['redirect']);
    }

    /**
     * View the RMA as per as selected $id
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

        foreach ($orderItems as $orderItem) {
            if ($orderItem->type == 'configurable'){
                $skus[] = $orderItem->child;
            } else {
                $skus[] = $orderItem->sku;
            }
        }

        $createdInvoiceItems = $invoiceItemsRepository->findWhereIn('order_item_id', $itemsId)->count();

        $productDetails = $this->rmaItemsRepository->with('getOrderItem')->findWhere(['rma_id' => $id]);

        $adminMessages = $this->rmaMessagesRepository->rmaMessages($id);

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
     * Send the message regarding the RMA
     */
    public function sendMessage()
    {
        $data = request()->all();

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
     * Save rma status by admin
     *
     * return $value
     */
    public function saveRmaStatus()
    {
        $status = request()->all();

        $rma = $this->rmaRepository->find($status['rma_id']);
        $orderId = $rma->order_id;

        $order = $this->orderRepository->find($orderId);

        $mailDetails['name'] = $order->customer_first_name . " " . $order->customer_last_name;
        $mailDetails['email'] = $order->customer_email;
        $mailDetails['rma_id'] = $status['rma_id'];
        $mailDetails['rma_status'] = $status['rma_status'];

        $orderRma = $this->rmaRepository->findWhere(['order_id' => $orderId]);

        foreach ($orderRma as $rma) {
            if ($rma->rmaItem) {
                $rmaItems[] = $rma->rmaItem;
            }
        }

        $totalCount = 0;
        foreach ($rmaItems as $rmaItem) {
            $totalCount += $rmaItem->quantity;
        }
        
        if ($totalCount) {
            if ($status['rma_status'] == 'Item Canceled') {
                foreach ($rmaItems as $key => $rmaItem) {
                    $this->orderItemRepository->find($rmaItem->order_item_id)
                    ->update(['qty_canceled' => "1"]);
                }
            } else {
                foreach ($rmaItems as $key => $rmaItem) {
                    $this->orderItemRepository->find($rmaItem->order_item_id)
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

            } else {
                foreach ($rmaItems as $key => $rmaItem) {
                    $this->orderItemRepository->find($rmaItem->order_item_id)
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
                $status['order_status'] = 'Closed';
                $order->update(['status' => 'closed']);
                
                $this->rmaRepository->find($status['rma_id'])->update(['status' => 1]);
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
     * Mass delete by Request
     */
    public function massDelete()
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

            if (! $suppressFlash) {
                session()->flash('success', trans('rma::app.response.delete-success', ['name' => 'Reason']));
            } else {
                session()->flash('error', trans( 'rma::app.response.attribute-reason-error', ['name' => 'Reason']));
            }

            return redirect()->back();
        }

        session()->flash('error', trans( 'rma::app.response.attribute-reason-error', ['name' => 'Reason']));

        return redirect()->back();
    }

    /**
     * Delete the data by $id
    */
    public function delete($id)
    {
        try {
            $this->rmaReasonRepository->delete($id);

            return response()->json([
                'message' => trans('rma::app.response.delete-success', ['name' => 'Reason']),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => trans( 'rma::app.response.attribute-reason-error', ['name' => 'Reason']),
            ]);
        }

        return redirect()->back();
    }

    /**
     * Create RMA
     */
    public function createRma() 
    {
        $quantityCount = 0;

        $orderQtyArr = [];

        $rmaData = isset($_COOKIE['rmaData']) ? json_decode($_COOKIE['rmaData']) : '';
        
        if (! empty($rmaData)) {
            $show = true;

            $order = $this->orderItemRepository
                    ->where('order_id', $rmaData->orderId)
                    ->where('type', "!=" ,'configurable')
                    ->paginate(10);

            foreach ($order as $orderKey => $orderItem) {
            if (! core()->getConfigData('sales.rma.setting.enable_rma_for_digital_products')
                && in_array($orderItem->type, ['booking', 'downloadable', 'virtual'])
            ) {
                session()->flash('error', trans('rma::app.response.enable-digital-products'));

                return redirect()->back();
            }

            if (($orderItem->type == "downloadable" 
                || $orderItem->type == "virtual") 
                && count($orderItem->invoice_items)
                && $orderItem->order->status != "pending") {
                    unset($order[$orderKey]);   

            } else if ($orderItem->type == "booking" && $orderItem->order->status != "pending") {
                unset($order[$orderKey]);
            }

            $countRmaItems = $this->rmaItemsRepository->findWhere(['order_item_id' => $orderItem->id]);

            foreach ($countRmaItems as $key => $countRmaItem) {
                $quantityCount += $countRmaItem->quantity;
            }

                $RMAQuantityCount = $quantityCount ? ($orderItem->qty_ordered - $quantityCount) : $orderItem->qty_ordered;

                $orderQtyArr[$orderKey] = $RMAQuantityCount;

                $quantityCount = 0;
            }
            
            foreach ($orderQtyArr as $key => $orderQty) {
                if ($orderQty == 0) {
                    unset($order[$key]);
                }
            }

            $reason = $this->rmaReasonRepository->findWhere(['status' => '1']);

        } else {
            $show = false; 
            $order = [];
            $rmaData = [];
            $reason=[];
        }
               
        return view($this->_config['view'] ,compact('show','order','rmaData','reason','orderQtyArr'));
    }

    /**
     * Validate Rma data
     */
    public function validateRma()
    {
        $quantityCount = 0;

        $orderQtyArr = [];

        $data = request()->all();
        
        $validOrder = $this->checkValidOrder($data["OrderId"]);
        
        if (!$validOrder) {
            session()->flash('error', trans( 'rma::app.admin.create_rma.invalid-order-id'));
            
            return redirect()->back();
        }

        $order = $this->orderItemRepository->findWhere(['order_id' => $data["OrderId"]]);

        foreach ($order as $orderKey => $orderItem) {
            if (! core()->getConfigData('sales.rma.setting.enable_rma_for_digital_products')
            && in_array($orderItem->type, ['booking', 'downloadable', 'virtual'])
            ) {
                session()->flash('error', trans('rma::app.response.enable-digital-products'));

                return redirect()->back();
            }

            if (($orderItem->type == "downloadable" 
                || $orderItem->type == "virtual") 
                && count($orderItem->invoice_items)
                && $orderItem->order->status != "pending") {
                    unset($order[$orderKey]);   

            } else if ($orderItem->type == "booking" && $orderItem->order->status != "pending") {
                unset($order[$orderKey]);
            }

            $countRmaItems = $this->rmaItemsRepository->findWhere(['order_item_id' => $orderItem->id]);

            foreach ($countRmaItems as $key => $countRmaItem) {
                $quantityCount += $countRmaItem->quantity;
            }

            $quantityCount = $orderItem->qty_ordered - $quantityCount;

            $orderQtyArr[$orderKey] = $quantityCount;
        }

        foreach ($orderQtyArr as $key => $qty) {
            if ($qty == 0) {
                unset($orderQtyArr[$key]);
            }
        }

        if (empty($orderQtyArr)) {
            session()->flash('error', trans( 'rma::app.admin.create_rma.rma-already-exist'));

            return redirect()->back();
        }

        else {
            if ($this->customerRepository->findOneWhere(['email' => $data["email"]])) {
                $isGuest = 0;        
            } else {
                $isGuest = 1;
            }
                $orderDetails = $this->orderRepository->find($data["OrderId"]);

            if ($orderDetails->customer_email != $data["email"]) {
                session()->flash('error', trans( 'rma::app.admin.create_rma.mismatch'));

                return redirect()->back();
            }

            if (count($order)) {
                $rmaData = [
                    'isGuest' => $isGuest,
                    'orderId' => $data["OrderId"],
                    'email' => $data["email"],
                ];
    
                setcookie('rmaData', json_encode($rmaData), time() + 10, "/");
            } else {
                session()->flash('error', trans( 'rma::app.admin.create_rma.select-other-order-id'));
            }
        }

        return redirect()->back();
    }

    /**
     * Check valid order
     */
    public function checkValidOrder($orderId) 
    {   
        $orderDetails = $this->orderRepository->find($orderId);
        if (empty($orderDetails) || $orderDetails->status == 'canceled') {
            return false;
        } else {
            $rma = $this->rmaRepository->findWhere(['order_id' => $orderId]);
            $checkRma = $rma->toArray();
            
            if (empty($checkRma)) {
                return true;
            } else {
                $orderItems = $this->orderItemRepository->findWhere(['order_id' => $orderId]);
               
                foreach ($orderItems as $orderItem) {
                    $orderItemsArray[] = $orderItem->id;
                }
                
                foreach ($rma as $rmaId) {
                    $rmaItem = $this->rmaItemsRepository->findWhere(['rma_id' => $rmaId->id]);
                
                    foreach ($rmaItem as $rmaItems) {
                        $rmaItemsArray[] = $rmaItems->id;
                    }

                    $remainingItem = array_diff($orderItemsArray, $rmaItemsArray);

                    if (empty($remainingItem)) {
                        return false;
                    } else {
                        return true;
                    }
                }
            }
        }
    }

    /**
     * Store Rma Data Created By Admin
     */
    public function storeRmaData() 
    {
        $data  = request()->all();
        $items = [];
        $data['order_items'] = [];

        foreach ($data['qty'] as $key => $itemQty) {
            if (empty($itemQty)) {
                unset($data['qty'][$key]);
                unset($items[$key]);
            }
        }

        if (! request()->order_item_id || empty($data['qty'])) {
            session()->flash('error', trans('rma::app.admin.create_rma.select-item'));

            return redirect()->back();
        }

        foreach ($data['order_item_id'] as $orderItemId) {
            $orderItem = $this->orderItemRepository->find($orderItemId);

            array_push($data['order_items'], $orderItem);

            array_push($items, [
                'order_id'      => $orderItem->order_id,
                'order_item_id' => $orderItem->id,
            ]);
        }

        $orderDataValue = $this->orderRepository->find($data['order_id']);
        
        $orderRMAData = [
            'status'        => '',
            'order_id'      => $data['order_id'],
            'resolution'    => "Cancel Items",
            'information'   => ! empty($info) ? $info : '',
            'order_status'  => $orderDataValue->status,
            'rma_status'    => 'Pending'
        ];

        $rma = $this->rmaRepository->create($orderRMAData);

        $lastInsertId = $rma->id;

        if (isset($data['images'])) {
            $imageCheck = implode(",", $data['images']);
        }

        $data['rma_id'] = $lastInsertId;
        
        // insert images
        if (! empty($imageCheck)) {
            foreach ($data['images'] as $itemImg) {
                $this->rmaImagesRepository->create([
                    'rma_id' => $lastInsertId,
                    'path'  => ! empty($itemImg) ?? $itemImg->getClientOriginalName(),
                ]);
            }
        }

        // insert orderItems
        foreach ($items as $key => $itemId) {
            $orderItemRMA = [
                'rma_id'        => $lastInsertId,
                'order_item_id' => $itemId['order_item_id'],
                'quantity'      => isset($data['qty'][$key]) ? $data['qty'][$key] : $data['qty'][$key+1],
                'rma_reason_id' => $data['reason'][$itemId['order_item_id']]
            ];

            $rmaOrderItem = $this->rmaItemsRepository->create($orderItemRMA);
        }

        $data['reasonsData'] =  $this->rmaReasonRepository->findWhereIn('id', $data['reason']);

        foreach ($data['reasonsData'] as $reasons) {
            $data['reasons'][] = $reasons->title;
        }

        // save the images in the public path
        $this->rmaImagesRepository->uploadImages($data, $rma);

        $orderItemsRMA = $this->rmaItemsRepository->findWhere(['rma_id' => $lastInsertId]);

        $order = $this->orderRepository->findOrFail($rma->order_id);

        $ordersItem = $order->items;

        $orderItem = [];
        foreach ($orderItemsRMA as $orderItemRMA) {
            $orderItem[] = $orderItemRMA->order_item_id;
        }

        $orderData = $ordersItem->whereIn('id', $orderItem);

        foreach ($orderData as $key => $configurableProducts) {
            if ($configurableProducts['type'] == 'configurable') {
                $data['skus'][] = $configurableProducts['child'];
            }
        }
      
        if ($rmaOrderItem) {
            try {
                Mail::queue(new CustomerRmaCreationEmail($data));

                session()->flash('success', trans('shop::app.customer.signup-form.success-verify'));
            } catch (\Exception $e) {
                session()->flash('success', trans('shop::app.customer.signup-form.success-verify-email-unsent'));
            }

            session()->flash('success', trans('admin::app.response.create-success', ['name' => 'Request']));
            Cookie::has('rmaData') ? setcookie('rmaData', null, -1, '/') : '';

            return redirect()->route('admin.rma.index');
        } else {
            session()->flash('error', trans('shop::app.customer.signup-form.failed'));

            return redirect()->route('admin.rma.index');
        }
    }
}
