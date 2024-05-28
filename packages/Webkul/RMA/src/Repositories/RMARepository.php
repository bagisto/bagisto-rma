<?php

namespace Webkul\RMA\Repositories;

use Illuminate\Container\Container as App;
use Webkul\Core\Eloquent\Repository;
use Webkul\Sales\Repositories\InvoiceItemRepository;
use Webkul\Sales\Repositories\OrderItemRepository;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Sales\Repositories\RefundRepository;

class RMARepository extends Repository
{
    /**
     * Specify model class name
     *
     * @return string
     */
    public function model()
    {
        return 'Webkul\RMA\Contracts\RMA';
    }

    public function __construct(

        protected RefundRepository $refundRepository,
        protected InvoiceItemRepository $invoiceItemRepository,
        protected OrderItemRepository $orderItemRepository,
        protected OrderRepository $orderRepository,
        protected RMAItemsRepository $rmaItemsRepository,
        protected RMAImagesRepository $rmaImagesRepository,
        protected RMAMessagesRepository $rmaMessagesRepository,
        App $app
    ) {
        parent::__construct($app);
    }

    /**
     * Retrieves the RMA data based on the provided ID.
     *
     * @param  int  $id
     * @param  object  $rma
     * @param  object  $rmaData
     * @return array
     */
    public function sendDataToView($id, $rma, $rmaData)
    {
        $orderDetails = $this->orderRepository->find($rma->order_id);

        $rmaImages = $this->rmaImagesRepository->findWhere(['rma_id' => $id]);

        $orderItems = $this->orderItemRepository->findWhere(['order_id' => $rma->order_id]);

        foreach ($this->orderRepository->find($rma->order_id)->items as $orderItem) {
            $itemsId[] = $orderItem->id;
        }

        foreach ($orderItems as $orderItem) {
            $sku[] = $orderItem->sku;

            if ($orderItem->type == 'configurable') {
                $sku[] = $orderItem->child;
            }
        }

        $createdInvoiceItems = $this->invoiceItemRepository->findWhereIn('order_item_id', $itemsId)->count();

        $productDetails = $this->rmaItemsRepository->with('getOrderItem')->findWhere(['rma_id' => $id]);

        $adminMessages = $this->rmaMessagesRepository->where('rma_id', $id)->orderBy('id', 'desc')->paginate(5);

        return [
            'sku'                 => $sku,
            'rma'                 => $rma,
            'rmaData'             => $rmaData,
            'rmaImages'           => $rmaImages,
            'orderItems'          => $orderItems,
            'orderDetails'        => $orderDetails,
            'adminMessages'       => $adminMessages,
            'productDetails'      => $productDetails,
            'createdInvoiceItems' => $createdInvoiceItems,
        ];
    }
}
