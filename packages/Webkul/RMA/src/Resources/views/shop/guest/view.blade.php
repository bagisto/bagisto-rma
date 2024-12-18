<x-shop::layouts>
    <!-- Title of the page -->
    <x-slot:title>
        @lang('rma::app.shop.guest.view.title')
    </x-slot>

    @php
        $show = true;

        if (
            is_null($rmaData['rma_status'])
            || $rmaData['rma_status'] == 'Received Package'
        ) {
            if ($rmaData['status'] == 1) {
                $show = false;
            }
        } else if (
            $rmaData['rma_status'] == 'Item Canceled'
            || $rmaData['rma_status'] == 'Declined'
            || $rmaData['rma_status'] == 'canceled'
        ) {
            $show = false;
        }

        $currentDate = \Carbon\Carbon::now();

        $expiredays = intval(core()->getConfigData('sales.rma.setting.default_allow_days'));

        $orderCustomer = app('Webkul\Sales\Repositories\OrderRepository')->find(session()->get('guestOrderId'));

        $newDateTime = \Carbon\Carbon::parse($rmaData->created_at);

        $DeferenceInDays = $currentDate->diffInDays($newDateTime);

        $checkDateExpires = false;

        if (
            $DeferenceInDays > $expiredays
            && $DeferenceInDays != 0
        ) {
            $checkDateExpires = true;
        }

        $rmaStatusData = app('Webkul\RMA\Repositories\RMAStatusRepository')
            ->where('title', $rmaData['rma_status'])
            ->first();

        $rmaStatusColor = '';
        
        if ($rmaStatusData) {
            $rmaStatusColor = $rmaStatusData->color;
        }
    @endphp

    <div class="container mt-8 px-14 max-lg:px-8">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-medium">
                @lang('rma::app.admin.sales.rma.all-rma.index.datagrid.id') {{ '#'.$rmaData['id'] }}
            </h2>

            <a
                href="javascript:history.back();"
                class="secondary-button flex items-center gap-x-2 border-[#E9E9E9] px-5 py-3 font-normal"
            >
                @lang('shop::app.checkout.onepage.address.back')
            </a>
        </div>

        <!-- Item(s) Requested for RMA -->
        <div class="mt-8 flex items-center justify-between">
            <h2 class="text-xl font-medium">
                @lang('rma::app.shop.view-customer-rma.heading')
            </h2>
        </div>

        <!-- Rma information -->
        <div class="overflow-x-auto">
            <x-table>
                <!-- Request On -->
                <div class="grid w-full grid-cols-[2fr_3fr] px-8 py-3">
                    <p class="text-sm font-medium">
                        @lang('rma::app.shop.view-guest-rma-content.request-on')
                    </p>

                    <p class="text-sm font-medium text-[#6E6E6E]">
                        {{ date("F j, Y, h:i:s A" ,strtotime($rmaData['created_at'])) }}
                    </p>
                </div>

                <!-- Order Id -->
                <div class="grid w-full grid-cols-[2fr_3fr] px-8 py-3">
                    <p class="text-sm font-medium">
                        @lang('rma::app.shop.view-guest-rma.order-id')
                    </p>

                    <p class="text-sm font-medium text-[#6E6E6E]">
                        @if (!session()->get('guestEmail'))
                            <a
                                href="{{ route('rma.customers.all-rma', $rmaData['order_id']) }}"
                                target="_blank"
                            >
                                {{ '#'.$rmaData['order_id'] }}
                            </a>
                        @endif

                        @if (session()->get('guestEmail'))
                            {{ '#'.$rmaData['order_id'] }}
                        @endif
                    </p>
                </div>

                <!-- Additional Fields -->
                @if (! empty($rmaAdditionalFieldValues))
                    @foreach ($rmaAdditionalFieldValues as $key => $rmaAdditionalFieldValue)
                        <div class="grid w-full grid-cols-[2fr_3fr] px-8 py-3">
                            <p class="text-base font-medium">
                                {{ $key }} :
                            </p>

                            <p class="text-base font-medium text-[#6E6E6E]">
                                {{ $rmaAdditionalFieldValue }}
                            </p>
                        </div>
                    @endforeach
                @endif

                <!-- Additional Information -->
                @if (! empty($rmaData['information']))
                    <div class="grid w-full grid-cols-[2fr_3fr] px-8 py-3">
                        <p class="text-sm font-medium">
                            @lang('rma::app.shop.view-customer-rma.additional-information')
                        </p>

                        <p class="text-sm font-medium text-[#6E6E6E]">
                            {{ $rmaData['information'] }}
                        </p>
                    </div>
                @endif

                <!-- Images shown which is uploaded -->
                <div class="grid grid-cols-[2fr_3fr] px-8 py-3">
                    @if (
                        ! empty($rmaImages)
                        || count($rmaImages) > 0
                    )
                        <p class="text-base font-medium">
                            @lang('rma::app.shop.view-customer-rma.images')
                        </p>

                        <p class="flex gap-1" style="max-width:100px;">
                            @foreach ($rmaImages as $images)
                                <a
                                    href="{{ Storage::url($images['path']) }}"
                                    target="_blank"
                                >
                                    <img
                                        class="box-shadow m-1 h-24 w-64 rounded dark:bg-gray-800"
                                        src="{{ Storage::url($images['path']) }}"
                                    >
                                </a>
                            @endforeach
                        </p>
                    @endif
                </div>

                <!-- Item(s) Requested for RMA -->
                <div class="mt-8 flex items-center justify-between">
                    <h2 class="text-xl font-medium">
                        @lang('rma::app.shop.view-customer-rma.items-request')
                    </h2>
                </div>

                <!-- Order information -->
                <div class="relative mt-4 overflow-x-auto rounded-xl border">
                    <x-table>
                        <x-table.thead>
                            @php($lang = Lang::get('rma::app.shop.table-heading'))

                            <x-table.tr>
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
                            </x-table.tr>
                        </x-table.thead>

                        <x-table.tbody>
                            @foreach($productDetails as $key => $prodDetail)
                                @foreach($prodDetail->getOrderItem as $key => $orderItem)
                                    <x-table.tr>
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

                                        <!-- Product Name -->
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

                                        <!-- SKU -->
                                        <x-table.td>
                                            <p style="width: 100px; max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: break-spaces;">
                                                @if ($orderItem['type'] == 'configurable')
                                                    @foreach ($skus as $k => $sku)
                                                        @if (
                                                            isset($sku['parent_id'])
                                                            && $sku['parent_id'] == $orderItem['id']
                                                        )
                                                            {!! $sku['sku'] !!}
                                                        @endif
                                                    @endforeach
                                                @else
                                                    {!! $orderItem['sku'] !!}
                                                @endif
                                            </p>
                                        </x-table.td>

                                        <!-- Price -->
                                        <x-table.td>
                                            {!! $orderItem['price'] !!}
                                        </x-table.td>

                                        <!-- RMA Quantity -->
                                        <x-table.td>
                                            {!! $prodDetail['quantity'] !!}
                                        </x-table.td>

                                        <!-- Qty Ordered -->
                                        <x-admin::table.td class="dark:text-gray-300">
                                            {{ $orderItem->qty_ordered }}
                                        </x-admin::table.td>

                                        <!-- Resolution -->
                                        <x-admin::table.td class="dark:text-gray-300">
                                            {!! ucwords($prodDetail['resolution']) !!}
                                        </x-admin::table.td>

                                        <!-- Reason -->
                                        <x-table.td>
                                            {!! wordwrap($reasons[$key]->getReasons->title,15,"<br>\n") !!}
                                        </x-table.td>
                                    </x-table.tr>
                                @endforeach
                            @endforeach
                        </x-table.tbody>
                    </x-table>
                </div>

                <!-- Status detail of rma -->
                <div class="mt-8 flex items-center justify-between">
                    <h2 class="text-xl font-medium">
                        @lang('rma::app.shop.view-customer-rma.status-details')
                    </h2>
                </div>

                <div class="relative mt-4 overflow-x-auto rounded-xl border">
                    <div class="mt-4 grid grid-cols-1">
                        <!-- RMA status -->
                        <div class="grid grid-cols-1 text-white">
                            <div class="grid grid-cols-[2fr_3fr] px-8  py-3">
                                <p class="text-base text-black font-medium">
                                    @lang('rma::app.shop.view-customer-rma-content.rma-status')
                                </p>

                                @if (
                                    empty($rmaData['rma_status'])
                                    || $rmaData['rma_status'] == 'pending'
                                    || $rmaData['rma_status'] == 'Pending'
                                )

                                    <span id="tag" class="label-pending">
                                        @lang('rma::app.status.status-name.pending')
                                    </span>
                                @elseif ($rmaData['rma_status'] == 'Received Package')

                                    @if ($rmaData['status'] != 1)
                                        <span class="label-active">
                                            @lang('rma::app.status.status-name.received-package')
                                        </span>
                                    @else
                                        <span class="label-active">
                                            @lang('rma::app.status.status-name.solved')
                                        </span>
                                    @endif
                                @elseif ($rmaData['rma_status'] == 'Item Canceled')
                                    <span class="label-canceled">
                                        @lang('rma::app.status.status-name.item-canceled')
                                    </span>

                                @elseif ($rmaData['rma_status'] == 'canceled')
                                    <span class="label-canceled">
                                        @lang('rma::app.status.status-name.canceled')
                                    </span>

                                @elseif ($rmaData['rma_status'] == 'Declined')

                                    <span class="label-canceled">
                                        {{  $rmaData['rma_status'] }}
                                    </span>
                                @elseif ($rmaData['rma_status'] == 'Awaiting')

                                    <span class="label-pending">
                                        @lang('rma::app.status.status-name.awaiting')
                                    </span>
                                @elseif ($rmaData['rma_status'] == 'Dispatched Package')

                                    <span class="label-pending">
                                        @lang('rma::app.status.status-name.dispatched-package')
                                    </span>
                                @elseif ($rmaData['rma_status'] == 'Accept')

                                    <span class="label-active">
                                        @lang('rma::app.status.status-name.accept')
                                    </span>
                                @elseif ($rmaData['rma_status'] == 'solved')

                                    <span class="label-active">
                                        @lang('rma::app.status.status-name.solved')
                                    </span>
                                @else

                                    <span 
                                        class="label-active" 
                                        style="background: {{ $rmaStatusColor }}"
                                    >
                                        {{ $rmaData['rma_status'] }}
                                    </span>
                                @endif
                            </div>

                            <!-- order status -->
                            <div class="grid grid-cols-[2fr_3fr] px-8 py-3">
                                <p class="text-base text-black font-medium">
                                    @lang('rma::app.shop.view-customer-rma-content.order-status')
                                </p>

                                <p
                                    @if ($rmaData['order_status'] == '1') 
                                        class="label-active"
                                    @else 
                                        class="label-info"
                                    @endif
                                >
                                    @if ($rmaData['order_status'] == '1')
                                        @lang('rma::app.shop.customer.delivered')
                                    @else
                                        @lang('rma::app.shop.customer.undelivered')
                                    @endif
                                </p>
                            </div>

                            @if (! $checkDateExpires)
                                @if (
                                    $rmaData['status'] == 1
                                    && $rmaData['rma_status'] != 'Declined'
                                )
                                    <div class="grid grid-cols-[2fr_3fr] px-8 py-3">
                                        <!-- Close RMA -->
                                        <p class="text-base text-black font-medium">
                                            @lang('rma::app.shop.view-customer-rma.close-rma')
                                        </p>

                                        <!-- RMA solved -->
                                        <p class="text-base font-medium text-[#6E6E6E]">
                                            @lang('rma::app.status.status-quotes.solved')
                                        </p>
                                    </div>
                                @endif

                                <!-- RMA solved -->
                                @if ($rmaData['rma_status'] == 'Item Canceled')
                                    <div class="grid grid-cols-[2fr_3fr] px-8 py-3">
                                        <p  class="text-base text-black font-medium">
                                            @lang('rma::app.shop.view-customer-rma.close-rma')
                                        </p>

                                        <p class="text-base font-medium text-[#6E6E6E]">
                                            @lang('rma::app.status.status-quotes.solved-by-admin')
                                        </p>
                                    </div>
                                @endif

                                @if ($rmaData['rma_status'] == 'Declined')
                                    <div class="grid grid-cols-[2fr_3fr] px-8 py-3">
                                        <p class="text-base text-black font-medium">
                                            @lang('rma::app.shop.view-customer-rma.close-rma')
                                        </p>

                                        <p class="text-base font-medium text-[#6E6E6E]">
                                            @lang('rma::app.status.status-quotes.declined-admin')
                                        </p>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>

            </x-table>
        </div>

        <option-wrapper></option-wrapper>        
    </div>

    @push('scripts')
        <script type="text/x-template" id="option-wrapper-template">
            <div class="container mt-8 px-14 max-lg:px-8">
                @if (! $checkDateExpires)
                    @if ($show)
                        <div class="relative mt-3 overflow-x-auto rounded-xl border px-8 py-4">
                            <!-- Close rma if solved -->
                            <div class="mt-2">
                                <p class="text-xl font-medium">
                                    @lang('rma::app.shop.view-customer-rma.close-rma')
                                </p>
                            </div>

                            <div class="grid w-full py-3">
                                <x-shop::form
                                    @submit="validateForm"
                                    id="check-form"
                                    enctype="multipart/form-data"
                                    :action="route('rma.customer.save.rma-status')"
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
                                                class="required text-xs font-medium"
                                            >
                                                @lang('rma::app.shop.view-customer-rma.status-quotes')
                                            </label>

                                            <p
                                                v-if="error"
                                                style="color:red;"
                                            >
                                                @lang('rma::app.shop.view-customer-rma.term')
                                            </p>
                                        </div>

                                        <button
                                            type="submit"
                                            class="primary-button m-0 block w-max rounded-2xl px-11 py-3 text-center text-base"
                                            v-if="closeRmaChecked"
                                        >
                                            @lang('rma::app.shop.view-customer-rma.save-btn')
                                        </button>
                                    </div>
                                </x-shop::form>
                            </div>
                        </div>
                    @else
                        @if (
                            core()->getConfigData('sales.rma.setting.allowed-new-rma-request-for-cancelled-request') == 'yes' 
                            && $rmaData['rma_status'] == 'canceled'
                        )
                            <div class="relative mt-3 overflow-x-auto rounded-xl border px-8 py-4">
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
                                        :action="route('rma.guest.save.rma-reopen-status')"
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
                                                    class="required text-xs font-medium"
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
                                                class="primary-button m-0 block w-max rounded-2xl px-11 py-3 text-center text-base"
                                                v-if="closeRmaChecked"
                                            >
                                                @lang('rma::app.shop.view-customer-rma.save-btn')
                                            </button>
                                        </div>
                                    </x-shop::form>
                                </div>
                            </div>
                        @endif
                        
                        @if (
                            core()->getConfigData('sales.rma.setting.allowed-new-rma-request-for-declined-request') == 'yes' 
                            && $rmaData['rma_status'] == 'Declined'
                        )
                            <div class="relative mt-3 overflow-x-auto rounded-xl border px-8 py-4">
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
                                        :action="route('rma.customer.save.rma-reopen-status')"
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
                                                    class="required text-xs font-medium"
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
                                                class="primary-button m-0 block w-max rounded-2xl px-11 py-3 text-center text-base"
                                                v-if="closeRmaChecked"
                                            >
                                                @lang('rma::app.shop.view-customer-rma.save-btn')
                                            </button>
                                        </div>
                                    </x-shop::form>
                                </div>
                            </div>
                        @endif
                    @endif
                @endif

                <!-- Enter message -->
                <div class="mt-8 flex items-center justify-between">
                    <p class="required text-xl font-medium">
                        @lang('rma::app.admin.sales.rma.all-rma.view.enter-message')
                    </p>
                </div>

                <div class="relative mt-3 overflow-x-auto rounded-xl border p-2">
                    <div class="border rounded-lg p-3">
                        <x-shop::form
                            v-slot="{ meta, errors, handleSubmit }"
                            as="div"
                        >
                            <form
                                @submit="handleSubmit($event, chatSubmit)"
                                ref="chatForm"
                            >
                                <input
                                    type="hidden"
                                    name="is_admin"
                                    value="0"
                                />

                                <input
                                    type="hidden"
                                    name="rma_id"
                                    value="{{ $rmaData['id'] }}"
                                />

                                <x-shop::form.control-group>
                                    <div class="bg-white !pl-0 !pt-2">
                                        <x-shop::form.control-group.control
                                            type="textarea"
                                            name="message"
                                            class="!mb-1 px-5 py-5"
                                            rules="required"
                                            maxlength="250"
                                            v-model="message"
                                            ::disabled="!isChatSend"
                                        >
                                        </x-shop::form.control-group.control>

                                        <x-shop::form.control-group.error
                                            class="flex"
                                            control-name="message"
                                        >
                                        </x-shop::form.control-group.error>
                                    </div>
                                </x-shop::form.control-group>

                                <div class="mb-4">
                                    <button 
                                        type="button" 
                                        id="newFileInput"
                                        class="transparent-button text-sm hover:bg-gray-200 relative"
                                    >
                                        + @lang('rma::app.admin.sales.rma.all-rma.view.add-attachments')
                                    
                                        <input 
                                            type="file" 
                                            id="file"
                                            class="opacity-0 absolute top-0 left-0 w-full h-full cursor-pointer" 
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
                                        :disabled="!isChatSend"
                                    >
                                        <svg v-if="!isChatSend" aria-hidden="true" class="w-5 h-5 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                        </svg>
                                        
                                        @lang('rma::app.admin.sales.rma.all-rma.view.send-message-btn')
                                    </button>
                                </div>
                            </form>
                        </x-shop::form>
                    </div>

                    <!-- View conversations -->
                    <div class="border rounded-lg mt-2 p-3">
                        <div class="mb-3 ml-3 mt-2">
                            <p class="text-xl font-medium">
                                @lang('rma::app.shop.view-customer-rma.conversations')
                            </p>
                        </div>

                        <div
                            class="h-80 overflow-x-auto p-5"
                            @wheel="getNewMessage()"
                            :class="! messages.length ? 'flex justify-center items-center' : ''"
                        >
                            <div
                                v-if="messages.length"
                                v-for="message in messages"
                                class="rounded"
                                style="padding: 10px; margin: 10px;"
                                :style="message.is_admin == 1 ? 'text-align:left; background-color: #a7a7a7' : 'text-align:right; background-color: #F0F0F0'"
                            >
                                <div class="title">
                                    @lang('rma::app.shop.conversation-texts.by')
                                        <strong v-if="message.is_admin == 1">
                                            @lang('rma::app.shop.view-customer-rma.admin')
                                        </strong>
                                        <strong v-else>
                                            {{ $orderCustomer->customer_first_name }} {{ $orderCustomer->customer_last_name }}
                                        </strong>
                                    @lang('rma::app.shop.conversation-texts.on')

                                    @{{ dateFormat( message.created_at) }}
                                </div>

                                <div
                                    class="value"
                                    style="margin-top:10px; word-break: break-all;"
                                    v-html="message.message"
                                >
                                </div>

                                <hr v-if="message.attachment"/>

                                <a 
                                    @click="viewAttachmentModal(message.attachment_path)"
                                    v-if="message.attachment"
                                    class="icon-hamburger dark:text-black-300 text-sm font-normal cursor-pointer"
                                >
                                    <span class="text-sm hover:underline cursor-pointer ml-2">
                                        @{{ message.attachment }}
                                    </span>
                                </a>
                            </div>

                            <div v-else>
                                <div
                                    class="icon-listing"
                                    style="font-size:150px; color:#d7d7d7;"
                                >
                                </div>

                                <p class="flex justify-center text-gray-300">
                                    @lang('rma::app.shop.conversation-texts.no-record')
                                </p>
                            </div>
                        </div>
                    </div>
                    <x-shop::modal ref="attachmentModal">
                        <!-- Modal Header -->
                        <x-slot:header>
                            <p class="text-lg font-bold text-gray-800 dark:text-white">
                                @lang('rma::app.admin.sales.rma.all-rma.view.attachment')
                            </p>
                        </x-slot>

                        <!-- Modal Content -->
                        <x-slot:content>
                            {!! view_render_event('bagisto.admin.sales.rma.view.message.attachment.modal.content.before') !!}

                            <img 
                                v-if="messagePath"
                                :src="'{{ config('app.url') }}' + 'storage/' + messagePath"
                                class="min-h-[300px] min-w-[300px] max-h-[300px] max-w-[300px] rounded m-auto"
                            />

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
                    </x-shop::modal>
                </div>
            </div>
        </script>

        <script type="module">
            app.component('option-wrapper', {
                template: '#option-wrapper-template',

                inject: ['$validator'],

                data() {
                    return {
                        error: false,
                        closeRmaChecked: false,
                        isChatSend: true,
                        messages: {},
                        message: '',
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
                        return this.allowedFileTypes.split(",");
                    }
                },

                methods: {
                    getMessage() {
                        this.$axios.get(`{{ route('rma.guest.get-messages') }}`, {
                            params: {
                                id: this.rma.id,
                                limit: this.limit,
                            }
                        })
                        .then(response => {
                            this.messages = response.data.messages.data;
                            
                        }).catch(error => {
                        });
                    },

                    chatSubmit(params, { resetForm, setErrors  }) {
                        let formData = new FormData(this.$refs.chatForm);

                        const messageInput = formData.get('message');
                        const sanitizedMessage = this.sanitizeInput(messageInput);
                        formData.set('message', sanitizedMessage);

                        this.isChatSend = false; 
                        
                        this.$axios.post("{{ route('rma.guest.send-message') }}", formData)
                            .then((response) => {
                                const attachmentPreview = document.getElementById('attachmentPreview');

                                attachmentPreview.innerHTML = '';

                                this.$emitter.emit('add-flash', { type: 'success', message: response.data.messages });

                                this.getNewMessage();

                                resetForm();
                            });
                    },

                    sanitizeInput(input) {
                        const tempDiv = document.createElement('div');
                        tempDiv.textContent = input;
                        return tempDiv.innerHTML;
                    },

                    viewAttachmentModal(messagePath) {
                        this.messagePath = messagePath;

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

                        this.isChatSend = true; 
                    },

                    resetForm() {
                        this.message = '';
                    },

                    validateForm(scope) {
                        if (! this.closeRmaChecked) {
                            this.error = true;

                            return;
                        }

                        this.error = false;

                        document.getElementById('check-form').submit();

                        this.$validator.validateAll(scope).then((result) => {
                            if (result) {
                                if (scope == 'form-1') {
                                    document.getElementById('form-1').submit();
                                } else if (scope == 'form-2') {
                                    document.getElementById('form-2').submit();
                                }
                            }
                        });
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

                        if (this.allowedFileTypesArray.length) {
                            const fileExtensions = Array.from(files).map(file => {
                                const fileName = file.name;
                                const extension = fileName.slice(fileName.lastIndexOf('.') + 1);

                                return extension;
                            });

                            const hasAllowedFileType = fileExtensions.some(extension =>
                                this.allowedFileTypesArray.includes(extension)
                            );

                            if (! hasAllowedFileType) {
                                this.$emitter.emit('add-flash', {
                                    type: 'warning',
                                    message: "@lang('rma::app.admin.configuration.index.sales.rma.allowed-file-types')"
                                });

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
                }
            })
        </script>
    @endpush
</x-shop::layouts>