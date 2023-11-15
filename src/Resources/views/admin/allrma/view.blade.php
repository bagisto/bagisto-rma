<x-admin::layouts>

<x-slot:title>
        @lang('rma::app.admin.rma-tab-name.title', ['id' => $rmaData->id])
    </x-slot:title>


    <div class="content full-page">
        <div class="page-header">
            <div class="page-title">
                <h1>
                    <i class="icon angle-left-icon back-link"
                        onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/rma/requests') }}';"></i>
                    @lang('rma::app.shop.view-admin-rma.rma') {{ '#'.$rmaData['id'] }}
                </h1>
            </div>
        </div>

        <div class="page-content">
            <tabs>
                <tab name="{{ __('rma::app.admin.rma-tab-name.tab-content.information') }}" :selected="true">
                    <div class="sale-container">
                        <accordian :title="'{{ __('rma::app.admin.rma-tab-name.tab-content.rma-details') }}'" :active="true">
                            <div slot="body">
                                <div class="sale-section">
                                    <div class="section-content">
                                    <x-admin::table>
                                        <x-table.tr>
                                            <x-table.td>
                                                @lang('rma::app.shop.view-admin-rma-content.request-on')
                                            </x-table.td>
                                            <x-table.td>
                                                {{ date("F j, Y, h:i:s A" ,strtotime($rmaData['created_at'])) }}    
                                            </x-table.td>
                                        </x-table.tr>
                                    

                                        <x-table.tr>
                                            <x-table.td>
                                                @lang('rma::app.shop.view-admin-rma.order-id')
                                            </x-table.td>
                                            <x-table.td>
                                                <a href="{{ route('admin.sales.orders.view',$rmaData['order_id']) }}"
                                                    target="_blank">{{ '#'.$rmaData['order_id'] }}
                                                </a>
                                            </x-table.td>
                                        </x-table.tr>

                                        <x-table.tr>
                                            <x-table.td>
                                                @lang('rma::app.shop.view-admin-rma-content.customer')
                                            </x-table.td>
                                            <x-table.td>
                                                {{ $orderDetails->customer_first_name }} {{ $orderDetails->customer_last_name }}
                                            </x-table.td>
                                        </x-table.tr>

                                        <x-table.tr>
                                            <x-table.td>
                                                @lang('rma::app.shop.view-admin-rma.resolution-type')
                                            </x-table.td>
                                            <x-table.td>
                                                {{ $rmaData['resolution'] }}
                                            </x-table.td>
                                        </x-table.tr>

                                
                                
                                        @if(! empty($rmaData['information']))

                                        <x-table.tr>
                                            <x-table.td>
                                                @lang('rma::app.shop.view-admin-rma.additional-information')
                                            </x-table.td>
                                            <x-table.td>
                                                {!! wordwrap($rmaData['information'],99,"<br>\n") !!}
                                            </x-table.td>
                                        </x-table.tr>
                                        @endif

                                        @if(is_null($rmaImages) || count($rmaImages) > 0)
                                            <div class="sale-section">
                                                <div class="secton-title">
                                                    <span>
                                                        {{ __('rma::app.shop.view-customer-rma.images')  }}
                                                    </span>
                                                </div>
                                                <div class="section-content">
                                                    <div class="row">
                                                        <span class="value">

                                                            @foreach($rmaImages as $images)
                                                                <img @if(isset($rmaImages)) height="50px;" style="margin-right:20px;" src="{{  bagisto_asset('/storage/'.$images['path']) }}" @else src="" @endif style="max-width:70%;">
                                                            @endforeach
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </x-admin::table>
                                    </div>
                                </div>
                            </div>
                        </accordian>
                    </div>

                    <div class="sale-container">
                        <accordian :title="'{{ __('rma::app.admin.rma-tab-name.tab-content.status') }}'" :active="true">
                                <div slot="body">
                                    <div class="sale-section">
                                        <div class="section-content">
                                            <div class="flex  gap-[20px] justify-between items-center max-sm:flex-wrap">
                                                <span class="py-[11px] text-[15px] text-gray-800 dark:text-white font-bold">
                                                    @lang('rma::app.shop.view-admin-rma-content.rma-status')
                                                </span>
                                                    <span class="value" @if($rmaData['status'] == 1) style="display: none;" @endif>
                                                        @if (empty($rmaData['rma_status']) || $rmaData['rma_status']=='Pending')
                                                            <span id="tag" class="tagbutton" style="background-color:#FBC02D">
                                                                {{ __('rma::app.status.status-name.pending') }}</span>
                                                        @elseif ($rmaData['rma_status'] == 'Received Package')
                                                            @if ($rmaData['status'] != 1)
                                                                <span style="background-color:#1976D2" class="tagbutton">
                                                                    {{ __('rma::app.status.status-name.received_package') }}
                                                                </span>
                                                            @else
                                                                <span style="background-color:#00796B" class="tagbutton">
                                                                    {{ __('rma::app.status.status-name.solved') }}
                                                                </span>
                                                            @endif
                                                        @elseif ($rmaData['rma_status'] == 'Declined' && $rmaData['rma_status'] != 'Item Canceled')
                                                        <span style="background-color:#616161" class="tagbutton">
                                                                {{ __('rma::app.status.status-name.declined') }} </span>
                                                        @elseif ($rmaData['rma_status'] == 'Declined')
                                                            <span style="background-color:#00796B" class="tagbutton">
                                                                {{ __('rma::app.status.status-name.solved') }} </span>
                                                        @elseif ($rmaData['rma_status'] == 'Item Canceled')
                                                            <span style="background-color:#00796B" class="tagbutton">
                                                                {{ __('rma::app.status.status-name.item_canceled') }} </span>
                                                        @elseif ($rmaData['rma_status'] == 'Not Receive Package yet')
                                                            <span class="tagbutton" style="background-color:#FBC02D">
                                                                {{ __('rma::app.status.status-name.not_received_package_yet') }}
                                                            </span>
                                                        @elseif ($rmaData['rma_status'] == 'Dispatched Package')
                                                            <span class="tagbutton" style="background-color:#FBC02D">
                                                                {{ __('rma::app.status.status-name.dispatched_package') }}
                                                            </span>
                                                        @elseif ($rmaData['rma_status'] == 'Accept')
                                                            <span class="tagbutton" style="background-color:#125112">
                                                                {{ __('rma::app.status.status-name.accept') }}
                                                            </span>
                                                        @endif
                                                    </span>
                                                    <span class="value" @if($rmaData['status'] == 0) style="display:none;" @endif>
                                                        <span style="background-color:#00796B" class="tagbutton">
                                                            {{ __('rma::app.status.status-name.solved') }} </span>
                                                    </span>
                                                </div>

                                                <div class="flex  gap-[20px] justify-between items-center max-sm:flex-wrap">
                                                    <span class="py-[11px] text-[15px] text-gray-800 dark:text-white font-bold">
                                                        @lang('rma::app.shop.view-admin-rma-content.order-status')
                                                    </span>
                                                    <span
                                                        class="value tagbutton"
                                                        @if($rmaData['order_status'] == 'Delivered')
                                                            style="background-color:#2E7D32; color: white;"
                                                        @else
                                                            style="background-color:#d32f2f; color: white;"
                                                        @endif>
                                                        {{ $rmaData['order_status'] }}
                                                    </span>
                                                </div>
                                        </div>
                                    </div>

                                    @if($rmaData['rma_status'] == 'Item Canceled' || $rmaData['rma_status'] == 'Declined')
                                        @php($flag = 0)
                                    @elseif($rmaData['status'] == 1 && $rmaData['resolution'] == 'Replace')
                                        @php($flag = 0)
                                    @elseif($rmaData['resolution'] == 'Return' && $rmaData['status'] == 1)
                                        @php($flag = 0)
                                    @else
                                        @php($flag = 1)
                                    @endif

                                    @if(isset($flag) && $flag == 1 && $rmaData['status'] == 0)
                                        <div class="sale-section" >
                                            <div class="secton-title">
                                                <span>
                                                    {{ __('rma::app.admin.rma-tab-name.tab-content.change-status') }}
                                                </span>
                                            </div>
                                            <div class="section-content">
                                                <div class="">
                                                    <form method="POST" action="{{ route('rma.admin.save.status') }}">
                                                        @csrf()
                                                        <input type="hidden" name="rma_id" value="{{ $rmaData['id'] }}">
                                                       
                                                        <div class="control-group">
                                                            <select class="control" id="orderItem" name="rma_status">
                                                                @if($createdInvoiceItems != 0)
                                                                    @php($statusArr = ['Pending','Not Receive Package yet','Received Package','Dispatched Package','Declined','Accept'])
                                                                    @if(isset($canceledRMAItemId))
                                                                        @foreach($invoiceCreateRMAItemsId as $invoiceItemId)
                                                                            @if(in_array($invoiceItemId,$shipmentCreatedRMAItemsId))
                                                                                @php($statusArr = ['Pending','Declined','Item Canceled'])
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @else
                                                                    @foreach($invoiceCreateRMAItemsId as $invoiceItemId)
                                                                        @if(in_array($invoiceItemId,$shipmentCreatedRMAItemsId))
                                                                            @php($statusArr = ['Pending','Declined','Item Canceled'])
                                                                        @endif
                                                                    @endforeach
                                                                    @php($statusArr = ['Pending','Declined','Item Canceled'])
                                                                @endif
                                                                @foreach ($statusArr as $status)
                                                                    <option value="{{ $status }}"
                                                                        @if ($status==$rmaData['rma_status']) selected @endif>
                                                                        {{ $status }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <br><br>
                                                        <div class="account-action">
                                                            <button
                                                                type="submit"
                                                                class="primary-button"
                                                            >
                                                                @lang('rma::app.shop.view-admin-rma.save-btn')
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(
                                        ($rmaData['status'] == 1 && $rmaData['resolution'] == 'Replace')
                                        || $rmaData['rma_status'] == 'Item Canceled'
                                        || $rmaData['resolution'] == 'Return'
                                        && $rmaData['status'] == 1 || $rmaData['status'] == 1
                                        && $rmaData['rma_status'] != 'Declined'
                                    )
                                        <div class="flex justify-between items-center">
                                                <h2 class="text-[26px] font-medium">
                                                    @lang('rma::app.shop.view-admin-rma.change-rma-status')
                                                </h2>
                                                </div><br><br>

                                                <div class="section-content">
                                                    <form method="POST" action="{{ route('rma.admin.save.status') }}">
                                                        @csrf()

                                                        <input type="hidden" name="rma_id" value="{{ $rmaData['id'] }}" />

                                                        <div class="control-group">

                                                            <select id="orderItem" name="rma_status" class="control">
                                                                @if($createdInvoiceItems != 0)
                                                                    @php($statusArr = [
                                                                        'Pending',
                                                                        'Not Receive Package yet',
                                                                        'Received Package',
                                                                        'Declined'
                                                                    ])

                                                                    @if ($rmaData['resolution'] != 'Return')
                                                                        @php(array_push($statusArr, 'Dispatched Package'))
                                                                    @endif

                                                                    @if(isset($canceledRMAItemId))
                                                                        @foreach($invoiceCreateRMAItemsId as $invoiceItemId)
                                                                            @if(in_array($invoiceItemId,$shipmentCreatedRMAItemsId))
                                                                                @php($statusArr = ['Pending','Declined','Item Canceled'])
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @else
                                                                    @foreach($invoiceCreateRMAItemsId as $invoiceItemId)
                                                                        @if(in_array($invoiceItemId,$shipmentCreatedRMAItemsId))
                                                                            @php($statusArr = ['Pending','Declined','Item Canceled'])
                                                                        @endif
                                                                    @endforeach

                                                                    @php($statusArr = ['Pending','Declined','Item Canceled'])
                                                                @endif

                                                                @foreach ($statusArr as $status)
                                                                    <option value="{{ $status }}" @if ($status == $rmaData['rma_status']) selected @endif>
                                                                        {{ $status }}
                                                                    </option>
                                                                @endforeach

                                                            </select>
                                                            <br><br><br>
                                                            <div class="account-action">
                                                                <button
                                                                    type="submit"
                                                                    class="primary-button"
                                                                >
                                                                    @lang('rma::app.shop.view-admin-rma.save-btn')
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($rmaData['rma_status'] == 'Declined')
                                        <div class="sale-section">
                                            <div class="sale-title">
                                                <div class="secton-title">
                                                    {{ __('rma::app.shop.view-customer-rma.close-rma') }}
                                                </div><br>
                                                <div class="row">
                                                    {{ __('rma::app.status.status-quotes.declined-admin') }}
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($rmaData['rma_status'] == 'Item Canceled')
                                        <div class="sale-section">
                                            <div class="sale-title">
                                                <div class="secton-title">
                                                    {{ __('rma::app.shop.view-customer-rma.close-rma') }}
                                                </div><br>
                                                <div class="row">
                                                    {{ __('rma::app.status.status-quotes.solved_by_admin') }}
                                            </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                        </accordian>
                    </div>
                    <br>
                    <div class="sale-container">
                        <accordian :title="'{{ __('rma::app.admin.rma-tab-name.tab-content.order-details') }}'" :active="true">
                            <div slot="body">
                                <div class="sale-section">
                                    <div class="row">
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

                                                @foreach($productDetails as $key => $prodDetail)
                                                    @foreach($prodDetail->getOrderItem as $orderItem)
                                                    <x-admin::table.thead.tr class="hover:bg-gray-50 dark:hover:bg-gray-950">
                                                            <x-admin::table.td>
                                                                {!! $orderItem['name'] !!}

                                                                {!! app('Webkul\RMA\Helpers\Helper')->getOptionDetailHtml($orderItem->additional['attributes'] ?? []) !!}
                                                            </x-admin::table.td>
                                                    
                                                            <x-admin::table.td>
                                                                @if($orderItem['type'] == 'configurable')

                                                                    @foreach ($skus as $k => $sku)
                                                                        @if(isset($sku['parent_id']) && $sku['parent_id'] == $orderItem['id'])
                                                                            {!! $sku['sku'] !!}
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
                                </div>
                            </div>
                        </accordian>
                    </div>
                    <br><br>
                    <div class="sale-container">
                        <accordian :title="'@lang('rma::app.admin.rma-tab-name.tab-content.conversation') ({{ count($adminMessages) }})'" :active="true">
                            <div slot="body">
                                <div class="sale-section">
                                    <div class="">

                                   
                                        @foreach($adminMessages as $key => $message)
                                            <span class="title">
                                                @lang('rma::app.shop.conversation-texts.by')
                                                    <strong>
                                                        @if($message->is_admin == 1)
                                                            @lang('rma::app.shop.view-customer-rma.you')
                                                        @else
                                                            ('rma::app.shop.conversation-texts.customer') {{ $orderDetails->customer_first_name }} {{ $orderDetails->customer_last_name }}
                                                        @endif
                                                    </strong>, {{ __('rma::app.shop.conversation-texts.on') }}
                                                {{ date("F j, Y, h:i:s A" ,strtotime($message['created_at'])) }}
                                            </span>
                                            <div class="value" style="margin-top:10px;word-break: break-all;">
                                                {{ $message['message'] }}
                                            </div><br>
                                        @endforeach                                   
                                        
                                    </div>

                                    {!! $adminMessages->links() !!}
                                </div>

                                <div class="sale-section">
                                    <div class="section-content">
                                        <div class="secton-title">
                                            <span class="title">
                                                @lang('rma::app.shop.view-admin-rma.send-message')
                                            </span>
                                            </div>
                                            <x-shop::form method="POST" @submit.prevent="onSubmit" action="{{ route('admin.rma.sendmessage') }}">
                                                @csrf()

                                                <x-shop::form.control-group.control
                                                    type="hidden"
                                                    name="order_id"
                                                    value="{{ $rmaData['order_id'] }}"
                                                >
                                                </x-shop::form.control-group.control>

                                                <x-shop::form.control-group.control
                                                    type="hidden"
                                                    name="is_admin"
                                                    value="1"
                                                >
                                                </x-shop::form.control-group.control>

                                                <input type="hidden" name="rma_id" value="{{ $rmaData['id'] }}">

                                                <div class="flex gap-x-[10px] items-center">
                                                    <div class="p-[16px]">
                                                    <x-shop::form.control-group class="mb-[10px]">
                                                        <x-shop::form.control-group.label class="required">
                                                            @lang('rma::app.shop.view-admin-rma.enter-message')
                                                        </x-shop::form.control-group.label>
                                                
                                                        <x-admin::form.control-group.control
                                                            type="textarea"
                                                            name="message"
                                                            id="message"
                                                            rules="required"
                                                            :label="trans('rma::app.shop.view-admin-rma.enter-message')"
                                                            :placeholder="trans('rma::app.shop.view-admin-rma.enter-message')"
                                                           
                                                            >
                                                        </x-admin::form.control-group.control>
                                                        <x-shop::form.control-group.error
                                                            control-name="message"
                                                        >
                                                        </x-shop::form.control-group.error>
                                                        <br>
                                                        <button
                                                            type="submit"
                                                            class="primary-button"
                                                        >
                                                        @lang('rma::app.shop.view-admin-rma.send-message-btn')
                                                        </button>
                                                    </x-shop::form.control-group>
                                                    </div>
                                                </div>
                                            </x-shop::form>

                                        </div>
                                    </div>
                                </div>
                        </accordian>
                    </div>
                </tab>
            </tabs>
        </div>
    </div>
</x-admin::layouts>
