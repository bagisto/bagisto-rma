<?php

namespace Webkul\RMA\Listeners;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Webkul\Checkout\Facades\Cart;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\Product\Repositories\ProductFlatRepository;
use Webkul\DailyDeal\Helpers\DailyDeal as DailyDealHelper;
use Webkul\DailyDeal\Repositories\DailyDealRepository;
use Webkul\Product\Repositories\ProductRepository;

class AllowRMA
{
    use ValidatesRequests;

    /**
     * @var string
     */
    public const YES = 'yes';

    /**
     * Create a new listener instance.
     *
     * @return void
     */
    public function __construct(
        protected ProductRepository $productRepository,
    ) {
    }

    /**
     * store the daily deals
     *
     * @param $product
     * @return void
     */
    public function afterProductCreatedUpdated($product)
    {
        $allData = request()->input();

        if (isset($allData['allow_rma'])) {
            $this->productRepository->where('id', $product->id)->update([ 
                'allow_rma' => $allData['allow_rma'],
            ]);
        }

        if (isset($allData['rma_rules'])) {
            $this->productRepository->where('id', $product->id)->update([ 
                'rma_rules' => NULL,
            ]);

            if (! empty($allData['rma_rules'])) {
                $this->productRepository->where('id', $product->id)->update([
                    'rma_rules' => $allData['rma_rules'],
                ]);
            }
        }
    }
}