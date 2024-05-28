<?php

namespace Webkul\RMA\Http\Controllers\Customer;

use Illuminate\Support\Facades\Mail;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Product\Facades\ProductImage;
use Webkul\Product\Repositories\ProductImageRepository;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\RMA\DataGrids\Shop\CustomerRmaDataGrid;
use Webkul\RMA\Helpers\Helper;
use Webkul\RMA\Mail\CustomerConversationEmail;
use Webkul\RMA\Mail\CustomerRmaCreationEmail;
use Webkul\RMA\Repositories\RMAImagesRepository;
use Webkul\RMA\Repositories\RMAItemsRepository;
use Webkul\RMA\Repositories\RMAMessagesRepository;
use Webkul\RMA\Repositories\RMAReasonsRepository;
use Webkul\RMA\Repositories\RMARepository;
use Webkul\Sales\Repositories\InvoiceItemRepository;
use Webkul\Sales\Repositories\OrderItemRepository;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Sales\Repositories\ShipmentItemRepository;

class CustomerController extends Controller
{
    public const PRODUCT_TYPE = ['virtual', 'downloadable', 'booking'];

    public function __construct(
        protected OrderItemRepository $orderItemRepository,
        protected OrderRepository $orderRepository,
        protected InvoiceItemRepository $invoiceItemRepository,
        protected ShipmentItemRepository $shipmentItemRepository,
        protected ProductRepository $productRepository,
        protected ProductImageRepository $productImageRepository,
        protected RMARepository $rmaRepository,
        protected RMAItemsRepository $rmaItemsRepository,
        protected RMAImagesRepository $rmaImagesRepository,
        protected RMAReasonsRepository $rmaReasonRepository,
        protected RMAMessagesRepository $rmaMessagesRepository,
        protected Helper $aditionalConfigurableAttribute,
    ) {
    }

    /**
     * Method to populate the customer and guest rma index page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(CustomerRmaDataGrid::class)->toJson();
        }

        if (auth()->guard('customer')->user()) {
            return view('rma::shop.customer.rma.index');
        }

        if (empty(session()->get('guestOrderId'))) {
            return redirect()->route('rma.guest.login');
        }

        return view('rma::shop.guest.index');
    }

    /**
     * Login for the guest user
     *
     * @return \Illuminate\View\View
     */
    public function guestLogin()
    {
        if (! auth()->guard('customer')->check()) {
            return view('rma::shop.guest.login');
        }

        return redirect()->route('rma.customers.allrma');
    }

    /**
     * Get the requested data for the guest
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function guestLoginCreate()
    {
        $guestUserData = request()->only(
            'order_id',
            'email',
        );

        $order = $this->orderRepository->findOneWhere([
            'id'             => $guestUserData['order_id'],
            'customer_email' => $guestUserData['email'],
            'is_guest'       => 1,
        ]);

        if ($order) {
            session()->put('guestOrderId', $guestUserData['order_id']);

            session()->put('guestEmail', $guestUserData['email']);

            return redirect()->route('shop.guest.allrma')->with('guestUserData');
        }

        return redirect()->back()->with('error', 'Invalid details for guest');
    }

    /**
     * Create rma for guest
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse
     */
    public function guestRmaCreate()
    {
        if (auth()->guard('customer')->user()) {
            session()->flash('error', trans('rma::app.response.permission-denied'));

            return redirect()->back();
        }

        $orderData = $this->orderRepository->findOneWhere([
            'id' => session()->get('guestOrderId'),
            ['status', '<>', 'canceled'],
        ]);

        if (! $orderData) {
            return redirect()->route('shop.customer.session.index');
        }

        $customerEmail = $orderData->customer_email;

        $customerName = $orderData->customer_first_name . ' ' . $orderData->customer_last_name;

        $returnData = $this->getOrderItems($this->orderRepository->orderBy('id', 'desc')->with('items')->findWhere([
            'customer_email' => session()->get('guestEmail'),
            ['status', '<>', 'canceled'],
            ['status', '<>', 'closed'],])
        );

        $orderItems = $returnData['orderItems'];

        $reasons = $returnData['reasons'];

        return view('rma::shop.guest.create', compact('customerName', 'customerEmail', 'orderItems', 'reasons'));
    }

