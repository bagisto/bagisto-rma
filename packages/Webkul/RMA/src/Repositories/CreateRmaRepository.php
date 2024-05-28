<?php

namespace Webkul\RMA\Repositories;

use Illuminate\Container\Container as App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Webkul\Core\Eloquent\Repository;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\RMA\Mail\CustomerRmaCreationEmail;
use Webkul\Sales\Repositories\OrderItemRepository;
use Webkul\Sales\Repositories\OrderRepository;

class CreateRmaRepository extends Repository
{
    /**
     * Specify model class name
     *
     * @return string
     */
    public function model()
    {
        return 'Webkul\RMA\Contracts\RMAItems';
    }

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
        protected RMAItemsRepository $rmaItemsRepository,
        protected RMAImagesRepository $rmaImagesRepository,
        protected RMAReasonsRepository $rmaReasonRepository,
        App $app
    ) {
        parent::__construct($app);
    }

    /**
     * Get the order items for the RMA.
     *
     * @param  array  $rmaData
     * @return array
     */
    public function getOrderItems($rmaData)
    {
        $order = $this->orderItemRepository->where('order_id', $rmaData['orderId'])
            ->where('type', '!=', 'configurable')
            ->paginate(10);

        foreach ($order as $orderKey => $orderItem) {
            if (! core()->getConfigData('sales.rma.setting.enable_rma_for_digital_products')
                && in_array($orderItem->type, ['booking', 'downloadable', 'virtual'])
            ) {
                session()->flash('error', trans('rma::app.response.enable-digital-products'));

                return redirect()->back();
            }

            if (
                (
                    $orderItem->type == 'downloadable'
                    || $orderItem->type == 'virtual'
                )
                && count($orderItem->invoice_items)
                && $orderItem->order->status != 'pending'
            ) {
                unset($order[$orderKey]);
            } elseif (
                $orderItem->type == 'booking'
                && $orderItem->order->status != 'pending'
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
            if ($qty == 0) {
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
     *
     * @param  array  $rmaData
     * @return array
     */
    public function validateRmaData($rmaData)
    {
        $orderQty = [];

        $order = $this->orderItemRepository->findWhere(['order_id' => $rmaData['orderId']]);

        foreach ($order as $orderKey => $orderItem) {
            if (! core()->getConfigData('sales.rma.setting.enable_rma_for_digital_products')
                && in_array($orderItem->type, ['booking', 'downloadable', 'virtual'])

            ) {
                session()->flash('error', trans('rma::app.admin.sales.rma.create-rma.rma-already-exist'));

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
            
            $rmaItems = $this->rmaItemsRepository->findWhere(['order_item_id' => $orderItem->id]);

            $quantity = $orderItem->qty_ordered - collect($rmaItems)->sum('quantity');

            if ($quantity == 0) {
                unset($order[$orderKey]);
            } else {
                $orderQty[$orderKey] = $quantity;
            }
        }

        if (empty($orderQty)) {
            session()->flash('error', trans('rma::app.admin.sales.rma.create-rma.rma-already-exist'));

            return redirect()->back();
        }

        $isGuest = $this->customerRepository->findOneByField(['email' => $rmaData['email']]) ? 0 : 1;

        if ($this->orderRepository->find($rmaData['orderId'])->customer_email != $rmaData['email']) {
            session()->flash('error', trans('rma::app.admin.sales.rma.create-rma.mismatch'));

            return redirect()->back();
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
     * Store RMA data.
     *
     * @param  array  $data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeData($data)
    {
        $items = [];

        $data['order_items'] = []; // Initialize as empty array

        foreach ($data['order_item_id'] as $orderItemId) {
            $orderItem = $this->orderItemRepository->find($orderItemId);

            if (! empty($orderItem)) { // Ensure $orderItem is not null
                $data['order_items'][] = $orderItem; // Push $orderItem into $data['order_items']

                $items[] = [
                    'order_id'      => $orderItem->order_id,
                    'order_item_id' => $orderItem->id,
                ];
            }
        }

        $orderRMAData = [
            'status'       => '',
            'order_id'     => $data['order_id'],
            'resolution'   => 'Cancel Items',
            'information'  => ! empty($data['information']) ? $data['information'] : '',
            'order_status' => $this->orderRepository->find($data['order_id'])->status,
            'rma_status'   => 'Pending',
        ];

        $rma = $this->rmaRepository->create($orderRMAData);

        $lastInsertId = $rma->id;

        $data['rma_id'] = $lastInsertId;

        if (! empty($data['images'])) {
            $imageCheck = implode(',', $data['images']);
        }

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

        // Insert rma items
        foreach ($items as $key => $itemId) {
            $rmaItem = [
                'rma_id'        => $lastInsertId,
                'order_item_id' => $itemId['order_item_id'],
                'quantity'      => isset($data['qty'][$key]) ? $data['qty'][$key] : $data['qty'][$key + 1],
                'rma_reason_id' => $data['reason'][$itemId['order_item_id']],
            ];

            $rmaOrderItem = $this->rmaItemsRepository->create($rmaItem);
        }

        $data['reasonsData'] = $this->rmaReasonRepository->findWhereIn('id', $data['reason']);

        foreach ($data['reasonsData'] as $reasons) {
            $data['reasons'][] = $reasons->title;
        }

        $rmaItems = $this->rmaItemsRepository->findWhere(['rma_id' => $lastInsertId]);

        $order = $this->orderRepository->findOrFail($rma->order_id);

        $ordersItem = $order->items;

        $orderItem = [];

        foreach ($rmaItems as $rmaItem) {
            $orderItem[] = $rmaItem->order_item_id;
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

            session()->flash('success', trans('rma::app.admin.sales.rma.create-rma.create-success'));

            Cookie::has('rmaData') ? setcookie('rmaData', null, -1, '/') : '';

            return redirect()->route('admin.sales.rma.index');
        }

        session()->flash('error', trans('shop::app.customer.signup-form.failed'));
    }
}
