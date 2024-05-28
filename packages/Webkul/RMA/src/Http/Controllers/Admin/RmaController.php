<?php

namespace Webkul\RMA\Http\Controllers\Admin;

use Illuminate\Support\Facades\Mail;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\RMA\DataGrids\Admin\RmaDataGrid;
use Webkul\RMA\Mail\AdminConversationEmail;
use Webkul\RMA\Mail\CustomerRMAStatusEmail;
use Webkul\RMA\Repositories\RMAItemsRepository;
use Webkul\RMA\Repositories\RMAMessagesRepository;
use Webkul\RMA\Repositories\RMARepository;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Sales\Repositories\RefundRepository;

class RmaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected RefundRepository $refundRepository,
        protected OrderRepository $orderRepository,
        protected RMARepository $rmaRepository,
        protected RMAItemsRepository $rmaItemsRepository,
        protected RMAMessagesRepository $rmaMessagesRepository,
    ) {
    }

    /**
     * RMA list
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(RmaDataGrid::class)->toJson();
        }

        return view('rma::admin.sales.rma.allrma.index');
    }

    /**
     * Show the view for the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view($rmaId)
    {
        $rmaData = $this->rmaRepository->with('orderItem')->findOneWhere([
            'id' => $rmaId,
        ]);

        $rma = $this->rmaRepository->find($rmaId);

        return view('rma::admin.sales.rma.allrma.view', $this->rmaRepository->sendDataToView($rmaId, $rma, $rmaData));
    }

    /**
     * Send message
     *
     * @return \Illuminate\View\View
     */
    public function sendMessage()
    {
        $requestData = request()->input();

        $orderDetails = $this->orderRepository->find($requestData['order_id']);

        $conversationDetails = [
            'message'       => $requestData['message'],
            'customerName'  => $orderDetails->customer_first_name . ' ' . $orderDetails->customer_last_name,
            'customerEmail' => $orderDetails->customer_email,
        ];

        unset($requestData['order_id']);

        $storedMessage = $this->rmaMessagesRepository->create($requestData);

        if ($storedMessage) {
            try {
                Mail::queue(new AdminConversationEmail($conversationDetails));

                session()->flash('success', trans('rma::app.admin.sales.rma.all-rma.view.send-message-success'));
            } catch (\Exception $e) {
                session()->flash('success', trans('rma::app.admin.sales.rma.all-rma.view.send-message-success'));
            }

            return redirect()->back();
        }

        session()->flash('error', trans('shop::app.customer.signup-form.failed'));

        return redirect()->back();
    }

    /**
     * Save status
     *
     * @return mixed
     */
    public function saveRmaStatus()
    {
        $status = request()->input();

        $rma = $this->rmaRepository->find($status['rma_id']);

        $orderId = $rma->order_id;

        $order = $this->orderRepository->find($orderId);

        $mailDetails = [
            'name'       => $order->customer_first_name . ' ' . $order->customer_last_name,
            'email'      => $order->customer_email,
            'rma_id'     => $status['rma_id'],
            'rma_status' => $status['rma_status'],
        ];

        $orderRma = $this->rmaRepository->findWhere(['order_id' => $orderId]);

        $rmaItems = [];

        foreach ($orderRma as $rma) {
            if ($rma->rmaItem) {
                $rmaItems[] = $rma->rmaItem;
            }
        }

        $totalCount = 0;

        foreach ($rmaItems as $rmaItem) {
            $totalCount += $rmaItem->quantity;
        }

        if ($totalCount > 0) {
            $qtyCanceled = ($status['rma_status'] == 'Item Canceled') ? 1 : 0;

            $qtyRefunded = ($status['rma_status'] == 'Accept') ? 0 : 1;

            foreach ($rmaItems as $key => $rmaItem) {
                $this->orderRepository->find($rmaItem->order_item_id)->update(['qty_canceled' => $qtyCanceled, 'qty_refunded' => $qtyRefunded]);
            }

            if ($status['rma_status'] == 'Accept') {
                $items = collect($rmaItems)->pluck('order_item_id')->mapWithKeys(function ($item) {
                    return [$item => 1];
                });

                $refundArray = [
                    'refund' => [
                        'items'             => $items,
                        'shipping'          => 0,
                        'adjustment_refund' => 0,
                        'adjustment_fee'    => 0,
                    ],
                    'order_id' => $orderId,
                ];

                $this->refundRepository->create($refundArray);
            } else {
                foreach ($rmaItems as $key => $rmaItem) {
                    $this->orderRepository->find($rmaItem->order_item_id)->update(['qty_refunded' => 0]);
                }
            }

            if ($order->total_qty_ordered == $totalCount) {
                if ($status['rma_status'] == 'Item Canceled') {
                    $status['order_status'] = 'Canceled';

                    $order->update(['status' => 'canceled']);
                } elseif ($status['rma_status'] == 'Accept') {
                    $status['order_status'] = 'Closed';

                    $order->update(['status' => 'closed']);

                    $this->rmaRepository->find($status['rma_id'])->update(['status' => 1]);
                }
            }
        }

        $updateStatus = $rma->update($status);

        if ($updateStatus) {
            try {
                Mail::queue(new CustomerRMAStatusEmail($mailDetails));

                session()->flash('success', trans('rma::app.admin.sales.rma.all-rma.view.update-success'));
            } catch (\Exception $e) {
                session()->flash('success', trans('rma::app.admin.sales.rma.all-rma.view.update-success'));
            }

            return redirect()->back();
        }

        session()->flash('error', trans('shop::app.customer.signup-form.failed'));

        return redirect()->back();
    }
}