    /**
     * Create rma for customer
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        $customer = auth()->guard('customer')->user();
        
        $customerEmail = $customer->email;

        $customerName = $customer->first_name . ' ' . $customer->last_name;

        $returnData = $this->getOrderItems($this->orderRepository->orderBy('id', 'desc')->with('items')->findWhere([
            'customer_id' => $customer->id,
            ['status', '<>', 'canceled'],])
        );
       
        $orderItems = $returnData['orderItems'];

        $reasons = $returnData['reasons'];

        return view('rma::shop.customer.rma.create', compact('customerName', 'customerEmail', 'orderItems', 'reasons'));
    }

    /**
     * Return data to create rma
     *
     * @param  object  $allOrderItems
     * @return array
     */
    public function getOrderItems($allOrderItems)
    {
        $orderItems = collect();

        $defaultAllowedDays = core()->getConfigData('sales.rma.setting.default_allow_days');

        foreach ($allOrderItems as $key => $orderItem) {
            if (
                ! $defaultAllowedDays
                || ($orderItem->created_at->addDays($defaultAllowedDays)->format('Y-m-d') >= now()->format('Y-m-d'))
            ) {
                $orderItems->push($orderItem);
            }

            foreach ($orderItem->items as $itemValue) {
                if (
                    in_array($itemValue->type, self::PRODUCT_TYPE)
                    && (
                        // Check if RMA is enabled for digital products or the order status is not completed
                        (
                            core()->getConfigData('sales.rma.setting.enable_rma_for_digital_products')
                            || $orderItem->status != 'completed'
                        )
                    )
                    || (
                        // Check if RMA is enabled for pending orders or the order status is not pending
                        (
                            core()->getConfigData('sales.rma.setting.enable_rma_for_pending_order')
                            || $orderItem->status == 'pending'
                        )
                    )
                ) {
                    unset($orderItems[$key]);
                }
            }
        }
           
        $orderIds = $orderItems->pluck('id')->toArray();

        $rmaCollection = $this->rmaRepository->findWhereIn('order_id', $orderIds)->groupBy('order_id');

        foreach ($rmaCollection->toArray() as $rma) {
            $rmaIds = [];

            foreach ($rma as $rmaPart) {
                $rmaIds[] = $rmaPart['id'];
            }

            $totalRMAQty = 0;

            $rmaItems = $this->rmaItemsRepository->findWhereIn('rma_id', $rmaIds);

            foreach ($rmaItems as $rmaItem) {
                $totalRMAQty += $rmaItem->quantity;
            }

            foreach ($orderItems as $key => $order) {
                if (
                    (
                        $rma[0]['order_id'] == $order->id
                        && $totalRMAQty == $order->total_qty_ordered
                    )
                    || (
                        core()->getConfigData('sales.rma.setting.enable_rma_for_cancel_order')
                        && $order->status == 'canceled'
                    )
                ) {
                    unset($orderItems[$key]);
                }
            }
        }

        return [
            'orderItems' => $orderItems,
            'reasons'    => $this->rmaReasonRepository->findWhere(['status'=> '1']),
        ];
    }

