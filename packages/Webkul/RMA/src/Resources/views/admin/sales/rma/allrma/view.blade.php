<x-admin::layouts>
    <!-- Title of the page --> 
    <x-slot:title>
        @lang('rma::app.admin.sales.rma.all-rma.view.title', ['id' => $rmaData->id])
    </x-slot>

    @php  
        $currentDate = \Carbon\Carbon::now();
                
        $expiredays = intval(core()->getConfigData('sales.rma.setting.default_allow_days'));
            
        $newDateTime = \Carbon\Carbon::parse($rmaData->created_at);
            
        $DeferenceInDays = $currentDate->diffInDays($newDateTime);
            
        $checkDateExpires = false;
            
        if ($DeferenceInDays > $expiredays && $DeferenceInDays != 0 ){
            $checkDateExpires = true;
        }
    @endphp

    <div class="flex items-center justify-between gap-[16px] max-sm:flex-wrap">
        <div class="flex items-center gap-[10px]">
            <!-- Title of the page --> 
            <p class="text-[20px] font-bold leading-[24px] text-gray-800 dark:text-white">
                @lang('rma::app.admin.sales.rma.all-rma.view.view-title')
            </p>
        </div>

        <!-- Back Button -->
        <a href="{{ route('admin.sales.rma.index') }}"
            class="transparent-button hover:bg-gray-200 dark:text-white dark:hover:bg-gray-800">
            @lang('admin::app.customers.customers.view.back-btn')
        </a>
    </div>

    <!-- Body content -->
    <div class="mt-[14px] flex gap-[10px] text-center max-xl:flex-wrap">
        <!-- Left sub-component -->
        <div class="flex flex-1 flex-col gap-[8px] max-xl:flex-auto">
            <!-- RMA details component -->
            <div class="box-shadow rounded-[4px] bg-white dark:bg-gray-900">
                <div class="flex justify-between p-[16px]">
                    <p class="p-[16px] pb-0 text-[16px] font-semibold text-gray-800 dark:text-white">
                        @lang('rma::app.admin.sales.rma.all-rma.view.view-title') {{ '#'.$rmaData['id'] }}
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <x-table>
                        <!-- Request On --> 
                        <x-table.tr>
                            <x-table.td>
                                @lang('rma::app.admin.sales.rma.all-rma.view.request-on')
                            </x-table.td>

                            <x-table.td>
                                {{ date("F j, Y, h:i:s A" ,strtotime($rmaData['created_at'])) }}    
                            </x-table.td>
                        </x-table.tr>

                        <!-- Order Id --> 
                        <x-table.tr>
                            <x-table.td>
                                @lang('rma::app.admin.sales.rma.all-rma.view.order-id')
                            </x-table.td>

                            <x-table.td>
                                <a
                                    href="{{ route('admin.sales.orders.view',$rmaData['order_id']) }}"
                                    target="_blank"
                                >
                                    {{ '#'.$rmaData['order_id'] }}
                                </a>
                            </x-table.td>
                        </x-table.tr>
                        
                        <!-- Customer Name --> 
                        <x-table.tr>
                            <x-table.td>
                                @lang('rma::app.admin.sales.rma.all-rma.view.customer')
                            </x-table.td>

                            <x-table.td>
                                {{ $orderDetails->customer_first_name }} {{ $orderDetails->customer_last_name }}    
                            </x-table.td>
                        </x-table.tr>

                        <!-- Resolution Type --> 
                        <x-table.tr>
                            <x-table.td>
                                @lang('rma::app.admin.sales.rma.all-rma.view.resolution-type')
                            </x-table.td>

                            <x-table.td>
                                {{ $rmaData['resolution'] }}  
                            </x-table.td>
                        </x-table.tr>

                        <!-- Additional Information --> 
                        <x-table.tr>
                            <x-table.td>
                                @lang('rma::app.admin.sales.rma.all-rma.view.additional-information')
                            </x-table.td>
                            
                            <x-table.td>
                                {!! wordwrap($rmaData['information'],99,"<br>\n") !!}   
                            </x-table.td>
                        </x-table.tr>

                        <x-table.tr>
                            <x-table.td>
                                @lang('rma::app.admin.sales.rma.all-rma.view.images')
                            </x-table.td>
                            
                            <x-table.td>
                                @foreach($rmaImages as $image)
                                    <img  src="{{ Storage::url($image->path) }}">
                                @endforeach  
                            </x-table.td>
                        </x-table.tr>
                    </x-table>
                </div>
            </div>

            <!-- Order details component -->
            <div class="box-shadow mt-[24px] rounded bg-white dark:bg-gray-900">
               
                <div class="flex justify-between p-[16px]">
                    <p class="p-[16px] pb-0 text-[16px] font-semibold text-gray-800 dark:text-white">
                        @lang('rma::app.admin.sales.rma.all-rma.view.order-details')
                    </p>
                </div>

                <div class="mt-[15px] overflow-x-auto">
                    <x-admin::table>
                        <x-admin::table.thead class="text-[14px] font-medium dark:bg-gray-800">
                            @php($lang = Lang::get('rma::app.shop.table-heading'))

                            <x-admin::table.thead.tr>
                                @foreach($lang as $languageFile)
                                
                                <x-admin::table.th>
                                    {{ $languageFile }}
                                </x-admin::table.th>
                                
                                @endforeach
                            </x-admin::table.thead.tr>
                        </x-admin::table.thead>

                        <tbody>
                            @foreach($productDetails as $key => $prodDetail)
                                @foreach($prodDetail->getOrderItem as $orderItem)
                                    <x-admin::table.thead.tr class="hover:bg-gray-50 dark:hover:bg-gray-950">
                                        <x-admin::table.td>
                                            {!! $orderItem['name'] !!}

                                            {!! app('Webkul\RMA\Helpers\Helper')->getOptionDetailHtml($orderItem->additional['attributes'] ?? []) !!}
                                        </x-admin::table.td>
                                
                                        <x-admin::table.td>
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

                                        <x-admin::table.td>
                                            {!! $orderItem['price'] !!}
                                        </x-admin::table.td>

                                        <x-admin::table.td>
                                            {!! $prodDetail['quantity'] !!}
                                        </x-admin::table.td>

                                        <x-admin::table.td>
                                            {!! wordwrap($prodDetail->getReasons->title, 15, "<br>\n") !!}
                                        </x-admin::table.td>
                                    </x-admin::table.thead.tr>    
                                @endforeach
                            @endforeach
                        </tbody>
                    </x-admin::table>
                </div>
            </div>

            <!--Send message-->
            <x-admin::accordion>
                <x-slot:header>
                    <p class="p-[16px] pb-0 text-[16px] font-semibold text-gray-800 dark:text-white">
                        @lang('rma::app.admin.sales.rma.all-rma.view.conversations')
                    </p>
                </x-slot:header>

                <x-slot:content>
                    @foreach($adminMessages as $key => $message)
                        <div class="title" style="text-[14px] font-medium; word-break: break-all; text-align:{{ $message->is_admin ? 'right' : 'left' }}">
                            @lang('rma::app.shop.conversation-texts.by')
                            
                                <strong>
                                    @if ($message->is_admin == 1)
                                        @lang('rma::app.shop.view-customer-rma.you')
                                    @else
                                        @lang('rma::app.shop.conversation-texts.customer') , {{ $orderDetails->customer_first_name }} {{ $orderDetails->customer_last_name }}
                                    @endif
                                </strong>, @lang('rma::app.shop.conversation-texts.on')
                            {{ date("F j, Y, h:i:s A" ,strtotime($message['created_at'])) }}
                        </div>
                        
                        <div class="value" style="text-[14px] font-medium; word-break: break-all;text-align:{{ $message->is_admin ? 'right' : 'left' }}">
                            {{ $message['message'] }}
                        </div><br>
                    @endforeach                                   
               
                    <div class="mt-2">
                        {!! $adminMessages->links('pagination::tailwind') !!}
                    </div>
                
                    <x-admin::form
                        :action="route('admin.sales.rma.send_message')"
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
                            <x-shop::form.control-group.label  class="required flex">
                                @lang('rma::app.admin.sales.rma.all-rma.view.send-message')
                            </x-shop::form.control-group.label>
                            
                            <x-admin::form.control-group.control
                                type="textarea"
                                name="message"
                                id="message"
                                rules="required"
                                :label="trans('rma::app.admin.sales.rma.all-rma.view.enter-message')"
                                :placeholder="trans('rma::app.admin.sales.rma.all-rma.view.enter-message')"
                            >
                            </x-admin::form.control-group.control>

                            <x-admin::form.control-group.error
                                control-name="message"
                            >
                            </x-admin::form.control-group.error>
                        </x-admin::form.control-group>

                        <button 
                            type="submit" 
                            class="primary-button"
                        >
                            @lang('rma::app.admin.sales.rma.all-rma.view.send-message-btn')
                        </button>
                    </x-admin::form> 
                </x-slot:content>  
            </x-admin::accordion>
        </div>

        <!-- Right sub-component -->
        <div class="flex w-[360px] max-w-full flex-col gap-[8px] max-sm:w-full">
            <!-- RMA and order status -->
            <x-admin::accordion>
                <x-slot:header>
                    <p class="p-[10px] text-[16px] font-semibold text-gray-600 dark:text-gray-300">
                        @lang('rma::app.admin.sales.rma.all-rma.view.status')
                    </p>
                </x-slot:header>
                
                <!-- RMA status -->
                <x-slot:content>
                    <div class="flex w-full justify-start gap-[20px]">
                        <div class="flex flex-col gap-y-[6px]">
                            <p class="text-gray-600 dark:text-gray-300">
                                @lang('rma::app.admin.sales.rma.all-rma.view.rma-status')
                            </p>    

                            <!-- Order status -->
                            <p class="text-gray-600 dark:text-gray-300">
                                @lang('rma::app.admin.sales.rma.all-rma.view.order-status')
                            </p>
                        </div>

                        <div class="flex flex-col gap-y-[6px]">
                            <p class="font-semibold text-blue-600 transition-all">
                                <span  @if ($rmaData['status'] == 1) class="hidden" @endif>
                                    @if (
                                        empty($rmaData['rma_status'])
                                        || $rmaData['rma_status'] == 'Pending'
                                    )
                                        <span id="tag" class="label-pending">
                                            @lang('rma::app.status.status-name.pending')
                                        </span>

                                    @elseif ($rmaData['rma_status'] == 'Received Package')
                                        @if ($rmaData['status'] != 1)
                                            <span class="label-closed">
                                                @lang('rma::app.status.status-name.received-package')
                                            </span>
                                        @else
                                            <span class="label-active">
                                                @lang('rma::app.status.status-name.solved')
                                            </span>
                                        @endif

                                    @elseif ($rmaData['rma_status'] == 'Item Canceled')
                                        <span class="label-cancelled">
                                            @lang('rma::app.status.status-name.item-canceled')
                                        </span>
                                        
                                    @elseif ($rmaData['rma_status'] == 'Declined')
                                        <span class="label-cancelled">
                                            {{ $rmaData['rma_status'] }}
                                        </span>

                                    @elseif ($rmaData['rma_status'] == 'Not Receive Package yet')
                                        <span class="label-pending">
                                            @lang('rma::app.status.status-name.not-received-package-yet')
                                        </span>
                                        
                                    @elseif ($rmaData['rma_status'] == 'Dispatched Package')
                                        <span class="label-pending">
                                            @lang('rma::app.status.status-name.dispatched-package')
                                        </span>
                                    @elseif ($rmaData['rma_status'] == 'Accept')
                                        <span class="label-active">
                                            @lang('rma::app.status.status-name.accept')
                                        </span>
                                    @else
                                        <span class="label-active">
                                            @lang('rma::app.status.status-name.solved')
                                        </span>
                                    @endif
                                </span>
                                
                                <!-- Status solved -->
                                <span  @if ($rmaData['status'] == 0) class="hidden" @endif>
                                    <span style="border-radius:35px; padding: 1px 6px; background-color:#00796B; color: white;" class="tagbutton">
                                        @lang('rma::app.status.status-name.solved') 
                                    </span>
                                </span>
                            </p>

                            <p class="text-gray-600 dark:text-gray-300">
                                <span
                                    @if ($rmaData['order_status'] == 'Delivered')
                                        style="border-radius:35px; padding: 1px 6px; background-color:#2E7D32; color: white;"
                                    @else
                                        class="label-cancelled"
                                    @endif
                                >
                                    {{ $rmaData['order_status'] }}
                                </span>
                            </p>
                        </div>
                    </div>
                </x-slot:content>
            </x-admin::accordion>

            <!-- RMA change status-->
            <x-admin::accordion>
                @php($statusArr = [])
                @if ($rmaData['rma_status'] == 'Item Canceled' 
                    || $rmaData['rma_status'] == 'Declined')
                    
                    @php($flag = 0)
                @elseif ($rmaData['status'] == 1 
                    && $rmaData['resolution'] == 'Replace')
                    
                    @php($flag = 0)
                @elseif ($rmaData['resolution'] == 'Return' 
                    && $rmaData['status'] == 1)
                
                    @php($flag = 0)
                @else
                    @php($flag = 1)
                @endif

                @if (! empty($flag) 
                    && $flag == 1 
                    && $rmaData['status'] == 0)

                    <x-slot:header>
                        <p class="p-[10px] text-[16px] font-semibold text-gray-600 dark:text-gray-300">
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

                            <x-admin::form.control-group class="mb-[10px] w-full">
                                <x-admin::form.control-group.control
                                    type="select"
                                    name="rma_status"
                                    id="orderItem"
                                > 
                                    @if ($createdInvoiceItems != 0)
                                        @php($statusArr = [
                                            'Pending', 
                                            'Not Receive Package yet', 
                                            'Received Package', 
                                            'Dispatched Package', 
                                            'Declined', 
                                            'Accept'
                                        ]);
                                        
                                        @foreach ($statusArr as $status)
                                            <option value="{{ $status }}" {{ $rmaData['rma_status'] == $status ? 'selected' : '' }}>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    @endif
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
                @endif

                @if (($rmaData['status'] == 1 
                    && $rmaData['resolution'] == 'Replace')
                    
                    || $rmaData['rma_status'] == 'Item Canceled'
                    || $rmaData['resolution'] == 'Return'
                    && $rmaData['status'] == 1 
                    || $rmaData['status'] == 1
                    && $rmaData['rma_status'] != 'Declined')
                    
                    <x-slot:header>
                        <p class="p-[10px] text-[16px] font-semibold text-gray-600 dark:text-gray-300">
                            @lang('rma::app.shop.view-customer-rma.change-rma-status')
                        </p>
                    </x-slot:header>

                    <x-slot:content>
                        <x-admin::form
                            :action="route('admin.sales.rma.save.status')"
                        >
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
        </div>
    </div>
</x-admin::layouts>
