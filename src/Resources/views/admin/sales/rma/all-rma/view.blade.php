<x-admin::layouts>
    <!-- Title of the page -->
    <x-slot:title>
        @lang('rma::app.admin.sales.rma.all-rma.view.title', ['id' => $rmaData->id])
    </x-slot>

    @php
        $currentDate = \Carbon\Carbon::now();

        $expireDays = intval(core()->getConfigData('sales.rma.setting.default_allow_days'));

        $newDateTime = \Carbon\Carbon::parse($rmaData->created_at);

        $DeferenceInDays = $currentDate->diffInDays($newDateTime);

        $checkDateExpires = false;

        if (
            $DeferenceInDays > $expireDays
            && $DeferenceInDays != 0
        ) {
            $checkDateExpires = true;
        }
        
        $statusArr = [];

        $rmaActiveStatus = $rmaActiveStatus->toarray();
        
        if ($rmaData['rma_status'] == 'Pending') {

            $rmaActiveStatus = array_filter($rmaActiveStatus, function ($status) {
                return in_array($status, ["Accept", "Declined"]);
            });
        } else {
            if ($productDetails['0']?->resolution != 'cancel-items') {
                $rmaActiveStatus = array_filter($rmaActiveStatus, function ($status) {
                    return $status !== "Item Canceled" && $status !== "Canceled" && $status !== "Accept" && $status !== "Declined" && $status !== "Pending";
                });
    
            } else {
                $rmaActiveStatus = array_filter($rmaActiveStatus, function ($status) {
                    return $status!== "Received Package" && $status !== "Canceled" && $status !== "Accept" && $status !== "Declined" && $status !== "Pending";
                });
            }
        }

        $statusArr = array_values($rmaActiveStatus);

        $rmaStatusColor = '';

        $rmaStatusData = app('Webkul\RMA\Repositories\RMAStatusRepository')
            ->where('title', $rmaData['rma_status'])
            ->first();

        if ($rmaStatusData) {
            $rmaStatusColor = $rmaStatusData->color;
        }
    @endphp

    <v-admin-rma-view></v-admin-rma-view>

    @push('scripts')
        <script
            type="text/x-template"
            id="v-admin-rma-view-template"
        >
            <div class="grid">
                <div class="flex items-center justify-between gap-4 max-sm:flex-wrap">

                    <div class="flex items-center gap-2.5">
                        <p class="text-xl font-bold leading-6 text-gray-800 dark:text-white">
                            @lang('rma::app.admin.sales.rma.all-rma.index.datagrid.id') {{ '#'.$rmaData['id'] }}
                        </p>
                    </div>

                    <!-- Back Button -->
                    <div class="flex gap-x-2.5 items-center">
                        <a 
                            class="transparent-button hover:bg-gray-200 dark:text-white dark:hover:bg-gray-800" 
                            @click="printPage"
                        >
                            @lang('rma::app.admin.configuration.index.sales.rma.print-page')
                        </a>
    
                        <!-- Back Button -->
                        <a
                            href="{{ route('admin.sales.rma.index') }}"
                            class="transparent-button hover:bg-gray-200 dark:text-white dark:hover:bg-gray-800"
                        >
                            @lang('admin::app.customers.customers.view.back-btn')
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex-wrap items-center justify-between mt-5 gap-x-1 gap-y-2">
                <!-- Body content -->
                <div class="flex flex-col flex-1 gap-2 max-xl:flex-auto">
                    <!-- Left sub-component -->
                    <div class="flex flex-col flex-1 gap-2 max-xl:flex-auto">
                        <!-- RMA details component -->
                        <div class="bg-white dark:bg-gray-900">
                            <!-- RMA Details -->
                            <div class="p-4 mb-2 rounded-md box-shadow">
                                <div class="my-2 text-xl font-medium dark:text-gray-300">
                                    @lang('rma::app.shop.view-customer-rma.heading')
                                </div>

                                <!-- RMA ID -->
                                <div class="flex justify-between p-2 mb-2 border-b-2">
                                    <div class="text-sm font-medium dark:text-gray-300">
                                        @lang('rma::app.admin.sales.rma.all-rma.index.datagrid.id') :
                                    </div>

                                    <div class="text-sm dark:text-gray-300">
                                        {{ '#'.$rmaData['id'] }}
                                    </div>
                                </div>

                                <!-- Created At -->
                                <div class="flex justify-between p-2 mb-2 border-b-2">
                                    <div class="text-sm font-medium dark:text-gray-300">
                                        @lang('rma::app.admin.sales.rma.all-rma.view.request-on')
                                    </div>

                                    <div class="text-sm dark:text-gray-300">
                                        {{ date("F j, Y, h:i:s A" ,strtotime($rmaData['created_at'])) }}
                                    </div>
                                </div>

                                <!-- Package Condition -->
                                @if ($rmaData['package_condition'])
                                    <div class="flex justify-between p-2 mb-2 border-b-2">
                                        <div class="text-sm font-medium dark:text-gray-300">
                                            @lang('rma::app.admin.configuration.index.sales.rma.package-condition'):
                                        </div>

                                        <div class="text-sm dark:text-gray-300">
                                            {{ ucwords($rmaData['package_condition']) }}
                                        </div>
                                    </div>
                                @endif

                                <!-- Additional Fields -->
                                @if (! empty($rmaAdditionalFieldValues))
                                    @foreach ($rmaAdditionalFieldValues as $key => $rmaAdditionalFieldValue)
                                        <div class="flex justify-between p-2 mb-2 border-b-2">
                                            <div class="text-sm font-medium dark:text-gray-300">
                                                {{ $rmaAdditionalFieldValue }} : 
                                            </div>

                                            <div class="text-sm dark:text-gray-300">
                                                {{ $key }}
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                <!-- Additional Information -->
                                <div class="flex justify-between p-2 mb-2 border-b-2">
                                    <div class="text-sm font-medium dark:text-gray-300">
                                        @lang('rma::app.admin.sales.rma.all-rma.view.additional-information')
                                    </div>

                                    <div class="text-sm dark:text-gray-300">
                                        {{ wordwrap($rmaData['information'],99,"<br>\n") }}
                                    </div>
                                </div>

                                <!--RMA Image -->
                                <div class="flex gap-2 p-2 mb-2">
                                    <div class="text-sm font-medium dark:text-gray-300 min-w-16">
                                        @lang('rma::app.admin.sales.rma.all-rma.view.images')
                                    </div>

                                    <div class="flex flex-wrap justify-between gap-2">
                                        @foreach($rmaImages as $image)
                                            <img
                                                class="relative w-24 h-20 rounded-md max-w-20 max-h-20"
                                                src="{{ Storage::url($image->path) }}"
                                            />
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Order Details -->
                            <div class="p-4 mb-2 rounded-md box-shadow">
                                <div class="my-2 text-xl font-medium dark:text-gray-300">
                                    @lang('rma::app.shop.view-customer-rma-content.order-details')
                                </div>

                                <!-- Order Id -->
                                <div class="flex justify-between p-2 mb-2 border-b-2">
                                    <div class="text-sm font-medium dark:text-gray-300">
                                        @lang('rma::app.admin.sales.rma.all-rma.view.order-id')
                                    </div>

                                    <div class="text-sm dark:text-gray-300">
                                        <a
                                            href="{{ route('admin.sales.orders.view',$rmaData['order_id']) }}"
                                            target="_blank"
                                            class="text-blue-600 transition-all cursor-pointer hover:underline"
                                        >
                                            {{ '#'.$rmaData['order_id'] }}
                                        </a>
                                    </div>
                                </div>

                                <!-- Order Total -->
                                <div class="flex justify-between p-2 mb-2 border-b-2">
                                    <div class="text-sm font-medium dark:text-gray-300">
                                        @lang('rma::app.admin.sales.rma.all-rma.view.order-total')
                                    </div>

                                    <div class="text-sm dark:text-gray-300">
                                        {{ core()->formatBasePrice($orderDetails->base_grand_total) }}
                                    </div>
                                </div>

                                <!-- Order Date -->
                                <div class="flex justify-between p-2 mb-2 border-b-2">
                                    <div class="text-sm font-medium dark:text-gray-300">
                                        @lang('rma::app.admin.sales.rma.all-rma.view.order-date')
                                    </div>

                                    <div class="text-sm dark:text-gray-300">
                                        {{ date("F j, Y, h:i:s A" ,strtotime($orderDetails->created_at)) }}
                                    </div>
                                </div>
                                
                                <!-- Payment Method -->
                                <div class="flex justify-between p-2 mb-2 border-b-2">
                                    <div class="text-sm font-medium dark:text-gray-300">
                                        @lang('admin::app.sales.orders.view.payment-method') : 
                                    </div>

                                    <div class="text-sm dark:text-gray-300">
                                        {{ $orderDetails->payment->method_title }}
                                    </div>
                                </div>
                            </div>

                            <!-- Customer Info -->
                            <div class="p-4 mb-2 rounded-md box-shadow">
                                <div class="my-2 text-xl font-medium dark:text-gray-300">
                                    @lang('rma::app.admin.sales.rma.all-rma.view.customer-details')
                                </div>

                                <!-- Customer Name -->
                                <div class="flex justify-between p-2 mb-2 border-b-2">
                                    <div class="text-sm font-medium dark:text-gray-300">
                                        @lang('rma::app.admin.sales.rma.all-rma.view.customer')
                                    </div>

                                    @if (empty($orderDetails->customer_id))
                                        <div class="text-sm dark:text-gray-300">
                                            {{ $orderDetails->customer_first_name }} {{ $orderDetails->customer_last_name }}  (@lang('rma::app.shop.view-customer-rma.guest'))
                                        </div>
                                    @else
                                        <a href="{{ route('admin.customers.customers.view', $orderDetails->customer_id) }}">
                                            <div class="text-sm dark:text-gray-300">
                                                {{ $orderDetails->customer_first_name }} {{ $orderDetails->customer_last_name }}
                                            </div>
                                        </a>
                                    @endif
                                </div>

                                <!-- Customer Email -->
                                <div class="flex justify-between p-2 mb-2 border-b-2">
                                    <div class="text-sm font-medium dark:text-gray-300">
                                        @lang('rma::app.admin.sales.rma.all-rma.view.customer-email')
                                    </div>

                                    <div class="text-sm dark:text-gray-300">
                                        {{ $orderDetails->customer_email }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order details component -->
                        <div class="p-4 mt-6 bg-white rounded box-shadow dark:bg-gray-900">
                            <div class="flex justify-between">
                                <p class="pb-0 text-base font-semibold text-gray-800 dark:text-white">
                                    @lang('rma::app.admin.sales.rma.all-rma.view.order-details')
                                </p>
                            </div>

                            <div class="mt-4 overflow-x-auto">
                                <x-admin::table>
                                    <x-admin::table.thead class="text-base font-medium dark:bg-gray-800">
                                        @php($lang = Lang::get('rma::app.shop.table-heading'))

                                        <x-admin::table.thead.tr>
                                            <x-admin::table.th>
                                                @lang('rma::app.shop.table-heading.image')
                                            </x-admin::table.th>

                                            <x-admin::table.th>
                                                @lang('rma::app.shop.table-heading.product-name')
                                            </x-admin::table.th>
                                            
                                            <x-admin::table.th>
                                                @lang('rma::app.shop.table-heading.sku')
                                            </x-admin::table.th>

                                            <x-admin::table.th>
                                                @lang('rma::app.shop.table-heading.price')
                                            </x-admin::table.th>
                                            
                                            <x-admin::table.th>
                                                @lang('rma::app.shop.table-heading.rma-qty')
                                            </x-admin::table.th>
                                            
                                            <x-admin::table.th>
                                                @lang('rma::app.shop.table-heading.order-qty')
                                            </x-admin::table.th>

                                            <x-admin::table.th>
                                                @lang('rma::app.shop.table-heading.resolution-type')
                                            </x-admin::table.th>

                                            <x-admin::table.th>
                                                @lang('rma::app.shop.table-heading.reason')
                                            </x-admin::table.th>
                                        </x-admin::table.thead.tr>
                                    </x-admin::table.thead>

                                    <tbody>
                                        @foreach($productDetails as $key => $prodDetail)
                                            @foreach($prodDetail->getOrderItem as $orderItem)
                                                <x-admin::table.thead.tr class="hover:bg-gray-50 dark:hover:bg-gray-950">
                                                    <!-- Product Name -->
                                                    <x-admin::table.td class="dark:text-gray-300">
                                                        @if (empty($orderItem->product->images->pluck('path')['0']))
                                                            <div class="w-[60px] h-[60px] max-w-[60px] max-h-[60px] relative border border-dashed border-gray-300 dark:border-gray-800 rounded-[4px] dark:invert dark:mix-blend-exclusion">
                                                                <img 
                                                                    src="{{ asset('themes/admin/default/build/assets/front-93490c30.svg') }}" 
                                                                    alt="Sample Images" 
                                                                    target="new"
                                                                >
                                                                <p class="w-full absolute bottom-[5px] text-[6px] text-gray-400 text-center font-semibold">
                                                                    @lang('admin::app.dashboard.index.product-image')
                                                                </p>
                                                            </div>
                                                        @else 
                                                            <a 
                                                                target="new" 
                                                                href="{{ asset('storage/' . $orderItem->product->images->pluck('path')['0']) }}"
                                                            >
                                                                <img 
                                                                    src="{{ asset('storage/'. $orderItem->product->images->pluck('path')['0']) }}" 
                                                                    alt="Sample Images" 
                                                                    target="new" 
                                                                    class="w-[60px] h-[60px] max-w-[60px] max-h-[60px] cursor-pointer shadow-2xl border"
                                                                >
                                                            </a>
                                                        @endif
                                                    </x-admin::table.td>

                                                    <x-admin::table.td class="dark:text-gray-300" style="max-width: 25px">
                                                        <p style="width: 100px; max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: break-spaces;">
                                                            <a 
                                                                target="_blank" 
                                                                class="text-blue-600 hover:underline" 
                                                                href="{{ route('shop.product_or_category.index', $orderItem->product->url_key) }}"
                                                            >  
                                                                {!! $orderItem['name'] !!}
                                                                {!! app('Webkul\RMA\Helpers\Helper')->getOptionDetailHtml($orderItem->additional['attributes'] ?? []) !!}
                                                            </a>
                                                        </p>                                                    
                                                    </x-admin::table.td>

                                                    <!-- Sku -->
                                                    <x-admin::table.td class="dark:text-gray-300">
                                                        <p style="width: 100px; max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: break-spaces;">
                                                            @if ($orderItem['type'] == 'configurable')

                                                                @foreach ($sku as $k => $parentID)
                                                                    @if (! empty($parentID['parent_id'])
                                                                        && $parentID['parent_id'] == $orderItem['id']
                                                                        )
                                                                        {!! $parentID['sku'] !!}
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                {!! $orderItem['sku'] !!}
                                                            @endif
                                                        </p>
                                                    </x-admin::table.td>

                                                    <!-- Price -->
                                                    <x-admin::table.td class="dark:text-gray-300">
                                                        {{ core()->formatBasePrice($orderItem['price']) }}
                                                    </x-admin::table.td>

                                                    <!-- RMA Quantity -->
                                                    <x-admin::table.td class="dark:text-gray-300">
                                                        {!! $prodDetail['quantity'] !!}
                                                    </x-admin::table.td>

                                                    <!-- Qty Ordered -->
                                                    <x-admin::table.td class="dark:text-gray-300">
                                                        {{ $orderItem->qty_ordered }}
                                                    </x-admin::table.td>

                                                    <!-- Resolution -->
                                                    <x-admin::table.td class="dark:text-gray-300">
                                                        {!! ucwords($prodDetail['resolution']) !!}
                                                    </x-admin::table.td>

                                                    <!-- Reasons -->
                                                    <x-admin::table.td class="dark:text-gray-300">
                                                        {!! wordwrap($prodDetail->getReasons->title, 15, "<br>\n") !!}
                                                    </x-admin::table.td>
                                                </x-admin::table.thead.tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </x-admin::table>
                            </div>
                        </div>

                        <!-- RMA and order status -->
                        <x-admin::accordion>
                            <x-slot:header>
                                <p class="p-3 text-base font-semibold text-gray-600 dark:text-gray-300">
                                    @lang('rma::app.admin.sales.rma.all-rma.view.status')
                                </p>
                            </x-slot:header>

                            <!-- RMA status -->
                            <x-slot:content>
                                <!-- RMA status -->
                                <div class="flex justify-between w-full gap-1 text-white">
                                    <p class="text-gray-600 dark:text-gray-300">
                                        @lang('rma::app.admin.sales.rma.all-rma.view.rma-status')
                                    </p>

                                    <p class="font-semibold transition-all">
                                        <span @if ($rmaData['status'] == 1) class="hidden" @endif>                                            
                                            @if ($rmaData['rma_status'] == 'solved')
                                                <span class="py-1 label-active">
                                                    @lang('rma::app.status.status-name.solved')
                                                </span>

                                            @elseif(
                                                    $orderDetails['status'] == 'canceled' 
                                                    || $orderDetails['status'] == 'closed'
                                                )
                                                <span 
                                                    class="py-1 text-xs label-canceled" 
                                                >
                                                    @lang('rma::app.status.status-name.item-canceled')
                                                </span>
                                            @else
                                                <span 
                                                    class="py-1 text-xs label-active" 
                                                    style="background: {{ $rmaStatusColor }}"
                                                >
                                                    {{ $rmaData['rma_status'] }}
                                                </span>
                                            @endif
                                        </span>

                                        <!-- Status solved -->
                                        <span @if ($rmaData['status'] == 0) class="hidden" @endif>
                                            <span style="border-radius:35px; padding: 1px 6px; background-color:#00796B; color: white;" class="tagbutton">
                                                @lang('rma::app.status.status-name.solved')
                                            </span>
                                        </span>
                                    </p>
                                </div>

                                <!-- Order status -->
                                <div class="flex justify-between gap-1 mt-4">
                                    <p class="text-gray-600 dark:text-gray-300">
                                        @lang('rma::app.admin.sales.rma.all-rma.view.order-status')
                                    </p>

                                    <p class="text-gray-600 dark:text-gray-300">
                                        <span
                                            @if (
                                                $rmaData['order_status'] == '1'
                                            ) 
                                                class="py-1 label-active"

                                            @elseif ( $orderDetails['status'] == 'canceled' 
                                                || $orderDetails['status'] == 'closed')
                                                    class="py-1 label-active"
                                            @else
                                                class="label-{{$orderDetails['status']}} py-1"
                                            @endif
                                        >
                                            @if ($rmaData['order_status'] == '1')
                                                @lang('rma::app.shop.customer.delivered')
                                            @elseif (
                                                $orderDetails['status'] == 'canceled' 
                                                || $orderDetails['status'] == 'closed'
                                            )
                                                @lang('rma::app.shop.customer.'. $orderDetails['status'])
                                            @else
                                                @lang('rma::app.shop.customer.undelivered')
                                            @endif
                                        </span>
                                    </p>
                                </div>
                            </x-slot:content>
                        </x-admin::accordion>

                        <!-- RMA change status-->
                        @if (
                            $rmaData['rma_status'] != 'Solved' 
                            && $rmaData['status'] != 1
                            && $rmaData['order']['status'] != 'canceled' 
                            && $rmaData['order']['status'] != 'closed'
                        )
                            <x-admin::accordion>
                                @if ($rmaData['rma_status'] == 'Item Canceled')
                                    @php($flag = 0)

                                @elseif ($rmaData['rma_status'] == 'Received Package')
                                    @php($flag = 0)

                                @elseif ($rmaData['rma_status'] == 'Declined')
                                    @php($flag = 0)
                                    

                                @elseif ($rmaData['rma_status'] == 'Canceled')
                                    @php($flag = 0)
                                    
                                @elseif (
                                    $rmaData['status'] == 1
                                    && $rmaData['resolution'] == 'Replace'
                                )
                                    @php($flag = 0)
                                @elseif (
                                    $rmaData['resolution'] == 'Return'
                                    && $rmaData['status'] == 1
                                )
                                    @php($flag = 0)
                                @else
                                    @php($flag = 1)
                                @endif

                                @if (
                                    ! empty($flag)
                                    && $flag == 1
                                    && $rmaData['status'] == 0
                                    && $orderDetails['status'] != 'closed'
                                )
                                    <x-slot:header>
                                        <p class="p-3 text-base font-semibold text-gray-600 dark:text-gray-300 required">
                                            @lang('rma::app.admin.sales.rma.all-rma.view.change-status')
                                        </p>
                                    </x-slot:header>

                                    <x-slot:content>
                                        <x-admin::form
                                            method="POST"
                                            :action="route('admin.sales.rma.save.status')"
                                        >
                                            <input
                                                type="hidden"
                                                name="rma_id"
                                                value="{{ $rmaData['id'] }}"
                                            >

                                            <x-admin::form.control-group class="w-full mb-2">
                                                <x-admin::form.control-group.control
                                                    type="select"
                                                    name="rma_status"
                                                    id="orderItem"
                                                    rules="required"
                                                    :label="trans('rma::app.admin.sales.rma.all-rma.index.datagrid.rma-status')"
                                                    :value="$rmaData['rma_status']"
                                                >
                                                    @foreach ($statusArr as $status)
                                                        <option value="{{ $status }}" {{ $rmaData['rma_status'] == $status ? 'selected' : '' }}>
                                                            {{ $status }}
                                                        </option>
                                                    @endforeach
                                                </x-admin::form.control-group.control>

                                                <x-admin::form.control-group.error
                                                    control-name="rma_status"
                                                >
                                                </x-admin::form.control-group.error>
                                            </x-admin::form.control-group>

                                            <div class="account-action">
                                                <button
                                                    type="submit"
                                                    class="primary-button"
                                                >
                                                    @lang('rma::app.admin.sales.rma.all-rma.view.save-btn')
                                                </button>
                                            </div>
                                        </x-admin::form>
                                    </x-slot:content>
                                @else
                                    <x-slot:header>
                                        <p class="p-3 text-base font-semibold text-gray-600 dark:text-gray-300 required">
                                            @lang('rma::app.admin.sales.rma.all-rma.view.change-status')
                                        </p>
                                    </x-slot:header>

                                    <x-slot:content>
                                    </x-slot:content>
                                @endif

                                @if (
                                    ($rmaData['status'] == 1 && $rmaData['resolution'] == 'Replace')
                                    || $rmaData['rma_status'] == 'Item Canceled'
                                    || $rmaData['resolution'] == 'Return'
                                    && $rmaData['status'] == 1
                                    || $rmaData['status'] == 1
                                    && $rmaData['rma_status'] != 'Declined'
                                )
                                    <x-slot:header>
                                        <p class="p-3 text-base font-semibold text-gray-600 dark:text-gray-300">
                                            @lang('rma::app.shop.view-customer-rma.change-rma-status')
                                        </p>
                                    </x-slot:header>

                                    <x-slot:content>
                                        <x-admin::form :action="route('admin.sales.rma.save.status')">
                                            <input
                                                type="hidden"
                                                name="rma_id"
                                                value="{{ $rmaData['id'] }}"
                                            >
                                        </x-admin::form>
                                    </x-slot:content>
                                @endif

                                @if ($rmaData['rma_status'] == 'Declined')
                                    <div class="sale-section">
                                        <div class="sale-title">
                                            <div class="section-title">
                                                @lang('rma::app.shop.view-customer-rma.close-rma')
                                            </div><br>

                                            <div class="row">
                                                @lang('rma::app.status.status-quotes.declined-admin')
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($rmaData['rma_status'] == 'Item Canceled')
                                    <div class="sale-section">
                                        <div class="sale-title">
                                            <div class="section-title">
                                                @lang('rma::app.shop.view-customer-rma.close-rma')
                                            </div><br>

                                            <div class="row">
                                                @lang('rma::app.status.status-quotes.solved-by-admin')
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </x-admin::accordion>
                        @endif

                        @if (
                            core()->getConfigData('sales.rma.setting.allowed-new-rma-request-for-declined-request') == 'yes' 
                            && $rmaData['rma_status'] == 'Declined'
                        )
                            <div class="relative px-8 py-4 mt-3 overflow-x-auto border rounded-xl">
                                <!-- Close rma if solved -->
                                <div class="mt-2">
                                    <p class="text-xl font-medium">
                                        @lang('rma::app.shop.view-customer-rma.status-reopen')
                                    </p>
                                </div>

                                <div class="grid w-full py-3">
                                    <x-shop::form
                                        @submit="validateForm"
                                        id="check-form"
                                        enctype="multipart/form-data"
                                        :action="route('admin.sales.rma.save.reopen-status')"
                                    >
                                        @csrf
                                        <div class="flex w-full gap-4">
                                            <div>
                                                <input
                                                    type="hidden"
                                                    name="rma_id"
                                                    value="{{ $rmaData['id'] }}"
                                                >

                                                <!-- Checkbox for closing RMA -->
                                                <input
                                                    type="checkbox"
                                                    id="close_rma"
                                                    name="close_rma"
                                                    v-model="closeRmaChecked"
                                                    v-validate="'required'"
                                                    data-vv-as="&quot;{{ __('rma::app.shop.validation.close-rma') }}&quot;"
                                                >

                                                <label
                                                    for="close_rma"
                                                    class="text-xs font-medium required"
                                                >
                                                    @lang('rma::app.shop.view-customer-rma.status-reopen')
                                                </label>

                                                <p
                                                    v-if="error"
                                                    style="color:red;"
                                                >
                                                    @lang('rma::app.shop.view-customer-rma.term')
                                                </p>
                                            </div>

                                            <br/>

                                            <button
                                                type="submit"
                                                class="block py-3 m-0 text-base text-center primary-button w-max rounded-2xl px-11"
                                                v-if="closeRmaChecked"
                                            >
                                                @lang('rma::app.shop.view-customer-rma.save-btn')
                                            </button>
                                        </div>
                                    </x-shop::form>
                                </div>
                            </div>
                        @endif

                        <!--Send message-->
                        <x-admin::accordion>
                            <x-slot:header>
                                <p class="p-4 pb-0 text-base font-semibold text-gray-800 dark:text-gray-300">
                                    @lang('rma::app.admin.sales.rma.all-rma.view.conversations')
                                </p>
                            </x-slot:header>

                            <x-slot:content>
                                <div class="p-3 mb-3 border rounded-lg">
                                    <x-admin::form
                                        v-slot="{ meta, errors, handleSubmit }"
                                        as="div"
                                    >
                                        <form
                                            @submit="handleSubmit($event, chatSubmit)"
                                            ref="adminChatForm"
                                        >
                                            <input
                                                type="hidden"
                                                name="order_id"
                                                value="{{ $rmaData['order_id'] }}"
                                            >

                                            <input
                                                type="hidden"
                                                name="is_admin"
                                                value="1"
                                            >

                                            <input
                                                type="hidden"
                                                name="rma_id"
                                                value="{{ $rmaData['id'] }}"
                                            >

                                            <x-admin::form.control-group>
                                                <x-shop::form.control-group.label class="flex required dark:text-gray-300">
                                                    @lang('rma::app.admin.sales.rma.all-rma.view.send-message')
                                                </x-shop::form.control-group.label>

                                                <x-admin::form.control-group.control
                                                    type="textarea"
                                                    name="message"
                                                    id="message"
                                                    rules="required"
                                                    :label="trans('rma::app.admin.sales.rma.all-rma.view.enter-message')"
                                                    :placeholder="trans('rma::app.admin.sales.rma.all-rma.view.enter-message')"
                                                />

                                                <div class="flex">
                                                    <x-admin::form.control-group.error
                                                        control-name="message"
                                                        class="text-red-500"
                                                    />
                                                </div>
                                            </x-admin::form.control-group>

                                            <div class="mb-4">
                                                <button 
                                                    type="button" 
                                                    id="newFileInput"
                                                    class="text-sm transparent-button hover:bg-gray-200 dark:text-white dark:hover:bg-gray-800"
                                                >
                                                    + @lang('rma::app.admin.sales.rma.all-rma.view.add-attachments')

                                                    <input 
                                                        type="file" 
                                                        id="file"
                                                        class="absolute opacity-0 cursor-pointer w-fit" 
                                                        name="file" 
                                                        @change="handleFileSelect($event)" 
                                                    />
                                                </button>
                
                                                <input type="hidden" name="removed_key" id="removed_key" />
                
                                                <div id="attachmentPreview"></div>
                                            </div>

                                            <div class="flex justify-end">
                                                <button
                                                    class="primary-button"
                                                    v-if="isSent"
                                                    disabled
                                                >
                                                    <svg  aria-hidden="true" class="w-4 h-4 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                                    </svg>

                                                    @lang('rma::app.admin.sales.rma.all-rma.view.send-message-btn')
                                                </button>

                                                <button
                                                    class="primary-button"
                                                    v-else
                                                >
                                                    @lang('rma::app.admin.sales.rma.all-rma.view.send-message-btn')
                                                </button>
                                            </div>
                                        </form>
                                    </x-shop::form>
                                </div>

                                <div class="p-3 border rounded-lg">
                                    <div
                                        class="p-5 mb-3 overflow-x-auto"
                                        style="height: 300px;"
                                        @wheel="getNewMessage()"
                                        :class="! messages.length ? 'flex justify-center items-center' : ''"
                                    >
                                        <div
                                            v-if="messages.length"
                                            v-for="message in messages"
                                            :class="message.is_admin != 1 
                                                ? 'text-left bg-gray-400 text-black dark:bg-gray-900 dark:text-gray-300' 
                                                : 'text-right bg-gray-100 text-black dark:bg-gray-800 dark:text-gray-300'"
                                            class="p-4 mb-3 rounded-md"
                                        >
                                            <div class="title">
                                                @lang('rma::app.shop.conversation-texts.by')
                                                    <strong v-if="message.is_admin == 1">
                                                        @lang('rma::app.shop.view-customer-rma.admin')
                                                    </strong>
                                                    <strong v-else>
                                                    {{ $orderDetails->customer_first_name }} {{ $orderDetails->customer_last_name }}
                                                    </strong>
                                                @lang('rma::app.shop.conversation-texts.on')

                                                @{{ dateFormat( message.created_at) }}
                                            </div>

                                            <div
                                                class="text-base font-medium value dark:text-black-300"
                                                style="margin-top:10px; word-break: break-all;"
                                                v-html="message.message"
                                            >
                                            </div>

                                            <hr v-if="message.attachment"/>

                                            <a 
                                                @click="viewAttachmentModal(message.attachment_path)"
                                                v-if="message.attachment"
                                                :style="message.is_admin != 1 ? 'color: black;' : 'color: black;'"
                                                class="text-base font-normal cursor-pointer icon-attribute dark:text-black-300"
                                            >
                                                <span class="ml-2 text-base hover:underline">
                                                    @{{ message.attachment }}
                                                </span>
                                            </a>
                                        </div>

                                        <div v-else>
                                            <div
                                                class="icon-sales"
                                                style="font-size:150px; color:#d7d7d7;"
                                                >
                                            </div>

                                            <p class="flex justify-center text-gray-300">@lang('rma::app.admin.sales.rma.all-rma.view.no-record')</p>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </x-slot:content>
                        </x-admin::accordion>
                        
                        {!! view_render_event('bagisto.admin.sales.rma.view.message.attachment.modal.before') !!}

                        <x-admin::modal ref="attachmentModal">
                            <!-- Modal Header -->
                            <x-slot:header>
                                <p class="text-lg font-bold text-gray-800 dark:text-white">
                                    @lang('rma::app.admin.sales.rma.all-rma.view.attachment')
                                </p>
                            </x-slot>

                            <!-- Modal Content -->
                            <x-slot:content>
                                {!! view_render_event('bagisto.admin.sales.rma.view.message.attachment.modal.content.before') !!}
                            
                                <!-- Display Image -->
                                <img 
                                    v-if="
                                            messagePath 
                                            && (
                                                this.getAttachmentExtension === 'jpg' 
                                                || this.getAttachmentExtension === 'jpeg' 
                                                || this.getAttachmentExtension === 'png' 
                                                || this.getAttachmentExtension === 'gif'
                                            )"
                                    :src="'{{ config('app.url') }}' + '/storage/' + messagePath"
                                    class="min-h-[500px] min-w-[500px] max-h-[500px] max-w-[500px] rounded m-auto"
                                />

                                <!-- Display PDF -->                            
                                <embed
                                    v-if="
                                        messagePath 
                                        && this.getAttachmentExtension === 'pdf'
                                        "
                                    :src="'{{ config('app.url') }}' + '/storage/' + messagePath"
                                    width="100%" height="500px"
                                    type="application/pdf"
                                />
                            
                                <!-- Display Video -->
                                <video
                                    v-if="
                                        messagePath 
                                        && (
                                            this.getAttachmentExtension === 'mp4' 
                                            || this.getAttachmentExtension === 'webm' 
                                            || this.getAttachmentExtension === 'ogg'
                                        )"
                                    controls
                                    class="w-full h-auto max-h-[500px] rounded m-auto"
                                >
                                    <source :src="'{{ config('app.url') }}' + '/storage/' + messagePath" />
                                    Your browser does not support the video tag.
                                </video>
                            
                                {!! view_render_event('bagisto.admin.sales.rma.view.message.attachment.modal.content.after') !!}
                            </x-slot>

                            <!-- Modal Footer -->
                            <x-slot:footer>
                                <div class="flex items-center gap-x-2.5">
                                    <!-- Save Button -->
                                    <button
                                        @click="downloadAttachment(messagePath)"
                                        class="transparent-button"
                                    >
                                        @lang('admin::app.export.download')
                                    </button>
                                </div>
                            </x-slot>
                        </x-admin::modal>

                        {!! view_render_event('bagisto.admin.sales.rma.view.message.attachment.modal.before') !!}
                    </div>
                </div>
            </div>

            <!-- Print RMA Data -->
            <div class="hidden" ref="printContent">
                <div class="mt-3.5 flex gap-2.5 max-xl:flex-wrap">
                    <!-- Left sub-component -->
                    <div class="flex flex-col flex-1 gap-2 max-xl:flex-auto"  style="max-width: 800px;">
                        <!-- RMA details component -->
                        <div class="bg-white dark:bg-gray-900">
                            <!-- RMA Details -->
                            <div class="p-4 mb-2 rounded-md box-shadow">
                                <div class="my-2 text-xl font-medium dark:text-gray-300">
                                    @lang('rma::app.admin.sales.rma.all-rma.view.view-title')
                                </div>

                                <!-- RMA ID -->
                                <div class="flex justify-between p-2 mb-2 border-b-2">
                                    <div class="text-sm font-medium dark:text-gray-300">
                                        @lang('rma::app.admin.sales.rma.all-rma.view.view-title')
                                    </div>

                                    <div class="text-sm dark:text-gray-300">
                                        {{ '#'.$rmaData['id'] }}
                                    </div>
                                </div>

                                <!-- Created At -->
                                <div class="flex justify-between p-2 mb-2 border-b-2">
                                    <div class="text-sm font-medium dark:text-gray-300">
                                        @lang('rma::app.admin.sales.rma.all-rma.view.request-on')
                                    </div>

                                    <div class="text-sm dark:text-gray-300">
                                        {{ date("F j, Y, h:i:s A" ,strtotime($rmaData['created_at'])) }}
                                    </div>
                                </div>

                                <!-- Package Condition -->
                                @if ($rmaData['package_condition'])
                                    <div class="flex justify-between p-2 mb-2 border-b-2">
                                        <div class="text-sm font-medium dark:text-gray-300">
                                            @lang('rma::app.admin.configuration.index.sales.rma.package-condition'):
                                        </div>

                                        <div class="text-sm dark:text-gray-300">
                                            {{ ucwords($rmaData['package_condition']) }}
                                        </div>
                                    </div>
                                @endif

                                <!-- RMA Status -->
                                <div class="flex justify-between p-2 mb-2 border-b-2">
                                    <div class="text-sm font-medium dark:text-gray-300">
                                        @lang('rma::app.admin.sales.rma.all-rma.view.rma-status')
                                    </div>

                                    <div class="text-sm dark:text-gray-300">
                                        <span @if ($rmaData['status'] == 1) class="hidden" @endif>

                                            @if ($rmaData['rma_status'] == 'solved')
                                                <span class="py-1 label-active">
                                                    @lang('rma::app.status.status-name.solved')
                                                </span>
                                            @else
                                                <span 
                                                    class="py-1 text-xs label-active" 
                                                    style="background: {{ $rmaStatusColor }}"
                                                >
                                                    {{ $rmaData['rma_status'] }}
                                                </span>
                                            @endif

                                            <!-- Status solved -->
                                            <span @if ($rmaData['status'] == 0) class="hidden" @endif>
                                                <span style="border-radius:35px; padding: 1px 6px; background-color:#00796B; color: white;" class="tagbutton">
                                                    @lang('rma::app.status.status-name.solved')
                                                </span>
                                            </span>
                                        </span>
                                    </div>
                                </div>

                                <!-- Additional Information -->
                                <div class="flex justify-between p-2 mb-2 border-b-2">
                                    <div class="text-sm font-medium dark:text-gray-300">
                                        @lang('rma::app.admin.sales.rma.all-rma.view.additional-information')
                                    </div>

                                    <div class="text-sm dark:text-gray-300">
                                        {{ wordwrap($rmaData['information'],99,"<br>\n") }}
                                    </div>
                                </div>

                                <!--RMA Image -->
                                <div class="flex gap-2 p-2 mb-2">
                                    <div class="text-sm font-medium dark:text-gray-300 min-w-16">
                                        @lang('rma::app.admin.sales.rma.all-rma.view.images')
                                    </div>

                                    <div class="flex flex-wrap justify-between gap-2">
                                        @foreach($rmaImages as $image)
                                            <img  
                                                class="relative w-24 h-20 rounded-md max-w-20 max-h-20"
                                                src="{{ Storage::url($image->path) }}"
                                            />
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Order Details -->
                            <div class="p-4 mb-2 rounded-md box-shadow">
                                <div class="my-2 text-xl font-medium dark:text-gray-300">
                                    @lang('rma::app.shop.view-customer-rma-content.order-details')
                                </div>

                                <!-- Order Id -->
                                <div class="flex justify-between p-2 mb-2 border-b-2">
                                    <div class="text-sm font-medium dark:text-gray-300">
                                        @lang('rma::app.admin.sales.rma.all-rma.view.order-id')
                                    </div>

                                    <div class="text-sm dark:text-gray-300">
                                        <a
                                            href="{{ route('admin.sales.orders.view',$rmaData['order_id']) }}"
                                            target="_blank"
                                            class="text-blue-600 transition-all cursor-pointer hover:underline"
                                        >
                                            {{ '#'.$rmaData['order_id'] }}
                                        </a>
                                    </div>
                                </div>

                                <!-- Order Total -->
                                <div class="flex justify-between p-2 mb-2 border-b-2">
                                    <div class="text-sm font-medium dark:text-gray-300">
                                        @lang('rma::app.admin.sales.rma.all-rma.view.order-total')
                                    </div>

                                    <div class="text-sm dark:text-gray-300">
                                        {{ core()->formatBasePrice($orderDetails->base_grand_total) }}
                                    </div>
                                </div>

                                <!-- Order Date -->
                                <div class="flex justify-between p-2 mb-2 border-b-2">
                                    <div class="text-sm font-medium dark:text-gray-300">
                                        @lang('rma::app.admin.sales.rma.all-rma.view.order-date')
                                    </div>

                                    <div class="text-sm dark:text-gray-300">
                                        {{ date("F j, Y, h:i:s A" ,strtotime($orderDetails->created_at)) }}
                                    </div>
                                </div>
                                
                                <!-- Payment Method -->
                                <div class="flex justify-between p-2 mb-2 border-b-2">
                                    <div class="text-sm font-medium dark:text-gray-300">
                                        @lang('admin::app.sales.orders.view.payment-method') : 
                                    </div>

                                    <div class="text-sm dark:text-gray-300">
                                        {{ $orderDetails->payment->method_title }}
                                    </div>
                                </div>
                                
                                <!-- Order Status -->
                                <div class="flex justify-between p-2 mb-2 border-b-2">
                                    <div class="text-sm font-medium dark:text-gray-300">
                                        @lang('rma::app.admin.sales.rma.all-rma.view.order-status')
                                    </div>

                                    <div class="text-sm dark:text-gray-300">
                                        <span
                                            @if (
                                                $rmaData['order_status'] == '1'
                                                || $orderDetails['status'] != 'closed'
                                            ) 
                                                class="text-xs font-semibold rounded-xl px-1.5 py-0.5" 
                                                style="border-radius:35px;"
                                            @else 
                                                class="text-xs font-semibold rounded-xl px-1.5 py-0.5" 
                                                style="border-radius:35px;"
                                            @endif
                                        >
                                            @if ($orderDetails['status'] == 'canceled')
                                                @lang('rma::app.shop.customer.closed')
                                            @elseif ($rmaData['order_status'] == '1')
                                                @lang('rma::app.shop.customer.delivered')
                                            @else
                                                @lang('rma::app.shop.customer.undelivered')
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Customer Info -->
                            <div class="p-4 mb-2 rounded-md box-shadow">
                                <div class="my-2 text-xl font-medium dark:text-gray-300">
                                    @lang('rma::app.admin.sales.rma.all-rma.view.customer-details')
                                </div>

                                <!-- Customer Name -->
                                <div class="flex justify-between p-2 mb-2 border-b-2">
                                    <div class="text-sm font-medium dark:text-gray-300">
                                        @lang('rma::app.admin.sales.rma.all-rma.view.customer')
                                    </div>

                                    <div class="text-sm dark:text-gray-300">
                                        {{ $orderDetails->customer_first_name }} {{ $orderDetails->customer_last_name }}
                                    </div>
                                </div>

                                <!-- Customer Email -->
                                <div class="flex justify-between p-2 mb-2 border-b-2">
                                    <div class="text-sm font-medium dark:text-gray-300">
                                        @lang('rma::app.admin.sales.rma.all-rma.view.customer-email')
                                    </div>

                                    <div class="text-sm dark:text-gray-300">
                                        {{ $orderDetails->customer_email }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order details component -->
                        <div class="p-4 mt-6 bg-white rounded box-shadow dark:bg-gray-900">
                            <div class="flex justify-between">
                                <p class="pb-0 text-base font-semibold text-gray-800 dark:text-white">
                                    @lang('rma::app.admin.sales.rma.all-rma.view.order-details')
                                </p>
                            </div>

                            <div class="mt-4 overflow-x-auto">
                                <x-admin::table>
                                    <x-admin::table.thead class="text-base font-medium dark:bg-gray-800">
                                        @php($lang = Lang::get('rma::app.shop.table-heading'))

                                        <x-admin::table.thead.tr>
                                                <x-admin::table.th>
                                                    @lang('rma::app.shop.table-heading.image') / @lang('rma::app.shop.table-heading.product-name')
                                                </x-admin::table.th>
                                                
                                                <x-admin::table.th>
                                                    @lang('rma::app.shop.table-heading.sku')
                                                </x-admin::table.th>

                                                <x-admin::table.th>
                                                    @lang('rma::app.shop.table-heading.price')
                                                </x-admin::table.th>
                                                
                                                <x-admin::table.th>
                                                    @lang('rma::app.shop.table-heading.rma-qty') /  @lang('rma::app.shop.table-heading.order-qty')
                                                </x-admin::table.th>

                                                <x-admin::table.th>
                                                    @lang('rma::app.shop.table-heading.resolution-type')
                                                </x-admin::table.th>

                                                <x-admin::table.th>
                                                    @lang('rma::app.shop.table-heading.reason')
                                                </x-admin::table.th>
                                        </x-admin::table.thead.tr>
                                    </x-admin::table.thead>

                                    <tbody>
                                        @foreach($productDetails as $key => $prodDetail)
                                            @foreach($prodDetail->getOrderItem as $orderItem)
                                                <x-admin::table.thead.tr class="hover:bg-gray-50 dark:hover:bg-gray-950">
                                                    <!-- Product Name -->
                                                    <x-admin::table.td class="dark:text-gray-300">
                                                        @if (empty($orderItem->product->images->pluck('path')['0']))
                                                            <div class="w-[60px] h-[60px] max-w-[60px] max-h-[60px] relative border border-dashed border-gray-300 dark:border-gray-800 rounded-[4px] dark:invert dark:mix-blend-exclusion">
                                                                <img 
                                                                    src="{{ asset('themes/admin/default/build/assets/front-93490c30.svg') }}" 
                                                                    alt="Sample Images" 
                                                                    target="new"
                                                                >
                                                                <p class="w-full absolute bottom-[5px] text-[6px] text-gray-400 text-center font-semibold">
                                                                    @lang('admin::app.dashboard.index.product-image')
                                                                </p>
                                                            </div>

                                                            <a 
                                                                target="_blank" 
                                                                class="text-blue-600 hover:underline" 
                                                                href="{{ route('shop.product_or_category.index', $orderItem->product->url_key) }}"
                                                            >  
                                                                {!! $orderItem['name'] !!}
                                                                {!! app('Webkul\RMA\Helpers\Helper')->getOptionDetailHtml($orderItem->additional['attributes'] ?? []) !!}
                                                            </a>
                                                        @else 
                                                            <a 
                                                                target="new" 
                                                                href="{{ asset('storage/' . $orderItem->product->images->pluck('path')['0']) }}"
                                                            >
                                                                <img 
                                                                    src="{{ asset('storage/'. $orderItem->product->images->pluck('path')['0']) }}" 
                                                                    alt="Sample Images" 
                                                                    target="new" 
                                                                    class="w-[60px] h-[60px] max-w-[60px] max-h-[60px] cursor-pointer shadow-2xl border"
                                                                >
                                                            </a>

                                                            <a 
                                                                target="_blank" 
                                                                class="text-blue-600 hover:underline" 
                                                                href="{{ route('shop.product_or_category.index', $orderItem->product->url_key) }}"
                                                            >  
                                                                {!! $orderItem['name'] !!}
                                                                {!! app('Webkul\RMA\Helpers\Helper')->getOptionDetailHtml($orderItem->additional['attributes'] ?? []) !!}
                                                            </a>
                                                        @endif
                                                    </x-admin::table.td>

                                                    <!-- Sku -->
                                                    <x-admin::table.td class="dark:text-gray-300">
                                                        @if ($orderItem['type'] == 'configurable')

                                                            @foreach ($sku as $k => $parentID)
                                                                @if (! empty($parentID['parent_id'])
                                                                    && $parentID['parent_id'] == $orderItem['id']
                                                                    )
                                                                    {!! $parentID['sku'] !!}
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            {!! $orderItem['sku'] !!}
                                                        @endif
                                                    </x-admin::table.td>

                                                    <!-- Price -->
                                                    <x-admin::table.td class="dark:text-gray-300">
                                                        {{ core()->formatBasePrice($orderItem['price']) }}
                                                    </x-admin::table.td>

                                                    <!-- RMA Quantity -->
                                                    <x-admin::table.td class="dark:text-gray-300">
                                                        {!! $prodDetail['quantity'] !!} / {{ $orderItem->qty_ordered }}
                                                    </x-admin::table.td>

                                                    <!-- Resolution -->
                                                    <x-admin::table.td class="dark:text-gray-300">
                                                        {!! ucwords($prodDetail['resolution']) !!}
                                                    </x-admin::table.td>

                                                    <!-- Reasons -->
                                                    <x-admin::table.td class="dark:text-gray-300">
                                                        {!! wordwrap($prodDetail->getReasons->title, 15, "<br>\n") !!}
                                                    </x-admin::table.td>
                                                </x-admin::table.thead.tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </x-admin::table>
                            </div>
                        </div>

                        <div class="p-3 border rounded-lg">
                            <div class="my-2 text-xl font-medium">
                                @lang('rma::app.admin.sales.rma.all-rma.view.conversations')
                            </div>
                            <div
                                class="mb-3"
                                :class="! messages.length ? 'flex justify-center items-center' : ''"
                            >
                                <div
                                    v-if="messages.length"
                                    v-for="message in messages"
                                    :class="message.is_admin != 1 
                                        ? 'text-left bg-gray-400 text-black dark:bg-gray-900 dark:text-gray-300' 
                                        : 'text-right bg-gray-100 text-black dark:bg-gray-800 dark:text-gray-300'"

                                    class="mb-3 rounded-md"
                                >
                                    <div class="title">
                                        @lang('rma::app.shop.conversation-texts.by')
                                            <strong v-if="message.is_admin == 1">
                                                @lang('rma::app.shop.view-customer-rma.admin')
                                            </strong>
                                            <strong v-else>
                                               {{ $orderDetails->customer_first_name }} {{ $orderDetails->customer_last_name }}
                                            </strong>
                                        @lang('rma::app.shop.conversation-texts.on')

                                        @{{ dateFormat( message.created_at) }}
                                    </div>

                                    <div
                                        class="text-base font-medium value dark:text-black-300"
                                        style="margin-top:10px; word-break: break-all;"
                                        v-html="message.message"
                                    >
                                    </div>

                                    <hr v-if="message.attachment"/>

                                    <a 
                                        v-if="message.attachment"
                                        class="text-base font-normal cursor-pointer icon-attribute dark:text-black-300"
                                    >
                                        <span class="ml-2 text-base hover:underline">
                                            @{{ message.attachment }}
                                        </span>
                                    </a>
                                    
                                    <hr class="my-2" />
                                </div>

                                <div v-else>
                                    <div
                                        class="icon-sales"
                                        style="font-size:150px; color:#d7d7d7;"
                                        >
                                    </div>

                                    <p class="flex justify-center text-gray-300">@lang('rma::app.admin.sales.rma.all-rma.view.no-record')</p>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </script>

        <script type="module">
            app.component('v-admin-rma-view', {
                template: '#v-admin-rma-view-template',

                data() {
                    return {
                        error: false,
                        closeRmaChecked: false,
                        messages: [],
                        message: '',
                        isSent: false,
                        rma: @json($rmaData),
                        limit: 5,
                        allowedFileTypes: @json(core()->getConfigData('sales.rma.setting.allowed-file-extension')),
                    };
                },

                mounted() {
                    this.getMessage();
                },

                computed: {
                    allowedFileTypesArray() {
                       return this.allowedFileTypes.split(",").map(extension => extension.trim());
                    }
                },

                methods: {
                    getMessage() {
                        this.$axios.get(`{{ route('admin.sales.rma.get-messages') }}`, {
                            params: {
                                id: this.rma.id,
                                limit: this.limit,
                            }
                        })
                        .then(response => {
                            this.messages =  response.data.messages.data;
                        }).catch(error => {
                        });
                    },

                    chatSubmit(params, { resetForm, setErrors  }) {
                        this.isSent = true;

                        let formData = new FormData(this.$refs.adminChatForm);
                        
                        // Sanitize the message input
                        const messageInput = formData.get('message');

                        const sanitizedMessage = this.sanitizeInput(messageInput);
                        
                        formData.set('message', sanitizedMessage);

                        this.$axios.post("{{ route('admin.sales.rma.send-message') }}", formData)
                            .then((response) => {
                                const attachmentPreview = document.getElementById('attachmentPreview');

                                attachmentPreview.innerHTML = '';
                                
                                this.$emitter.emit('add-flash', { type: 'success', message: response.data.message });

                                this.getNewMessage();

                                resetForm();

                                this.isSent = false;
                            })
                            .catch (error => {
                            });
                    },

                    sanitizeInput(input) {
                        const tempDiv = document.createElement('div');

                        tempDiv.textContent = input;
                        
                        return tempDiv.innerHTML;
                    },

                    viewAttachmentModal(messagePath) {
                        this.messagePath = messagePath;

                        this.getAttachmentExtension = messagePath.split('.').pop().toLowerCase();

                        this.$refs.attachmentModal.toggle();
                    },

                    downloadAttachment(messagePath) {
                        const imageUrl = `{{ config('app.url') }}/storage/${messagePath}`;

                        const link = document.createElement('a');

                        link.href = imageUrl;

                        link.download = imageUrl.split('/').pop();

                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    },

                    getNewMessage() {
                        this.limit += 5;

                        this.getMessage();
                    },

                    resetForm() {
                        this.message = '';
                    },

                    dateFormat(v) {
                        let date = new Date(v);

                        return date.getFullYear() + '-' + (date.getMonth() + 1) + '-' +  date.getDate() + ' ' + date.getHours() + ':' + date.getMinutes();
                    },

                    handleFileSelect($event) {
                        const attachmentPreview = document.getElementById('attachmentPreview');

                        attachmentPreview.innerHTML = '';

                        const files = event.target.files;

                        const fileNames = Array.from(files).map(file => file.name);

                        console.log(this.allowedFileTypesArray);
                        if (this.allowedFileTypesArray.length) {
                            const fileExtensions = Array.from(files).map(file => {
                                const fileName = file.name;
                                const extension = fileName.slice(fileName.lastIndexOf('.') + 1);

                                return extension;
                            });

                            const hasAllowedFileType = fileExtensions.some(extension =>
                                this.allowedFileTypesArray.includes(extension.trim())
                            );

                            console.log(hasAllowedFileType);
                            if (! hasAllowedFileType) {
                                this.$emitter.emit('add-flash', {
                                    type: 'warning',
                                    message: "@lang('rma::app.admin.configuration.index.sales.rma.allowed-file-types')"
                                });

                                event.target.value = '';

                                return;
                            }
                        }

                        const fileParagraph = document.createElement('p');

                        fileParagraph.classList.add('attachmentPreview');

                        fileParagraph.classList.add('border', 'p-3', 'my-2', 'rounded-md');

                        fileParagraph.innerHTML = fileNames;

                        const removeButton = document.createElement('button');

                        removeButton.classList.add('removeFile');
                        
                        removeButton.classList.add('text-blue-600');

                        removeButton.textContent = "@lang('admin::app.catalog.products.edit.remove')";
                        
                        removeButton.style.float = 'right';

                        removeButton.addEventListener('click', function() {
                            attachmentPreview.innerHTML = '';

                            event.target.value = '';
                        });

                        fileParagraph.appendChild(removeButton);

                        attachmentPreview.appendChild(fileParagraph);
                    },

                    printPage() {
                        this.$emitter.emit('open-confirm-modal', {
                            agree: () => {
                                const printContents = this.$refs.printContent.innerHTML;
                                const originalContents = document.body.innerHTML;

                                document.body.innerHTML = printContents;
                                window.print();

                                document.body.innerHTML = originalContents;
                                window.location.reload();
                            }
                        });
                    },
                }
            })
        </script>
    @endpush
</x-admin::layouts>