    /**
     * Get order for selected order id
     *
     * @param  string  $orderId
     * @param  string  $resolutions
     * @return array
     */
    public function getOrders($orderId, $resolutions)
    {
        $orderItems = $this->orderItemRepository
            ->where('order_id', $this->orderRepository->findOrFail($orderId)->id)
            ->where('type', '!=', 'configurable')
            ->latest()->paginate(5);

        if ($resolutions == 'null') {
            //check the product's shipment and invoice is generated or not
            foreach ($orderItems as $orderItem) {
                $itemsId[] = $orderItem->id;

                $productImage = $productId = [];

                $product = $this->productRepository->find($orderItem->product_id);

                $productImage[$product->id] = ProductImage::getProductBaseImage($product);

                $productId[] = $orderItem->product_id;
            }

            $shippedOrderItems = $this->shipmentItemRepository->findWhereIn('order_item_id', $itemsId);

            foreach ($shippedOrderItems as $shippedOrderItem) {
                $shippedOrderItemId[] = $shippedOrderItem->order_item_id;
            }

            $invoiceCreatedItems = $this->invoiceItemRepository->findWhereIn('order_item_id', $itemsId);

            foreach ($invoiceCreatedItems as $invoiceCreatedItem) {
                $invoiceCreatedItemId[] = $invoiceCreatedItem->order_item_id;
            }

            $resolutions = [];

            if (core()->getConfigData('sales.rma.setting.enable_rma_for_pending_order')) {
                $resolutions = ['Cancel Items'];
            }

            if (! empty($shippedOrderItemId)) {
                $resolutions = ['Cancel Items', 'Exchange'];
            }

            if (
                ! empty($invoiceCreatedItemId)
                || (
                    ! empty($invoiceCreatedItemId)
                    && ! empty($shippedOrderItemId)
                )
            ) {
                $resolutions = ['Return', 'Exchange'];
            }
        }

        return [
            'search_results'     => $orderItems,
            'resolutions'        => $resolutions,
            'productImage'       => $productImage,
            'productImageCounts' => $this->productImageRepository->findWhereIn('product_id', $productId)->count(),
        ];
    }

    /**
     * Fetch the product from the specific order id
     *
     * @param  string  $orderId
     * @param  string  $resolution
     * @return array
     */
    public function getProducts($orderId, $resolution)
    {
        if (gettype($resolution) == 'array') {
            //check the orderItems by selected $order_id
            $order = $this->orderRepository->findOrFail($orderId);

            $orderItems = $order->items;

            //check the product's shipment and invoice is generated or not
            foreach ($orderItems as $orderItem) {
                $itemId[] = $orderItem['id'];

                $productId[] = $orderItem['product_id'];
            }

            $invoiceCreatedItems = $this->invoiceItemRepository->findWhereIn('order_item_id', $itemId);

            $shippedOrderItems = $this->shipmentItemRepository->findWhereIn('order_item_id', $itemId);

            $productImageCounts = $this->productImageRepository->findWhereIn('product_id', $productId)->count();

            foreach ($productId as $orderItemIds) {
                $allProducts[] = $this->productRepository->find($orderItemIds);
            }

            $productImage = [];

            foreach ($allProducts as $product) {
                if ($product && $product->id) {
                    $productImage[$product->id] = $product->getTypeInstance()->getBaseImage($product);
                }
            }

            foreach ($invoiceCreatedItems as $invoiceCreatedItem) {
                $invoiceCreatedItemId[] = $invoiceCreatedItem->order_item_id;
            }

            foreach ($shippedOrderItems as $shippedOrderItem) {
                $shippedOrderItemId[] = $shippedOrderItem->order_item_id;
            }

            if ((bool) core()->getConfigData('sales.rma.setting.enable_rma_for_pending_order')) {
                $resolutions = ['Cancel Items'];
            } else {
                $resolutions = [];
            }

            $orderStatus = ['Not Delivered'];

            if (! empty($shippedOrderItemId)) {
                $resolutions = ['Cancel Items', 'Exchange'];

                if (count($shippedOrderItemId) == count($itemId)) {
                    $orderStatus = ['Not Delivered', 'Delivered'];
                }
            }

            if (
                ! empty($invoiceCreatedItemId)
                || (
                    ! empty($invoiceCreatedItemId)
                    && ! empty($shippedOrderItemId)
                )
            ) {
                $resolutions = ['Return', 'Exchange'];
            }

            if (
                ! empty($order)
                && $order->status == 'completed'
            ) {
                $orderStatus = ['Delivered'];
            }

            $order = $this->orderRepository->findOrFail($orderId);

            $orderItems = $this->orderItemRepository->where('order_id', $order->id)->latest()->paginate(5);

            return response()->json([
                'search_results'     => $orderItems,
                'resolutions'        => $resolutions,
                'orderId'            => $orderId,
                'orderItems'         => $orderItems,
                'orderStatus'        => $orderStatus,
                'resolutions'        => $resolutions,
                'productImageCounts' => $productImageCounts,
                'productImage'       => $productImage,
            ]);
        }

        return $this->fetchOrderDetails($orderId, $resolution);
    }

