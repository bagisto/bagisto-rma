<?php

namespace Webkul\RMA\Repositories;

use Carbon\Carbon;
use Illuminate\Container\Container as App;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Webkul\Core\Eloquent\Repository;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Sales\Repositories\OrderItemRepository;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Sales\Contracts\OrderItem;
use Illuminate\Database\Eloquent\Collection;
use Webkul\RMA\Contracts\RMAItems;
use Webkul\RMA\Mail\CustomerRmaCreationEmail;

class CreateRmaRepository extends Repository
{
    /**
     * @var string
     */
    public const DOWNLOADABLE = 'downloadable';

    /**
     * @var string
     */
    public const VIRTUAL = 'virtual';

    /**
     * @var string
     */
    public const PENDING = 'Pending';

    /**
     * @var string
     */
    public const BOOKING = 'booking';

    /**
     * @var string
     */
    public const CANCELITEMS = 'Cancel Items';
    
    /**
     * @var string
     */
    public const CONFIGURABLE = 'configurable';
    
    /**
     * @var string
     */
    public const ZERO = 0;

    /**
     * RMA status Solved.
     *
     * @var string
     */
    public const SOLVED = 'solved';

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
    public const CANCELED = 'canceled';

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
     * Create a new repository instance.
     *
     * @return void
     */
    public function __construct(
        protected CustomerRepository $customerRepository,
        protected OrderItemRepository $orderItemRepository,
        protected OrderRepository $orderRepository,
        protected ProductRepository $productRepository,
        protected RMAAdditionalFieldRepository $rmaAdditionalFieldRepository,
        protected RMAImagesRepository $rmaImagesRepository,
        protected RMAItemsRepository $rmaItemsRepository,
        protected RMAMessagesRepository $rmaMessagesRepository,
        protected RMAReasonsRepository $rmaReasonRepository,
        protected RMARepository $rmaRepository,
        App $app
    ) {
        parent::__construct($app);
    }

    /**
     * Specify model class name
     */
    public function model(): string
    {
        return RMAItems::class;
    }

    /**
     * Get the order items for the rma.
     */
    public function getOrderItems(array $rmaData): array
    {
        $order = $this->orderItemRepository
            ->where('order_id', $rmaData['orderId'])
            ->where('type', '!=', 'configurable')
            ->paginate(10);

        foreach ($order as $orderKey => $orderItem) {
            if (in_array($orderItem->type, ['booking', 'downloadable', 'virtual'])) {
                session()->flash('error', trans('rma::app.response.enable-digital-products'));

                return back();
            }

            if (
                (
                    $orderItem->type == self::DOWNLOADABLE
                    || $orderItem->type == self::VIRTUAL
                )
                && count($orderItem->invoice_items)
                && $orderItem->order->status != self::VIRTUAL
            ) {
                unset($order[$orderKey]);
            } elseif (
                $orderItem->type == self::BOOKING
                && $orderItem->order->status != self::PENDING
            ) {
                unset($order[$orderKey]);
            }

            $rmaItems = $this->rmaItemsRepository->findWhere(['order_item_id' => $orderItem->id]);

            $quantity = 0;

            foreach ($rmaItems as $key => $rmaItem) {
                $quantity += $rmaItem->quantity;
            }

            $rmaQuantity = $quantity ? ($orderItem->qty_ordered - $quantity) : $orderItem->qty_ordered;

            $orderQty[$orderKey] = $rmaQuantity;
        }

        foreach ($orderQty as $key => $qty) {
            if ($qty == self::ZERO) {
                unset($order[$key]);
            }
        }

        $reason = $this->rmaReasonRepository->findWhere(['status' => '1']);

        return [
            'show'     => true,
            'order'    => $order,
            'rmaData'  => $rmaData,
            'reason'   => $reason,
            'orderQty' => $orderQty,
        ];
    }

