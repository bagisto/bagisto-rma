<?php

namespace Webkul\RMA\Helpers;

use Webkul\Sales\Repositories\OrderItemRepository;
use Webkul\RMA\Repositories\RMAItemsRepository;

class Helper
{
    /**
     * Rma in declined status.
     * 
     * @var string
     */
    public const DECLINED = 'Declined';

    /** 
     * rma refund-related statuses
     */
    public const REFUND_EXCLUDED_STATUSES = ['Received Package', 'Declined', 'Canceled', 'Solved', 'Item Canceled'];

    /**
     * Rma in canceled status.
     * 
     * @var string
     */
    public const CANCELED = 'Canceled';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected RMAItemsRepository $rmaItemsRepository,
        protected OrderItemRepository $orderItemRepository,
    ) {
    }

    /**
     * Get html for option details.
     */
    public function getOptionDetailHtml(array $attributes): string
    {
        $attributeValue = '';

        foreach ($attributes as $attribute) {
            if (! empty($attribute)) {
                $attributeValue .= $attribute['attribute_name'] . ': ' . $attribute['option_label']. " </br> ";
            }
        }

        return $attributeValue != '' ? "($attributeValue)" : '';
    }

    /**
     * Get rma status
     */
    public function getRMAStatus(int $orderItemId): array
    {
        $rmaItems = $this->rmaItemsRepository
                        ->select('rma_items.quantity', 'rma.rma_status', 'rma.status')  // Only fetch necessary columns
                        ->leftJoin('rma', 'rma_items.rma_id', '=', 'rma.id')  // Use explicit join condition for clarity
                        ->leftJoin('order_items', 'rma_items.order_item_id', '=', 'order_items.id')
                        ->where('rma_items.order_item_id', $orderItemId)
                        ->get();

        $orderItem = $this->orderItemRepository->find($orderItemId);

        $rmaQty = $rmaItems->reduce(function ($carry, $item) {
            return $carry + (! in_array($item->rma_status, [self::DECLINED, self::CANCELED]) ? $item->quantity : 0);
        }, 0);

        return [
            'qty'     => ($orderItem->qty_ordered - $rmaQty) ?: $orderItem->qty_ordered,
            'message' => $rmaQty ? trans('rma::app.admin.sales.invoice.create.rma-created-message', ['qty' => $rmaQty]) : '',
        ];
    }


    /**
     * Get refund status
     */
    public function getRefundStatus(int $orderItemId): bool
    {
        $rmaItems = $this->rmaItemsRepository
            ->select('rma.status', 'rma.rma_status')
            ->leftJoin('rma', 'rma_id', '=', 'rma.id')
            ->where('order_item_id', $orderItemId)
            ->get();

        $refundStatus = false;

        if (
            $rmaItems 
            && count($rmaItems)
        ) {
            foreach ($rmaItems as $rmaItem) {
                if (! in_array($rmaItem->rma_status, self::REFUND_EXCLUDED_STATUSES)) {
                    $refundStatus = false;
                    
                    break;
                } 

                $refundStatus = true;   
            }
        }

        return $refundStatus;
    }

}