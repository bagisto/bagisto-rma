<?php

namespace Webkul\RMA\Repositories;

use Illuminate\Container\Container as App;
use Webkul\Core\Eloquent\Repository;
use Webkul\RMA\Contracts\RMA;
use Webkul\Sales\Repositories\InvoiceItemRepository;
use Webkul\Sales\Repositories\OrderItemRepository;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Sales\Repositories\RefundRepository;

class RMARepository extends Repository
{
    /**
     * @var string
     */
    public const CONFIGURABLE = 'configurable';
    
    /**
     * Specify model class name
     *
     * @return string
     */
    public function model()
    {
        return RMA::class;
    }

    /**
     * Constructor for the class.
     *
     * @return void
     */
    public function __construct(
        protected InvoiceItemRepository $invoiceItemRepository,
        protected OrderItemRepository $orderItemRepository,
        protected OrderRepository $orderRepository,
        protected RefundRepository $refundRepository,
        protected RmaCustomFieldRepository $rmaCustomFieldRepository,
        protected RMAImagesRepository $rmaImagesRepository,
        protected RMAItemsRepository $rmaItemsRepository,
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
    public function sendDataToView($id, $rma, $rmaData, $rmaActiveStatus, $rmaAdditionalValues)
    {
        $orderDetails = $this->orderRepository->with('payment')->find($rma->order_id);

        $rmaImages = $this->rmaImagesRepository->findWhere(['rma_id' => $id]);

        $orderItems = $this->orderItemRepository->findWhere(['order_id' => $rma->order_id]);

        foreach ($this->orderRepository->find($rma->order_id)->items as $orderItem) {
            $itemsId[] = $orderItem->id;
        }

        foreach ($orderItems as $orderItem) {
            $sku[] = $orderItem->sku;

            if ($orderItem->type == self::CONFIGURABLE) {
                $sku[] = $orderItem->child;
            }
        }

        $createdInvoiceItems = $this->invoiceItemRepository->findWhereIn('order_item_id', $itemsId)->count();

        $productDetails = $this->rmaItemsRepository->with('getOrderItem')->findWhere(['rma_id' => $id]);

        $rmaAdditionalFieldValues = [];

        foreach ($rmaAdditionalValues as $key => $value) {
            $rmaCustomField = $this->rmaCustomFieldRepository->findOneWhere(['code' => $value->field_name]);
        
            if ($rmaCustomField) {
                $rmaAdditionalFieldValues[$value->field_value] = $rmaCustomField['label'];
            }
        }
    
        return [
            'sku'                      => $sku,
            'rma'                      => $rma,
            'rmaData'                  => $rmaData,
            'rmaImages'                => $rmaImages,
            'orderItems'               => $orderItems,
            'orderDetails'             => $orderDetails,
            'productDetails'           => $productDetails,
            'createdInvoiceItems'      => $createdInvoiceItems,
            'rmaActiveStatus'          => $rmaActiveStatus,
            'rmaAdditionalFieldValues' => $rmaAdditionalFieldValues,
        ];
    }
}