    /**
     * Fetch order details
     *
     * @param  string  $orderId
     * @param  string  $resolution
     * @return \Illuminate\Http\JsonResponse
     */
    private function fetchOrderDetails($orderId, $resolution)
    {
        $order = $this->orderRepository->findOrFail($orderId);

        $orderItems = $order->items;

        $orderItemsId = $orderItems->pluck('id')->toArray();

        $rmaDataByOrderId = $this->rmaRepository->findWhere([
            'order_id' => $orderId,
        ]);

        $rmaId = [];

        foreach ($rmaDataByOrderId as $rmaDataId) {
            $rmaId[] = $rmaDataId->id;
        }

        $qty = [];

        if ($resolution != 'Cancel Items') {
            //Remove order items
            foreach ($orderItems as $index => $orderItem) {
                $isOrderItemValid = in_array($orderItem->type, ['downloadable', 'virtual', 'booking']);

                if ($isOrderItemValid) {
                    unset($orderItems[$index]);
                }
            }
        }

        if (count($this->rmaItemsRepository->findWhereIn('order_item_id', $orderItemsId))) {
            $rmaItems = $this->rmaItemsRepository->findWhereIn('order_item_id', $orderItems->pluck('id'));

            foreach ($rmaItems as $rmaItem) {
                $rmaOrderItemQty[$rmaItem->order_item_id][$rmaItem->id] = $rmaItem->quantity;
            }

            foreach ($rmaOrderItemQty as $key => $itemQty) {
                $qtyAddedrma[$key] = array_sum($itemQty);
                $rmaItemsId[] = $key;
            }

            foreach ($orderItems as $key => $orderItem) {
                if (in_array($orderItem->id, $rmaItemsId)) {
                    $qty[$orderItem->id] = $orderItem->qty_ordered - $qtyAddedrma[$orderItem->id];
                } else {
                    $qty[$orderItem->id] = $orderItem->qty_ordered;
                }
            }

            foreach ($orderItems as $orderItem) {
                if ($qty[$orderItem->id] != 0) {
                    $isExisting = false;

                    if (! $isExisting) {
                        $filteredData[] = $orderItem;
                    }
                }
            }
        } else {
            foreach ($orderItems as $orderItem) {
                $qty[$orderItem->id] = $orderItem->qty_ordered;
            }
        }

        $productId =  $products = [];

        foreach ($orderItems as $orderItem) {
            $productId[] = $orderItem->product_id;

            $products[] = $this->productRepository->find($orderItem->product_id);
        }

        foreach ($products as $product) {
            if (
                $product
                && $product->type == 'configurable'
                && $product->id
            ) {
                foreach ($orderItems as $item) {
                    $productImage[$product->id] = $item->product->getTypeInstance()->getBaseImage($orderItems);
                }
            } elseif (
                $product
                && $product->id
            ) {
                $productImage[$product->id] = ProductImage::getProductBaseImage($product);
            }
        }

        $html = [];

        foreach ($orderItems as $key => $orderItem) {
            if ($orderItem->type == 'configurable') {
                $additional = '';

                $html[$orderItem->id] = str_replace(',', '<br>', $additional);

                $attributeValue = $this->aditionalConfigurableAttribute->getOptionDetailHtml($orderItem->additional['attributes'] ?? []);

                $child[$orderItem->id] = [
                    'attribute' => $attributeValue,
                    'sku'       => $orderItem->child->sku,
                    'name'      => $orderItem->child->name,
                ];

                $variants = $orderItem->product->variants;
            } else {
                $child[$orderItem->id] = $orderItem->sku;
            }
        }

        $invoiceCreatedItems = $this->invoiceItemRepository->findWhereIn('order_item_id', $orderItemsId);

        $shippedOrderItems = $this->shipmentItemRepository->findWhereIn('order_item_id', $orderItemsId);

        $invoiceCreatedItemId = [];

        foreach ($invoiceCreatedItems as $invoiceCreatedItem) {
            $invoiceCreatedItemId[] = $invoiceCreatedItem->order_item_id;
        }

        $shippedOrderItemId =  $shippedProductId = [];

        foreach ($shippedOrderItems as $shippedOrderItem) {
            $shippedOrderItemId[] = $shippedOrderItem->order_item_id;

            $shippedProductId[] = $shippedOrderItem->product_id;
        }

        $resolutionResponse = ['Cancel Items'];

        $orderStatus = ['Not Delivered'];

        if (! empty($shippedOrderItemId)) {
            $resolutionResponse = ['Cancel Items', 'Exchange'];

            $orderStatus = ['Not Delivered', 'Delivered'];
        }

        if (
            ! empty($invoiceCreatedItemId)
            || (
                ! empty($invoiceCreatedItemId)
                && ! empty($shippedOrderItemId)
            )
        ) {
            $orderStatus = ['Not Delivered', 'Delivered'];

            if (count(array_unique($invoiceCreatedItemId)) == count($orderItemsId)) {
                $resolutionResponse = ['Return', 'Exchange'];

                $orderStatus = ['Not Delivered'];
            }

            if (count(array_unique($invoiceCreatedItemId)) != count($orderItemsId)) {
                $resolutionResponse = ['Return', 'Exchange', 'Cancel Items'];

                $orderStatus = ['Not Delivered'];
            }
        }

        $orderData = [];

        if (
            ! empty($invoiceCreatedItemId)
            || ! empty($shippedOrderItemId)) {
            if (
                (! empty($resolution)
                && $resolution == 'Exchange')
                || ('Return'
                    && $resolution != 'Cancel Items')
            ) {
                foreach ($orderItems as $orderItem) {
                    $isExisting = false;
                    if (
                        ! $isExisting
                        && in_array($orderItem->id, $invoiceCreatedItemId)
                    ) {
                        if ($orderItem->type == 'configurable') {
                            $orderData[] = $orderItem;
                        } elseif (! in_array($orderItem->id, $shippedOrderItemId)) {
                            $orderData[] = $orderItem;
                        }

                        $orderData[] = $orderItem;
                    }
                }
            }
        }

        if (
            ! empty($resolution)
            && (
                $resolution == 'Cancel Items'
                || $resolution == 'Exchange'
            )
        ) {
            foreach ($orderItems as $item) {
                if (! in_array($item->id, $invoiceCreatedItemId)) {
                    $isExisting = false;
                    foreach ($orderData as $existingData) {
                        if ($item->id == $existingData->id) {
                            $isExisting = true;
                        }
                    }

                    if ($item->product->type == 'configurable') {
                        $orderData[] = $item;
                    } elseif (! $isExisting) {
                        $orderData[] = $item;
                    }
                }
            }
        }

        if (empty($resolution)) {
            $orderData = [];
        }

        if (
            ! empty($order)
            && $order->status == 'completed'
        ) {
            $orderStatus = ['Delivered'];
        }

        return response()->json([
            'quantity'            => $qty,
            'html'                => $html,
            'child'               => $child,
            'variants'            => $variants ?? [],
            'orderItems'          => $orderData,
            'orderStatus'         => $orderStatus,
            'productImage'        => $productImage,
            'resolutions'         => $resolutionResponse,
            'productImageCounts'  => $this->productImageRepository->findWhereIn('product_id', $productId)->count(),
            'shippedProductId'    => $shippedProductId,
            'shippingOrderStatus' => count($shippedOrderItemId) > 0 ? 1 : 0,
        ]);
    }

