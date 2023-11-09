<x-shop::layouts.account>

{{-- Title of the page --}}
<x-slot:title>
    @lang('rma::app.shop.customer.title')
</x-slot>

<div class="account-layout" @if(!auth()->guard('customer')->user())@endif>
</div>

@pushOnce('scripts')

<script type="text/x-template" id="rma-request-template">

    <div>
            <x-shop::form
                :action="route('rma.customers.store')"
                method="POST"
                enctype="multipart/form-data"
            >

            <div class="flex justify-between items-center">
                <span class="back-icon">
                    </span>
                        <h2 class="text-[26px] font-medium">
                            @lang('rma::app.shop.view-customer-rma.rma') {{ '#'.$rmaData['id'] }}
                        </h2>
                </div><br>

                <div class="sale-section">
                    <div class="section-content">
                        <div class="row">
                            <div class="flex justify-between items-center">
                                <h2 class="text-[26px] font-medium">
                                    @lang('rma::app.shop.view-customer-rma-content.request-on')
                                </h2>
                            </div>
                            <span class="value">
                                {{ date("F j, Y, h:i:s A" ,strtotime($rmaData['created_at'])) }}
                            </span>
                        </div>
                        <div class="row">
                            <span class="title">
                                @lang('rma::app.shop.view-customer-rma.order-id')
                            </span>
                            <span class="value">
                                @if (!session()->get('guestEmailId'))
                                    <a href="{{ route('customer.orders.view', $rmaData['order_id']) }}"
                                    target="_blank">{{ '#'.$rmaData['order_id'] }}</a>
                                @endif
                                @if (session()->get('guestEmailId'))
                                    {{ '#'.$rmaData['order_id'] }}
                                @endif
                            </span>
                        </div>
                        <div class="row">
                            <span class="title">
                                @lang('rma::app.shop.view-customer-rma.resolution-type')
                            </span>
                            <span class="value">
                                {{ $rmaData['resolution'] }}
                            </span>
                        </div>

                            @if(! empty($rmaData['information']))
                                <div class="row">
                                    <span class="title">
                                        @lang('rma::app.shop.view-customer-rma.additional-information')
                                    </span>
                                    <span class="value"  style="display:inline;line-height: 28px;">
                                        {{ $rmaData['information'] }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div><br>

                    <div class="sale-section">
                        <div class="secton-title">
                            <span>
                                @lang('rma::app.shop.view-admin-rma.items-request')
                            </span>
                        </div>
                        <div class="row">
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
                                        @foreach($productDetails as $key=>$prodDetail)
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
                                                    <td>{!! wordwrap($reasons[$key]->getReasons->title,15,"<br>\n") !!}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><br>

                    <!––images shown which is uploaded––>
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
                                            <img @if(isset($rmaImages)) class="rma-image" style="margin-right:20px;" src="{{  bagisto_asset('/storage/'.$images['path']) }}" @else src="" @endif style="max-width:70%;">
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="sale-section">
                        <div class="secton-title">
                            <span>
                                @lang('rma::app.shop.view-customer-rma.status-details')
                            </span>
                        </div>
                        <div class="section-content">
                            <div class="row">
                                <span class="title">
                                    @lang('rma::app.shop.view-customer-rma-content.rma-status')
                                </span>

                                @if (is_null($rmaData['rma_status']) || $rmaData['rma_status'] == 'Pending')
                                    @if ($rmaData['status'] != 1)
                                        <span class="tagbutton" style="background-color:#FBC02D">@lang('rma::app.status.status-name.pending')</span>
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
                                @elseif ($rmaData['rma_status'] != 'Item Canceled' || $rmaData['rma_status'] == 'Declined')
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
                                @endif
                            </div>

                            <div class="row">
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
                                <button type="button" class="btn btn-lg btn-primary" style="margin-top: 15px;">
                                    {{ __('rma::app.shop.customer-rma-create.reopen_request') }}
                                </button>
                            </a>
                        @else
                            <a href="{{ route('rma.guest.reopen.rma-status', ['id' => $rmaData['id']]) }}">
                                <button type="button" class="btn btn-lg btn-primary" style="margin-top: 15px;">
                                    {{ __('rma::app.shop.customer-rma-create.reopen_request') }}
                                </button>
                            </a>
                        @endif
                    @endif

                    @if ($rmaData['status'] == 1 && $rmaData['rma_status'] != 'Declined')
                        <div class="sale-section">
                            <div class="secton-title">
                                {{ __('rma::app.shop.view-customer-rma.close-rma') }}
                            </div><br>
                            <div class="row">
                                {{ __('rma::app.status.status-quotes.solved') }}
                            </div>
                        </div>
                    @endif

                    @if ($rmaData['rma_status'] == 'Item Canceled')
                        <div class="sale-section">
                            <div class="secton-title">
                                {{ __('rma::app.shop.view-customer-rma.close-rma') }}
                            </div><br>
                            <div class="row">
                                {{ __('rma::app.status.status-quotes.solved_by_admin') }}
                            </div>
                        </div>
                    @endif

                    @if ($rmaData['rma_status'] == 'Declined')
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
                    <option-wrapper></option-wrapper>
                </div>
            </div>
        </div>
    </div>
        <div>
            @if ($show)
                <div class="sale-section">
                    <div class="secton-title">
                        <span>
                            {{ __('rma::app.shop.view-customer-rma.close-rma') }}
                        </span>
                    </div>
                    <div class="section-content">
                            <div class="row">
                                <form method="POST" id="form-1"  data-vv-scope="form-1" @submit.prevent="validateForm('form-1')"
                                    action="{{ route('rma.customer.save.rma-status') }}">
                                    @csrf()

                                    <input type="hidden" name="rma_id" value="{{ $rmaData['id'] }}">

                                    <div class="control-group" :class="[errors.has('form-1.close_rma') ? 'has-error' : '']">
                                        <span class="checkbox">
                                            <input type="checkbox" id="close_rma" name="close_rma"  v-validate="'required'" data-vv-as="&quot;{{ __('rma::app.shop.validation.close_rma') }}&quot;">
                                            <label class="checkbox-view" for="close_rma"></label>
                                            {{ __('rma::app.shop.view-customer-rma.status-quotes') }}
                                            <span style="color:red;">*</span>
                                        </span>
                                        <span class="control-error" v-if="errors.has('form-1.close_rma')">@{{ errors.first('form-1.close_rma') }}</span>
                                    </div>
                                    <button type="submit" class="btn btn-lg btn-primary" name="form-1">
                                        {{ __('rma::app.shop.view-customer-rma.save-btn') }}
                                    </button>
                                </form>
                            </div>
                    </div>
                </div>
            @endif

            @if (count($messages) > 0)
                <div class="sale-section">
                    <div class="secton-title">
                        {{ __('rma::app.shop.view-customer-rma.conversations') }} ({{ count($messages) }})
                    </div><br>

                    @foreach($messages as $key => $message)
                        <div class="">
                            <span class="title">
                                {{ __('rma::app.shop.conversation-texts.by') }}
                                <strong>
                                    @if ($message->is_admin == 1)
                                        {{ __('rma::app.shop.view-customer-rma.admin') }}
                                    @elseif ($message->is_admin == 0)
                                        {{ __('rma::app.shop.view-customer-rma.you') }}
                                    @endif
                                </strong> {{ __('rma::app.shop.conversation-texts.on') }}
                                {{ date("F j, Y, h:i:s A" ,strtotime($message->created_at)) }}
                            </span><br>
                            <div class="value" style="margin-top:10px;word-break: break-all;">
                                {{ $message->message }}
                            </div>
                        </div><br>
                    @endforeach
                </div>
            @endif
            <div class="sale-section">
                <div class="section-content">
                        <div class="secton-title">
                            <span class="title">
                                {{ __('rma::app.shop.view-customer-rma.send-message') }}
                            </span>
                        </div>
                        <div class="row">
                        <span class="title" style="width: 380px;">
                            {{ __('rma::app.shop.view-admin-rma.enter-message') }}
                            <span style="color:red;">*</span>
                        </span>
                        <form  data-vv-scope="form-2" id="form-2" method="POST" @submit.prevent="validateForm('form-2')"
                            action="{{ route('rma.customer.sendmessage') }}">
                            @csrf()

                            <input type="hidden" name="is_admin" value="0">
                            <input type="hidden" name="rma_id" value="{{ $rmaData['id'] }}">

                            <div class="control-group" :class="[errors.has('form-2.message') ? 'has-error' : '']">
                                <textarea  v-validate="'required'"
                                    class="control required" id="message" name="message"
                                    data-vv-as="&quot;{{ __('rma::app.shop.validation.message') }}&quot;"></textarea>
                                <span class="control-error" v-if="errors.has('form-2.message')">@{{ errors.first('form-2.message') }}</span><br>
                                <button type="submit" class="btn btn-lg btn-primary" name="form-2" style="margin-top:7px;">
                                    {{ __('rma::app.shop.view-admin-rma.send-message-btn') }}
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

            validateForm(scope) {

                var this_this = this;

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

        })
    </script>
@endpushOnce
</x-shop::layouts.account>
