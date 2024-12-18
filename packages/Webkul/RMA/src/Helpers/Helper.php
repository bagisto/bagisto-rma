<?php

namespace Webkul\RMA\Helpers;

use Webkul\RMA\Repositories\RMAItemsRepository;

class Helper
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected RMAItemsRepository $rmaItemsRepository,
    ) {
    }

    /**
     * Get HTML for option details.
     *
     * @param  array  $attributes Array containing option attributes.
     * @return string
     */
    public function getOptionDetailHtml($attributes)
    {
        $attributeValue = '';

        foreach ($attributes as $attribute) {
            $attributeValue = $attribute['option_label'];

            if (! empty($attributeValue)) {
                $attributeValue = $attributeValue . '-' . $attribute['option_label'];
            }
        }

        return $attributeValue != '' ? "($attributeValue)" : '';
    }

    /**
     * Get RMA status
     *
     * @param int $orderItemId
     * @return boolean
     */
    public function getRMAStatus($orderItemId)
    {
        $rmaSolved = false;

        $rmaStatus = ['Item Canceled'];

        $rmaItem = $this->rmaItemsRepository
                    ->select(
                        'rma.status',
                        'rma.rma_status'
                    )
                    ->leftJoin('rma', 'rma_id', 'rma.id')
                    ->where('order_item_id', $orderItemId)
                    ->get();

        if ($rmaItem && sizeof($rmaItem)) {
            $rmaItem = $rmaItem->first();

            if (! $rmaItem->status
                || in_array($rmaItem->rma_status, $rmaStatus)) {
                $rmaSolved = true;
            }
        }

        return $rmaSolved;
    }

    /**
     * Get RMA status
     *
     * @param  int  $orderItemId
     * @return bool
     */
    public function getRefundStatus($orderItemId)
    {
        $refundStatus = false;
        $rmaStatus = ['Received Package', 'Declined', 'Canceled', 'Solved', 'Item Canceled'];

        $rmaItems = $this->rmaItemsRepository
            ->select(
                'rma.status',
                'rma.rma_status'
            )
            ->leftJoin('rma', 'rma_id', 'rma.id')
            ->where('order_item_id', $orderItemId)
            ->get();

        if ($rmaItems && count($rmaItems)) {
            foreach ($rmaItems as $rmaItem) {
                if (in_array($rmaItem->rma_status, $rmaStatus)) {
                    $refundStatus = false;
                } else {
                    $refundStatus = true;
                    break;
                }
            }
        }

        return $refundStatus;
    }
}