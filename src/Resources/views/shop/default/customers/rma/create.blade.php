<x-shop::layouts.account>

{{-- Title of the page --}}
<x-slot:title>
    @lang('rma::app.shop.customer.title')
</x-slot>

<div class="account-layout" @if(!auth()->guard('customer')->user())@endif>
    <rma-request-wrapper></rma-request-wrapper>
    
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
                    <h2 class="text-[26px] font-medium">
                        @lang('rma::app.shop.customer-rma-create.heading')
                    </h2>

                    <div class="account-action">
                        <button
                            type="submit"
                            class="primary-button"
                            onClick="formValidation()"
                        >
                            @lang('rma::app.general.create')
                        </button>
                    </div>
                </div>
            
                @csrf()
                <br>
                
                <div class="sale-section">
                    <div class="control-group">
                        <input
                            type="text"
                            class="control"
                            v-model="searchOrderValue"
                           
                        />
                    </div>

                    <!-- <div class="control-group">
                        <button
                            class="btn btn-md btn-primary"
                        >
                            @lang('rma::app.datagrid.apply')
                        </button>
                    </div> -->

                    <!-- <div class="flex gap-[16px] justify-between items-center max-sm:flex-wrap"> -->

                        <div class="p-[16px]">
                            <x-shop::form.control-group class="mb-[10px]">
                                <x-shop::form.control-group.label class="required">
                                    @lang('rma::app.shop.validation.order_id')
                                </x-shop::form.control-group.label>
                        
                                <x-shop::form.control-group.control
                                    type="select"
                                    name="order_id"
                                    id="orderItem"
                                    rules="required"
                                    @change="getSellersName($event)"
                                    :label="trans('rma::app.shop.validation.order_id')"
                                    :placeholder="trans('rma::app.shop.validation.order_id')"
                                >
                                <option
                                    :value="null"
                                >
                                @lang('rma::app.shop.default-option.select-order')
                                </option>
                                <option
                                    v-for="(orderItem, index) in orderItems"
                                    :value="orderItem.id"
                                    :selected="index == 0"
                                >
                                @{{ '#' + orderItem.increment_id }}, $@{{ orderItem.grand_total}}
                                </option>
                                </x-shop::form.control-group.control>

                                <x-shop::form.control-group.error
                                    control-name="order_id"
                                >
                                </x-shop::form.control-group.error>
                            </x-shop::form.control-group>

                            
                            <x-shop::form.control-group class="mb-[10px]">
                                <x-shop::form.control-group.label  class="required">
                                    @lang('rma::app.shop.customer-rma-create.resolution')
                                </x-shop::form.control-group.label>
                        
                                <x-shop::form.control-group.control
                                    type="select"
                                    id="resolution"
                                    name="resolution"
                                    rules="required"
                                    @change="getOrderByResolution()"
                                    :label="trans('rma::app.shop.validation.resolution')"
                                >
                                @lang('rma::app.shop.validation.resolution')
                                <option
                                    :value="null"
                                >
                                @lang('rma::app.shop.default-option.select-resolution')

                                </option>
                                <option
                                    v-for="selectResolutionByOrder in resolutionSelect"
                                    :value="selectResolutionByOrder"
                                >
                                @{{ selectResolutionByOrder }}
                                </option>
                                </x-shop::form.control-group.control>

                                <x-shop::form.control-group.error
                                    control-name="resolution"
                                >
                                </x-shop::form.control-group.error>
                            </x-shop::form.control-group>

                            <x-shop::form.control-group class="mb-[10px]">
                                <x-shop::form.control-group.label class="required">
                                    @lang('rma::app.shop.customer-rma-create.order_status')
                                </x-shop::form.control-group.label>
                        
                                <x-shop::form.control-group.control
                                    type="select"
                                    id="checkOrderStatus"
                                    name="order_status"
                                    rules="required"
                                    for="order_status"
                                    @change="checkOrderStatus($event)"
                                    :label="trans('rma::app.shop.validation.order_status')"
                                    :placeholder="trans('rma::app.shop.validation.order_status')"
                                >
                                <option
                                    v-for="orderStatusOptions in orderStatus"
                                    :value="orderStatusOptions"
                                >
                                @{{ orderStatusOptions }}
                                </option>
                                </x-shop::form.control-group.control>

                                <x-shop::form.control-group.error
                                    v-if="orderStatus == 0"
                                    control-name="order_status"
                                >
                                <p>@lang('rma::app.shop.customer-rma-create.not_allowed')</p>
                                </x-shop::form.control-group.error>
                            </x-shop::form.control-group>
                        </div>
                    <!-- </div> -->
                </div>
                 <br><br>  
                <div class="flex justify-between items-center">
                    <p class="text-[20px] text-gray-800 dark:text-white font-bold">
                        @lang('rma::app.shop.customer-rma-create.item-ordered')
                    </p>
                </div>
                <!-- <div class="section-content">
                        <div class="table"> -->
                        <div class="mt-[15px] overflow-x-auto">
                            <x-admin::table>
                            <draggable
                                    tag="tbody"
                                    ghost-class="draggable-ghost"
            
                                >
                                <x-admin::table.thead class="text-[14px] font-medium dark:bg-gray-800">
                                    <x-admin::table.thead.tr>
                                        <x-admin::table.th class="!p-0"></x-admin::table.th>
                                        <x-admin::table.th>

                                            <x-admin::form.control-group.control
                                                type="checkbox"
                                                v-model="isCheckAll"
                                                id="checkbox"
                                                @click="checkAll()"
                                            >
                                            </x-admin::form.control-group.control>
                                        </x-admin::table.th>

                                        <x-admin::table.th>
                                            @lang('rma::app.shop.customer-rma-create.image')
                                        </x-admin::table.th>

                                        <x-admin::table.th>
                                            @lang('rma::app.shop.customer-rma-create.product')
                                        </x-admin::table.th>

                                        <x-admin::table.th>
                                            @lang('rma::app.shop.customer-rma-create.sku')
                                        </x-admin::table.th>

                                        <x-admin::table.th>
                                            @lang('rma::app.shop.customer-rma-create.price')
                                        </x-admin::table.th>

                                        <x-admin::table.th>
                                            @lang('rma::app.shop.customer-rma-create.quantity')
                                        </x-admin::table.th>

                                        <x-admin::table.th>
                                            @lang('rma::app.shop.customer-rma-create.reason')
                                        </x-admin::table.th>
                                    </x-admin::table.thead.tr>
                                </x-admin::table.thead>

                                <x-admin::table.thead.tr  v-for="(orderData,index) in sellerOrderedData" class="hover:bg-gray-50 dark:hover:bg-gray-950">
                                    
                                    <x-admin::table.td>

                                        <input
                                            type="checkbox"
                                            id="checkboxSingle"
                                            name="order_item_id[]"
                                            v-bind:value="orderData.id"
                                            v-model='selected'
                                            @change='updateCheckall(); getId($event)'
                                        />
                                        <x-admin::form.control-group.label
                                            type="checkbox-view"
                                            name="checkbox"
                                        >
                                        </x-admin::form.control-group.label>
                                    </x-admin::table.td>

                                    <x-admin::table.td v-if="productImageCounts > 0">
                                        <!-- Image -->
                                        <div>
                                            <img 
                                                src="productImage[orderData.product_id]['medium_image_url']"
                                            />

                                            <img 
                                                src="{{  url('vendor/webkul/ui/assets/images/product/small-product-placeholder.png') }}"
                                            /> 
                                        </div>
                                    </x-admin::table.td>

                                    <x-admin::table.td>
                                    <span>
                                        @{{ orderData.type == 'configurable' ? child[orderData.id] ? child[orderData.id].name : orderData.name : orderData.name }}
                                    </span>
                                    <li 
                                        v-if="html.length != 0" 
                                        :v-html="html[orderData.id]"
                                    >

                                        @{{ html[orderData.id] }}

                                    </li>
                                    </x-admin::table.td>

                                    <x-admin::table.td>
                                        @{{  orderData.type == 'configurable' ? child[orderData.id] ? child[orderData.id].sku : orderData.sku : orderData.sku }}
                                    </x-admin::table.td>

                                    <x-admin::table.td>
                                        @{{ orderData.price }}
                                    </x-admin::table.td>

                                    <x-admin::table.td>
                                        <x-admin::form.control-group class="mb-[10px]">
                                            <x-admin::form.control-group.label class="required">
                                                @lang('rma::app.shop.default-option.select-quantity')
                                            </x-admin::form.control-group.label>
                                    
                                            <x-admin::form.control-group.control
                                                type="select"
                                                id="quantity"
                                                name="quantity"
                                                rules="required"
                                                :label="trans('rma::app.shop.default-option.select-quantity')"
                                                :placeholder="trans('rma::app.shop.default-option.select-quantity')"
                                            >
                                            <option
                                                :value="null"
                                            >
                                            <p>@lang('rma::app.shop.default-option.select-quantity')</p>
                                            </option>

                                            <option
                                                v-for="qtyLength in quantity[orderData.id]"
                                                :value="qtyLength"
                                            >
                                            @{{ qtyLength }}

                                            </option>
                                            </x-admin::form.control-group.control>

                                            <x-admin::form.control-group.error
                                                control-name="('quantity[' + sellerOrderedData[index].id + ']')"
                                            >
                                            </x-admin::form.control-group.error>
                                        </x-admin::form.control-group>
                                    </x-admin::table.td>
                            
                                    <x-admin::table.td>
                                        <x-admin::form.control-group class="mb-[10px]">
                                            <x-admin::form.control-group.label class="required">
                                                @lang('rma::app.shop.default-option.select-reason')
                                            </x-admin::form.control-group.label>
                                    
                                            <x-admin::form.control-group.control
                                                type="select"
                                                id="rma_reason_id"
                                                name="rma_reason_id"
                                                v-validate="validate[sellerOrderedData[index].id] || is_required ? 'required' : ''"
                                                rules="required"
                                                :label="trans('rma::app.shop.default-option.select-reason')"
                                                :placeholder="trans('rma::app.shop.default-option.select-reason')"
                                            >
                                            <option
                                                :value="null"
                                            >
                                            <p>@lang('rma::app.shop.default-option.select-reason')</p>
                                            </option>

                                            @foreach($reasons as $reasons_value)
                                                <option value="{{ $reasons_value->id }}">
                                                    {{ $reasons_value->title }}
                                                </option>
                                            @endforeach

                                            </x-admin::form.control-group.control>

                                            <x-admin::form.control-group.error
                                                control-name="rma_reason_id"
                                            >
                                            </x-admin::form.control-group.error>
                                        </x-admin::form.control-group>
                                    </x-admin::table.td>
                                </x-admin::table.thead.tr>
                                </draggable>
                            </x-admin::table>
                            <div v-if="seller == true && resolutionShow == true">
                                <div v-if="sellerOrderedData.length == 0" style="text-align: center;">
                                    <p>@lang('rma::app.shop.customer-rma-create.rma-not-avilable-quotes')</p>
                                </div>
                            </div>
                        </div>
                        <!-- </div>
                    </div> -->
                    <br><br>
                <div class="sale-container">
                    <div>
                    <div class="sale-section">
                    <div class="flex justify-between items-center">
                        <h2 class="text-[26px] font-medium">
                            @lang('rma::app.shop.customer-rma-create.images')
                        </h2>
                    </div>
                    <div class="row">
                        <x-shop::form.control-group>
                            <x-shop::media
                                name="images"
                                :multiple="true"
                            >
                            @lang('admin::app.catalog.products.add-image-btn-title')
                            </x-shop::media>
                        </x-shop::form.control-group>
                        </div>
                        </div>

                        <x-shop::form.control-group.control
                            type="hidden"
                            name="email"
                            value="{{ $customerEmail }}"
                        >
                        </x-shop::form.control-group.control>

                        <x-shop::form.control-group.control
                            type="hidden"
                            name="name"
                            value="{{ $customerName }}"
                        >
                        </x-shop::form.control-group.control>

                        <x-shop::form.control-group.control
                            type="hidden"
                            name="token"
                            value="{!! csrf_token() !!}"
                        >
                        </x-shop::form.control-group.control>

                        <div class="flex gap-x-[10px] items-center">
                            <div class="p-[16px]">
                            <x-shop::form.control-group class="mb-[10px]">
                                <x-shop::form.control-group.label class="required">
                                    @lang('rma::app.shop.customer-rma-create.information')
                                </x-shop::form.control-group.label>
                        
                                <x-shop::form.control-group.control
                                    type="text"
                                    name="information"
                                    id="information"
                                    rules="required"
                                    :label="trans('rma::app.shop.customer-rma-create.information')"
                                    :placeholder="trans('rma::app.shop.customer-rma-create.information')"
                                    rows="3"
                                >
                                </x-shop::form.control-group.control>

                                <x-shop::form.control-group.error
                                    control-name="information"
                                >
                                </x-shop::form.control-group.error>
                            </x-shop::form.control-group>
                            </div>
                        </div>
                    </div>
                    </div>
            </x-shop::form>
        </div>
    </script>

    <script type="module">
        app.component('rma-request-wrapper', {
            template: '#rma-request-template',

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
                // console.log(this.orderItems);
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
                   
                    let this_this = this;

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

                        this.$axios.get(`{{ route('rma.customers.getproduct') }}/${orderId}`)
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

                    let this_this = this;

                    var orderId = this.orderId;

                    var resolution = event.target.value;

                    this_this.resolutionShow = true;

                    if (resolution == '') {
                        this_this.resolutionShow = false;
                        resolution = null;
                        this_this.sellerOrderedData = this_this.blankData;
                    }


                    let currentObj = this_this;

                    immediate: true,

                    this.$axios.get(`{{ route('rma.customers.getproduct') }}/${orderId}/${resolution}`)
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

                        this.$axios.post("{{ route('rma.customers.getproductbyseller') }}",

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
                    this.$axios.get(`{{ route('rma.customer.search.order') }}/${this.searchOrderValue != '' ? this.searchOrderValue : 'all'}`)
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
    </script>
@endpushOnce
</x-shop::layouts.account>