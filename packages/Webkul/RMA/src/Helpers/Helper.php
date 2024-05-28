<?php

namespace Webkul\RMA\Helpers;

class Helper
{
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
}