    /**
     * Get the order items for the RMA.
     */
    public function validateRmaData(array $rmaData): array|RedirectResponse
    {
        $orderQty = [];

        $order = $this->orderItemRepository->findWhere(['order_id' => $rmaData['orderId']]);

        foreach ($order as $orderKey => $orderItem) {
            if ( in_array($orderItem->type, ['booking', 'downloadable', 'virtual'])) {
                session()->flash('error', trans('rma::app.admin.sales.rma.create-rma.rma-already-exist'));

                return back();
            }

            if (
                (
                    $orderItem->type == self::DOWNLOADABLE
                    || $orderItem->type == self::VIRTUAL
                )
                && count($orderItem->invoice_items)
                && $orderItem->order->status != self::PENDING
            ) {
                unset($order[$orderKey]);

            } elseif (
                $orderItem->type == self::BOOKING
                && $orderItem->order->status != self::PENDING
            ) {
                unset($order[$orderKey]);
            }

            $rmaItems = $this->rmaItemsRepository->findWhere(['order_item_id' => $orderItem->id]);

            $quantity = $orderItem->qty_ordered - collect($rmaItems)->sum('quantity');

            if ($quantity == 0) {
                unset($order[$orderKey]);
            } else {
                $orderQty[$orderKey] = $quantity;
            }
        }

        if (empty($orderQty)) {
            $orderEmail = $this->orderRepository->find($rmaData['orderId'])->customer_email;

            if ($orderEmail != $rmaData['email']) {
                session()->flash('error', trans('rma::app.admin.sales.rma.create-rma.mismatch'));

                return back();
            } else {
                session()->flash('error', trans('rma::app.admin.sales.rma.create-rma.rma-already-exist'));

                return back();
            }
        }

        $isGuest = $this->customerRepository->findOneByField(['email' => $rmaData['email']]) ? 0 : 1;

        if ($this->orderRepository->find($rmaData['orderId'])->customer_email != $rmaData['email']) {
            session()->flash('error', trans('rma::app.admin.sales.rma.create-rma.mismatch'));

            return back();
        }

        if (count($order)) {
            $rmaData = [
                'isGuest' => $isGuest,
                'orderId' => $rmaData['orderId'],
                'email'   => $rmaData['email'],
            ];

            return $this->getOrderItems($rmaData);
        } else {
            session()->flash('error', trans('rma::app.admin.create_rma.select-other-order-id'));
        }
    }

    /**
     * Store rma data.
     */
    public function storeData(array $data, string $info): JsonResponse
    {
        $items = [];
       
        $data['order_items'] = [];

        foreach ($data['order_item_id'] as $key => $orderItemId) {
            $orderItem = $this->orderItemRepository->find($orderItemId);
            
            if (! empty($orderItem)) { 
                array_push($data['order_items'], $orderItem);
                
                array_push($items, [
                    'order_id'      => $orderItem->order_id,
                    'order_item_id' => $orderItem->id,
                    'rma_reason_id' => $data['rma_reason_id'][$key],
                    'quantity'      => $data['rma_qty'][$key],
                    'resolution'    => $data['resolution_type'][$key],
                ]);
            }
        }

        $orderRMAData = [
            'status'            => '',
            'order_id'          => $data['order_id'],
            'information'       => ! empty($info) ? $info : '',
            'order_status'      => $data['order_status'],
            'rma_status'        => self::PENDING,
            'package_condition' => $data['package_condition'] ?? '',
        ];
        
        $rma = $this->rmaRepository->create($orderRMAData);

        $lastInsertId = DB::getPdo()->lastInsertId();
        
        $requestData = [
            'message'    => trans('rma::app.mail.customer-conversation.process'),
            'rma_id'     => $rma->id,
            'is_admin'   => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $this->rmaMessagesRepository->create($requestData);

        $imageCheck = '';
        
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
        ]);

        foreach ($customRMADetails as $key => $customRMADetail) {
            $customRMADetailData = [];

            if (is_array($customRMADetail)) {
                $customRMADetail = implode(',', $customRMADetail);
            }
            
            $customRMADetailData = [
                'rma_id'      => $data['rma_id'],
                'field_name'  => $key,
                'field_value' => $customRMADetail,
            ];

            $rma = $this->rmaAdditionalFieldRepository->create($customRMADetailData);
        }

