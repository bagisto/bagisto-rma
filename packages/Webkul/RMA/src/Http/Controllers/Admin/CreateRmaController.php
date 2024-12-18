<?php

namespace Webkul\RMA\Http\Controllers\Admin;

use Webkul\Admin\Http\Controllers\Controller;
use Webkul\RMA\DataGrids\Admin\OrderRMADataGrid;
use Webkul\RMA\Repositories\{CreateRmaRepository, ReasonResolutionsRepository, RMAMessagesRepository, RMAReasonsRepository, RMARepository};
use Webkul\Sales\Repositories\OrderRepository;

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
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if (request()->ajax()) {
            return app(OrderRMADataGrid::class)->toJson();
        }

        return view('rma::admin.sales.rma.create.rma-create');
    }

    /**
     * Store RMA created by admin.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
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

        if (
            ! empty($data['information'])
            && str_word_count($data['information'], 0) > 100
        ) {
            $words = str_word_count($data['information'], 2);

            $pos = array_keys($words);

            $info = substr($data['information'], 0, $pos[100]) . '...';
        } else {
            $info = $data['information'];
        }

        $this->createRmaRepository->storeData($data, $info);

        return response()->json([
            'messages' => trans('rma::app.admin.sales.rma.create-rma.create-success'),
        ]);
    }

    /**
     * Get Order details
     *
     * @param mixed $orderId
     * @return mixed
     */
    public function getOrderProduct($orderId)
    {
        $orderItems = $this->createRmaRepository->getOrderProduct($orderId);

        return $orderItems;
    }

    /**
     * Get reason for resolution.
     *
     * @param mixed $resolutionType
     * @return array
     */
    public function getResolutionReason($resolutionType)
    {
        $existResolutions = $this->reasonResolutionsRepository->where('resolution_type', $resolutionType)->pluck('rma_reason_id');

        $reasons = [];

        foreach ($existResolutions as $existResolution) {
            $reason = $this->rmaReasonRepository->findOneWhere(['id' => $existResolution, 'status' => self::ACTIVE]);
            
            if ($reason) {
                $reasons[] = $reason;
            }
        }

        return $reasons;
    }
}