    /**
     * Add custom reason
     *
     * @param [type] $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function addReason($id)
    {
        $reasons = $this->rmaReasonRepository->create([
            'status'=> '1',
            'title' => request()['inputData']
        ]);

        return response()->json(['reasons' => $reasons]);
    }

    /**
     * Get details of rma
     *
     * @param int
     * @return $value
     */
    public function view($id)
    {
        $guestDetails = null;

        $rmaData = $this->rmaRepository->with('orderItem')->findOneWhere(['id' => $id]);

        $rmaImages = $this->rmaImagesRepository->findWhere(['rma_id' => $id]);
        
        $customer = auth()->guard('customer')->user();

        $reasons = $this->rmaItemsRepository->with('getReasons')->findWhere(['rma_id' => $id]);

        $productDetails = $this->rmaItemsRepository->findWhere(['rma_id' => $id]);

        $rmaItems = $this->rmaItemsRepository->findWhere(['rma_id' => $rmaData['id']]);

        $order = $this->orderRepository->findOrFail($rmaData['order_id']);

        $rmaItemIds = [];

        foreach ($rmaItems as $rmaItem) {
            $rmaItemIds[] = $rmaItem->id;
        }

        foreach ($order->items as $key => $configurableProducts) {
            $skus[] = $configurableProducts['sku'];

            if ($configurableProducts['type'] == 'configurable') {
                $skus[] = $configurableProducts['child'];
            }
        }

        if (! empty($id)) {
            $messages = $this->rmaMessagesRepository
                ->where('rma_id', $id)
                ->orderBy('id', 'desc')
                ->paginate(5);
        }

        if (! empty($customer)) {
            $isGuest = 0;

            $customerDetails = $this->orderRepository->findOneWhere([
                'is_guest'    => 0,
                'id'          => $this->rmaRepository->find($id)->order_id,
                'customer_id' => auth()->guard('customer')->user()->id,
            ]);

            if (empty($customerDetails)) {
                return redirect()->route('rma.customers.allrma');
            }

            $customerLastName = $customerDetails->customer_last_name;

            $customerFirstName = $customerDetails->customer_first_name;

            session()->forget('guestEmail');

            return view('rma::shop.customer.rma.view', compact(
                'skus',
                'rmaData',
                'reasons',
                'isGuest',
                'messages',
                'customer',
                'rmaImages',
                'productDetails',
                'customerLastName',
                'customerFirstName'
            ));
        } else {
            $isGuest = 1;

            if (! $this->rmaRepository->find($id)) {
                return redirect()->route('shop.customer.session.index');
            }

            $guestDetails = $this->orderRepository->findWhere(['id' => $this->rmaRepository->find($id)->order_id, 'customer_email' => session()->get('guestEmail'), 'is_guest' => 1])->first();

            if (empty($guestDetails)) {
                return redirect()->route('shop.customer.session.index');
            }

            $customerLastName = $guestDetails->customer_last_name;

            $customerFirstName = $guestDetails->customer_first_name;

            return view('rma::shop.guest.view', compact(
                'skus',
                'rmaData',
                'reasons',
                'isGuest',
                'messages',
                'customer',
                'rmaImages',
                'productDetails',
                'customerLastName',
                'customerFirstName'
            ));
        }
    }

