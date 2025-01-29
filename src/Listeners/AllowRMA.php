<?php

namespace Webkul\RMA\Listeners;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Product\Contracts\Product;

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
     * Set rma rules into particular product .
     */
    public function afterProductCreatedUpdated(Product $product): void
    {
        if (! empty(request()->allow_rma)) {
            $this->productRepository->where('id', $product->id)->update([ 
                'allow_rma' => request()->allow_rma,
            ]);
        }

        if (! empty(request()->rma_rules)) {
            $this->productRepository->where('id', $product->id)->update([
                'rma_rules' => request()->rma_rules,
            ]);
        }
    }
}