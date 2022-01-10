@extends('shop::layouts.master')

@section('page_title')
    {{ __('rma::app.shop.customer.title') }}
@endsection

@section('content-wrapper')
    <div class="account-content">
        @if (auth()->guard('customer')->user())
            @include('shop::customers.account.partials.sidemenu')
        @endif

        <div class="account-layout" @if(!auth()->guard('customer')->user()) style="width: 100%;" @endif>
            <form method="POST" action="{{ route('rma.customers.store') }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
                <div class="account-head mb-30">
                    <span class="account-heading">
                        {{ __('rma::app.shop.customer-rma-create.heading') }}
                    </span>

                    <div class="account-action">
                        <button type="submit" class="btn btn-md btn-primary" onClick="formValidation()">
                            {{ __('rma::app.general.create') }}
                        </button>
                    </div>
                </div>
                <div class="horizontal-rule"></div>
                @csrf()
                <br>
                <option-wrapper></option-wrapper>
                <div class="sale-container">
                    <div>
                        <div class="sale-section">
                            <div class="sale-title">
                                <div class="secton-title">
                                    {{ __('rma::app.shop.customer-rma-create.images') }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="control-group">
                                    <image-wrapper :button-label="'{{ __('admin::app.catalog.products.add-image-btn-title') }}'"
                                        input-name="images" :multiple="true">
                                    </image-wrapper>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="email" value="{{ $customerEmail }}">
                        <input type="hidden" name="name" value="{{ $customerName }}">
                        <input type="hidden" name="token" value="{!! csrf_token() !!} ">

                        <div class="sale-section">
                            <div class="sale-title">
                                <div class="secton-title">
                                    {{ __('rma::app.shop.customer-rma-create.information') }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="control-group" :class="[errors.has('information') ? 'has-error' : '']">
                                    <textarea class="control" id="information" name="information"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@push('scripts')
    <script type="text/x-template" id="options-template">
        <div class="sale-container">
            <div>
                <div class="sale-section">
                    <div class="control-group">
                        <input
                            type="text"
                            class="control"
                            v-model="searchOrderValue"
                            placeholder="{{ __('rma::app.shop.customer-rma-create.search_order') }}"
                        />
                    </div>

                    <div class="control-group">
                        <button
                            class="btn btn-md btn-primary"
                            @click="searchOrders($event)"
                        >
                            {{ __('ui::app.datagrid.apply') }}
                        </button>
                    </div>

                    <div class="sale-title">
                        <div class="secton-title">
                            {{ __('rma::app.shop.customer-rma-create.orders') }}
                        </div>
                    </div>

                    <div class="control-group" :class="[errors.has('order_id') ? 'has-error' : '']">
                        <select v-validate="'required'" class="control" id="orderItem" name="order_id" @change="getSellersName($event)" data-vv-as="&quot;{{ __('rma::app.shop.validation.order_id') }}&quot;">
                            <option :value="null" >{{ __('rma::app.shop.default-option.select-order') }}</option>
                            <option v-for="(orderItem, index) in orderItems" :value="orderItem.id" :selected="index == 0">
                                @{{ '#' + orderItem.increment_id }}, $@{{ orderItem.grand_total}}
                            </option>
                        </select>
                        <span class="control-error" v-if="errors.has('order_id')">@{{ errors.first('order_id') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('resolution') ? 'has-error' : '']" v-if="resolutionSelect != ''">
                        <label for="resolution">{{ __('rma::app.shop.customer-rma-create.resolution') }}</label>

                        <select
                            class="control"
                            id="resolution"
                            name="resolution"
                            v-validate="'required'"
                            @change="getOrderByResolution()"
                            data-vv-as="&quot;{{ __('rma::app.shop.validation.resolution') }}&quot;">
                            <option :value="null" >{{ __('rma::app.shop.default-option.select-resolution') }}</option>
                            <option v-for="selectResolutionByOrder in resolutionSelect" :value="selectResolutionByOrder">
                                @{{ selectResolutionByOrder }}
                            </option>
                        </select>

                        <span class="control-error" v-if="errors.has('resolution')">@{{ errors.first('resolution') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('order_status') ? 'has-error' : '']" v-if="orderStatus">
                        <label for="order_status">{{ __('rma::app.shop.customer-rma-create.order_status') }}</label>
                        <select class="control" id="checkOrderStatus"  name="order_status" v-validate="'required'" @change="checkOrderStatus($event)" data-vv-as="&quot;{{ __('rma::app.shop.validation.order_status') }}&quot;">
                            <option v-for="orderStatusOptions in orderStatus" :value="orderStatusOptions">
                                @{{ orderStatusOptions }}</option>
                        </select>
                        <span class="control-error" v-if="errors.has('order_status')">@{{ errors.first('order_status') }}</span>
                    </div>
                    <div class="control-group" :class="[errors.has('order_status') ? 'has-error' : '']" v-if="orderStatus == 0">
                        <p>{{ __('rma::app.shop.customer-rma-create.not_allowed') }}</p>
                    </div>
                </div>

                <div class="sale-section">
                    <div class="secton-title">
                        <span class="title">
                            {{ __('rma::app.shop.customer-rma-create.item-ordered') }}
                        </span>
                    </div>
                    <div class="section-content">
                        <div class="table">
                            <table>
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>
                                            <div class="checkbox">
                                                <input type='checkbox' @click='checkAll()' id="checkbox" v-model='isCheckAll'>
                                                <label class="checkbox-view" for="checkbox"></label>
                                            </div>
                                        </th>
                                        <th>
                                            {{ __('rma::app.shop.customer-rma-create.image') }}
                                        </th>

                                        <th style="max-width: 100%;
                                        width: 20%;">{{ __('rma::app.shop.customer-rma-create.product') }}</th>

                                        <th>{{ __('rma::app.shop.customer-rma-create.sku') }}</th>

                                        <th>{{ __('rma::app.shop.customer-rma-create.price') }}</th>

                                        <th>{{ __('rma::app.shop.customer-rma-create.quantity') }}</th>

                                        <th>{{ __('rma::app.shop.customer-rma-create.reason') }}</th>
                                    </tr>
                                </thead>

                                <tbody style="text-align: center;" v-if="seller == true && sellerOrderedData.length != 0 && resolutionSelect != null">
                                    <tr v-for="(orderData,index) in sellerOrderedData">
                                        <td>
                                            <div class="checkbox">
                                                <input type='checkbox' id="checkboxSingle" name="order_item_id[]"  v-bind:value="orderData.id" v-model='selected' @change='updateCheckall(); getId($event)'>
                                                <label class="checkbox-view" for="checkbox"></label>
                                            </div>
                                        </td>

                                        <td>
                                            <img style="height: auto; max-width: 30%;" v-if="productImageCounts > 0" :src="productImage[orderData.product_id]['medium_image_url']">
                                            <img v-else style="max-width: 100%;max-height: 50%;" src="{{  url('vendor/webkul/ui/assets/images/product/small-product-placeholder.png') }}">
                                        </td>

                                        <td style="width: auto;" >
                                            <span>
                                                @{{ orderData.type == 'configurable' ? child[orderData.id] ? child[orderData.id].name : orderData.name : orderData.name }}
                                            </span><br><br>
                                            <li style="display:inline;"  v-if="html.length != 0" v-html="html[orderData.id]">
                                            @{{ html[orderData.id] }}
                                            </li>
                                        </td>

                                        <td>
                                            @{{  orderData.type == 'configurable' ? child[orderData.id] ? child[orderData.id].sku : orderData.sku : orderData.sku }}</td>
                                        </td>

                                        <td>@{{ orderData.price }}</td>

                                        <td>
                                            <div class="control-group" :class="[errors.has('quantity[' + sellerOrderedData[index].id + ']') ? 'has-error' : '']">
                                                <select class="control" :name="'quantity[' + sellerOrderedData[index].id + ']'"
                                                id="quantity" v-validate="validate[sellerOrderedData[index].id] || is_required ? 'required' : ''" data-vv-as="&quot;{{ __('rma::app.shop.default-option.select-quantity') }}&quot;">
                                                    <option :value="null">{{ __('rma::app.shop.default-option.select-quantity') }}</option>
                                                    <option v-for="qtyLength in quantity[orderData.id]"  :value="qtyLength">@{{ qtyLength }}</option>
                                                </select>
                                                <span class="control-error" v-if="errors.has('quantity[' + sellerOrderedData[index].id + ']')">@{{ errors.first('quantity[' + sellerOrderedData[index].id + ']') }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="control-group" :class="[errors.has('rma_reason_id[' + sellerOrderedData[index].id + ']') ? 'has-error' : '']">
                                                <select class="control" :name=" 'rma_reason_id[' + sellerOrderedData[index].id + ']'"
                                                id="rma_reason_id" v-validate="validate[sellerOrderedData[index].id] || is_required ? 'required' : ''" data-vv-as="&quot;{{ __('rma::app.shop.default-option.select-reason') }}&quot;">
                                                    <option :value="null" >{{ __('rma::app.shop.default-option.select-reason') }}</option>
                                                    @foreach($reasons as $reasons_value)
                                                        <option value="{{ $reasons_value->id }}">
                                                            {{ $reasons_value->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="control-error" v-if="errors.has('rma_reason_id[' + sellerOrderedData[index].id + ']')">@{{ errors.first('rma_reason_id[' + sellerOrderedData[index].id + ']') }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div v-if="seller == true && resolutionShow == true">
                                <div v-if="sellerOrderedData.length == 0" style="text-align: center;">
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

            data: function(data) {
                return {
                    orderItems: @json($orderItems),
                    sellerOrderedData : [],
                    seller: false,
                    data: [],
                    productImage: [],
                    selected: [],
                    seller_id: null,
                    showSelectBox: false,
                    sellerInfo: [],
                    orderId: null,
                    renderComponent: true,
                    resolutionSelect: [],
                    orderStatus: null,
                    blankData: [],
                    searchOrderValue: '',
                    singleOrderSellerId: null,
                    productImageCounts: null,
                    is_required: false,
                    child: [],
                    validate: {
                        'is_required': false,
                    },
                    isCheckAll: false,
                    quantity: [],
                    rmaOrderItemId: [],
                    countRmaOrderItems: [],
                    resolutionShow: false,
                    html: [],
                    shippedProductId: [],
                    shippingOrderStatus: 0,
                    orderItemShipped: []
                }
            },

            mounted() {
                if(this.orderItems) {
                    this.getSellersName(this.orderItems[0].id);
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

                        this_this.sellerOrderedData = orders;                       
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
    
                        this_this.sellerOrderedData = orders;
                    }
                },

                deliveredOrderStatus:  function() {

                    let this_this = this;

                    let orders = [];

                    for(let i = 0 ; i < this_this.shippedProductId.length ; i++){                                
                        for(let k = 0; k < this_this.orderItemShipped.length ; k++){                                     
                            if(this_this.shippedProductId[i] == this_this.orderItemShipped[k].product_id) {
                                orders.push(this_this.orderItemShipped[k]);
                            }
                        }
                    }

                    this_this.sellerOrderedData = orders;                    
                },

                getSellersName: function (order_id) {

                    var orderId = 0 ;

                    if(typeof order_id == 'number'){
                        orderId = order_id;
                    }else{
                        orderId = event.target.value;
                    }
                   
                    this_this = this;

                    this_this.resolutionShow = false;

                    if (orderId.length == 0 ) {
                        this_this.sellerOrderedData = this_this.blankData;
                        this_this.showSelectBox = false;
                        this_this.orderStatus = null;
                        this_this.resolutionSelect = [];
                    }

                    let currentObj = this_this;

                    if(orderId) {

                        immediate: true,

                        this_this.$http.get(`{{ route('rma.customers.getproduct') }}/${orderId}`)
                        .then(response => {
                            this_this.data = response.data;

                            this_this.resolutionSelect = response.data.resolutions;

                            this_this.orderId = this_this.data.orderId;

                            // this_this.orderStatus = ['Not Delivered'];
                            this_this.orderStatus = response.data.orderStatus;

                            this_this.renderComponent = true;

                            this_this.$forceUpdate();

                            this_this.sellerOrderedData = this_this.blankData;

                            if (response.data.showSelectBox == true) {
                                this_this.showSelectBox = true;
                            } else {
                                this_this.showSelectBox = false;
                            }
                        }).catch(function (error) {
                            currentObj.output = error;
                        });
                    }
                },

                getOrderByResolution: function() {

                    var orderId = this.orderId;

                    var resolution = event.target.value;

                    this_this.resolutionShow = true;

                    if (resolution == '') {
                        this_this.resolutionShow = false;
                        resolution = null;
                        this_this.sellerOrderedData = this_this.blankData;
                    }

                    this_this = this;

                    let currentObj = this_this;

                    immediate: true,

                        this_this.$http.get(`{{ route('rma.customers.getproduct') }}/${orderId}/${resolution}`)
                        .then(response => {

                            this_this.sellerOrderedData = response.data.orderItems;

                            this_this.html = response.data.html;

                            this_this.itemsId = response.data.itemsId;

                            this_this.child = response.data.child;

                            this_this.productImage = response.data.productImage;

                            this_this.productImageCounts = response.data.productImageCounts;

                            this_this.quantity = response.data.quantity;

                            this_this.resolutionSelect= response.data.resolutions;

                            this_this.rmaOrderItemId = response.data.rmaOrderItemId;

                            this_this.countRmaOrderItems = response.data.countRmaOrderItems;

                            this_this.orderStatus = response.data.orderStatus;

                            this_this.shippedProductId = response.data.shippedProductId;

                            this_this.shippingOrderStatus = response.data.shippingOrderStatus;

                            this_this.orderItemShipped = response.data.orderItems;

                            if(this_this.shippingOrderStatus) {
                                
                                let orders = [];
                                for(let i = 0 ; i < this_this.shippedProductId.length ; i++){                                
                                    for(let k = 0; k < this_this.sellerOrderedData.length ; k++){                                     
                                        if(this_this.shippedProductId[i] != this_this.sellerOrderedData[k].product_id) {
                                            orders.push(this_this.sellerOrderedData[k]);
                                        }
                                    }
                                }

                                this_this.sellerOrderedData = orders;
                            }

                            if ($('#checkOrderStatus').val() == 'Delivered') {
                                this_this.deliveredOrderStatus();
                            }

                            this_this.seller = true;

                        }).catch(function (error) {
                            currentObj.output = error;
                        });

                    this_this.orderId = this_this.data.orderId;

                    this_this.renderComponent = true;

                    this_this.$forceUpdate();

                    this_this.sellerOrderedData = this_this.blankData;
                },

                getOrderDetail: function (marketplace_seller_id) {

                        this_this = this;

                        var marketplace_seller_id =  event.target.value;

                        if( marketplace_seller_id != '' ) {
                            this_this.resolutionSelect = this_this.blankData;
                            this_this.seller = false;
                            this_this.resolutionShow = true;
                        } else {
                            this_this.sellerOrderedData = this_this.blankData;
                        }

                        var order_id = this_this.data['orderId'];

                        let currentObj = this_this;

                        this_this.$http.post("{{ route('rma.customers.getproductbyseller') }}",

                        {marketplace_seller_id: marketplace_seller_id, order_id: order_id,resolution:this_this.resolutionSelect})

                        .then(response => {

                            this_this.orderStatus = response.data.orderStatus;

                            this_this.resolutionSelect= response.data.resolutionSelect;

                        }).catch(function (error) {
                            currentObj.output = error;
                        });
                },

                getId: function(e) {

                    var this_this = this;

                    if (e.target.checked) {
                        this_this.validate[e.target.value] = true;
                    } else {
                        this_this.validate[e.target.value] = false;
                    }
                },

                checkAll: function () {
                    this.isCheckAll = !this.isCheckAll;
                    this.selected = [];
                    if(this.isCheckAll){
                        for (var key in this.sellerOrderedData) {
                        this.selected.push(this.sellerOrderedData[key].id);
                        this_this.validate[this.sellerOrderedData[key].id] = true;
                        }
                    }

                    if(!this.isCheckAll){
                        for (var key in this.sellerOrderedData) {
                            this_this.validate[this.sellerOrderedData[key].id] = false;
                        }
                    }
                },

                updateCheckall: function(){
                    if(this.selected.length == this.sellerOrderedData.length){
                        this.isCheckAll = true;
                    }else{
                        this.isCheckAll = false;
                    }
                },

                searchOrders: function (event) {
                    this.$http.get(`{{ route('rma.customer.search.order') }}/${this.searchOrderValue != '' ? this.searchOrderValue : 'all'}`)
                        .then(response => {
                            if (response.data.length) {
                                this.orderItems = response.data; 
                                this.getSellersName(this.orderItems[0].increment_id);
                            } else {
                                alert('Invalid Order Id ');
                            }
                        }).catch(error => {
                            this.output = error;
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
        })
    </script>
@endpush
