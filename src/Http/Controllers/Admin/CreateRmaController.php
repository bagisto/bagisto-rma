<?php

namespace Webkul\RMA\Http\Controllers\Admin;

use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\RMA\DataGrids\Admin\OrderRMADataGrid;
use Webkul\RMA\Contracts\RMAItems;
use Webkul\RMA\Contracts\ReasonResolutions;
use Webkul\RMA\Repositories\{CreateRmaRepository, ReasonResolutionsRepository, RMAMessagesRepository, RMAReasonsRepository, RMARepository};

class CreateRmaController extends Controller
{
    /**
     * @var string
     */
    public const CANCELED = 'canceled';

    /**
     * @var int
     */
    public const ACTIVE = 1;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected CreateRmaRepository $createRmaRepository,
        protected OrderRepository $orderRepository,
        protected ReasonResolutionsRepository $reasonResolutionsRepository,
        protected RMAReasonsRepository $rmaReasonRepository,
        protected RMARepository $rmaRepository,
    ) {
    }

    /**
     * Display the RMA creation form.
     */
    public function create(): View|JsonResponse
    {
        if (request()->ajax()) {
            return datagrid(OrderRMADataGrid::class)->process();
        }

        return view('rma::admin.sales.rma.create.rma-create');
    }

    /**
     * Store RMA created by admin.
     */
    public function store(): RedirectResponse|JsonResponse
    {
        if (! is_array(request()->input('order_item_id'))) {
            session()->flash('warning', trans('Please select the item'));

            return redirect()->route('admin.sales.rma.create');
        }

        $this->validate(request(), [
            'rma_qty'         => 'required',
            'resolution_type' => 'required',
            'order_status'    => 'required',
        ]);

        $data = request()->only([
            'order_id',
            'resolution_type',
            'order_status',
            'order_item_id',
            'rma_qty',
            'rma_reason_id',
            'images',
            'information',
        ]);

        if (request()->input('package_condition')) {
            $data['package_condition'] = request()->input('package_condition');
        }

        if (request()->input('return_pickup_address')) {
            $data['return_pickup_address'] = request()->input('return_pickup_address');
        }

        if (request()->input('return_pickup_time')) {
            $data['return_pickup_time'] = request()->input('return_pickup_time');
        }

        $info = $data['information'] ?? '';
        
        if (
            ! empty($data['information'])
            && str_word_count($data['information'], 0) > 100
        ) {
            $words = str_word_count($data['information'], 2);

            $pos = array_keys($words);

            $info = substr($data['information'], 0, $pos[100]) . '...';
        }

        $this->createRmaRepository->storeData($data, $info);

        return new JsonResponse([
            'messages' => trans('rma::app.admin.sales.rma.create-rma.create-success'),
        ]);
    }

    /**
     * Get order details
     */
    public function getOrderProduct(int $orderId): RMAItems|Collection
    {
        return $this->createRmaRepository->getOrderProduct($orderId);
    }

    /**
     * Get reason for resolution.
     */
    public function getResolutionReason(string $resolutionType): ReasonResolutions|Collection
    {
        $existResolutions = $this->reasonResolutionsRepository->where('resolution_type', $resolutionType)->pluck('rma_reason_id');

        return $this->rmaReasonRepository->whereIn('id', $existResolutions)->where('status', self::ACTIVE)->get();
    }
}