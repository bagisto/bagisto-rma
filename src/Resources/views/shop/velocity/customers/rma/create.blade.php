@extends('shop::customers.account.index')

@section('page_title')
    {{ __('rma::app.shop.customer.title') }}
@endsection

@section('page-detail-wrapper')
@if (auth()->guard('customer')->user())
    @section('page-detail-wrapper')
@else
    @section('content-wrapper')
        <div class="account-content row no-margin velocity-divide-page">
            <div class="account-layout full-width mt10">
@endif

    <div class="account-table-content">
        <div class="tabs-content">
            <form
                method="POST"
                @submit.prevent="onSubmit"
                enctype="multipart/form-data"
                action="{{ route('rma.customers.store') }}">

                @csrf()

                <div class="account-head mb-30">
                    <span class="account-heading">
                        {{ __('rma::app.shop.customer-rma-create.heading') }}
                    </span>

                    <div class="account-action">
                        <button type="submit" class="theme-btn" onClick="formValidation()"  @if (core()->getCurrentLocale()->direction == 'rtl') style="float:left;" @else style="float:right;" @endif>
                            {{ __('rma::app.general.create') }}
                        </button>
                    </div>
                </div>

                <option-wrapper></option-wrapper>

                <div class="sale-container">
                    <div class="sale-section">
                        <div class="sale-title">
                            <div class="section-title">
                                {{ __('rma::app.shop.customer-rma-create.images') }}
                            </div>
                        </div>

                        <div class="control-group"> 
                            <image-wrapper :button-label="'{{ __('admin::app.catalog.products.add-image-btn-title') }}'"
                                input-name="images" :multiple="true">
                            </image-wrapper>
                        </div>
                    </div>

                    <input type="hidden" name="email" value="{{ $customerEmail }}">
                    <input type="hidden" name="name" value="{{ $customerName }}">
                    <input type="hidden" name="token" value="{!! csrf_token() !!} ">

                    <div class="sale-section no-border">
                        <div class="sale-title">
                            <div class="section-title no-padding">
                                {{ __('rma::app.shop.customer-rma-create.information') }}
                            </div>
                        </div>
                        <div class="row col-lg-6 col-12 no-padding">
                            <div class="col-12" :class="[errors.has('information') ? 'has-error' : '']">
                                <textarea class="control" id="information" name="information"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@if (! auth()->guard('customer')->user())
        </div>
    </div>