    /**
     * Store a newly created rma.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        if (empty(request()->input('order_item_id'))) {
            session()->flash('warning', trans('Please select the item'));

            return redirect()->route('shop.guest.create_rma');
        }

        $this->validate(request(), [
            'quantity'     => 'required',
            'resolution'   => 'required',
            'order_status' => 'required',
        ]);

        $items = [];

        $data = request()->only([
            'order_id',
            'resolution',
            'order_status',
            'order_item_id',
            'quantity',
            'rma_reason_id',
            'newId',
            'images',
            'information',
        ]);

        if (
            ! empty($data['information'])
            && str_word_count($data['information'], 0) > 100
        ) {
            $words = str_word_count($data['information'], 2);
            $pos = array_keys($words);
            $info = substr($data['information'], 0, $pos[100]) . '...';
        }

        $info = $data['information'];

        $data['order_items'] = [];

        foreach ($data['order_item_id'] as $orderItemId) {
            $orderItem = $this->orderItemRepository->find($orderItemId);

            array_push($data['order_items'], $orderItem);

            array_push($items, [
                'order_id'      => $orderItem->order_id,
                'order_item_id' => $orderItem->id,
            ]);
        }

        $orderRMAData = [
            'status'       => '',
            'order_id'     => $data['order_id'],
            'resolution'   => $data['resolution'],
            'information'  => ! empty($info) ? $info : '',
            'order_status' => $data['order_status'],
            'rma_status'   => 'Pending',
        ];

        $rma = $this->rmaRepository->create($orderRMAData);
        
        $lastInsertId = \DB::getPdo()->lastInsertId();

        $imageCheck = implode(",", $data['images']);

        $data['rma_id'] = $lastInsertId;
        
        // insert images
        if (! empty($imageCheck)) {
            foreach ($data['images'] as $itemImg) {
            
            $this->rmaImagesRepository->create([
                    'rma_id' => $lastInsertId,
                    'path'   => $itemImg->getClientOriginalName(),
                ]);
            }
        }

        $this->rmaImagesRepository->uploadImages($data, $rma);

        foreach ($items as $key => $itemId) {
            $orderItemRMA = [
                'rma_id'        => $lastInsertId,
                'order_item_id' => $itemId['order_item_id'],
                'quantity'      => $data['quantity'],
                'rma_reason_id' => $data['rma_reason_id'],
                'variant_id'    => ! empty($data['variant'][$key]) ? $data['variant'][$key] : null,
            ];

            $rmaOrderItem = $this->rmaItemsRepository->create($orderItemRMA);
        }

        $data['reason'] = $this->rmaReasonRepository->findOneWhere(['id' => $data['rma_reason_id']])->title;

        $rmaItems = $this->rmaItemsRepository->findWhere(['rma_id' => $lastInsertId]);

        $order = $this->orderRepository->findOrFail($this->rmaRepository->find($lastInsertId)->order_id);

        $rmaItemIds = [];

        foreach ($rmaItems as $rmaItem) {
            $rmaItemId[] = $rmaItem->order_item_id;
        }

        $orderData = $order->items->whereIn('id', $rmaItemIds);

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

            session()->flash('success', trans('rma::app.response.create-success', ['name' => 'Request']));

            if (auth()->guard('customer')->user()) {
                return redirect()->route('rma.customers.allrma');
            }

            return redirect()->route('shop.guest.allrma');
        } else {
            session()->flash('error', trans('shop::app.customer.signup-form.failed'));

            return redirect()->route('rma.customer.view');
        }
    }

    /**
     * Save rma status by customer
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function savestatus()
    {
        $data = request()->all();

        if (! empty($data['close_rma'])) {
            $rma = $this->rmaRepository->find($data['rma_id']);

            if (empty($rma)) {
                session()->flash('error', 'Something Went Wrong');

                return back();

            }

            $order = $this->orderRepository->find($rma->order_id);

            $order->update(['status' => 'closed']);

            $this->rmaRepository->find($data['rma_id'])->update(['status' => 1]);
        }

        session()->flash('success', trans('rma::app.response.update-success', ['name' => 'Status']));

        return back();
    }

    /**
     * Send message by email
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMessage()
    {
        $data = request()->all();

        $conversationDetails = [
            'adminName'     => 'Admin',
            'message'       => $data['message'],
            'adminEmail'    => core()->getConfigData('emails.configure.email_settings.admin_email') ?: config('mail.admin.address'),
            'customerEmail' => auth()->guard('customer')->check() ? auth()->guard('customer')->user()->email : $this->orderRepository->find(session()->get('guestOrderId'))->customer_email,
        ];

        if (! empty($this->rmaMessagesRepository->create($data))) {
            try {
                if ($conversationDetails['adminEmail']) {
                    Mail::queue(new CustomerConversationEmail($conversationDetails));

                    session()->flash('success', trans('shop::app.customer.signup-form.success-verify'));
                }
            } catch (\Exception $e) {

                session()->flash('info', trans('rma::app.response.send-message', ['name' => 'Message']));
            }

                session()->flash('success', trans('rma::app.response.send-message', ['name' => 'Message']));

            return redirect()->back();

        } else {
            session()->flash('error', trans('shop::app.customer.signup-form.failed'));

            return redirect()->back();
        }

        session()->flash('success', trans('rma::app.response.send-message', ['name' => 'Message']));

        return redirect()->back();
    }

    /**
     * Reopen RMA
     *
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function reopenRMA($id)
    {
        $rma = $this->rmaRepository->find($id);

        if (! empty($rma)) {
            $rma->rma_status = null;
            $rma->status = 0;
            $rma->save();
        }

        return redirect()->route('rma.customers.allrma');
    }

    /**
     * Search Order
     *
     * @return orders
     */
    public function searchOrder($orderId)
    {
        return $this->getOrdersForRMA(1, 5, $orderId == 'all' ? '' : $orderId);
    }

