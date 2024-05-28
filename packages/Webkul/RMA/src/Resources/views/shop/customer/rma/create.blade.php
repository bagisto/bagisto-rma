<x-shop::layouts.account>

    <!-- Title of the page -->   
    <x-slot:title>
        @lang('rma::app.shop.customer.title')
    </x-slot>

    <rma-request-wrapper></rma-request-wrapper>  

    @pushOnce('scripts')
        <script type="text/x-template" id="rma-request-template">
            <x-shop::form
                :action="route('rma.customers.store')"
                enctype="multipart/form-data"
            >
                <!-- Heading of the page --> 
                <div class="flex items-center justify-between">
                    <h2 class="text-[26px] font-medium">
                        @lang('rma::app.shop.customer.create.heading')
                    </h2>
                </div>
            
                @csrf()
                <!-- Search order -->
                <x-shop::form.control-group class="mb-4">
                    <x-shop::form.control-group.label class="required">
                        @lang('rma::app.shop.customer.create.enter-order-id')
                    </x-shop::form.control-group.label>
                    
                    <x-shop::form.control-group.control
                        type="text"
                        name="search-order"
                        v-model="searchOrderValue"
                        :placeholder="trans('rma::app.shop.customer.create.enter-order-id')"
                    >
                    </x-shop::form.control-group.control>

                    <button
                        class="primary-button"
                        @click="searchOrders($event)"
                    >
                        @lang('rma::app.shop.customer.create.search-order')
                    </button>

                </x-shop::form.control-group>

                <!-- Select order id -->
                <x-shop::form.control-group class="mb-4">
                    <x-shop::form.control-group.label class="required">
                        @lang('rma::app.shop.validation.order-id')
                    </x-shop::form.control-group.label>
                    
                    <x-shop::form.control-group.control
                        type="select"
                        name="order_id"
                        id="orderItem"
                        class="mb-4"
                        rules="required"
                        ref='orderId'
                        @change="getResolutions($event)"
                        :label="trans('rma::app.shop.validation.select-orders')"
                    >
                        <option v-for="(order, index) in orders" :value="order.id">
                            @{{ '#' + order.increment_id }}, $@{{ order.grand_total }}
                        </option>
                
                    </x-shop::form.control-group.control>

                    <x-shop::form.control-group.error
                        control-name="order_id"
                    >
                    </x-shop::form.control-group.error>
                </x-shop::form.control-group>

                <!-- Select resolution for order -->     
                <x-shop::form.control-group v-if="resolutions != ''" class="mb-4">
                    <x-shop::form.control-group.label  class="required">
                        @lang('rma::app.shop.customer.create.resolution')
                    </x-shop::form.control-group.label>

                    <x-shop::form.control-group.control
                        type="select"
                        id="resolution"
                        name="resolution"
                        v-model="resolution"
                        rules="required"
                        @change="getOrderByResolution($event)"
                        :label="trans('rma::app.shop.validation.resolution')"
                    >
                        @lang('rma::app.shop.validation.resolution')

                        <option v-for="selectResolutionByOrder in resolutions" :value="selectResolutionByOrder">
                            @{{ selectResolutionByOrder }}
                        </option>
                    </x-shop::form.control-group.control>

                    <x-shop::form.control-group.error
                        control-name="resolution"
                    >
                    </x-shop::form.control-group.error>
                </x-shop::form.control-group>

                <!-- Select order status -->
                <x-shop::form.control-group v-if="orderStatus" class="mb-4">
                    <x-shop::form.control-group.label class="required">
                        @lang('rma::app.shop.customer.create.order-status')
                    </x-shop::form.control-group.label>
            
                    <x-shop::form.control-group.control
                        type="select"
                        id="checkOrderStatus"
                        name="order_status"
                        rules="required"
                        for="order_status"
                        @change="checkOrderStatus($event)"
                        :label="trans('rma::app.shop.validation.order-status')"
                    >
                        <option v-for="orderStatusOptions in orderStatus" :value="orderStatusOptions">
                            @{{ orderStatusOptions }}
                        </option>
                    </x-shop::form.control-group.control>

                    <x-shop::form.control-group.error
                        control-name="order_status"
                    >
                        <p>
                            @lang('rma::app.shop.customer.create.not-allowed')
                        </p>
                    </x-shop::form.control-group.error>
                </x-shop::form.control-group>
                <br><br>  

                <div class="flex items-center justify-between">
                    <p class="text-[26px] font-medium">
                        @lang('rma::app.shop.customer.create.item-ordered')
                    </p>
                </div>

                <!-- Table of order item -->
                <div class="mt-[15px] overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="border-b-[1px] border-[#E9E9E9] bg-[#F5F5F5] text-[14px] text-black">
                            <tr>
                                <th class="px-6 py-[16px] font-medium text-black">
                                    <input
                                        type='checkbox'
                                        @click='checkAll()'
                                        id="checkbox"
                                        v-model='isCheckAll'
                                    />
                                </th>

                                <th 
                                    scope="col"
                                    class="px-6 py-[16px] font-medium"
                                >
                                    @lang('rma::app.shop.customer.create.image')
                                </th>

                                <th 
                                    scope="col"
                                    class="px-6 py-[16px] font-medium"
                                >
                                    @lang('rma::app.shop.customer.create.product')
                                </th>

                                <th 
                                    scope="col"
                                    class="px-6 py-[16px] font-medium"
                                >
                                    @lang('rma::app.shop.customer.create.sku')
                                </th>

                                <th 
                                    scope="col"
                                    class="px-6 py-[16px] font-medium"
                                >
                                    @lang('rma::app.shop.customer.create.price')
                                </th>

                                <th 
                                    scope="col"
                                    class="px-6 py-[16px] font-medium"
                                >
                                    @lang('rma::app.shop.customer.create.quantity')
                                </th>

                                <th 
                                    scope="col"
                                    class="px-6 py-[16px] font-medium"
                                >
                                    @lang('rma::app.shop.customer.create.reason')
                                </th>
                            </tr>
                        </thead>

                        <tbody v-if="orderItems.length && resolutions.length">
                            
                            <tr v-for="(orderData,index) in orderItems" class="border-b bg-white">
                                <td
                                    class="px-6 py-[16px] font-medium text-black"
                                >
                                    <div class="checkbox">
                                        <input 
                                            type="checkbox"
                                            id="checkboxSingle"
                                            name="order_item_id[]"
                                            rule="required"
                                            v-bind:value="orderData.id"
                                            v-model='selected'
                                            @change='updateCheckall(); getId($event)'
                                        >

                                        <label class="checkbox-view" for="checkbox"></label>
                                    </div>
                                </td>

                                <td
                                    class="px-6 py-[16px] font-medium text-black"
                                >
                                    <img style="max-width: 60px;" v-if="productImageCounts > 0" :src="productImage[orderData.product_id]['medium_image_url']">
                                
                                    <img 
                                        style="max-width: 60px;" class="" v-else src="{{ bagisto_asset('images/medium-product-placeholder.webp') }}"
                                        alt="thankyou" 
                                        title=""
                                    >
                                </td>

                                <td
                                    class="px-6 py-[16px] font-medium text-black"
                                >
                                    <span v-if="orderData.type == 'configurable' && child[orderData.id]">
                                        @{{ child[orderData.id].name }}
                                        
                                        <div>
                                            @{{ child[orderData.id].attribute }}
                                        </div>
                                    </span>

                                    <span v-else>
                                        @{{ orderData.name }}
                                    </span>

                                    <li 
                                        v-if="html.length != 0" 
                                        :v-html="html[orderData.id]"
                                    >
                                        @{{ html[orderData.id] }}
                                    </li>
                                </td>

                                <td
                                    class="px-6 py-[16px] font-medium text-black"
                                >
                                    @{{  orderData.type == 'configurable' ? child[orderData.id] ? child[orderData.id].sku : orderData.sku : orderData.sku }}
                                </td>

                                <td
                                    class="px-6 py-[16px] font-medium text-black"
                                >
                                    @{{ orderData.price }}
                                </td>

                                <!-- Select quantity -->
                                <td>
                                    <x-shop::form.control-group class="w-full"> 
                                        <x-shop::form.control-group.control
                                            type="select"
                                            id="quantity"
                                            name="quantity"
                                            rules="required"
                                            class="!w-[150px]"
                                            :label="trans('rma::app.shop.default-option.select-quantity')"
                                            :placeholder="trans('rma::app.shop.default-option.select-quantity')"
                                        >
                                            <option v-for="qtyLength in quantity[orderData.id]" :value="qtyLength">
                                                @{{ qtyLength }}
                                            </option>

                                        </x-shop::form.control-group.control>

                                        <x-shop::form.control-group.error
                                            ::control-name="quantity"
                                        >
                                        </x-shop::form.control-group.error>
                                    </x-shop::form.control-group>
                                </td>
                    
                                <!-- Select reason -->
                                <td>
                                    <x-shop::form.control-group class="w-full">
                                        <x-shop::form.control-group.control
                                            type="select"
                                            id="rma_reason_id"
                                            name="rma_reason_id"
                                            class="!w-[260px]"
                                            v-model="newId"
                                            rules="required"
                                            @change='admSelectCheck(event,this)'
                                            ref="selectvalue"
                                            :label="trans('rma::app.shop.default-option.select-reason')"
                                            :placeholder="trans('rma::app.shop.default-option.select-reason')"
                                        >
                                            <option :value = 0>
                                                @lang('rma::app.shop.default-option.others')
                                            </option>

                                            <option v-for='(reason, index) in newReasons' :value="reason.id" >
                                                @{{ reason.title }}
                                            </option>
                                            
                                            <input 
                                                type="hidden" 
                                                id="newId" 
                                                name="newId" 
                                                :value="newId"
                                            />
                                        </x-shop::form.control-group.control>

                                        <x-shop::form.control-group.error
                                            ::control-name="rma_reason_id"
                                        >
                                        </x-shop::form.control-group.error>
                                    </x-shop::form.control-group>

                                    <x-shop::form.control-group v-if="reason">
                                        <x-shop::form.control-group.control
                                            type="text"
                                            name="addReason"
                                            ref="inputValue"
                                            value=""
                                        >
                                        </x-shop::form.control-group.control>
                                        
                                        <div class="flex gap-[8px]">
                                            <div class="primary-button" @click='savereason($event)'>
                                                @lang('rma::app.shop.customer.create.save')
                                            </div>
                                            
                                            <div class="secondary-button border-[#E9E9E9] px-[20px] py-[12px] font-normal" @click='closefield($event,orderItems)'>
                                                @lang('rma::app.shop.customer.create.cancel')
                                            </div>
                                        </div>
                                    </x-shop::form.control-group>
                                </td>
                            </tr> 
                        </tbody>
                    </table>

                    <div v-if="seller == true && resolutionShow == true">
                        <div v-if="sellerOrderedData.length == 0">
                            <p>
                                @lang('rma::app.shop.customer.create.rma-not-available-quotes')
                            </p>
                        </div>
                    </div>
                </div><br><br>

                <div>
                    <div class="flex items-center justify-between">
                        <p class="text-[26px] font-medium">
                            @lang('rma::app.shop.customer.create.images')
                        </p>
                    </div>

                    <!-- Upload images -->
                    <div class="max-w-[286px]">
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.control
                                type="image"
                                name="images[]"
                                class="mb-0 rounded-[12px] !p-0 text-gray-700"
                                :label="trans('admin::app.catalog.products.add-image-btn-title')"
                                :is-multiple="true"
                                accepted-types="image/*"
                            >
                            </x-shop::form.control-group.control>

                            <x-shop::form.control-group.error
                                class="mt-4"
                                control-name="images"
                            >
                            </x-shop::form.control-group.error>
                        </x-shop::form.control-group>
                    </div>

                    <input type="hidden" name="email" value="{{ $customerEmail }}">
                    <input type="hidden" name="name" value="{{ $customerName }}">

                    <!-- Additional information -->
                    <div class="p-[16px]">
                        <x-shop::form.control-group class="mb-[10px]">
                            <x-shop::form.control-group.label>
                                @lang('rma::app.shop.customer.create.information')
                            </x-shop::form.control-group.label>
                    
                            <x-shop::form.control-group.control
                                type="textarea"
                                name="information"
                                id="information"
                                :label="trans('rma::app.shop.customer.create.information')"
                                :placeholder="trans('rma::app.shop.customer.create.information')"
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

                <div>
                    <button
                        type="submit"
                        class="primary-button"
                    >
                        @lang('rma::app.shop.customer.create.create-btn')
                    </button>
                </div>
            </x-shop::form>
        </script>

        <script type="module">
            app.component('rma-request-wrapper', {
                template: '#rma-request-template',

                inject: ['$validator'],
                data: function (data) {
                    return {
                        data: [],
                        html: [],
                        child: [],
                        selected: [],
                        seller: false,
                        dosearch: false,
                        searchOrderValue: '',
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
                        is_required: false,
                        showSelectBox: false,
                        resolutionShow: false,
                        renderComponent: true,
                        productImageCounts: null,
                        singleOrderSellerId: null,
                        orders: @json($orderItems),
                        validate: {
                            'is_required': false,
                        },
                        shippedProductId: [],
                        shippingOrderStatus: 0,
                        orderItemShipped: [],
                        pagNotif:[],
                        records:[],
                        url: "{{ route('rma.customers.get_orders') }}",
                        pagination:false,
                        variants:[],
                        reason:false,
                        newId : null,
                        newReasons:@json($reasons)
                    }
                },

                methods: {
                    getResolutions: function (event) {
                        let this_this = this;

                        this.orderId = this.$refs.orderId.value;

                        var orderId = 0;

                        if (typeof event == 'number') {
                            orderId = event;
                        } else {
                            orderId = this.$refs.orderId.value;
                        }

                        this.resolutionShow = false;

                        if (orderId.length == 0) {
                            this.orderItems = this.blankData;
                            this.showSelectBox = false;
                            this.orderStatus = null;
                            this.resolutions = [];
                        }

                        this.$axios.get(`{{ route('rma.customers.get_orders') }}/${orderId}/${this.resolution}`)
                            .then(response => {
                                if (response.status == 200) {
                                    
                                    // Filter out orders for which RMA has already been created
                                    const orders = response.data.search_results.data.filter(order => !order.rma_created);
                                   
                                    this_this.orderItems = orders;
                                    this_this.records = response.data.search_results;
                                    this_this.resolutions = response.data.resolutions;
                                    this_this.productImage = response.data.productImage;
                                    if (orders.length >= 1) {
                                        this.pagination = true;
                                    }
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });

                        this_this.renderComponent = true;
                        this_this.resolution = null;
                        this_this.$forceUpdate();
                    },

                    getOrderByResolution: function (event) {
                        var resolution = event.target.value;

                        let this_this = this;

                        this.resolutionShow = true;

                        if (resolution == '') {
                            this.resolutionShow = false;
                            resolution = null;
                            this.orderItems = this.blankData;
                        }
                        
                        this.$axios.get(`{{ route('rma.customers.get_product') }}/${this.$refs.orderId.value}/${resolution}`)
                        .then(response => {
                            this_this.orderItems = response.data.orderItems;

                            this_this.html = response.data.html;
                            this_this.child = response.data.child;
                            this_this.quantity = response.data.quantity;
                            this_this.resolutions= response.data.resolutions;
                            this_this.orderStatus = response.data.orderStatus;
                            this_this.productImage = response.data.productImage;
                            this_this.productImageCounts = response.data.productImageCounts;
                            this_this.shippedProductId = response.data.shippedProductId;
                            this_this.shippingOrderStatus = response.data.shippingOrderStatus;
                            this_this.orderItemShipped = response.data.orderItems;
                            this_this.variants = response.data.variants;

                            if (this_this.shippingOrderStatus) {                            
                                let orders = [];

                                for (let i = 0 ; i < this_this.shippedProductId.length ; i++) {                                
                                    for (let k = 0; k < this_this.orderItems.length ; k++) {
                                        if (this_this.shippedProductId[i] == this_this.orderItems[k].product_id) {
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

                            this.pagination = false;
                        }).catch(error => {
                            this.output = error;
                        });

                        this.renderComponent = true;
                        this.orderId = this.data.orderId;

                        this.$forceUpdate();

                        this.orderItems = this.blankData;
                    },
                    
                    checkOrderStatus: function(event) {
                        let this_this = this;
                        let orders = [];

                        if (this_this.shippingOrderStatus && event.target.value == 'Delivered') {
                            for (let i = 0 ; i < this_this.shippedProductId.length ; i++) {                                
                                for (let k = 0; k < this_this.orderItemShipped.length ; k++){                                     
                                    if (this_this.shippedProductId[i] == this_this.orderItemShipped[k].product_id) {
                                        orders.push(this_this.orderItemShipped[k]);
                                    }
                                }
                            }

                            this_this.orderItems = orders;                       
                        }

                        if (this_this.shippingOrderStatus && event.target.value == 'Not Delivered') {
                            for (let i = 0 ; i < this_this.shippedProductId.length ; i++) {                                
                                for (let k = 0; k < this_this.orderItemShipped.length ; k++){                                     
                                if (this_this.shippedProductId[i] != this_this.orderItemShipped[k].product_id) {
                                        orders.push(this_this.orderItemShipped[k]);
                                    }
                                }
                            }

                            this_this.orderItems = orders;
                        }
                    },

                    deliveredOrderStatus: function(){
                        let this_this = this;

                        let orders = [];

                        for (let i = 0 ; i < this_this.shippedProductId.length ; i++){                                
                            for (let k = 0; k < this_this.orderItemShipped.length ; k++){                                     
                                if (this_this.shippedProductId[i] == this_this.orderItemShipped[k].product_id) {
                                    orders.push(this_this.orderItemShipped[k]);
                                }
                            }
                        }

                        this_this.orderItems = orders;                       
                        
                    }, 

                    getResolutionsBySearch: function (orderId) {
                        var orderId = orderId;

                        this.resolutionShow = false;

                        if (orderId.length == 0 ) {
                            this.orderItems = this.blankData;
                            this.showSelectBox = false;
                            this.orderStatus = null;
                            this.resolutions = [];
                        }

                        immediate: true,

                        this.$axios.get(`{{ route('rma.customers.get_product') }}/${orderId}/''`)
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

                        if (! this.isCheckAll) {
                            for (var key in this.orderItems) {
                                this.validate[this.orderItems[key].id] = false;
                            }
                        }
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

                        this.$axios.post("{{ route('rma.customers.get_product_by_seller') }}", {
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

                    updateCheckall: function () {
                        this.isCheckAll = this.selected.length == this.orderItems.length;
                    },

                    searchOrders: function (event) {
                        this.$axios.get(`{{ route('rma.customer.search.order') }}/${this.searchOrderValue != '' ? this.searchOrderValue : 'all'}`)
                            .then(response => {
                                if (response.data.orders) {
                                    this.orders = response.data.orders;

                                    this.dosearch = true;

                                    this.getResolutionsBySearch(this.orders[0].increment_id);
                                } else {
                                    alert('Invalid Order Id ');
                                }
                            }).catch(error => {
                                console.log(error);
                            });

                        event.preventDefault();
                    },

                    admSelectCheck: function(nameSelect,e){
                        if (
                            this.$refs.selectvalue[0].value == 0 
                            && this.$refs.selectvalue[0].value != ''
                        ) {
                            this.reason = true;
                        } else {
                            this.reason = false;
                        }
                    },

                    savereason: function (event){
                        let inputValue = this.$refs.inputValue[0].value;

                        let this_this = this;
                        
                        this.orderId = this.$refs.orderId.value;

                        this.$axios.post(`{{ route('rma.customers.customer_create_rma.add_reason')}}/${this.orderId}`, {
                            inputData: inputValue
                        })
                        .then((response) => {
                            let data = response.data.reasons;
                            this.newId = data.id;
                            
                            this.newReasons.push(data);

                            this.reason = false;                       
                        })
                        .catch(function (error) {})                  
                    },

                    closefield: function(event,orderItems){                    
                        if (this.reason = true){
                            this.reason = false;
                        }
                    }
                },
            });
        </script>
    @endpushOnce
</x-shop::layouts.account>