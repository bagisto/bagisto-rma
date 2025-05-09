<?php

namespace Webkul\RMA\Http\Controllers\Customer;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Product\Facades\ProductImage;
use Webkul\Product\Repositories\{ProductImageRepository, ProductRepository};
use Webkul\Sales\Repositories\{InvoiceItemRepository, OrderItemRepository, OrderRepository, ShipmentItemRepository};
use Webkul\RMA\DataGrids\Shop\CustomerRmaDataGrid;
use Webkul\RMA\DataGrids\Shop\Guest\OrderRMADataGrid as GuestOrderRMADataGrid;
use Webkul\RMA\DataGrids\Shop\OrderRMADataGrid;
use Webkul\RMA\Helpers\Helper as RMAHelper;
use Webkul\RMA\Repositories\CreateRmaRepository;
use Webkul\RMA\Mail\{CustomerConversationEmail, CustomerRmaCreationEmail};
use Webkul\RMA\Contracts\RMAItems;
use Webkul\RMA\Contracts\RMAReasons;
use Webkul\RMA\Repositories\{ReasonResolutionsRepository, RMAAdditionalFieldRepository, RmaCustomFieldRepository, RMAImagesRepository, RMAItemsRepository, RMAMessagesRepository, RMAReasonsRepository, RMARepository};

class CustomerController extends Controller
{
    /**
     * Product Type
     *
     * @var Array
     */
    public const PRODUCT_TYPE = ['virtual', 'downloadable', 'booking', 'configurable'];

    /**
     * RMA Resolutions.
     *
     * @var Array
     */
    public const RESOLUTIONS = [
        'return'      => 'Return',
        'exchange'    => 'Exchange',
        'cancel_item' => 'Cancel Items',
    ];

    /**
     * RMA order status.
     *
     * @var Array
     */
    public const RMA_ORDER_STATUS = [
        'not_delivered' => 'Not Delivered',
        'delivered'     => 'Delivered',
    ];

    /**
     * RMA status Solved.
     *
     * @var string
     */
    public const SOLVED = 'Solved';

    /**
     * RMA Status
     *
     * @var string
     */
    public const PENDING = 'Pending';

    /**
     *
     * @var string
     */
    public const SPECIFIC = 'specific';

    /**
     * @var string
     */
    public const COMPLETED = 'completed';

    /**
     * @var string
     */
    public const CANCELED = 'Canceled';

    /**
     * @var string
     */
    public const ITEMCANCELED = 'Item Canceled';

    /**
     * @var string
     */
    public const DECLINED = 'Declined';

    /**
     * @var string
     */
    public const YES = 'yes';

    /**
     * @var int
     */
    public const INACTIVE = 0;

    /**
     * @var int
     */
    public const ACTIVE = 1;

