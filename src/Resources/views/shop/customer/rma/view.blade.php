<x-shop::layouts.account>
    <!-- Title of the page -->
    <x-slot:title>
        @lang('rma::app.shop.customer.title')
    </x-slot>

    <!-- Breadcrumbs -->
    @section('breadcrumbs')
        <x-shop::breadcrumbs name="rma.view"></x-shop::breadcrumbs>
    @endSection

    <div class="mx-4">
        <x-shop::layouts.account.navigation />
    </div>
    
    @php
        $show = true;
        
        if (
            is_null($rmaData['rma_status'])
            || $rmaData['rma_status'] == 'Received Package'
            || $rmaData['rma_status'] == 'Solved'
        ) {
            if ($rmaData['status'] == 1) {
                $show = false;
            }
        } else if (
            $rmaData['rma_status'] == 'Item Canceled'
            || $rmaData['rma_status'] == 'Declined'
            || $rmaData['rma_status'] == 'Canceled'
            || $rmaData['order']['status'] == 'canceled' 
            || $rmaData['order']['status'] == 'closed'
        ) {
            $show = false;
        } 
        
        $currentDate = \Carbon\Carbon::now();

        $expiredays = intval(core()->getConfigData('sales.rma.setting.default_allow_days'));

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

    <div class="flex-auto mx-4 max-md:mx-6 max-sm:mx-4">
        <div class="flex items-center mb-8 max-md:mb-5">
            <h2 class="text-2xl font-medium max-md:text-xl max-sm:text-base ltr:ml-2.5 md:ltr:ml-0 rtl:mr-2.5 md:rtl:mr-0">
                @lang('rma::app.admin.sales.rma.all-rma.index.datagrid.id') {{ '#'.$rmaData['id'] }}
            </h2>
        </div>

        <!-- Item(s) Requested for RMA -->
        <div class="flex items-center justify-between mt-8">
            <h2 class="text-xl font-medium">
                @lang('rma::app.shop.view-customer-rma.heading')
            </h2>
        </div>
    
        <div class="mt-5 grid gap-5 max-1060:grid-cols-[1fr] max-md:mt-5">
            <!-- Rma information -->
            <div class="relative mt-4 overflow-x-auto border rounded-xl">
                <x-table>
                    <div class="grid grid-cols-1 mt-4">
                    <!-- Request On -->
                        <div class="grid w-full grid-cols-[2fr_3fr] px-8 py-3">
                            <p class="text-base font-medium">
                                @lang('rma::app.shop.view-customer-rma-content.request-on')
                            </p>
    
                            <p class="text-base font-medium text-[#6E6E6E]">
                                {{ date("F j, Y, h:i:s A" ,strtotime($rmaData['created_at'])) }}
                            </p>
                        </div>
    
                        <!-- Order Id -->
                        <div class="grid w-full grid-cols-[2fr_3fr] px-8 py-3">
                            <p class="text-base font-medium">
                                @lang('rma::app.shop.view-customer-rma.order-id')
                            </p>
    
                            <p class="text-base font-medium text-[#2633aa] hover:underline">
                                @if (!session()->get('guestEmail'))
                                    <a
                                        href="{{ route('shop.customers.account.orders.view', $rmaData['order_id']) }}"
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
                                        {{ $rmaAdditionalFieldValue }} :
                                    </p>
                                    
                                    <p class="text-base font-medium text-[#6E6E6E]">
                                        {{ $key }}
                                    </p>
                                </div>
                            @endforeach
                        @endif
    
                        <!-- Additional Information -->
                        @if (! empty($rmaData['information']))
                            <div class="grid w-full grid-cols-[2fr_3fr] px-8 py-3">
                                <p class="text-base font-medium">
                                    @lang('rma::app.shop.view-customer-rma.additional-information')
                                </p>
    
                                <p class="text-base font-medium text-[#6E6E6E]">
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
    
                                <p class="flex gap-1" style="max-width: 150px;">
                                    @foreach ($rmaImages as $images)
                                        <a
                                            href="{{ Storage::url($images['path']) }}"
                                            target="_blank"
                                        >
                                            <img
                                                class="w-64 h-24 m-1 rounded box-shadow"
                                                src="{{ Storage::url($images['path']) }}"
                                            >
                                        </a>
                                    @endforeach
                                </p>
                            @endif
                        </div>
                    </div>
                </x-table>
            </div>

            <!-- Item(s) Requested for RMA -->
            <div class="flex items-center justify-between mt-8">
                <h2 class="text-xl font-medium">
                    @lang('rma::app.shop.view-customer-rma.items-request')
                </h2>
            </div>
    
            <!-- Order information -->
            <div class="relative mt-4 overflow-x-auto border rounded-xl">
                <x-table>
                    <x-table.thead>
                        @php($lang = Lang::get('rma::app.shop.table-heading'))
    
                        <x-table.tr>
                            <x-admin::table.thead.tr class="text-gray-500">
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
                        </x-table.tr>
                    </x-table.thead>
    
                    <x-table.tbody>
                        @foreach($productDetails as $key => $prodDetail)
                            @foreach($prodDetail->getOrderItem as $key => $orderItem)
                                <x-table.tr>
                                    <!-- Product Name -->
                                    <x-admin::table.td class="dark:text-gray-300">
                                        @if (empty($orderItem->product->images->pluck('path')['0']))
                                            <div class="w-[60px] h-[60px] max-w-[60px] max-h-[60px] relative border border-dashed border-gray-300 rounded-[4px]">
                                                <img 
                                                    src="{{ asset('themes/admin/default/build/assets/front-93490c30.svg') }}" 
                                                    alt="Sample Images" 
                                                    target="new"
                                                >
                                                <p class="w-full absolute bottom-[5px] text-[6px] text-gray-400 text-center font-semibold">
                                                    @lang('admin::app.dashboard.index.product-image')
                                                </p>
                                            </div>
    
                                            <br/>
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
    
                                            <br/>
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
                                        @endif
                                    </x-admin::table.td>
    
                                    <!-- SKU -->
                                    <x-table.td>
                                        <p style="width: 100px; max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: break-spaces;">
                                            @if ($orderItem['type'] == 'configurable')
                                                @foreach ($skus as $k => $sku)
                                                    @if (
                                                        ! empty($sku['parent_id'])
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
                                        
                                        <br/>
    
                                        {{ $orderItem->qty_ordered }}
                                    </x-table.td>
    
                                    <!-- Resolution -->
                                    <x-admin::table.td>
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
            <div class="flex items-center justify-between mt-8">
                <h2 class="text-xl font-medium">
                    @lang('rma::app.shop.view-customer-rma.status-details')
                </h2>
            </div>
    
            <div class="relative mt-4 overflow-x-auto border rounded-xl">
                <div class="grid grid-cols-1 mt-4">
                    <!-- RMA status -->
                    <div class="grid grid-cols-1 text-white">
                        <div class="grid grid-cols-[2fr_3fr] px-8  py-3">
                            <p class="text-base font-medium text-black">
                                @lang('rma::app.shop.view-customer-rma-content.rma-status')
                            </p>
    
                            <span @if ($rmaData['status'] == 1) class="hidden" @endif>
                                @if ($rmaData['rma_status'] == 'solved')
                                    <span class="py-1 label-active">
                                        @lang('rma::app.status.status-name.solved')
                                    </span>
                                @elseif(
                                    $rmaData['order']['status'] == 'canceled' 
                                    || $rmaData['order']['status'] == 'closed'
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
                                <span class="py-1 label-active">
                                    @lang('rma::app.status.status-name.solved')
                                </span>
                            </span>
                        </div>
    
                        <!-- order status -->
                        <div class="grid grid-cols-[2fr_3fr] px-8 py-3">
                            <p class="text-base font-medium text-black">
                                @lang('rma::app.shop.view-customer-rma-content.order-status')
                            </p>
    
                            <p
                                @if ($rmaData['order_status'] == '1') 
                                    class="pt-1 label-active"
                                @elseif (
                                        $rmaData['order']['status'] == 'canceled' 
                                        || $rmaData['order']['status'] == 'closed'
                                    )
                                    class="label-{{$rmaData['order']['status']}} pt-1"
                                @else 
                                    class="pt-1 label-info"
                                @endif
                            >
                                @if ($rmaData['order_status'] == '1')
                                    @lang('rma::app.shop.customer.delivered')
                                @elseif (
                                    $rmaData['order']['status'] == 'canceled' 
                                    || $rmaData['order']['status'] == 'closed'
                                )
                                    @lang('rma::app.shop.customer.'. $rmaData['order']['status'])
                                @else
                                    @lang('rma::app.shop.customer.undelivered')
                                @endif
                            </p>
                        </div>
    
                        @if (! $checkDateExpires)
                            @if (
                                $rmaData['status'] == 1
                                && $rmaData['rma_status'] != 'Declined'
                                && $rmaData['rma_status'] != 'Pending'
                            )
                                <div class="grid grid-cols-[2fr_3fr] px-8 py-3">
                                    <!-- Close RMA -->
                                    <p class="text-base font-medium text-black">
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
                                    <p  class="text-base font-medium text-black">
                                        @lang('rma::app.shop.view-customer-rma.close-rma')
                                    </p>
    
                                    <p class="text-base font-medium text-[#6E6E6E]">
                                        @lang('rma::app.status.status-quotes.solved-by-admin')
                                    </p>
                                </div>
                            @endif
    
                            @if ($rmaData['rma_status'] == 'Declined')
                                <div class="grid grid-cols-[2fr_3fr] px-8 py-3">
                                    <p class="text-base font-medium text-black">
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
    
            <option-wrapper></option-wrapper>
        </div>
    </div>
    
    @push('scripts')
        <script type="text/x-template" id="option-wrapper-template">
            @if (! $checkDateExpires)
                @if ($show)
                    <div class="relative px-8 py-4 mt-3 overflow-x-auto border rounded-xl">
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
                                            class="text-xs font-medium required"
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
                                        class="block py-3 m-0 text-base text-center primary-button w-max rounded-2xl px-11"
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
                        && $rmaData['rma_status'] == 'Canceled'
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
                                                data-vv-as="{{ trans('rma::app.shop.validation.close-rma') }}"
                                            >

                                            <label
                                                for="close_rma"
                                                class="text-xs font-medium required"
                                            >
                                                @lang('rma::app.shop.customer.create.reopen-request')
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
                @endif
            @endif

            <!-- Enter message -->
            <div class="mt-8">
                <p class="text-xl font-medium required">
                    @lang('rma::app.admin.sales.rma.all-rma.view.enter-message')
                </p>
            </div>

            <div class="relative p-2 mt-3 overflow-x-auto border rounded-xl">
                <div class="p-3 border rounded-lg">
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
                                    class="relative text-sm transparent-button hover:bg-gray-200"
                                >
                                    + @lang('rma::app.admin.sales.rma.all-rma.view.add-attachments')
                                
                                    <input 
                                        type="file" 
                                        id="file"
                                        class="absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer" 
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
                <div class="p-3 mt-2 border rounded-lg">
                    <div class="mt-2 mb-3 ml-3">
                        <p class="text-xl font-medium">
                            @lang('rma::app.shop.view-customer-rma.conversations')
                        </p>
                    </div>

                    <div
                        class="p-5 overflow-x-auto h-80"
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
                                        {{ auth()->guard('customer')->user()->name }}
                                    </strong>
                                @lang('rma::app.shop.conversation-texts.on')

                                @{{ dateFormat( message.created_at) }}
                            </div>

                            <div
                                class="mt-4 value"
                                v-html="message.message"
                            >
                            </div>

                            <hr v-if="message.attachment"/>

                            <a 
                                @click="viewAttachmentModal(message.attachment_path)"
                                v-if="message.attachment"
                                class="text-sm font-normal cursor-pointer icon-hamburger"
                            >
                                <span class="ml-2 text-sm cursor-pointer hover:underline">
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
                        <p class="text-lg font-bold text-gray-800">
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
                </x-shop::modal>
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
                        return this.allowedFileTypes.split(",").map(extension => extension.trim());
                    }
                },

                methods: {
                    getMessage() {
                        this.$axios.get(`{{ route('rma.customer.get-messages') }}`, {
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

                        // Sanitize the message input
                        const messageInput = formData.get('message');
                        
                        const sanitizedMessage = this.sanitizeInput(messageInput);
                        
                        formData.set('message', sanitizedMessage);

                        this.isChatSend = false; 
                        
                        this.$axios.post("{{ route('rma.customer.send-message') }}", formData)
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
                }
            })
        </script>
    @endpush
</x-shop::layouts.account>