        foreach ($items as $key => $itemId) {
            $orderItemRMA = [
                'resolution'    => $itemId['resolution'],
                'rma_id'        => $lastInsertId,
                'order_item_id' => $itemId['order_item_id'],
                'quantity'      => $itemId['quantity'],
                'rma_reason_id' => $itemId['rma_reason_id'],
                'variant_id'    => ! empty($data['variant'][$key]) ? $data['variant'][$key] : null,
            ];

            $rmaOrderItem = $this->rmaItemsRepository->create($orderItemRMA);

            $data['reason'][] = $this->rmaReasonRepository->findOneWhere(['id' => $orderItemRMA['rma_reason_id']])->title;
        }

        $rmaItems = $this->rmaItemsRepository->findWhere(['rma_id' => $lastInsertId]);

        $order = $this->orderRepository->findOrFail($this->rmaRepository->find($lastInsertId)->order_id);

        $rmaItemIds = [];

        foreach ($rmaItems as $rmaItem) {
            $rmaItemIds[] = $rmaItem->order_item_id;
        }

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

            Cookie::has('rmaData') ? setcookie('rmaData', null, -1, '/') : '';

            return response()->json([
                'messages' => trans('rma::app.admin.sales.rma.create-rma.create-success'),
            ]);
        }

        return response()->json([
            'messages' => trans('shop::app.customer.signup-form.failed'),
        ]);
    }

    /**
     * Get order details
     */
    public function getOrderProduct(RMAItems|int $orderId): OrderItem|Collection
    {
        $allowedProductTypes = explode(',', core()->getConfigData('sales.rma.setting.select-allowed-product-type'));

        $orderItems = $this->orderItemRepository->where('order_id', $orderId)
            ->addSelect(
                'product_flat.product_id',
                'product_flat.name',
                'product_flat.url_key',
                'product_flat.visible_individually',
                'product_flat.sku',
                'product_flat.type',
                'order_items.price',
                'order_items.order_id',
                'order_items.id as order_item_id',
                'order_items.qty_ordered as qty_ordered',
                'order_items.created_at',
                'order_items.additional',
                'product_images.path as base_image',
                'orders.status as order_status',
                'orders.id as order_id',
                'products.type as product_type',
                'products.rma_rules',
                'rma_rules.id as rule_id',
                'rma_rules.exchange_period as rma_exchange_period',
                'rma_rules.return_period as rma_return_period',
                'parent_products.id as parentId',
            )
            ->leftJoin('product_flat', 'order_items.product_id', '=', 'product_flat.product_id')
            ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
            ->leftJoin('rma_rules', 'products.rma_rules', '=', 'rma_rules.id')
            ->leftJoin('products as parent_products', 'products.parent_id', '=', 'parent_products.id') 
            ->leftJoin('product_images', 'product_flat.product_id', '=', 'product_images.product_id')
            ->leftJoin('orders', 'order_items.order_id', '=', 'orders.id')
            ->whereNull('order_items.parent_id')
            ->where(function ($query) use ($allowedProductTypes) {
                $query->where(function ($subQuery) use ($allowedProductTypes) {
                    $subQuery->whereNull('products.parent_id')
                             ->whereIn('products.type', $allowedProductTypes);
                })->orWhere(function ($subQuery) use ($allowedProductTypes) {
                    $subQuery->whereNotNull('products.parent_id')
                        ->whereIn('parent_products.type', $allowedProductTypes);
                });
            })
            ->where('product_flat.locale', app()->getLocale())
            ->groupBy('order_items.id')
            ->get();

        foreach ($orderItems as $orderItem) {
            $rma = $this->rmaRepository->where('order_id', $orderId)->first();

            $attributes = '';
            
            if (! empty($orderItem->additional['attributes'])) {
                $attributes = $orderItem->additional['attributes'];
            }

            $product = $this->productRepository->find($orderItem->product_id);

            $rmaQuantity = $this->rmaItemsRepository->where('order_item_id', $orderItem->order_item_id)->pluck('quantity')->sum();

            if (core()->getConfigData('sales.rma.setting.allowed-rma-for-product') == self::SPECIFIC) {
                if ($product->allow_rma != self::YES) {
                    continue;
                }
            }

            $orderItem->rma_quantity = $rmaQuantity;

            $orderItem->attributes = $attributes;
            
            $orderItem->currentQuantity = $orderItem->qty_ordered - $rmaQuantity;
        }

        return $orderItems;
    }
}