    /**
     * @var string
     */
    public const CONFIGURABLE = 'configurable';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected CreateRmaRepository $createRmaRepository,
        protected InvoiceItemRepository $invoiceItemRepository,
        protected OrderItemRepository $orderItemRepository,
        protected OrderRepository $orderRepository,
        protected ProductImageRepository $productImageRepository,
        protected ProductRepository $productRepository,
        protected ReasonResolutionsRepository $reasonResolutionsRepository,
        protected RMAAdditionalFieldRepository $rmaAdditionalFieldRepository,
        protected RmaCustomFieldRepository $rmaCustomFieldRepository,
        protected RMAHelper $rmaHelper,
        protected RMAImagesRepository $rmaImagesRepository,
        protected RMAItemsRepository $rmaItemsRepository,
        protected RMAMessagesRepository $rmaMessagesRepository,
        protected RMAReasonsRepository $rmaReasonRepository,
        protected RMARepository $rmaRepository,
        protected ShipmentItemRepository $shipmentItemRepository,
    ) {}

    /**
     * Method to populate the customer and guest rma index page.
     */
    public function index(): View|JsonResponse
    {
        if (request()->ajax()) {
            return datagrid(CustomerRmaDataGrid::class)->process();
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
     */
    public function guestLogin(): View|RedirectResponse
    {
        if (! empty(session()->get('guestOrderId'))) {
            return view('rma::shop.guest.index');
        }

        if (! auth()->guard('customer')->check()) {
            return view('rma::shop.guest.login');
        }

        return redirect()->route('rma.customers.all-rma');
    }

    /**
     * Logout for the guest user
     */
    public function guestLogout(): RedirectResponse
    {
        session()->forget(['guestOrderId', 'guestEmail']);

        return redirect()->route('rma.guest.login');
    }

    /**
     * Get the requested data for the guest
     */
    public function guestLoginCreate(): RedirectResponse
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

            return redirect()->route('shop.guest.all-rma')->with('guestUserData');
        }

        return redirect()->back()->with('error', 'Invalid details for guest');
    }

    /**
     * Create rma for guest
     */
    public function guestRmaCreate(): RedirectResponse|View|JsonResponse
    {
        if (auth()->guard('customer')->user()) {
            session()->flash('error', trans('rma::app.response.permission-denied'));

            return back();
        }

        $orderData = $this->orderRepository->findOneWhere([
            'id' => session()->get('guestOrderId'),
            ['status', '<>', 'canceled'],
        ]);

        if (request()->ajax()) {
            return datagrid(GuestOrderRMADataGrid::class)->process();
        }

        return view('rma::shop.guest.create');
    }

    /**
     * Create rma for customer
     */
    public function create(): JsonResponse|View
    {
        if (request()->ajax()) {
            return datagrid(OrderRMADataGrid::class)->process();
        }

        return view('rma::shop.customer.rma.create');
    }

    /**
     * Get Order details
     */
    public function getOrderProduct(int $orderId): RMAItems|Collection
    {
        return $this->createRmaRepository->getOrderProduct($orderId);
    }

    /**
     * Get reason for resolution.
     */
    public function getResolutionReason(mixed $resolutionType): RMAReasons|Collection
    {
        $existResolutions = $this->reasonResolutionsRepository->where('resolution_type', $resolutionType)->pluck('rma_reason_id');
        
        return $this->rmaReasonRepository->whereIn('id', $existResolutions)->where('status', self::ACTIVE)->get();
    }

    /**
     * Return data to create rma
     */
    public function getOrderItems(object $allOrderItems): array
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
                    && $orderItem->status != self::COMPLETED
                ) {
                    unset($orderItems[$key]);
                } elseif (
                    ! in_array($itemValue->type, self::PRODUCT_TYPE)
                    && $orderItem->status != 'pending'
                ) {
                    unset($orderItems[$key]);
                }
            }
        }

        $rmaCollection = $this->rmaRepository->findWhereIn('order_id', $orderItems->pluck('id')?->toArray() ?? [])->groupBy('order_id')?->toArray();

        foreach ($rmaCollection as $rma) {
            $rmaIds = [];

            foreach ($rma as $rmaPart) {
                $rmaIds[] = $rmaPart['id'];
            }

            $totalRMAQty = $this->rmaItemsRepository->findWhereIn('rma_id', $rmaIds)?->sum('quantity') ?? 0;

            foreach ($orderItems as $key => $order) {
                if (
                    (
                        $rma[0]['order_id'] == $order->id
                        && $totalRMAQty == $order->total_qty_ordered
                    )
                    || (
                        core()->getConfigData('sales.rma.setting.enable_rma_for_cancel_order')
                        && $order->status == self::CANCELED
                    )
                ) {
                    unset($orderItems[$key]);
                }
            }
        }

        return [
            'orderItems' => $orderItems,
            'reasons'    => $this->rmaReasonRepository->findWhere(['status' => '1']),
        ];
    }

    /**
     * Get order for selected order id
     */
    public function getOrders(int $orderId, string $resolutions): array
    {
        $orderItems = $this->orderItemRepository
            ->where('order_id', $this->orderRepository->findOrFail($orderId)->id)
            ->where('type', '!=', self::CONFIGURABLE)
            ->latest()->paginate(5);

        if (is_null($resolutions)) {
            //check the product's shipment and invoice is generated or not
            foreach ($orderItems as $orderItem) {
                $itemsId[] = $orderItem->id;

                $productImage = $productId = [];

                $product = $this->productRepository->find($orderItem->product_id);

                $productImage[$product->id] = ProductImage::getProductBaseImage($product);

                $productId[] = $orderItem->product_id;
            }

            $shippedOrderItemId = $this->shipmentItemRepository->findWhereIn('order_item_id', $itemsId)->pluck('order_item_id')?->toArray() ?? [];

            $invoiceCreatedItemId = $this->invoiceItemRepository->findWhereIn('order_item_id', $itemsId)->pluck('order_item_id')?->toArray() ?? [];

            if (! empty($invoiceCreatedItemId)) {
                $resolutions = [self::RESOLUTIONS['cancel_item']];
            }

            if (! empty($shippedOrderItemId)) {
                $resolutions = array_values(self::RESOLUTIONS);
            }
        }

        return [
            'search_results'     => $orderItems,
            'resolutions'        => $resolutions ?? [],
            'productImage'       => $productImage ?? [],
            'productImageCounts' => $this->productImageRepository->findWhereIn('product_id', $productId)->count(),
        ];
    }

    /**
     * Fetch the product from the specific order id
     */
    public function getProducts(int $orderId, string $resolution): JsonResponse
    {
        if (is_array($resolution)) {
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

            $orderStatus = self::RMA_ORDER_STATUS['not_delivered'];

            if (! empty($shippedOrderItemId)) {
                $resolutions = [self::RESOLUTIONS['cancel_item'], self::RESOLUTIONS['exchange']];

                if (count($shippedOrderItemId) == count($itemId)) {
                    $orderStatus = array_values(self::RMA_ORDER_STATUS);
                }
            }

            if (
                ! empty($invoiceCreatedItemId)
                || (
                    ! empty($invoiceCreatedItemId)
                    && ! empty($shippedOrderItemId)
                )
            ) {
                $resolutions = [self::RESOLUTIONS['cancel_item']];
            }

            if (
                ! empty($order)
                && $order->status == self::COMPLETED
            ) {
                $orderStatus = [self::RMA_ORDER_STATUS['delivered']];
            }

            $order = $this->orderRepository->findOrFail($orderId);

            $orderItems = $this->orderItemRepository->where('order_id', $order->id)->latest()->paginate(5);


            return new JsonResponse([
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
     */
    private function fetchOrderDetails(int $orderId, string $resolution): JsonResponse
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

        if ($resolution != self::RESOLUTIONS['cancel_item']) {
            //Remove order items
            foreach ($orderItems as $index => $orderItem) {
                $isOrderItemValid = in_array($orderItem->type, array_values(self::PRODUCT_TYPE));

                if ($isOrderItemValid) {
                    unset($orderItems[$index]);
                }
            }
        }

        $qty = [];

        $rmaItems = $this->rmaItemsRepository->findWhereIn('order_item_id', $orderItemsId);

        if ($rmaItems->count()) {
            foreach ($rmaItems as $rmaItem) {
                $rmaOrderItemQty[$rmaItem->order_item_id][$rmaItem->id] = $rmaItem->quantity;
            }

            foreach ($rmaOrderItemQty as $key => $itemQty) {
                $qtyAddedRma[$key] = array_sum($itemQty);

                $rmaItemsId[] = $key;
            }

            foreach ($orderItems as $key => $orderItem) {
                if (in_array($orderItem->id, $rmaItemsId)) {
                    $qty[$orderItem->id] = $orderItem->qty_ordered - $qtyAddedRma[$orderItem->id];
                } else {
                    $qty[$orderItem->id] = $orderItem->qty_ordered;
                }

                if ($qty[$orderItem->id] > 0) {

                    $filteredData[] = $orderItem;
                }
            }
        } else {
            foreach ($orderItems as $orderItem) {
                $qty[$orderItem->id] = $orderItem->qty_ordered;
            }
        }

        $productId = $products = [];

        foreach ($orderItems as $orderItem) {
            $productId[] = $orderItem->product_id;

            $products[] = $this->productRepository->find($orderItem->product_id);
        }

        foreach ($products as $product) {
            if (
                $product
                && $product->type == self::CONFIGURABLE
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
            if ($orderItem->type == self::CONFIGURABLE) {
                $additional = '';

                $html[$orderItem->id] = str_replace(',', '<br>', $additional);

                $attributeValue = $this->rmaHelper->getOptionDetailHtml($orderItem->additional['attributes'] ?? []);

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

        $shippedOrderItemId = $shippedProductId = [];

        foreach ($shippedOrderItems as $shippedOrderItem) {
            $shippedOrderItemId[] = $shippedOrderItem->order_item_id;

            $shippedProductId[] = $shippedOrderItem->product_id;
        }

        $resolutionResponse = [self::RESOLUTIONS['cancel_item']];

        $orderStatus = [self::RMA_ORDER_STATUS['delivered']];

        if (! empty($shippedOrderItemId)) {
            $resolutionResponse = [self::RESOLUTIONS['cancel_item'], self::RESOLUTIONS['exchange']];

            $orderStatus = array_values(self::RMA_ORDER_STATUS);
        }

        if (count(array_unique($invoiceCreatedItemId)) == count($orderItemsId)) {
            $resolutionResponse = [self::RESOLUTIONS['cancel_item']];

            $orderStatus = [self::RMA_ORDER_STATUS['delivered']];
        }

        if (count(array_unique($shippedOrderItemId)) == count($orderItemsId)) {
            $resolutionResponse = array_values(self::RESOLUTIONS);

            $orderStatus = array_values(self::RMA_ORDER_STATUS);
        }

        $orderData = [];

        if (
            ! empty($invoiceCreatedItemId)
            || ! empty($shippedOrderItemId)
        ) {
            if (
                (! empty($resolution))
                || (
                    'Return'
                    && $resolution != self::RESOLUTIONS['cancel_item']
                )
            ) {
                foreach ($orderItems as $orderItem) {
                    $isExisting = false;
                    if (
                        ! $isExisting
                        && in_array($orderItem->id, $invoiceCreatedItemId)
                    ) {
                        if ($orderItem->type == self::CONFIGURABLE) {
                            $orderData[] = $orderItem;
                        } elseif (! in_array($orderItem->id, $shippedOrderItemId)) {
                            $orderData[] = $orderItem;
                        }
                    }
                }
            }
        }

        if (
            ! empty($resolution)
            && (
                $resolution == self::RESOLUTIONS['cancel_item']
                || $resolution == self::RESOLUTIONS['exchange']
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

                    if ($item->product->type == self::CONFIGURABLE) {
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
            && $order->status == self::COMPLETED
        ) {
            $orderStatus = array_values(self::RMA_ORDER_STATUS);
        }

        return new JsonResponse([
            'quantity'            => $qty,
            'html'                => $html,
            'child'               => $child ?? [],
            'variants'            => $variants ?? [],
            'orderItems'          => $orderData,
            'orderStatus'         => $orderStatus,
            'productImage'        => $productImage ?? [],
            'resolutions'         => $resolutionResponse,
            'productImageCounts'  => $this->productImageRepository->findWhereIn('product_id', $productId)->count(),
            'shippedProductId'    => $shippedProductId,
            'shippingOrderStatus' => count($shippedOrderItemId) > 0 ? 1 : 0,
        ]);
    }

    /**
     * Add custom reason
     */
    public function addReason(int $id): JsonResponse
    {
        $reasons = $this->rmaReasonRepository->create([
            'status' => '1', 
            'title' => request()['inputData'],
        ]);

        return new JsonResponse(['reasons' => $reasons]);
    }

    /**
     * Get details of rma
     */
    public function view(int $id): View|RedirectResponse
    {
        $customer = auth()->guard('customer')->user();
        
        $isGuest = empty($customer) ? 1 : 0;

        // Fetch RMA data
        $rmaData = $this->rmaRepository->with(['orderItem', 'order'])->findOneWhere(['id' => $id]);
        
        if (! $rmaData) {
            return redirect()->route('shop.customer.session.index');
        }

        // Fetch order and validate
        $order = $this->orderRepository->where([
            'id'       => $rmaData['order_id'],
            'is_guest' => $isGuest,
            $customer ? 'customer_id' : 'customer_email' => $customer?->id ?? session()->get('guestEmail')
        ])->first();

        if (empty($order)) {
            return redirect()->route(empty($customer) ? 'shop.customer.session.index' : 'rma.customers.all-rma');
        }

        // Fetch additional data
        $rmaImages = $this->rmaImagesRepository->findWhere(['rma_id' => $id]);
        
        $rmaAdditionalValues = $this->rmaAdditionalFieldRepository->findWhere(['rma_id' => $id]);
        
        $rmaAdditionalFieldValues = [];

        foreach ($rmaAdditionalValues as $value) {
            $rmaCustomField = $this->rmaCustomFieldRepository->findOneWhere(['code' => $value->field_name]);
        
            if ($rmaCustomField) $rmaAdditionalFieldValues[$value->field_value] = $rmaCustomField['label'];
        }

        $reasons = $this->rmaItemsRepository->with('getReasons')->findWhere(['rma_id' => $id]);
        
        $productDetails = $this->rmaItemsRepository->findWhere(['rma_id' => $id]);
        
        $rmaItems = $this->rmaItemsRepository->findWhere(['rma_id' => $rmaData['id']]);

        // Collect SKUs
        $skus = [];
        
        foreach ($order->items as $item) {
            if ($item['type'] == self::CONFIGURABLE) {
                $skus[] = $item['child'];
            }
        
            $skus[] = $item['sku'];
        }

        // Customer details
        $customerFirstName = $order->customer_first_name;
        
        $customerLastName = $order->customer_last_name;

        return view(empty($customer) ? 'rma::shop.guest.view' : 'rma::shop.customer.rma.view', compact(
            'skus',
            'rmaData',
            'reasons',
            'isGuest',
            'customer',
            'rmaImages',
            'productDetails',
            'customerLastName',
            'customerFirstName',
            'rmaAdditionalFieldValues',
        ));
    }

    /**
     * Change rma status
     */
    public function cancelRMAStatus(int $id): JsonResponse
    {
        $rma = $this->rmaRepository->find($id);

        if ($rma->rma_status == self::CANCELED) {

            return new JsonResponse([
                'message' => trans('rma::app.response.already-cancel'),
            ]);
        }

        $rma->update([
            'rma_status' => self::CANCELED,
        ]);

        return new JsonResponse([
            'message' => trans('rma::app.response.cancel-success'),
        ]);
    }

    /**
     * Store a newly created rma.
     */
    public function store(): JsonResponse|RedirectResponse
    {
        if (! is_array(request()->input('order_item_id'))) {
            return new JsonResponse([
                'message' => trans('rma::app.response.please-select-the-item'),
            ], 400);
        }

        $this->validate(request(), [
            'rma_qty'         => 'required',
            'resolution_type' => 'required',
            'order_status'    => 'required',
        ]);

        $items = [];
        
        $data = request()->only([
            'order_id',
            'resolution_type',
            'order_status',
            'order_item_id',
            'rma_qty',
            'rma_reason_id',
            'images',
            'information',
        ]);

        if (request()->input('package_condition')) {
            $data['package_condition'] = request()->input('package_condition');
        }

        if (request()->input('return_pickup_address')) {
            $data['return_pickup_address'] = request()->input('return_pickup_address');
        }

        if (request()->input('return_pickup_time')) {
            $data['return_pickup_time'] = request()->input('return_pickup_time');
        }

        $info = $data['information'] ?? '';

        if (
            ! empty($data['information'])
            && str_word_count($data['information'], 0) > 100
        ) {
            $words = str_word_count($data['information'], 2);

            $pos = array_keys($words);

            $info = substr($data['information'], 0, $pos[100]) . '...';
        }

        $data['order_items'] = [];

        foreach ($data['order_item_id'] as $key => $orderItemId) {
            $orderItem = $this->orderItemRepository->find($orderItemId);

            array_push($data['order_items'], $orderItem);

            array_push($items, [
                'order_id'      => $orderItem->order_id,
                'order_item_id' => $orderItem->id,
                'rma_reason_id' => $data['rma_reason_id'][$key],
                'quantity'      => $data['rma_qty'][$key],
                'resolution'    => $data['resolution_type'][$key],
            ]);
        }

        $rma = $this->rmaRepository->create([
            'status'            => '',
            'order_id'          => $data['order_id'],
            'information'       => ! empty($info) ? $info : '',
            'order_status'      => $data['order_status'],
            'rma_status'        => self::PENDING,
            'package_condition' => $data['package_condition'] ?? '',
        ]);

        $lastInsertId = DB::getPdo()->lastInsertId();

        $this->rmaMessagesRepository->create([
            'message'    => trans('rma::app.mail.customer-conversation.process'),
            'rma_id'     => $rma->id,
            'is_admin'   => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        if (! empty($data['images'])) {
            $imageCheck = implode(',', $data['images']);
        }

        $data['rma_id'] = $lastInsertId;

        // Insert image
        if (! empty($imageCheck)) {
            foreach ($data['images'] as $itemImg) {
                $this->rmaImagesRepository->create([
                    'rma_id' => $lastInsertId,
                    'path'   => ! empty($itemImg) ?? $itemImg->getClientOriginalName(),
                ]);
            }

            // Save the image in the public path
            $this->rmaImagesRepository->uploadImages($data, $rma);
        }
                
        $customRMADetails = request()->except([
            'order_id',
            'resolution_type',
            'order_status',
            'order_item_id',
            'rma_qty',
            'rma_reason_id',
            'images',
            'information',
            'return_pickup_time',
            'return_pickup_address',
            'package_condition',
            'isChecked',
            '_token',
            'agreement',
        ]);

        foreach ($customRMADetails as $key => $customRMADetail) {
            $this->rmaAdditionalFieldRepository->create([
                'rma_id'      => $data['rma_id'],
                'field_name'  => $key,
                'field_value' => is_array($customRMADetail) ? implode(',', $customRMADetail) : $customRMADetail,
            ]);
        }

        foreach ($items as $key => $itemId) {
            $rmaOrderItem = $this->rmaItemsRepository->create([
                'resolution'    => $itemId['resolution'],
                'rma_id'        => $lastInsertId,
                'order_item_id' => $itemId['order_item_id'],
                'quantity'      => $itemId['quantity'],
                'rma_reason_id' => $itemId['rma_reason_id'],
                'variant_id'    => ! empty($data['variant'][$key]) ? $data['variant'][$key] : null,
            ]);

            $data['reason'][] = $this->rmaReasonRepository->findOneWhere(['id' => $itemId['rma_reason_id']])->title;
        }

        $rmaItemIds = $this->rmaItemsRepository->findWhere(['rma_id' => $lastInsertId])->pluck('order_item_id')?->toArray() ?? [];

        $order = $this->orderRepository->findOrFail($this->rmaRepository->find($lastInsertId)->order_id);

        $orderData = $order->items->whereIn('id', $rmaItemIds);

        foreach ($orderData as $key => $configurableProducts) {
            if ($configurableProducts['type'] == self::CONFIGURABLE) {
                $data['skus'][] = $configurableProducts['child'];
            }
        }

        $data['email'] = auth()->guard('customer')->user()->email;

        $data['name'] = auth()->guard('customer')->user()->name;

        unset($data['images']);

        if ($rmaOrderItem) {
            try {
                Mail::queue(new CustomerRmaCreationEmail($data));
            } catch (\Exception $e) {
                \Log::error('Error in Sending Email'.$e->getMessage());
            }

            return new JsonResponse([
                'messages' => trans('rma::app.response.create-success', ['name' => 'Request']),
            ]);
        } else {
            return new JsonResponse([
                'messages' => trans('shop::app.customer.signup-form.failed'),
            ]);
        }
    }

    /**
     * Store a newly created rma.
     */
    public function storeGuest(): JsonResponse|RedirectResponse
    {
        if (! is_array(request()->input('order_item_id'))) {
            return new JsonResponse([
                'message' => trans('rma::app.response.please-select-the-item'),
            ], 400);
        }

        $this->validate(request(), [
            'rma_qty'         => 'required',
            'resolution_type' => 'required',
            'order_status'    => 'required',
        ]);

        $items = [];

        $data = request()->only([
            'order_id',
            'resolution_type',
            'order_status',
            'order_item_id',
            'rma_qty',
            'rma_reason_id',
            'images',
            'information',
        ]);

        if (request()->input('package_condition')) {
            $data['package_condition'] = request()->input('package_condition');
        }

        if (request()->input('return_pickup_address')) {
            $data['return_pickup_address'] = request()->input('return_pickup_address');
        }

        if (request()->input('return_pickup_time')) {
            $data['return_pickup_time'] = request()->input('return_pickup_time');
        }

        $info = $data['information'] ?? '';

        if (
            ! empty($data['information'])
            && str_word_count($data['information'], 0) > 100
        ) {
            $words = str_word_count($data['information'], 2);

            $pos = array_keys($words);

            $info = substr($data['information'], 0, $pos[100]) . '...';
        }

        $data['order_items'] = [];

        foreach ($data['order_item_id'] as $key => $orderItemId) {
            $orderItem = $this->orderItemRepository->find($orderItemId);

            array_push($data['order_items'], $orderItem);

            array_push($items, [
                'order_id'      => $orderItem->order_id,
                'order_item_id' => $orderItem->id,
                'rma_reason_id' => $data['rma_reason_id'][$key],
                'quantity'      => $data['rma_qty'][$key],
                'resolution'    => $data['resolution_type'][$key],
            ]);
        }

        $rma = $this->rmaRepository->create([
            'status'            => '',
            'order_id'          => $data['order_id'],
            'information'       => ! empty($info) ? $info : '',
            'order_status'      => $data['order_status'],
            'rma_status'        => self::PENDING,
            'package_condition' => $data['package_condition'] ?? '',
        ]);

        $lastInsertId = DB::getPdo()->lastInsertId();

        $requestData = [
            'message'    => trans('rma::app.mail.customer-conversation.process'),
            'rma_id'     => $rma->id,
            'is_admin'   => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $this->rmaMessagesRepository->create($requestData);

        if (! empty($data['images'])) {
            $imageCheck = implode(',', $data['images']);
        }
        
        $data['rma_id'] = $lastInsertId;

        // insert images
        if (! empty($imageCheck)) {
            foreach ($data['images'] as $itemImg) {
                $this->rmaImagesRepository->create([
                    'rma_id'     => $lastInsertId,
                    'path'       => $itemImg->getClientOriginalName(),
                ]);
            }

            $this->rmaImagesRepository->uploadImages($data, $rma);
        }


        $customRMADetails = request()->except([
            'order_id',
            'resolution_type',
            'order_status',
            'order_item_id',
            'rma_qty',
            'rma_reason_id',
            'images',
            'information',
            'return_pickup_time',
            'return_pickup_address',
            'package_condition',
            'isChecked',
            '_token',
            'agreement',
        ]);

        foreach ($customRMADetails as $key => $customRMADetail) {
            $this->rmaAdditionalFieldRepository->create([
                'rma_id'      => $data['rma_id'],
                'field_name'  => $key,
                'field_value' => is_array($customRMADetail) ? implode(',', $customRMADetail) : $customRMADetail,
            ]);
        }

        foreach ($items as $key => $itemId) {
            $rmaOrderItem = $this->rmaItemsRepository->create([
                'resolution'    => $itemId['resolution'],
                'rma_id'        => $lastInsertId,
                'order_item_id' => $itemId['order_item_id'],
                'quantity'      => $itemId['quantity'],
                'rma_reason_id' => $itemId['rma_reason_id'],
                'variant_id'    => ! empty($data['variant'][$key]) ? $data['variant'][$key] : null,
            ]);

            $data['reason'][] = $this->rmaReasonRepository->findOneWhere(['id' => $itemId['rma_reason_id']])->title;
        }

        $rmaItemIds = $this->rmaItemsRepository->findWhere(['rma_id' => $lastInsertId])->pluck('order_item_id')?->toArray() ?? [];

        $order = $this->orderRepository->findOrFail($this->rmaRepository->find($lastInsertId)->order_id);

        $orderData = $order->items->whereIn('id', $rmaItemIds);

        foreach ($orderData as $key => $configurableProducts) {
            if ($configurableProducts['type'] == self::CONFIGURABLE) {
                $data['skus'][] = $configurableProducts['child'];
            }
        }

        $data['email'] = $order->customer_email;

        $data['name'] = $order->customer_first_name.' '.$order->customer_last_name;

        unset($data['images']);

        if ($rmaOrderItem) {
            try {
                Mail::queue(new CustomerRmaCreationEmail($data));

            } catch (\Exception $e) {
                \Log::error('Error in Sending Email'.$e->getMessage());
            }

            return new JsonResponse([
                'messages' => trans('rma::app.response.create-success', ['name' => 'Request']),
            ]);
        }

        return new JsonResponse([
            'messages' => trans('shop::app.customer.signup-form.failed'),
        ]);
    }

    /**
     * Save rma status by customer
     */
    public function saveStatus(): RedirectResponse
    {
        $data = request()->all();
        
        $rma = $this->rmaRepository->find($data['rma_id']);
        
        if (! empty($data['close_rma'])) {
            if (empty($rma)) {
                session()->flash('error', 'Something Went Wrong');

                return back();
            }

            // $order = $this->orderRepository->find($rma->order_id);

            // $order->update(['status' => 'closed']);

            $rma->update([
                'status'       => 1,
                'rma_status'   => self::SOLVED,
                'order_status' => 'closed',
            ]);

            $this->rmaMessagesRepository->create([
                'message'    => trans('rma::app.mail.customer-conversation.solved'),
                'rma_id'     => $data['rma_id'],
                'is_admin'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        session()->flash('success', trans('rma::app.response.update-success', ['name' => trans('rma::app.admin.sales.rma.all-rma.view.status')]));

        return back();
    }

    /**
     * Save rma status by customer
     */
    public function saveReOpenStatus(): RedirectResponse
    {
        $data = request()->all();

        $rma = $this->rmaRepository->find($data['rma_id']);
        
        if (! empty($data['close_rma'])) {
            if (empty($rma)) {
                session()->flash('error', 'Something Went Wrong');

                return back();
            }

            $order = $this->orderRepository->find($rma->order_id);

            $order->update(['status' => 'pending']);

            $rma->update([
                'status'       => self::ACTIVE,
                'rma_status'   => self::PENDING,
                'status'       => self::INACTIVE,
                'order_status' => self::INACTIVE,
            ]);
    
            $this->rmaMessagesRepository->create([
                'message'    => trans('rma::app.mail.customer-conversation.process'),
                'rma_id'     => $data['rma_id'],
                'is_admin'   => self::ACTIVE,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        session()->flash('success', trans('rma::app.response.update-success', ['name' => 'Status']));

        return back();
    }

    /**
     * Get all messages
     */
    public function getMessages(): JsonResponse
    {
        $messages = $this->rmaMessagesRepository
            ->where('rma_id', request()->get('id'))
            ->orderBy('id', 'desc')
            ->paginate(request()->get('limit') ?? 5);

        return new JsonResponse([
            'messages' => $messages,
        ]);
    }

    /**
     * Send message by email
     */
    public function sendMessage(): JsonResponse
    {
        $data = request()->all();

        $conversationDetails = [
            'adminName'     => 'Admin',
            'message'       => $data['message'],
            'adminEmail'    => core()->getConfigData('emails.configure.email_settings.admin_email') ?: config('mail.admin.address'),
            'customerEmail' => auth()->guard('customer')->check() ? auth()->guard('customer')->user()->email : $this->orderRepository->find(session()->get('guestOrderId'))->customer_email,
        ];

        $storedMessage = $this->rmaMessagesRepository->create($data);

        if (! empty($storedMessage)) {
            $removedKeys = explode(',', request()->input('removed_key'));

            array_shift($removedKeys);

            if (! empty(request()->file('file'))) {
                $file = request()->file('file');

                $filename = $file->getClientOriginalName();

                $path = $file->storeAs('rma-conversation/' . $storedMessage->id, $filename);

                $this->rmaMessagesRepository->update([
                    'attachment_path' => $path,
                    'attachment'      => $filename,
                ], $storedMessage->id);
            }

            try {
                if ($conversationDetails['adminEmail']) {
                    Mail::queue(new CustomerConversationEmail($conversationDetails));
                }
            } catch (\Exception $e) {
                return new JsonResponse([
                    'messages' => trans('rma::app.response.send-message', ['name' => trans('rma::app.mail.customer-conversation.message')]),
                ]);
            }

            return new JsonResponse([
                'messages' => trans('rma::app.response.send-message', ['name' => trans('rma::app.mail.customer-conversation.message')]),
            ]);
        }

        return new JsonResponse([
            'messages' => trans('shop::app.customer.signup-form.failed'),
        ]);
    }

    /**
     * Send message by email
     */
    public function guestSendMessage(): JsonResponse|RedirectResponse
    {
        $data = request()->all();

        $conversationDetails = [
            'adminName'     => 'Admin',
            'message'       => $data['message'],
            'adminEmail'    => core()->getConfigData('emails.configure.email_settings.admin_email') ?: config('mail.admin.address'),
            'customerEmail' => auth()->guard('customer')->check() ? auth()->guard('customer')->user()->email : $this->orderRepository->find(session()->get('guestOrderId'))->customer_email,
        ];

        if (! empty($this->rmaMessagesRepository->create($data))) {

            if ($conversationDetails['adminEmail']) {
                Mail::queue(new CustomerConversationEmail($conversationDetails));
            }

            session()->flash('success', trans('rma::app.response.send-message', ['name' => trans('rma::app.mail.customer-conversation.message')]));

            return redirect()->back();
        }

        return new JsonResponse([
            'message' => trans('shop::app.customer.signup-form.failed'),
        ]);
    }

    /**
     * Reopen rma
     */
    public function reopenRMA(int $id): RedirectResponse
    {
        $rma = $this->rmaRepository->find($id);

        if (! empty($rma)) {
            $rma->update([
                'rma_status' => null,
                'status'     => 0
            ]);
        }

        return redirect()->route('rma.customers.all-rma');
    }

    /**
     * Search order
     */
    public function searchOrder($orderId):  RedirectResponse|array
    {
        return $this->getOrdersForRMA(1, 5, $orderId == 'all' ? '' : $orderId);
    }

    /**
     * Get all order for rma
     */
    private function getOrdersForRMA(...$params): RedirectResponse|array
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
                [
                    'id' => $guestOrderId,
                    ['status', '<>', 'canceled']
                ]
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
            $orderItem->grand_total = core()->formatPrice($orderItem->grand_total);

            if (
                ! $defaultAllowedDays
                || ($orderItem->created_at->addDays($defaultAllowedDays)->isAfter(now()))
            ) {
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
                    if ($order->status == self::CANCELED) {
                        unset($orders[$key]);
                    }
                }
            }
        }

        $response = [
            'customerName'  => $customerName,
            'customerEmail' => $customerEmail,
            'count'         => $orders->count(),
            'orders'        => $orders->forPage($page, $perPage),
        ];

        if (! $orders->count()) {
            $response['message'] = trans('rma::app.shop.customer.create.no-record');
        }

        return $response;
    }
}