@extends('shop::customers.account.index')

@section('page_title')
    {{ __('rma::app.shop.customer.title') }}
@endsection

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
    ) {
        $show = false;
    }
@endphp

@if (auth()->guard('customer')->user())
    @section('page-detail-wrapper')
@else
    @section('content-wrapper')
        <div class="account-content row no-margin velocity-divide-page">
            <div class="account-layout full-width mt10">
@endif
    <div class="account-layout">
        <div class="account-head">
            <span class="back-icon">
            </span>
            <span class="account-heading">
                {{ __('rma::app.shop.view-customer-rma.rma') }} {{ '#' . $rmaData['id'] }}
            </span>
        </div>

        <div class="sale-container">
            <div class="account-table-content">
                <div class="tabs-content">
                    <div class="sale-section no-padding">
                        <div class="section-content">
                            <div>
                                <span class="title">
                                    {{ __('rma::app.shop.view-customer-rma-content.request-on') }}
                                </span>
                                <span class="value">
                                    {{ date("F j, Y, h:i:s A" ,strtotime($rmaData['created_at'])) }}
                                </span>
                            </div>
                            <div>
                                <span class="title">
                                    {{ __('rma::app.shop.view-customer-rma.order-id')  }}
                                </span>
                                <span class="value">
                                    @if (!session()->get('guestEmailId'))
                                        <a href="{{ route('customer.orders.view', $rmaData['order_id']) }}"
                                        target="_blank">{{ '#'.$rmaData['order_id'] }}</a>
                                    @endif
                                    @if (session()->get('guestEmailId'))
                                        {{ '#' . $rmaData['order_id'] }}
                                    @endif
                                </span>
                            </div>
                            <div>
                                <span class="title">
                                    {{ __('rma::app.shop.view-customer-rma.resolution-type') }}
                                </span>
                                <span class="value">
                                    {{ $rmaData['resolution'] }}
                                </span>
                            </div>

                            @if(! empty($rmaData['information']))
                                <div>
                                    <span class="title">
                                        {{ __('rma::app.shop.view-customer-rma.additional-information') }}
                                    </span>
                                    <span class="value">
                                        {{ $rmaData['information'] }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="sale-section">
                        <div class="section-title">
                            <span>
                                {{ __('rma::app.shop.view-customer-rma.items-request') }}
                            </span>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        @php($lang = Lang::get('rma::app.shop.table-heading'))
                                        <tr>
                                            @foreach($lang as $languageFile)
                                                <th>{{ $languageFile }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($productDetails as $key => $prodDetail)
                                            @foreach($prodDetail->getOrderItem as $key => $orderItem)
                                                <tr style="border-bottom: 0px solid #d3d3d3;">
                                                    <td>
                                                        {!! $orderItem['name'] !!}

                                                        {!! app('Webkul\RMA\Helpers\Helper')->getOptionDetailHtml($orderItem->additional['attributes'] ?? []) !!}
                                                    </td>

                                                    <td>@if($orderItem['type'] == 'configurable')
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
                                                    <td>{!! wordwrap($reasons[$key]->getReasons->title,15,"\n") !!}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- images shown which is uploaded --}}
                    @if(is_null($rmaImages) || count($rmaImages) > 0)
                        <div class="sale-section">
                            <div class="section-title">
                                <span>
                                    {{ __('rma::app.shop.view-customer-rma.images')  }}
                                </span>
                            </div>
                            <div class="section-content">
                                <div>
                                    <span class="value">
                                        @foreach($rmaImages as $images)
                                            <img @if(isset($rmaImages)) class="mr20 rma-image" src="{{  bagisto_asset('/storage/'.$images['path']) }}" @else src="" @endif style="max-width:70%;">
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="sale-section">
                        <div class="section-title">
                            <span>
                                {{ __('rma::app.shop.view-customer-rma.status-details')  }}
                            </span>
                        </div>
                        <div class="section-content">
                            <div>
                                <span class="title">
                                    {{ __('rma::app.shop.view-customer-rma-content.rma-status') }}
                                </span>

                                @if (is_null($rmaData['rma_status']) || $rmaData['rma_status'] == 'Pending')
                                    @if ($rmaData['status'] != 1)
                                        <span class="tagbutton" style="background-color:#FBC02D">{{ __('rma::app.status.status-name.pending') }}</span>
                                    @else
                                        <span style="background-color:#00796B" class="tagbutton">
                                            {{ __('rma::app.status.status-name.solved') }}
                                        </span>
                                    @endif
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
                                @elseif ($rmaData['rma_status'] == 'Item Canceled')
                                    <span style="background-color:#00796B" class="tagbutton">
                                        {{ __('rma::app.status.status-name.item_canceled') }}
                                    </span>
                                @elseif ($rmaData['rma_status'] == 'Declined')
                                    <span style="background-color:#616161" class="tagbutton">
                                        {{  $rmaData['rma_status'] }}
                                    </span>
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
                            </div>

                            <div>
                                <span class="title">
                                    {{ __('rma::app.shop.view-customer-rma-content.order-status') }}
                                </span>
                                <span class="value tagbutton" @if($rmaData['order_status'] == 'Delivered') style="background-color:#2E7D32" @else style="background-color:#d32f2f" @endif>
                                    {{ $rmaData['order_status'] }}
                                </span>
                            </div>
                        </div>
                    </div>

                    @if ($rmaData['rma_status'] == 'Declined')
                        @if(auth()->guard('customer')->user())
                            <a href="{{ route('rma.customer.reopen.rma-status', ['id' => $rmaData['id']]) }}">
                                <button type="button" class="theme-btn mt15">
                                    {{ __('rma::app.shop.customer-rma-create.reopen_request') }}
                                </button>
                            </a>
                        @else
                            <a href="{{ route('rma.guest.reopen.rma-status', ['id' => $rmaData['id']]) }}">
                                <button type="button" class="theme-btn mt15">
                                    {{ __('rma::app.shop.customer-rma-create.reopen_request') }}
                                </button>
                            </a>
                        @endif
                    @endif

                    @if ($rmaData['status'] == 1 && $rmaData['rma_status'] != 'Declined')
                        <div class="sale-section">
                            <div class="section-title">
                                {{ __('rma::app.shop.view-customer-rma.close-rma') }}
                            </div>
                            <div>
                                {{ __('rma::app.status.status-quotes.solved') }}
                            </div>
                        </div>
                    @endif

                    @if ($rmaData['rma_status'] == 'Item Canceled')
                        <div class="sale-section">
                            <div class="section-title">
                                {{ __('rma::app.shop.view-customer-rma.close-rma') }}
                            </div>
                            <div>
                                {{ __('rma::app.status.status-quotes.solved_by_admin') }}
                            </div>
                        </div>
                    @endif

                    @if ($rmaData['rma_status'] == 'Declined')
                        <div class="sale-section">
                            <div class="sale-title">
                                <div class="section-title">
                                    {{ __('rma::app.shop.view-customer-rma.close-rma') }}
                                </div>
                                <div>
                                    {{ __('rma::app.status.status-quotes.declined-admin') }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <option-wrapper></option-wrapper>
                </div>
            </div>
        </div>
    </div>

    @if (! auth()->guard('customer')->user())
            </div>
        </div>
    @endif

@endsection

@push('scripts')
    <script type="text/x-template" id="options-template">
        <div>

            @if ($show)
                <div class="sale-section">
                    <div class="section-title">
                        <span>
                            {{ __('rma::app.shop.view-customer-rma.close-rma') }}
                        </span>
                    </div>

                    <div class="section-content">
                        <form
                            method="POST"
                            id="form-1"
                            data-vv-scope="form-1"
                            @submit.prevent="validateForm('form-1')"
                            action="{{ route('rma.customer.save.rma-status') }}">

                            @csrf()

                            <input type="hidden" name="rma_id" value="{{ $rmaData['id'] }}">

                            <div class="control-group">
                                <div class="checkbox">                                 

                                    <label class="checkbox-view no-padding" for="close_rma">
                                        {{ __('rma::app.shop.view-customer-rma.status-quotes') }}
                                    </label>

                                    <span style="color:red;">*</span>

                                    <input
                                        type="checkbox"
                                        id="close_rma"
                                        name="close_rma"
                                        v-validate="'required'"
                                        data-vv-as="&quot;{{ __('rma::app.shop.validation.close_rma') }}&quot;" style="width:20% !important" />
                                  
                                </div>

                                <span
                                    class="control-error"
                                    v-if="errors.has('form-1.close_rma')">

                                    @{{ errors.first('form-1.close_rma') }}
                                </span>
                            </div>
                            <button type="submit" class="theme-btn" name="form-1">
                                {{ __('rma::app.shop.view-customer-rma.save-btn') }}
                            </button>
                        </form>
                    </div>
                </div>
            @endif

            @if (count($messages) > 0)
                <div class="sale-section">
                    <div class="section-title">
                        {{ __('rma::app.shop.view-customer-rma.conversations') }} ({{ count($messages) }})
                    </div>

                    @foreach($messages as $key => $message)
                        <div class="message">
                            <div class="title">
                                {{ __('rma::app.shop.conversation-texts.by') }}
                                <strong>
                                        @if ($message->is_admin == 1)
                                            {{ __('rma::app.shop.view-customer-rma.admin') }}
                                        @elseif ($message->is_admin == 0)
                                            {{ __('rma::app.shop.view-customer-rma.you') }}
                                        @endif
                                </strong>

                                <div>
                                    {{ __('rma::app.shop.conversation-texts.on') }}
                                    {{ date("F j, Y, h:i:s A" ,strtotime($message->created_at)) }}
                                </div>
                            </div>
                            <div class="value" style="margin-top:10px;word-break: break-all;">
                                {{ $message->message }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="sale-section">
                <div class="section-content">
                    <div class="section-title">
                        <span class="title">
                            {{ __('rma::app.shop.view-customer-rma.send-message') }}
                        </span>
                    </div>

                    <div>
                        <span class="title" style="width: 380px;">
                            {{ __('rma::app.shop.view-customer-rma-content.enter-message') }}
                            <span style="color:red;">*</span>
                        </span>

                        <form
                            id="form-2"
                            method="POST"
                            data-vv-scope="form-2"
                            @submit.prevent="validateForm('form-2')"
                            action="{{ route('rma.customer.sendmessage') }}">

                            @csrf()

                            <input type="hidden" name="is_admin" value="0">
                            <input type="hidden" name="rma_id" value="{{ $rmaData['id'] }}">

                            <div class="row col-lg-6 col-12" :class="[errors.has('form-2.message') ? 'has-error' : '']">
                                <textarea
                                    v-validate="'required'"
                                    class="control required" id="message" name="message"
                                    data-vv-as="&quot;{{ __('rma::app.shop.validation.message') }}&quot;">
                                </textarea>

                                <span class="control-error" v-if="errors.has('form-2.message')">
                                    @{{ errors.first('form-2.message') }}
                                </span>
                            </div>

                            <div class="row col-12">
                                <button type="submit" class="theme-btn display-block mt10" name="form-2">
                                    {{ __('rma::app.shop.view-customer-rma.send-message-btn') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </script>

    <script>
        Vue.component('option-wrapper', {
            template: '#options-template',

            inject: ['$validator'],

            methods: {
                validateForm (scope) {
                    this.$validator.validateAll(scope).then((result) => {
                        if (result) {
                            if (scope == 'form-1') {
                                document.getElementById('form-1').submit();
                            } else if (scope == 'form-2') {
                                document.getElementById('form-2').submit();
                            }
                        }
                    });
                }
            }
        });
    </script>
@endpush

@push('css')
    <style>
        .section-content > div {
            padding: 7px 0;
        }
        span.title {
            width: 200px;
            letter-spacing: -.26px;
            display: inline-block;
        }
        .message {
            padding: 20px 0;
        }
        textarea {
            width: 100%;
            resize: none;
            font-size: 16px;
            padding: 5px 16px;
            border-radius: 1px;
            background: #FFFFFF;
            border: 1px solid #CCCCCC;
        }
        textarea:active,
        textarea:focus {
            border-color: #26A37C;
        }
        .tagbutton {
            border-radius: 44px;
            padding: 4px 9px 4px 10px;
            width: fit-content;
            height: auto;
            color: white;
            font-size: 16px;
            display: inline;
        }
        .title {
            font-weight: 600;
        }
        .rma-image {
            width: 200px;
            height: 200px;
        }
    </style>
@endpush