@endif
@stop
@push('scripts')
<script type="text/javascript"src="{{asset('vendor/webkul/ui/assets/js/ui.js') }}"></script>
@endpush
@push('scripts')
    <script type="text/x-template" id="options-template">
        <div class="sale-container">
            <div>
                <div class="sale-section">
                    <div class="row col-12">
                        <input
                            type="text"
                            v-model="searchOrderValue"
                            class="mb-4 col-lg-2 col-md-12"
                            placeholder="{{ __('rma::app.shop.customer-rma-create.enter_order_id') }}"
                        />
                        <button
                            class="theme-btn"
                            @click="searchOrders($event)"
                            style="padding-top: 6px; margin-left: 10px; margin-right: 10px; font-size: 15px; height: 36px;"
                        >
                            {{ __('rma::app.shop.customer-rma-create.search_order') }}
                        </button>
                    </div>

                    <div class="control-group" :class="[errors.has('order_id') ? 'has-error' : '']">
                        <div class="sale-title">
                            <div class="section-title">
                                {{ __('rma::app.shop.customer-rma-create.orders') }}
                            </div>
                        </div>

                        <select
                            id="orderItem"
                            name="order_id"
                            v-validate="'required'"
                            @change="getResolutions($event)"
                            data-vv-as="&quot;{{ __('rma::app.shop.validation.order_id') }}&quot;">
                            <option :value="null" disable hidden v-if="dosearch">@{{ '#' + orders[0].increment_id }}, $@{{ orders[0].grand_total }}</option>
                            <option :value="null" >{{ __('rma::app.shop.default-option.select-order') }}</option>
                            <option v-for="(order, index) in orders" :value="order.id" :selected="index == 0">
                                @{{ '#' + order.increment_id }}, $@{{ order.grand_total }}
                            </option>
                        </select>

                        <span class="control-error" v-if="errors.has('order_id')">
                            @{{ errors.first('order_id') }}
                        </span>
                    </div>

                    <div
                        class="control-group"
                        v-if="resolutions != ''"
                        :class="[errors.has('resolution') ? 'has-error' : '']">

                        <div class="sale-title">
                            <div class="section-title">
                                {{ __('rma::app.shop.customer-rma-create.resolution') }}
                            </div>
                        </div>

                        <select
                            class="control"
                            id="resolution"
                            name="resolution"
                            v-model="resolution"
                            v-validate="'required'"
                            @change="getOrderByResolution($event)"
                            data-vv-as="&quot;{{ __('rma::app.shop.validation.resolution') }}&quot;">

                            <option :value="null">
                                {{ __('rma::app.shop.default-option.select-resolution') }}
                            </option>

                            <option v-for="selectResolutionByOrder in resolutions" :value="selectResolutionByOrder">
                                @{{ selectResolutionByOrder }}
                            </option>
                        </select>

                        <span class="control-error" v-if="errors.has('resolution')">
                            @{{ errors.first('resolution') }}
                        </span>
                    </div>

                    <div
                        v-if="orderStatus"
                        class="control-group"
                        :class="[errors.has('order_status') ? 'has-error' : '']">

                        <div class="sale-title">
                            <div class="section-title">
                                {{ __('rma::app.shop.customer-rma-create.order_status') }}
                            </div>
                        </div>

                        <select class="control" id="checkOrderStatus"  name="order_status" @change="checkOrderStatus($event)" v-validate="'required'" data-vv-as="&quot;{{ __('rma::app.shop.validation.order_status') }}&quot;">
                            <option v-for="orderStatusOptions in orderStatus" :value="orderStatusOptions">
                                @{{ orderStatusOptions }}
                            </option>
                        </select>

                        <span class="control-error" v-if="errors.has('order_status')">
                            @{{ errors.first('order_status') }}
                        </span>
                    </div>
                    <div
                        v-if="orderStatus == 0"
                        class="control-group"
                        :class="[errors.has('order_status') ? 'has-error' : '']">
                        <p style = "margin-top:24px; color:red;"> {{ __('rma::app.shop.customer-rma-create.not_allowed') }}</p>
                    </div>
                </div>

                <div class="sale-section">
                    <div class="section-title">
                        <span class="title">
                            {{ __('rma::app.shop.customer-rma-create.item-ordered') }}
                        </span>
                    </div>
                    <div class="section-content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th> 
                                            <input type='checkbox' @click='checkAll()' id="checkbox" v-model='isCheckAll' />
                                        </th>

                                        <th>
                                            {{ __('rma::app.shop.customer-rma-create.image') }}
                                        </th>

                                        <th style="max-width: 100%; width: 20%;">
                                            {{ __('rma::app.shop.customer-rma-create.product') }}
                                        </th>

                                        <th>{{ __('rma::app.shop.customer-rma-create.sku') }}</th>

                                        <th>{{ __('rma::app.shop.customer-rma-create.price') }}</th>

                                        <th>{{ __('rma::app.shop.customer-rma-create.quantity') }}</th>

                                        <th>{{ __('rma::app.shop.customer-rma-create.reason') }}</th>
                                    </tr>
                                </thead>

                                <tbody style="text-align: center;" v-if="orderItems.length != 0 && resolutions != null">
                                    <tr v-for="(orderData,index) in orderItems">
                                        <td class="no-padding">
                                            <input type='checkbox' id="checkboxSingle" name="order_item_id[]"  v-bind:value="orderData.id" v-model='selected' @change='updateCheckall(); getId($event)'>
                                        </td>

                                        <td>
                                            <img style="height: auto; max-width: 30%;" v-if="productImageCounts > 0" :src="productImage[orderData.product_id]['medium_image_url']">

                                            <img v-else style="max-width: 100%;max-height: 50%;" src="{{  url('vendor/webkul/ui/assets/images/product/small-product-placeholder.png') }}">
                                        </td>

                                        <td style="width: auto;" >
                                            <span v-if="orderData.type == 'configurable' && child[orderData.id]">
                                                @{{ child[orderData.id].name }}
                                                <div>@{{ child[orderData.id].attribute }}</div>
                                            </span>
                                            <span v-else>
                                                @{{ orderData.name }}
                                            </span>

                                            <li style="display:inline;"  v-if="html.length != 0" v-html="html[orderData.id]">
                                            @{{ html[orderData.id] }}
                                            </li>
                                        </td>

                                        <td>
                                            @{{  orderData.type == 'configurable' ? child[orderData.id] ? child[orderData.id].sku : orderData.sku : orderData.sku }}</td>
                                        </td>

                                        <td>@{{ orderData.price }}</td>

                                        <td>
                                            <div class="control-group full-width" :class="[errors.has('quantity[' + orderItems[index].id + ']') ? 'has-error' : '']">
                                                <select class="control" :name="'quantity[' + orderItems[index].id + ']'"
                                                id="quantity" v-validate="validate[orderItems[index].id] || is_required ? 'required' : ''" data-vv-as="&quot;{{ __('rma::app.shop.default-option.select-quantity') }}&quot;">
                                                    <option :value="null">{{ __('rma::app.shop.default-option.select-quantity') }}</option>
                                                    <option v-for="qtyLength in quantity[orderData.id]"  :value="qtyLength">@{{ qtyLength }}</option>
                                                </select>
                                                <span class="control-error" v-if="errors.has('quantity[' + orderItems[index].id + ']')">@{{ errors.first('quantity[' + orderItems[index].id + ']') }}</span>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="control-group" :class="[errors.has('rma_reason_id[' + orderItems[index].id + ']') ? 'has-error' : '']">

                                                <select
                                                    class="control"
                                                    id="rma_reason_id"
                                                    :name=" 'rma_reason_id[' + orderItems[index].id + ']'"
                                                    v-validate="validate[orderItems[index].id] || is_required ? 'required' : ''"
                                                    data-vv-as="&quot;{{ __('rma::app.shop.default-option.select-reason') }}&quot;">

                                                    <option :value="null" >{{ __('rma::app.shop.default-option.select-reason') }}</option>
                                                    @foreach($reasons as $reasons_value)
                                                        <option value="{{ $reasons_value->id }}">
                                                            {{ $reasons_value->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="control-error" v-if="errors.has('rma_reason_id[' + orderItems[index].id + ']')">@{{ errors.first('rma_reason_id[' + orderItems[index].id + ']') }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div v-if="resolutionShow == true">
                                <div v-if="orderItems.length == 0" style="text-align: center;">
                                    <p>{{ __('rma::app.shop.customer-rma-create.rma-not-avilable-quotes') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </script>

    <script>
        Vue.component('option-wrapper', {
            template: '#options-template',

            inject: ['$validator'],

            data: function (data) {
                return {
                    data: [],
                    html: [],
                    child: [],
                    selected: [],
                    seller: false,
                    dosearch: false,
                    orderId: null,
                    quantity: [],
                    blankData: [],
                    sellerInfo: [],
                    seller_id: null,
                    orderItems : [],
                    resolutions: [],
                    resolution: null,
                    productImage: [],
                    orderStatus: null,
                    isCheckAll: false,
                    rmaOrderItemId: [],
                    is_required: false,
                    showSelectBox: false,
                    searchOrderValue: '',
                    resolutionShow: false,
                    renderComponent: true,
                    countRmaOrderItems: [],
                    productImageCounts: null,
                    singleOrderSellerId: null,
                    orders: @json($orderItems),
                    validate: {
                        'is_required': false,
                    },
                    shippedProductId: [],
                    shippingOrderStatus: 0,
                    orderItemShipped: []
                }
            },

            mounted() {             
                if(this.orders) {
                    this.getResolutions(this.orders[0].id);
                }
            },

            methods: {
                checkOrderStatus:  function(event){
                    let this_this = this;

                    if(this_this.shippingOrderStatus && event.target.value == 'Delivered') {
                            
                        let orders = [];

                        for(let i = 0 ; i < this_this.shippedProductId.length ; i++){                                
                            for(let k = 0; k < this_this.orderItemShipped.length ; k++){                                     
                                if(this_this.shippedProductId[i] == this_this.orderItemShipped[k].product_id) {
                                    orders.push(this_this.orderItemShipped[k]);
                                }
                             }
                        }

                        this_this.orderItems = orders;                       
                    }

                    if(this_this.shippingOrderStatus && event.target.value == 'Not Delivered') {
                            
                        let orders = [];

                        for(let i = 0 ; i < this_this.shippedProductId.length ; i++){                                
                            for(let k = 0; k < this_this.orderItemShipped.length ; k++){                                     
                               if(this_this.shippedProductId[i] != this_this.orderItemShipped[k].product_id) {
                                    orders.push(this_this.orderItemShipped[k]);
                                }
                            }
                        }
    
                        this_this.orderItems = orders;
                    }
                },

                deliveredOrderStatus:  function(){
                    let this_this = this;

                    let orders = [];

                    for(let i = 0 ; i < this_this.shippedProductId.length ; i++){                                
                        for(let k = 0; k < this_this.orderItemShipped.length ; k++){                                     
                            if(this_this.shippedProductId[i] == this_this.orderItemShipped[k].product_id) {
                                orders.push(this_this.orderItemShipped[k]);
                            }
                        }
                    }

                    this_this.orderItems = orders;                       
                      
                }, deliveredOrderStatus:  function(){
                    let this_this = this;

                    let orders = [];

                    for(let i = 0 ; i < this_this.shippedProductId.length ; i++){                                
                        for(let k = 0; k < this_this.orderItemShipped.length ; k++){                                     
                            if(this_this.shippedProductId[i] == this_this.orderItemShipped[k].product_id) {
                                orders.push(this_this.orderItemShipped[k]);
                            }
                        }
                    }

                    this_this.orderItems = orders;                       
                      
                }, deliveredOrderStatus:  function(){
                    let this_this = this;

                    let orders = [];

                    for(let i = 0 ; i < this_this.shippedProductId.length ; i++){                                
                        for(let k = 0; k < this_this.orderItemShipped.length ; k++){                                     
                            if(this_this.shippedProductId[i] == this_this.orderItemShipped[k].product_id) {
                                orders.push(this_this.orderItemShipped[k]);
                            }
                        }
                    }

                    this_this.orderItems = orders;                       
                      
                }, deliveredOrderStatus:  function(){
                    let this_this = this;

                    let orders = [];

                    for(let i = 0 ; i < this_this.shippedProductId.length ; i++){                                
                        for(let k = 0; k < this_this.orderItemShipped.length ; k++){                                     
                            if(this_this.shippedProductId[i] == this_this.orderItemShipped[k].product_id) {
                                orders.push(this_this.orderItemShipped[k]);
                            }
                        }
                    }

                    this_this.orderItems = orders;                       
                      
                }, deliveredOrderStatus:  function(){
                    let this_this = this;

                    let orders = [];

                    for(let i = 0 ; i < this_this.shippedProductId.length ; i++){                                
                        for(let k = 0; k < this_this.orderItemShipped.length ; k++){                                     
                            if(this_this.shippedProductId[i] == this_this.orderItemShipped[k].product_id) {
                                orders.push(this_this.orderItemShipped[k]);
                            }
                        }
                    }

                    this_this.orderItems = orders;                       
                      
                }, deliveredOrderStatus:  function(){
                    let this_this = this;

                    let orders = [];

                    for(let i = 0 ; i < this_this.shippedProductId.length ; i++){                                
                        for(let k = 0; k < this_this.orderItemShipped.length ; k++){                                     
                            if(this_this.shippedProductId[i] == this_this.orderItemShipped[k].product_id) {
                                orders.push(this_this.orderItemShipped[k]);
                            }
                        }
                    }

                    this_this.orderItems = orders;                       
                      
                }, deliveredOrderStatus:  function(){
                    let this_this = this;

                    let orders = [];

                    for(let i = 0 ; i < this_this.shippedProductId.length ; i++){                                
                        for(let k = 0; k < this_this.orderItemShipped.length ; k++){                                     
                            if(this_this.shippedProductId[i] == this_this.orderItemShipped[k].product_id) {
                                orders.push(this_this.orderItemShipped[k]);
                            }
                        }
                    }

                    this_this.orderItems = orders;                       
                      
                }, deliveredOrderStatus:  function(){
                    let this_this = this;

                    let orders = [];

                    for(let i = 0 ; i < this_this.shippedProductId.length ; i++){                                
                        for(let k = 0; k < this_this.orderItemShipped.length ; k++){                                     
                            if(this_this.shippedProductId[i] == this_this.orderItemShipped[k].product_id) {
                                orders.push(this_this.orderItemShipped[k]);
                            }
                        }
                    }

                    this_this.orderItems = orders;                       
                      
                }, 
                
                deliveredOrderStatus:  function(){

                    let this_this = this;

                    let orders = [];

                    for(let i = 0 ; i < this_this.shippedProductId.length ; i++){                                
                        for(let k = 0; k < this_this.orderItemShipped.length ; k++){                                     
                            if(this_this.shippedProductId[i] == this_this.orderItemShipped[k].product_id) {
                                orders.push(this_this.orderItemShipped[k]);
                            }
                        }
                    }

                    this_this.orderItems = orders;                       
                      
                },

                getResolutions: function (event) {

                    let this_this = this;

                    var orderId = 0;

                    if(typeof event == 'number'){
                        orderId = event;
                    }else{
                        orderId = event.target.value;
                    }

                    this.resolutionShow = false;                               

                    if (orderId.length == 0 ) {
                        this.orderItems = this.blankData;
                        this.showSelectBox = false;
                        this.orderStatus = null;
                        this.resolutions = [];
                    }

                    if(orderId) {

                        this.$http.get(`{{ route('rma.customers.getproduct') }}/${orderId}`)
                        .then(response => {
                            this_this.data = response.data;

                            this_this.resolutions = response.data.resolutions;
                            this_this.orderId = this_this.data.orderId;
                            this_this.sellerInfo = this_this.data.sellerDetails;

                            this_this.orderId = this_this.data.orderId;

                            this_this.orderItems = this_this.blankData;

                            this_this.orderStatus = response.data.orderStatus;
                          
                        }).catch(error => {
                            this_this.output = error;
                        });
                    }

                    this_this.renderComponent = true;

                    this_this.$forceUpdate();

                },

                getResolutionsBySearch: function (order_id) {
                    var orderId = order_id;

                    this.resolutionShow = false;

                    if (orderId.length == 0 ) {
                        this.orderItems = this.blankData;
                        this.showSelectBox = false;
                        this.orderStatus = null;
                        this.resolutions = [];
                    }

                    immediate: true,

                    this.$http.get(`{{ route('rma.customers.getproduct') }}/${orderId}`)
                    .then(response => {
                        this.data = response.data;

                        this.resolutions = response.data.resolutions;
                        this.orderId = this.data.orderId;
                        this.sellerInfo = this.data.sellerDetails;

                        this.renderComponent = true;
                        this.orderId = this.data.orderId;
    
                        if (this.resolutions.length) {
                            this.orderStatus = ['Not Delivered'];
                        } else {
                            this.orderStatus = 0;
                        }
                        

                        this.$forceUpdate();
                    }).catch(error => {
                        this.output = error;
                    });
                },

                getOrderByResolution: function (event) {
                    var orderId = this.orderId;
                    var resolution = event.target.value;
                    let this_this = this;

                    this.resolutionShow = true;

                    if (resolution == '') {
                        this.resolutionShow = false;
                        resolution = null;
                        this.orderItems = this.blankData;
                    }

                    this.$http.get(`{{ route('rma.customers.getproduct') }}/${orderId}/${resolution}`)
                    .then(response => {

                        this_this.orderItems = response.data.orderItems;

                        this_this.html = response.data.html;
                        this_this.child = response.data.child;
                        this_this.itemsId = response.data.itemsId;
                        this_this.quantity = response.data.quantity;
                        this_this.resolutions= response.data.resolutions;
                        this_this.orderStatus = response.data.orderStatus;
                        this_this.productImage = response.data.productImage;
                        this_this.rmaOrderItemId = response.data.rmaOrderItemId;
                        this_this.productImageCounts = response.data.productImageCounts;
                        this_this.countRmaOrderItems = response.data.countRmaOrderItems;
                        this_this.shippedProductId = response.data.shippedProductId;
                        this_this.shippingOrderStatus = response.data.shippingOrderStatus;
                        this_this.orderItemShipped = response.data.orderItems;

                        if(this_this.shippingOrderStatus) {
                            
                            let orders = [];

                            for(let i = 0 ; i < this_this.shippedProductId.length ; i++){                                
                                for(let k = 0; k < this_this.orderItems.length ; k++){                                     
                                    if(this_this.shippedProductId[i] != this_this.orderItems[k].product_id) {
                                        orders.push(this_this.orderItems[k]);
                                    }
                                }
                            }

                            this_this.orderItems = orders;
                        }

                        if ($('#checkOrderStatus').val() == 'Delivered') {
                            this_this.deliveredOrderStatus();
                        }

                        window.updateHeight();
                        $('.account-content').css('height', '100%');
                    }).catch(error => {
                        this.output = error;
                    });

                    this.renderComponent = true;
                    this.orderId = this.data.orderId;

                    this.$forceUpdate();

                    this.orderItems = this.blankData;
                },

                getOrderDetail: function (marketplace_seller_id) {
                    var marketplace_seller_id =  event.target.value;

                    if (marketplace_seller_id != '' ) {
                        this.resolutions = this.blankData;
                        this.seller = false;
                        this.resolutionShow = true;
                    } else {
                        this.orderItems = this.blankData;
                    }

                    var order_id = this.data['orderId'];

                    this.$http.post("{{ route('rma.customers.getproductbyseller') }}", {
                        marketplace_seller_id: marketplace_seller_id,
                        order_id: order_id,
                        resolution:this.resolutions
                    }).then(response => {
                        this.orderStatus = response.data.orderStatus;

                        this.resolutions= response.data.resolutions;
                    }).catch(error => {
                        this.output = error;
                    });
                },

                getId: function (e) {
                    this.validate[e.target.value] = e.target.checked ? true : false;
                },

                checkAll: function () {
                    this.selected = [];
                    this.isCheckAll = !this.isCheckAll;

                    if (this.isCheckAll) {
                        for (var key in this.orderItems) {
                            this.selected.push(this.orderItems[key].id);
                            this.validate[this.orderItems[key].id] = true;
                        }
                    }

                    if (!this.isCheckAll) {
                        for (var key in this.orderItems) {
                            this.validate[this.orderItems[key].id] = false;
                        }
                    }
                },

                updateCheckall: function () {
                    this.isCheckAll = this.selected.length == this.orderItems.length;
                },

                searchOrders: function (event) {
                    this.$http.get(`{{ route('rma.customer.search.order') }}/${this.searchOrderValue != '' ? this.searchOrderValue : 'all'}`)
                        .then(response => {
                            if (response.data.length) {
                                this.orders = response.data; 
                                this.dosearch = true;
                                this.getResolutionsBySearch(this.orders[0].increment_id);
                            } else {
                                alert('Invalid Order Id ');
                            }
                        }).catch(error => {
                            console.log(this.__('error.something_went_wrong'));
                        });

                    event.preventDefault();
                }
            },

           
        });

        function  formValidation() {
            var allCheckbox = document.getElementById('checkbox').checked;
            var checkboxes = document.querySelectorAll('#checkboxSingle:checked'), values = [];
            Array.prototype.forEach.call(checkboxes, function(el) {
                values.push(el.value);
            });
            if (values.length > 0) {
                singleCheckBox = true;
            } else {
                singleCheckBox = false;
            }
            if (allCheckbox == false && singleCheckBox == false) {
                alert('Please select item');
                event.preventDefault();
                return false;
            }
        }

        $(document).ready(function() {
            $('#information').keypress(function(e) {
                max = 50;
                if (e.which < 0x20) {
                    return;
                }
                if (this.value.length == max) {
                    e.preventDefault();
                } else if (this.value.length > max) {
                    this.value = this.value.substring(0, max);
                }
            });

            $('.image-wrapper~.btn').click(() => {
                window.updateHeight();
            });
        })
    </script>
@endpush

@push('css')
    <style>
        .small-padding {
            padding: 3px 12px!important;
        }
        .btn {
            font-size: 16px;
            font-weight: 600;
            border-radius: 0;
        }
        .image-wrapper {
            margin-bottom: 20px;
            margin-top: 10px;
            display: inline-block;
            width: 100%;
        }
        .image-wrapper .image-item {
            width: 200px;
            height: 200px;
            margin-right: 20px;
            background: #f8f9fa;
            border-radius: 3px;
            display: inline-block;
            position: relative;
            background-repeat: no-repeat;
            background-position: 50%;
            margin-bottom: 20px;
            float: left;
            background-image: url(/vendor/webkul/ui/assets/images/placeholder-icon.svg);
        }
        .image-wrapper .image-item .remove-image {
            background-image: linear-gradient(-180deg,rgba(0,0,0,.08),rgba(0,0,0,.24));
            border-radius: 0 0 4px 4px;
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 10px;
            text-align: center;
            color: #fff;
            text-shadow: 0 1px 2px rgba(0,0,0,.24);
            margin-right: 20px;
            cursor: pointer;
        }
        .image-wrapper .image-item input {
            display: none;
        }
        .control-group {
            vertical-align: top;
            margin-right: 20px;
            display: inline-block;
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
        input[type=checkbox] {
            margin: 0px;
            width: 20px !important;
        }
    </style>
@endpush
