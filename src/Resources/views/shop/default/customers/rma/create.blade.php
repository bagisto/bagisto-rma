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
                            placeholder="trans('rma::app.shop.customer-rma-create.search_order')"
                        />
                    </div>

                    <div class="control-group">
                        <button
                            class="btn btn-md btn-primary"
                        >
                            @lang('rma::app.datagrid.apply')
                        </button>
                    </div>

                    <div class="sale-title">
                        <!-- <div class="flex gap-[20px] justify-between mb-[16px]">
                                <div class="flex flex-col gap-[8px]">
                                    <p class="text-[16px] text-gray-800 dark:text-white font-semibold">
                                        @lang('rma::app.shop.customer-rma-create.orders')
                                    </p>
                                </div>
                            </div>
                        </div> -->

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
                        </div>
                    </div>
                </div>
                    
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

        // function  formValidation() {
        //     var allCheckbox = document.getElementById('checkbox').checked;
        //     var checkboxes = document.querySelectorAll('#checkboxSingle:checked'), values = [];
        //     Array.prototype.forEach.call(checkboxes, function(el) {
        //         values.push(el.value);
        //     });
        //     if (values.length > 0) {
        //         singleCheckBox = true;
        //     } else {
        //         singleCheckBox = false;
        //     }
        //     if (allCheckbox == false && singleCheckBox == false) {
        //         alert('Please select item');
        //         event.preventDefault();
        //         return false;
        //     }
        // }

    </script>
@endpushOnce
</x-shop::layouts.account>