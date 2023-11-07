<x-shop::layouts.account>

{{-- Page Title --}}
    <x-slot:title>
        @lang('rma::app.shop.customer.title')
    </x-slot>
        <x-shop::form
                :action="route('rma.customers.allrma')"
                class="rounded mt-[30px]" 
                method="GET"
                enctype="multipart/form-data"
            >
            
            <div class="account-layout" @if(!auth()->guard('customer')->user())@endif>
                <div class="flex gap-[16px] justify-between items-center max-sm:flex-wrap">
                    <div class="flex gap-x-[10px] items-center">
                        <h1 class="text-[20px] text-gray-800 dark:text-white font-bold">

                            @lang('rma::app.shop.customer-rma-create.heading')
                        </h1>
                    </div>
                    <div class="flex gap-x-[10px] items-center">

                    <!-- Update Button -->
                    <button type="submit" class="primary-button">
                        @lang('rma::app.general.create')
                    </button>
                    </div>
                </div>
                <div class="horizontal-rule"></div>

                @csrf()
                <br>
                    <div class="relative p-[16px] bg-white dark:bg-gray-900 rounded-[4px] box-shadow">
                    
                    <!-- Panel Header -->
                        <div class="flex gap-[20px] justify-between mb-[16px]">
                            <div class="flex flex-col gap-[8px]">
                                <p class="text-[16px] text-gray-800 dark:text-white font-semibold">
                                    @lang('rma::app.shop.customer-rma-create.images')
                                </p>
                            </div>
                        </div>
                        <input type="hidden" name="email" value="{{ $customerEmail }}">
                        <input type="hidden" name="name" value="{{ $customerName }}">
                        <input type="hidden" name="token" value="{!! csrf_token() !!} ">
        
                        <!-- Image Blade Component -->
                        <x-shop::media
                            name="images[files]"
                            allow-multiple="true"
                            show-placeholders="true"
                        >
                        </x-shop::media>
                        </div>
                        <div class="sale-section">
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
            </form>
        </div>
    </div>
</x-shop::form>

@pushOnce('scripts')
    <script 
        type="text/x-template" 
        id="options-template"
    >
        <div class="sale-section">
            <div class="control-group">
                <input
                    type="text"
                    class="control"
                    v-model="searchOrderValue"
                    placeholder="trans('rma::app.shop.customer-rma-create.search_order')"
                />
                </div>
                    <div class="control-group">
                        <button
                            class="btn btn-md btn-primary"
                        >
                            @lang('datagrid::app.datagrid.apply')
                        </button>
                    </div>

                    <v-dropdown v-bind:close-on-click="false">
                    <div class="sale-title">
                        <div class="flex gap-[20px] justify-between mb-[16px]">
                                <div class="flex flex-col gap-[8px]">
                                    <p class="text-[16px] text-gray-800 dark:text-white font-semibold">
                                        @lang('rma::app.shop.customer-rma-create.orders')
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="p-[16px]">
                            <x-shop::form.control-group class="mb-[10px]">
                                <x-shop::form.control-group.label class="required">
                                    @lang('rma::app.shop.validation.order_id')
                                </x-shop::form.control-group.label>
                        
                                    <x-shop::form.control-group.control
                                        name="order_id"
                                        id="orderItem"
                                        rules="required"
                                        :value="null"
                                        :label="trans('rma::app.shop.default-option.select-order')"
                                        :placeholder="trans('rma::app.shop.default-option.select-order')"
                                    >
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
                                    <x-shop::form.control-group.label class="required">
                                        @lang('rma::app.shop.customer-rma-create.resolution')
                                    </x-shop::form.control-group.label>
                            
                                    <x-shop::form.control-group.control
                                        id="resolution"
                                        name="resolution"
                                        rules="required"
                                        :label="trans('rma::app.shop.validation.resolution')"
                                        :placeholder="trans('rma::app.shop.validation.resolution')"
                                    >
                                    <option
                                        :value="null"
                                    >
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
                                        id="checkOrderStatus"
                                        name="order_status"
                                        rules="required"
                                        for="order_status"
                                        :label="trans('rma::app.shop.customer-rma-create.order_status')"
                                        :placeholder="trans('rma::app.shop.customer-rma-create.order_status')"
                                    >
                                    <option
                                    v-for="orderStatusOptions in orderStatus"
                                    :value="orderStatusOptions"
                                    >
                                    @{{ orderStatusOptions }}
                                    <option
                                        v-if="orderStatus == 0"
                                    >
                                    <p>@lang('rma::app.shop.customer-rma-create.not_allowed')</p>

                                    </option>
                                    </x-shop::form.control-group.control>

                                    <x-shop::form.control-group.error
                                        control-name="order_status"
                                    >
                                    </x-shop::form.control-group.error>
                                </x-shop::form.control-group>
                    
                            <div class="sale-title">
                            <div class="flex gap-[20px] justify-between mb-[16px]">
                                    <div class="flex flex-col gap-[8px]">
                                        <p class="text-[16px] text-gray-800 dark:text-white font-semibold">
                                            @lang('rma::app.shop.customer-rma-create.item-ordered')
                                        </p>
                                    </div>
                                </div>
    
                            <x-slot:content class="px-[0px] py-[15px]">
                                <div class="flex select-none">
                                    <input
                                        type="checkbox"
                                        :id="checkbox"
                                        class="checkbox-view"
                                        for="checkbox"
                                        v-model="isCheckAll"
                                    >
                                <button class="secondary-button">
                                    @lang('rma::app.shop.customer-rma-create.image')
                                </button>
                                <div class="flex gap-x-[4px] items-center">
                
                                    <th>@lang('rma::app.shop.customer-rma-create.product')</th>

                                        <th>@lang('rma::app.shop.customer-rma-create.sku')</th>

                                        <th>@lang('rma::app.shop.customer-rma-create.price')</th>

                                        <th>@lang('rma::app.shop.customer-rma-create.quantity')</th>

                                        <th>@lang_('rma::app.shop.customer-rma-create.reason')</th>
                                    </div>
                                        <template v-if="seller == true && sellerOrderedData.length != 0 && resolutionSelect != null">
                                            <label
                                                class="flex gap-[10px] items-center px-5 py-2 text-[14px] text-gray-600 dark:text-gray-300 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-950  select-none"
                                                v-for="(orderData,index) in sellerOrderedData"
                                            >
                                                <div class="flex select-none">
                                                    <input
                                                        type="checkbox"
                                                        name="order_item_id[]"
                                                        :id="checkboxSingle"
                                                        v-bind:value="orderData.id"
                                                        v-model="selected"
                                                    >
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
                                        <div v-if="seller == true && resolutionShow == true">
                                        <div v-if="sellerOrderedData.length == 0" style="text-align: center;">
                                            <p>{{ __('rma::app.shop.customer-rma-create.rma-not-avilable-quotes') }}</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </v-dropdown>
    </x-slot:content>
</script>

<script type="module">
            app.component('options', {
                template: '#template',

            data: function(data) {
                return {
                    orderItems:($orderItems),
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
                    required: false,
                    child: [],
                    validate: {
                        'required': false,
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

                        this.$axios.get('{{ route('rma.customers.getproduct') }}+/{orderId}')
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

                    this.$axios.get("{{ route('rma.customers.getproduct') }}+/{orderId}+/${resolution}")
                
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
                    this.$axios.get(`{{ route('rma.customer.search.order') }}+/${this.searchOrderValue != '' ? this.searchOrderValue : 'all'}`)
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
