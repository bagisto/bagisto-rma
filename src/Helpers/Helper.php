<?php

namespace Webkul\RMA\Helpers;

class Helper
{
    public function getOptionDetailHtml($attributes)
    {
        $attributeValue = '';
        foreach ($attributes as $attribute) {
            if ($attributeValue != "") {
                $attributeValue = $attributeValue . "-" . $attribute['option_label'];
            } else {
                $attributeValue = $attribute['option_label'];
            }
        }

        return $attributeValue != '' ? "($attributeValue)" : "";
    }

    public function getRMAStatus($orderItemId)
    {
        $rmaSolved = false;
        $rmaStatus = ['Item Canceled'];

        $rmaItem = app('\Webkul\RMA\Repositories\RMAItemsRepository')
                ->getModel()
                ->select(
                    'rma.status',
                    'rma.rma_status'
                )
                ->leftJoin(
                    'rma',
                    'rma_id',
                    'rma.id'
                )
                ->where('order_item_id', $orderItemId)
                ->get();

        if ($rmaItem && sizeof($rmaItem)) {
            $rmaItem = $rmaItem->first();

            if (
                $rmaItem->status == 0
                || in_array($rmaItem->rma_status, $rmaStatus)
            ) {
                $rmaSolved = true;
            }
        }

        return $rmaSolved;
    }
}
