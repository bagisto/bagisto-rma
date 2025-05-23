<?php

namespace Webkul\RMA\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Sales\Repositories\{OrderRepository,RefundRepository};
use Webkul\Sales\Repositories\OrderItemRepository;
use Webkul\RMA\DataGrids\Admin\RmaDataGrid;
use Webkul\RMA\Mail\{AdminConversationEmail,CustomerRMAStatusEmail};
use Webkul\RMA\Repositories\{RMAAdditionalFieldRepository, RMAMessagesRepository,RMARepository};
use Webkul\RMA\Repositories\RMAItemsRepository;
use Webkul\RMA\Repositories\RMAStatusRepository;

class RmaController extends Controller
{
    /**
     * @var string
     */
    public const ACCEPT = 'Accept';

    /**
     * @var string
     */
    public const RECEIVEDPACKAGE = 'Received Package';

    /**
     * @var string
     */
    public const ITEMCANCELED = 'Item Canceled';

    /**
     * @var string
     */
    public const ORDERCANCELED = 'Canceled';

    /**
     * @var string
     */
    public const CANCELED = 'canceled';

    /**
     * @var int
     */
    public const ACTIVE = 1;

    /**
     * RMA Status
     *
     * @var string
     */
    public const PENDING = 'Pending';

    /**
     * @var int
     */
    public const INACTIVE = 0;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected OrderItemRepository $orderItemRepository,
        protected OrderRepository $orderRepository,
        protected RMAAdditionalFieldRepository $rmaAdditionalFieldRepository,
        protected RMAItemsRepository $rmaItemsRepository,
        protected RMAMessagesRepository $rmaMessagesRepository,
        protected RMARepository $rmaRepository,
        protected RMAStatusRepository $rmaStatusRepository,
        protected RefundRepository $refundRepository,
    ) {
    }

    /**
     * RMA list
     */
    public function index(): View|JsonResponse
    {
        if (request()->ajax()) {
            return datagrid(RmaDataGrid::class)->process();
        }

        return view('rma::admin.sales.rma.all-rma.index');
    }

    /**
     * Show the view for the specified resource.
     */
    public function view(int $rmaId): View
    {
        $rma = $this->rmaRepository->with(['orderItem', 'order'])->find($rmaId);

        $rmaActiveStatus = $this->rmaStatusRepository->where('status', 1)->pluck('title');

        $rmaAdditionalValues = $this->rmaAdditionalFieldRepository->findWhere(['rma_id' => $rmaId]);

        return view('rma::admin.sales.rma.all-rma.view', $this->rmaRepository->sendDataToView($rmaId, $rma, $rma, $rmaActiveStatus, $rmaAdditionalValues));
    }

    /**
     * Save rma status by customer
     */
    public function saveReOpenStatus(): RedirectResponse
    {
        $data = request()->only([
            'close_rma',
            'rma_id',
        ]);

        if (! empty($data['close_rma'])) {
            $rma = $this->rmaRepository->find($data['rma_id']);

            if (empty($rma)) {
                session()->flash('error', 'Something Went Wrong');

                return back();
            }

            $order = $this->orderRepository->find($rma->order_id);

            $order->update(['status' => 'pending']);

            $this->rmaRepository->find($data['rma_id'])->update([
                'status'       => self::ACTIVE,
                'rma_status'   => self::PENDING,
                'status'       => self::INACTIVE,
                'order_status' => self::INACTIVE,
            ]);

            $requestData = [
                'message'    => trans('rma::app.mail.customer-conversation.process'),
                'rma_id'     => $data['rma_id'],
                'is_admin'   => self::ACTIVE,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
    
            $this->rmaMessagesRepository->create($requestData);
        }

        session()->flash('success', trans('rma::app.response.update-success', ['name' => 'Status']));

        return back();
    }

    /**
     * Get all Messages
     */
    public function getMessages()
    {
        $messages = $this->rmaMessagesRepository->where('rma_id', request()->get('id'))
                    ->orderBy('id', 'desc')
                    ->paginate(request()->get('limit') ?? 5);

        return new JsonResponse([
            'messages' => $messages,
        ]);
    }

    /**
     * Send message
     */
    public function sendMessage(): JsonResponse
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

        $removedKeys = explode(',', request()->input('removed_key'));

        array_shift($removedKeys);

        if (! empty(request()->file('file'))) {
            $file = request()->file('file');

            $filename = $file->getClientOriginalName();
            
            $path = $file->storeAs('rma-conversation/'. $storedMessage->id, $filename);
            
            $this->rmaMessagesRepository->update([
                'attachment_path' => $path,
                'attachment'      => $filename,
            ], $storedMessage->id);
        }
        
        if ($storedMessage) {
            try {
                Mail::queue(new AdminConversationEmail($conversationDetails));

                return new JsonResponse([
                    'message' => trans('rma::app.admin.sales.rma.all-rma.view.send-message-success'),
                ]);
            } catch (\Exception $e) {
                return new JsonResponse([
                    'message' => trans('rma::app.admin.sales.rma.all-rma.view.send-message-success'),
                ]);
            }
        }

        return new JsonResponse([
            'message' => trans('shop::app.customer.signup-form.failed'),
        ]);
    }

    /**
     * Save rma status
     */
    public function saveRmaStatus(): RedirectResponse
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

        $ordersRma = $this->rmaRepository->findWhere(['order_id' => $orderId]);

        $totalCount = (int)$this->rmaItemsRepository->whereIn('rma_id', $ordersRma->pluck('id'))->sum('quantity');

        if ($totalCount > 0) {
            $qtyCanceled = ($status['rma_status'] == self::ITEMCANCELED) ? 1 : 0;

            foreach ($ordersRma as $orderRma) {
                $rmaItems = $this->rmaItemsRepository->findWhere([
                    'rma_id' => $orderRma->id,
                ]);
                
                foreach ($rmaItems as $key => $rmaItem) {
                    $item1 = $this->orderItemRepository->find($rmaItem->order_item_id);

                    if ($item1->parent_id != null) {
                        $parentItem = $this->orderItemRepository->find($item1->parent_id);

                        $parentItem->update([
                            'qty_canceled' => $parentItem->qty_canceled + ($qtyCanceled == 1 ? $rmaItem->quantity : 0),
                        ]);
                    } else {
                        $item1->update([
                            'qty_canceled' => $item1->qty_canceled + ($qtyCanceled == 1 ? $rmaItem->quantity : 0),
                        ]);
                    }
                }
            }

            if ($qtyCanceled == 1) {
                $this->updateOrderStatus($order);

                Event::dispatch('sales.order.cancel.after', $order);
            }

           
            if ($order->total_qty_ordered == $totalCount) {
                if ($status['rma_status'] == self::ITEMCANCELED) {
                    $status['order_status'] = self::ORDERCANCELED;

                    $order->update(['status' => self::CANCELED]);
                } elseif ($status['rma_status'] == self::ACCEPT) {
                    $this->rmaRepository->find($status['rma_id'])->update(['status' => 0]);
                }
            }
        }

        $updateStatus = $rma->update($status);

        $requestData = [
            'message'    => trans('rma::app.mail.status.your-rma-id') .' '. trans('rma::app.mail.status.status-change', ['id' => $status['rma_id']]) .'. '. trans('rma::app.mail.status.status') . ' : ' . $rma['rma_status'],
            'rma_id'     => $status['rma_id'],
            'is_admin'   => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $this->rmaMessagesRepository->create($requestData);

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

     /**
     * Update order status.
     */
    public function updateOrderStatus(\Webkul\Sales\Contracts\Order $order, string $orderState = null): void
    {
        Event::dispatch('sales.order.update-status.before', $order);

        if (! empty($orderState)) {
            $status = $orderState;
        } else {
            if ($this->orderRepository->isInCompletedState($order)) {
                $status = 'completed';
            }

            if ($this->orderRepository->isInCanceledState($order)) {
                $status = 'canceled';
            } elseif ($this->orderRepository->isInClosedState($order)) {
                $status = 'closed';
            }
        }

        if (! empty($status)) {
            $order->status = $status;
        }

        $order->save();

        Event::dispatch('sales.order.update-status.after', $order);
    }
}