    /**
     * Get all order for rma
     *
     * @return void
     */
    private function getOrdersForRMA(...$params)
    {
        [$page, $perPage, $search] = $params;

        $guestOrderId = session()->get('guestOrderId');

        $guestEmail = session()->get('guestEmail');

        if (
            ! empty($guestEmail)
            && ! empty($guestOrderId)
            && ! auth()->guard('customer')->check()
        ) {
            $allOrderItems = $this->orderRepository->orderBy('id', 'desc')->with('items')->findWhere([
                'customer_email' => $guestEmail,
                ['status', '<>', 'canceled'],
                ['status', '<>', 'closed'],
            ]);

            $orderData = $this->orderRepository->findOneWhere(
                ['id' => $guestOrderId,
                ['status', '<>', 'canceled']]
            );

            if (! $orderData) {
                return redirect()->route('shop.customer.session.index');
            }

            $customerEmail = $orderData->customer_email;

            $customerName = $orderData->customer_first_name . ' ' . $orderData->customer_last_name;
        } else {
            $customer = auth()->guard('customer')->user();

            $customerEmail = $customer->email;

            $customerName = $customer->first_name . ' ' . $customer->last_name;

            $allOrderItems = $this->orderRepository
                ->orderBy('id', 'desc')
                ->with('items')
                ->findWhere([
                    'customer_id' => $customer->id,
                    ['status', '<>', 'canceled'],
                    ['status', '<>', 'closed'],
                ]);
        }

        

        if (! empty($search)) {
            $allOrderItems = $allOrderItems->where('increment_id', $search);
        }

        $defaultAllowedDays = core()->getConfigData('sales.rma.setting.default_allow_days');

        $enableRMAForCanceledOrder = core()->getConfigData('sales.rma.setting.enable_rma_for_cancel_order');
        
        $orders = collect();
        
        foreach ($allOrderItems as $orderItem) {
            $orderItem->formatted_price = core()->formatPrice($orderItem->grand_total);
        
           
            if (! $defaultAllowedDays 
                || ($orderItem->created_at->addDays($defaultAllowedDays)->isAfter(now()))) {
                $orders->push($orderItem);
            }
        }

        $rmaCollection = $this->rmaRepository->findWhereIn('order_id', $orders->pluck('id')->toArray())->groupBy('order_id');

        foreach ($rmaCollection->toArray() as $rma) {
            $rmaIds = [];

            foreach ($rma as $rmaPart) {
                $rmaIds[] = $rmaPart['id'];
            }

            $totalRMAQty = 0;
            $rmaItems = $this->rmaItemsRepository
                ->findWhereIn('rma_id', $rmaIds);

            foreach ($rmaItems as $rmaItem) {
                $totalRMAQty += $rmaItem->quantity;
            }

            foreach ($orders as $key => $order) {
                if ($rma[0]['order_id'] == $order->id) {
                    if ($totalRMAQty == $order->total_qty_ordered) {
                        unset($orders[$key]);
                    }
                }

                if ($enableRMAForCanceledOrder) {
                    if ($order->status == 'canceled') {
                        unset($orders[$key]);
                    }
                }
            }
        }

        return [
            'customerName'  => $customerName,
            'customerEmail' => $customerEmail,
            'count'         => $orders->count(),
            'orders'        => $orders->forPage($page, $perPage),
        ];
    }
}
