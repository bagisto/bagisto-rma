<?php

namespace Webkul\RMA\Repositories;

use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Webkul\Core\Eloquent\Repository;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\Sales\Repositories\InvoiceItemRepository;
use Webkul\Sales\Repositories\OrderItemRepository;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Sales\Repositories\RefundRepository;
use Webkul\RMA\Contracts\RMA;

class RMARepository extends Repository
{
    /**
     * @var string
     */
    public const CONFIGURABLE = 'configurable';

    /**
     * Constructor for the class.
     *
     * @return void
     */
    public function __construct(
        protected CustomerRepository $customerRepository,
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
     * Specify model class name
     */
    public function model(): string
    {
        return RMA::class;
    }

    /**
     * Retrieves the rma data based on the provided id.
     */
    public function sendDataToView(int $id, RMA $rma, RMA $rmaData, Collection $rmaActiveStatus, Collection $rmaAdditionalValues): array
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
            'rmaAdditionalFieldValues' => $rmaAdditionalFieldValues ?? [],
        ];
    }
}