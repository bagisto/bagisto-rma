@extends('admin::layouts.master')

@section('page_title')
    {{ __('rma::app.admin.rma-tab-name.title', ['id' => $rmaData->id]) }}
@stop

@section('css')
    <style>
        .tagbutton{
            border-radius: 44px;
            padding: 4px 9px 4px 10px;
            width: fit-content;
            height: auto;
            color: white;
            font-size: 16px;
            display: inline;
        }
        .title {
            vertical-align: top;
        }

    </style>
@stop

@section('content-wrapper')
    <div class="content full-page">
        <div class="page-header">
            <div class="page-title">
                <h1>
                    <i class="icon angle-left-icon back-link"
                        onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/rma/requests') }}';"></i>
                    {{ __('rma::app.shop.view-admin-rma.rma') }} {{ '#'.$rmaData['id'] }}
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
                                        <div class="row">
                                            <span class="title">
                                                {{ __('rma::app.shop.view-admin-rma-content.request-on') }}
                                            </span>
                                            <span class="value">
                                                {{ date("F j, Y, h:i:s A" ,strtotime($rmaData['created_at'])) }}
                                            </span>
                                        </div>
                                        <div class="row">
                                            <span class="title">
                                                {{ __('rma::app.shop.view-admin-rma.order-id')  }}
                                            </span>
                                            <span class="value">
                                                <a href="{{ route('admin.sales.orders.view',$rmaData['order_id']) }}"
                                                    target="_blank">{{ '#'.$rmaData['order_id'] }}
                                                </a>
                                            </span>
                                        </div>
                                        <div class="row">
                                            <span class="title">
                                                    {{ __('rma::app.shop.view-admin-rma-content.customer') }}
                                            </span>
                                            <span class="value">
                                                {{ $orderDetails->customer_first_name }} {{ $orderDetails->customer_last_name }}
                                            </span>
                                        </div>
                                        <div class="row">
                                            <span class="title">
                                                {{ __('rma::app.shop.view-admin-rma.resolution-type') }}
                                            </span>
                                            <span class="value">
                                                {{ $rmaData['resolution'] }}
                                            </span>
                                        </div>
                                        @if(! empty($rmaData['information']))
                                            <div class="row">
                                                <span class="title">
                                                    {{ __('rma::app.shop.view-admin-rma.additional-information') }}
                                                </span>
                                                <span class="value">
                                                    {!! wordwrap($rmaData['information'],99,"<br>\n") !!}
                                                </span>
                                            </div>
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
                                                <div class="row">
                                                    <span class="title">
                                                        {{ __('rma::app.shop.view-admin-rma-content.rma-status') }}
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

                                                <div class="row">
                                                    <span class="title">
                                                        {{ __('rma::app.shop.view-admin-rma-content.order-status') }}
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

                                                        <button type="submit" class="btn btn-lg btn-primary" style="margin-top: 7px;">
                                                            {{ __('rma::app.shop.view-admin-rma.save-btn') }}
                                                        </button>
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
                                        <div class="sale-section">
                                            <div class="sale-title">
                                                <div class="secton-title">
                                                    {{ __('rma::app.shop.view-admin-rma.change-rma-status') }}
                                                </div><br>

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

                                                            <button
                                                                type="submit"
                                                                class="btn btn-lg btn-primary"
                                                                style="display: block;margin-top: 10px;">
                                                                {{ __('rma::app.shop.view-admin-rma.save-btn') }}
                                                            </button>
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

                    <div class="sale-container">
                        <accordian :title="'{{ __('rma::app.admin.rma-tab-name.tab-content.order-details') }}'" :active="true">
                            <div slot="body">
                                <div class="sale-section">
                                    <div class="row">
                                        <div class="table">
                                            <table>
                                                <thead>
                                                    @php($lang = Lang::get('rma::app.shop.table-heading'))
                                                    <tr>
                                                        @foreach($lang as $languageFile)
                                                            <th>{{ $languageFile }}</th>
                                                        @endforeach
                                                    </tr>
                                                </thead>

                                                @foreach($productDetails as $key => $prodDetail)
                                                    @foreach($prodDetail->getOrderItem as $orderItem)
                                                        <tr style="border-bottom: 0px solid #d3d3d3;">
                                                            <td>
                                                                {!! $orderItem['name'] !!}

                                                                {!! app('Webkul\RMA\Helpers\Helper')->getOptionDetailHtml($orderItem->additional['attributes'] ?? []) !!}
                                                            </td>
                                                            <td>
                                                                @if($orderItem['type'] == 'configurable')

                                                                    @foreach ($skus as $k => $sku)
                                                                        @if(isset($sku['parent_id']) && $sku['parent_id'] == $orderItem['id'])
                                                                            {!! $sku['sku'] !!}
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    {!! $orderItem['sku'] !!}
                                                                @endif
                                                            </td>
                                                            <td>{!! $orderItem['price'] !!}</td>
                                                            <td>{!! $prodDetail['quantity'] !!}</td>
                                                            <td>{!! wordwrap($prodDetail->getReasons->title, 15, "<br>\n") !!}</td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </accordian>
                    </div>

                    <div class="sale-container">
                        <accordian :title="'{{ __('rma::app.admin.rma-tab-name.tab-content.conversation') }} ({{ count($adminMessages) }})'" :active="true">
                            <div slot="body">
                                <div class="sale-section">
                                    <div class="">

                                   
                                        @foreach($adminMessages as $key => $message)
                                            <span class="title">
                                                {{ __('rma::app.shop.conversation-texts.by') }}
                                                    <strong>
                                                        @if($message->is_admin == 1)
                                                            {{ __('rma::app.shop.view-customer-rma.you') }}
                                                        @else
                                                            {{ __('rma::app.shop.conversation-texts.customer') }} {{ $orderDetails->customer_first_name }} {{ $orderDetails->customer_last_name }}
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
                                                {{ __('rma::app.shop.view-admin-rma.send-message') }}
                                            </span>
                                        </div>

                                            <form method="POST" @submit.prevent="onSubmit" action="{{ route('admin.rma.sendmessage') }}">
                                                @csrf()

                                                <input type="hidden" name="order_id" value="{{ $rmaData['order_id'] }}">
                                                <input type="hidden" name="is_admin" value="1">
                                                <input type="hidden" name="rma_id" value="{{ $rmaData['id'] }}">

                                                <div class="control-group" :class="[errors.has('message') ? 'has-error' : '']">
                                                    <label class="required">
                                                        {{ __('rma::app.shop.view-admin-rma.enter-message') }}
                                                    </label>
                                                    <textarea  v-validate="'required'" class="control required" id="message" name="message" data-vv-as="&quot;{{ __('rma::app.shop.validation.message') }}&quot;"></textarea>
                                                    <span class="control-error" v-if="errors.has('message')">@{{ errors.first('message') }}</span>
                                                        <br>
                                                    <button type="submit" class="btn btn-lg btn-primary" style="margin-top: 7px;">
                                                        {{ __('rma::app.shop.view-admin-rma.send-message-btn') }}
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                        </accordian>
                    </div>
                </tab>
            </tabs>
        </div>
    </div>
@stop
