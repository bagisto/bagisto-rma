@php
$customAttributes = app('Webkul\RMA\Repositories\RmaCustomFieldRepository')->with('options')->where('status', 1)->get();
@endphp

<x-shop::layouts>
    <!-- Title of the page -->
    <x-slot:title>
        @lang('rma::app.shop.guest.create.title')
    </x-slot>

    <div class="flex flex-wrap">
        <div class="container mt-8 px-16 max-lg:px-4">
            <!-- Heading of the page -->
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl max-lg:text-base font-medium">
                    @lang('rma::app.shop.guest.create.heading')
                </h2>

                <a
                    href="javascript:history.back();"
                    class="secondary-button flex items-center gap-x-2 border-[#E9E9E9] px-5 max-lg:px-3 max-lg:text-xs py-3 font-normal"
                >
                    @lang('shop::app.checkout.onepage.address.back')
                </a>
            </div>

            {!! view_render_event('bagisto.shop.guest.account.new-rma.list.before') !!}

            <rma-request-wrapper></rma-request-wrapper>

            {!! view_render_event('bagisto.shop.guest.account.new-rma.list.after') !!}
        </div>
    </div>

    @pushOnce('scripts')
        <script type="text/x-template" id="rma-request-template">
            <div class="md:border-2 bg-white box-shadow rounded-md mb-2 p-4">
                <!-- Desktop view -->
                <div class="max-md:hidden">
                    <x-shop::datagrid :src="route('shop.guest.create-rma')" >
                        <!-- Datagrid Header -->
                        <template #header="{ columns, records, sortPage, selectAllRecords, applied, isLoading}">
                            <template v-if="isLoading">
                                <x-shop::shimmer.datagrid.table.head :isMultiRow="true"/>
                            </template>

                            <template v-else>
                                <div 
                                    class="row grid grid-rows-1 items-center px-4 py-2.5 border-b" 
                                    style="grid-template-columns: repeat(6, minmax(0, 1fr));"
                                >
                                    <div
                                        class="flex gap-2.5 items-center select-none"
                                        v-for="(columnGroup, index) in [['increment_id'], ['created_at'], ['grand_total'], ['method_title'], ['status']]"
                                    >
                                        <p class="text-gray-600 dark:text-gray-300">
                                            <span class="[&>*]:after:content-['_/_']">
                                                <template v-for="column in columnGroup">
                                                    <span
                                                        class="after:content-['/'] last:after:content-['']"
                                                        :class="{
                                                            'text-gray-800 font-medium': applied.sort.column == column,
                                                            'cursor-pointer hover:text-gray-800': columns.find(columnTemp => columnTemp.index === column)?.sortable,
                                                        }"
                                                        @click="
                                                            columns.find(columnTemp => columnTemp.index === column)?.sortable ? sortPage(columns.find(columnTemp => columnTemp.index === column)): {}
                                                        "
                                                    >
                                                        @{{ columns.find(columnTemp => columnTemp.index === column)?.label }}
                                                    </span>
                                                </template>
                                            </span>

                                            <i
                                                class="align-text-bottom text-base text-gray-800 dark:text-white ltr:ml-1.5 rtl:mr-1.5"
                                                :class="[applied.sort.order === 'asc' ? 'icon-down-stat': 'icon-up-stat']"
                                                v-if="columnGroup.includes(applied.sort.column)"
                                            ></i>
                                        </p>
                                    </div>

                                    <p class="flex justify-end text-gray-600 cursor-pointer">
                                        @lang('admin::app.settings.data-transfer.imports.edit.action')
                                    </p>
                                </div>
                            </template>
                        </template>

                        <template #body="{ records, setCurrentSelectionMode, applied, performAction, isLoading }">
                            <template v-if="isLoading">
                                <x-shop::shimmer.datagrid.table.body :isMultiRow="true"/>
                            </template>

                            <template v-else>
                                <div
                                    class="row grid px-4 py-2.5 border-b transition-all hover:bg-gray-50"
                                    style="grid-template-columns: repeat(6, minmax(0, 1fr));"
                                    v-for="record in records"
                                >
                                        <!-- Order Id, Created -->
                                        <p
                                            class="text-base text-gray-800 "
                                            v-html="record.increment_id"
                                        >
                                        </p>

                                        <p
                                            class="text-gray-600"
                                            v-html="record.created_at"
                                        >
                                        </p>

                                        <!--  Grand Total, Method Title -->
                                        <p 
                                            class="text-base text-gray-800 font-semibold"
                                            v-html="record.grand_total"
                                        >
                                        </p>

                                        <p 
                                            class="text-gray-600 "
                                            v-html="record.method_title"
                                        >
                                        </p>

                                        <p v-html="record.status"></p>
                                        
                                        <p class="flex justify-end">
                                            <!-- Arrow -->
                                            <a
                                                class="icon-edit text-2xl"
                                                @click="productAvail(record)"
                                            >
                                            </a>
                                        </p>
                                </div>
                            </template>
                        </template>
                    </x-shop::datagrid>
                </div>

                <div class="md:hidden">
                    <x-shop::datagrid :src="route('shop.guest.create-rma')" >
                        <!-- Datagrid Header -->
                        <template #header="{ columns, records, sortPage, selectAllRecords, applied, isLoading}">
                            <template v-if="isLoading">
                                <x-shop::shimmer.datagrid.table.head :isMultiRow="true"/>
                            </template>

                            <template v-else>
                                <div 
                                    class="row grid grid-rows-1 items-center px-4 py-2.5 border-b" 
                                    style="grid-template-columns: repeat(2, minmax(0, 1fr));"
                                >
                                    <div
                                        class="flex gap-2.5 items-center select-none"
                                        v-for="(columnGroup, index) in [['increment_id', 'created_at', 'grand_total'], ['method_title', 'status']]"
                                    >
                                        <p class="text-gray-600 dark:text-gray-300">
                                            <span class="[&>*]:after:content-['_/_']">
                                                <template v-for="column in columnGroup">
                                                    <span
                                                        class="after:content-['/'] last:after:content-['']"
                                                        :class="{
                                                            'text-gray-800 font-medium': applied.sort.column == column,
                                                            'cursor-pointer hover:text-gray-800': columns.find(columnTemp => columnTemp.index === column)?.sortable,
                                                        }"
                                                        @click="
                                                            columns.find(columnTemp => columnTemp.index === column)?.sortable ? sortPage(columns.find(columnTemp => columnTemp.index === column)): {}
                                                        "
                                                    >
                                                        @{{ columns.find(columnTemp => columnTemp.index === column)?.label }}
                                                    </span>
                                                </template>
                                            </span>

                                            <i
                                                class="align-text-bottom text-base text-gray-800 dark:text-white ltr:ml-1.5 rtl:mr-1.5"
                                                :class="[applied.sort.order === 'asc' ? 'icon-down-stat': 'icon-up-stat']"
                                                v-if="columnGroup.includes(applied.sort.column)"
                                            ></i>
                                        </p>
                                    </div>
                                </div>
                            </template>
                        </template>

                        <template #body="{ records, setCurrentSelectionMode, applied, performAction, isLoading }">
                            <template v-if="isLoading">
                                <x-shop::shimmer.datagrid.table.body :isMultiRow="true"/>
                            </template>

                            <template v-else>
                                <div
                                    class="row grid px-4 py-2.5 border-b transition-all hover:bg-gray-50"
                                    style="grid-template-columns: repeat(2, minmax(0, 1fr));"
                                    v-for="record in records"
                                >
                                    <div class="flex gap-x-4 justify-between items-center">
                                        <div class="flex flex-col gap-1.5">
                                            <p
                                                class="text-gray-600 dark:text-gray-300"
                                                v-html="record.increment_id ?? 'N/A'"
                                            >
                                            </p>
                
                                            <p
                                                class="text-gray-600 dark:text-gray-300"
                                                v-html="record.created_at"
                                            >
                                            </p>
                
                                            <p
                                                class="text-gray-600 dark:text-gray-300"
                                                v-html="record.grand_total"
                                            >
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex gap-x-4 justify-between items-center">
                                        <div class="flex flex-col gap-1.5">

                                        <p 
                                            class="text-gray-600 "
                                            v-html="record.method_title"
                                        >
                                        </p>

                                        <p v-html="record.status"></p>
                                        
                                        <p class="flex justify-end">
                                            <!-- Arrow -->
                                            <a
                                                class="icon-edit text-2xl"
                                                @click="productAvail(record)"
                                            >
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                </div>
                            </template>
                        </template>
                    </x-shop::datagrid>
                </div>

                <x-shop::form
                    v-slot="{ meta, errors, handleSubmit }"
                    as="div"
                >
                    <form
                        @submit="handleSubmit($event, rmaSubmit)"
                        ref="rmaSubmit"
                    >
                        <x-shop::modal ref="rmaModel">
                            <!-- Modal Header -->
                            <x-slot:header>
                                <h2 class="text-base font-medium max-md:text-base">
                                    @lang('rma::app.shop.customer.create.heading')
                                </h2>
                            </x-slot>

                            <!-- Modal Content -->
                            <x-slot:content class="bg-white p-4 max-sm:p-3">
                                <div class="overflow-auto" style="min-height: 400px; max-height: 400px;">
                                    <v-order-items-list :key="refreshComponent" :order-id="isSelect"></v-order-items-list>
                                </div>
                            </x-slot>

                            <x-slot:footer>
                                <div class="flex justify-end">
                                    <button
                                        type="submit"
                                        :disabled="!rmaFormButton || !rmaFormSubmit"
                                        class="primary-button"
                                    >
                                        <svg v-if="!rmaFormSubmit" aria-hidden="true" class="w-5 h-5 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                        </svg>
                                        
                                        @lang('rma::app.shop.customer.submit-req')
                                    </button>
                                </div>
                            </x-slot>
                        </x-shop::modal>
                    </form>
                </x-shop::form>
            </div>
        </script>

        <script
            type="text/x-template"
            id="v-order-items-list-template"
        >
            <div v-if="products.length > 0">
                <div v-for="product in products">
                    <div class="flex-row gap-2.5 border-b mt-2 mb-2">
                        <div class="flex gap-2.5 mb-3">
                            <!-- Checkbox -->
                            <p>
                                <div v-if="product.currentQuantity > '0'">
                                    <input 
                                        type="checkbox" 
                                        :name="'isChecked[' + product.product_id + ']'" 
                                        :id="'isChecked[' + product.product_id + ']'" 
                                        class="mt-6"
                                        v-model="isChecked[product.product_id]"
                                    >
                                </div>

                                <div v-else>
                                    <div class="ltr:ml-3 rtl:mr-3"></div>
                                </div>

                                <div v-if="isChecked[product.product_id]">
                                    <x-shop::form.control-group>
                                        <x-shop::form.control-group.control
                                            type="hidden"
                                            name="order_id" 
                                            ::value="product.order_id"
                                        />
                                    </x-shop::form.control-group>

                                    <x-shop::form.control-group>
                                        <x-shop::form.control-group.control
                                            type="hidden"
                                            ::name="'order_item_id[' + product.product_id + ']'" 
                                            :label="trans('rma::app.shop.customer.rma-qty')"
                                            :placeholder="trans('rma::app.shop.customer.rma-qty')"
                                            ::value="product.order_item_id"
                                        />
                                    </x-shop::form.control-group>
                                </div>
                            </p>

                            <!-- Image -->
                            <p>
                                <template v-if="product.base_image">
                                    <img
                                        class="min-h-[80px] max-h-[80px] min-w-[80px] max-w-[80px] rounded"
                                        :src="`${baseImageUrl}${product.base_image}`"
                                        :alt="`${product.base_image}`"
                                    />
                                </template>

                                <template v-else>
                                    <img
                                        class="min-h-[80px] max-h-[80px] min-w-[80px] max-w-[80px] rounded"
                                        src="{{ bagisto_asset('images/medium-product-placeholder.webp') }}"
                                        alt="medium-product-placeholder.webp"
                                    >
                                </template>
                            </p>

                            <p style="width: 100px; max-width: 100px;">
                                <div v-if="product.url_key && product.visible_individually">
                                    <a 
                                        :href="`{{ route('shop.product_or_category.index', '') }}/${product.url_key}`" 
                                        target='_blank' 
                                        class="text-blue-500 text-xs"
                                    > 
                                        @{{ product.name }} 

                                        <br/>
                                        <span v-for="(attribute) in product.attributes" v-if="product.attributes">
                                            <b>@{{ attribute.attribute_name }} : </b>@{{ attribute.option_label }}<br>
                                        </span> 
                                    </a>
                                </div>

                                <div v-else>
                                    @{{ product.name }}

                                    <br/>
                                    <span v-for="(attribute) in product.attributes" v-if="product.attributes">
                                        <b>@{{ attribute.attribute_name }} : </b>@{{ attribute.option_label }}<br>
                                    </span>
                                </div>
                            </p>

                            <!-- Sku, Price, Return Window -->
                            <p class="w-full">
                                <p class="flex text-sm justify-between whitespace-nowrap">
                                    <span>
                                        @lang('admin::app.catalog.products.index.create.sku'):
                                    </span>
                                    
                                    <span style="width: 300px; max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">@{{ product.sku }}</span>
                                </p>

                                <p class="flex text-sm justify-between whitespace-nowrap">
                                    <span>
                                        @lang('admin::app.catalog.attributes.create.price'):  
                                    </span>
                                    
                                    <span>@{{ formatPrice(product.price) }}</span>
                                </p>

                                <p class="flex text-sm justify-between whitespace-nowrap">
                                    <span>
                                        @lang('rma::app.admin.configuration.index.sales.rma.current-order-quantity'):
                                    </span>
                                    
                                    <span>
                                        @{{ product.currentQuantity }}
                                    </span>
                                </p>

                                <span v-if="product.rma_rules && products['0'].order_status != 'pending'">
                                    <p 
                                        v-if="resolutionType[product.product_id] == 'return'" 
                                        class="flex text-sm justify-between gap-3 whitespace-nowrap"
                                    >
                                        <span>
                                            @lang('rma::app.shop.customer.create.return-window'): 
                                        </span>

                                        <span>
                                            @{{ calculateDeliveredReturnWindow(product.created_at, product.rma_return_period) }}
                                        </span>
                                    </p>

                                    <p 
                                        v-if="resolutionType[product.product_id] == 'exchange'" 
                                        class="flex text-sm justify-between gap-3 whitespace-nowrap"
                                    >
                                        <span>
                                            @lang('rma::app.shop.customer.create.exchange-window'): 
                                        </span>

                                        <span>
                                            @{{ calculateDeliveredReturnWindow(product.created_at, product.rma_exchange_period) }}
                                        </span>
                                    </p>
                                </span>

                                <p 
                                    v-else 
                                    class="flex text-sm justify-between gap-3 whitespace-nowrap"
                                >
                                    <span v-if="! product.rma_exchange_period && ! product.rma_return_period">
                                        <span>
                                            @lang('rma::app.shop.customer.create.return-window'): 
                                        </span>

                                        <span>
                                            @{{ calculateReturnWindow(product.created_at) }}
                                        </span>
                                    </span>
                                </p>
                            </p>
                        </div>

                        <!-- RMA QTY -->
                        <p class="w-full">
                            <div v-if="isChecked[product.product_id] && product.currentQuantity > '0'">
                                <!-- RMA Quantity -->
                                <x-shop::form.control-group>
                                    <x-shop::form.control-group.label class="required text-sm flex">
                                        @lang('rma::app.shop.customer.rma-qty')
                                    </x-shop::form.control-group.label>

                                    <x-shop::form.control-group.control
                                        type="text"
                                        ::name="'rma_qty[' + product.product_id + ']'" 
                                        ::rules="'min_value:1|required|max_value:' + product.currentQuantity"
                                        :label="trans('rma::app.shop.customer.rma-qty')"
                                        :placeholder="trans('rma::app.shop.customer.rma-qty')"
                                        v-model="rma_qty[product.product_id]"
                                    />

                                    <x-shop::form.control-group.error ::name="'rma_qty[' + product.product_id + ']'" class="flex"/>
                                </x-shop::form.control-group>
                            </div>

                            <div 
                                v-if="product.currentQuantity <= '0'" 
                                class="text-sm text-red-600 flex mb-2"
                            >
                                @lang('rma::app.admin.configuration.index.sales.rma.product-already-raw')
                            </div>
                        </p>

                        <div class="flex gap-3">
                            <!-- Resolution Type for rules product -->
                            <p class="w-full" v-if="product.rma_exchange_period || product.rma_return_period">
                                <div v-if="isChecked[product.product_id] && product.currentQuantity > '0'">
                                    <x-shop::form.control-group>
                                        <x-shop::form.control-group.label class="required text-sm flex">
                                            @lang('rma::app.admin.configuration.index.sales.rma.resolution-type')
                                        </x-shop::form.control-group.label>

                                        <x-shop::form.control-group.control
                                            type="select"
                                            ::name="'resolution_type[' + product.product_id + ']'" 
                                            rules="required"
                                            v-model="resolutionType[product.product_id]"
                                            @change="getResolutionReason(product.product_id)"
                                            :label="trans('rma::app.admin.configuration.index.sales.rma.resolution-type')"
                                        >
                                            <option value="">
                                                @lang('admin::app.catalog.products.edit.types.bundle.update-create.select')
                                            </option>

                                            <option 
                                                v-if="products['0'].order_status != 'pending' && (products['0'].order_status == 'processing' || products['0'].order_status == 'completed')  && product.rma_return_period" 
                                                value="return"
                                            >
                                                @lang('rma::app.admin.configuration.index.sales.rma.return')
                                            </option>

                                            <option
                                                v-if="products['0'].order_status != 'pending' && products['0'].order_status != 'processing' && products['0'].order_status == 'completed' && product.rma_exchange_period" 
                                                value="exchange"
                                            >
                                                @lang('rma::app.admin.configuration.index.sales.rma.exchange')
                                            </option>

                                            <option 
                                                v-if="products['0'].order_status == 'pending' && products['0'].order_status != 'processing' && products['0'].order_status != 'completed'"  
                                                value="cancel-items"
                                            >
                                                @lang('rma::app.admin.configuration.index.sales.rma.cancel-items')
                                            </option>
                                        </x-shop::form.control-group.control>

                                        <x-shop::form.control-group.error ::name="'resolution_type[' + product.product_id + ']'" class="flex"/>
                                    </x-shop::form.control-group>
                                </div>
                            </p>

                            <!-- Resolution Type -->
                            <p class="w-full" v-else>
                                <div v-if="isChecked[product.product_id] && product.currentQuantity > '0'">
                                    <x-shop::form.control-group>
                                        <x-shop::form.control-group.label class="required text-sm flex">
                                            @lang('rma::app.admin.configuration.index.sales.rma.resolution-type')
                                        </x-shop::form.control-group.label>

                                        <x-shop::form.control-group.control
                                            type="select"
                                            ::name="'resolution_type[' + product.product_id + ']'" 
                                            rules="required"
                                            v-model="resolutionType[product.product_id]"
                                            @change="getResolutionReason(product.product_id)"
                                            :label="trans('rma::app.admin.configuration.index.sales.rma.resolution-type')"
                                        >
                                            <option value="">
                                                @lang('admin::app.catalog.products.edit.types.bundle.update-create.select')
                                            </option>

                                            <option 
                                                v-if="products['0'].order_status != 'pending' && (products['0'].order_status == 'processing' || products['0'].order_status == 'completed')" 
                                                value="return"
                                            >
                                                @lang('rma::app.admin.configuration.index.sales.rma.return')
                                            </option>

                                            <option 
                                                v-if="products['0'].order_status != 'pending' && products['0'].order_status != 'processing' && products['0'].order_status == 'completed'" 
                                                value="exchange"
                                            >
                                                @lang('rma::app.admin.configuration.index.sales.rma.exchange')
                                            </option>

                                            <option 
                                                v-if="products['0'].order_status == 'pending' && products['0'].order_status != 'processing' && products['0'].order_status != 'completed'"  
                                                value="cancel-items"
                                            >
                                                @lang('rma::app.admin.configuration.index.sales.rma.cancel-items')
                                            </option>
                                        </x-shop::form.control-group.control>

                                        <x-shop::form.control-group.error ::name="'resolution_type[' + product.product_id + ']'" class="flex"/>
                                    </x-shop::form.control-group>
                                </div>
                            </p>

                            <!-- Reasons -->
                            <p class="w-full">
                                <div 
                                    v-if="isChecked[product.product_id] 
                                        && product.currentQuantity > '0'
                                        && resolutionType[product.product_id] 
                                        && resolutionReason[product.product_id] 
                                        && resolutionReason[product.product_id].length"
                                >
                                    <x-shop::form.control-group>
                                        <x-shop::form.control-group.label class="required text-sm flex">
                                            @lang('rma::app.shop.customer.create.reason')
                                        </x-shop::form.control-group.label>

                                        <x-shop::form.control-group.control
                                            type="select"
                                            ::name="'rma_reason_id[' + product.product_id + ']'" 
                                            v-model="rma_reason_id[product.product_id]"
                                            rules="required"
                                            :label="trans('rma::app.shop.customer.create.reason')"
                                        >
                                            <option
                                                v-for="reason in resolutionReason[product.product_id]"
                                                :value="reason.id"
                                                :key="reason.id"
                                            >
                                                @{{ formatTitle(reason.title) }}
                                            </option>
                                        </x-shop::form.control-group.control>

                                        <x-shop::form.control-group.error ::name="'rma_reason_id[' + product.product_id + ']'" class="flex"/>
                                    </x-shop::form.control-group>
                                </div>
                            </p>
                        </div>
                    </div>
                </div>

                <div 
                    class="gap-5" 
                    v-if="isChecked.length == rma_reason_id.length && rma_reason_id.length && rma_qty.length"
                >
                    <!-- Delivery Status -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required text-sm mt-4 flex">
                            @lang('rma::app.admin.configuration.index.sales.rma.product-delivery-status')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="select"
                            name="order_status" 
                            rules="required"
                            v-model="orderStatus"
                            :label="trans('rma::app.admin.configuration.index.sales.rma.product-delivery-status')"
                            >
                            <option value="">
                                @lang('admin::app.catalog.products.edit.types.bundle.update-create.select')
                            </option>

                            <option 
                                v-if="products['0'].order_status != 'pending' && products['0'].order_status != 'processing'" 
                                value="1"
                            >
                                @lang('rma::app.shop.customer.delivered')
                            </option>

                            <option value="0">
                                @lang('rma::app.shop.customer.undelivered')
                            </option>
                        </x-shop::form.control-group.control>

                        <x-shop::form.control-group.error name="order_status" class="flex"/>
                    </x-shop::form.control-group>

                    <div v-if="orderStatus == '1'">
                        <!-- Delivery Status -->
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label class="required text-sm mt-4 flex">
                                @lang('rma::app.admin.configuration.index.sales.rma.package-condition')
                            </x-shop::form.control-group.label>

                            <x-shop::form.control-group.control
                                type="select"
                                name="package_condition" 
                                rules="required"
                                v-model="packageCondition"
                                :label="trans('rma::app.admin.configuration.index.sales.rma.package-condition')"
                            >
                                <option value="">
                                    @lang('admin::app.catalog.products.edit.types.bundle.update-create.select')
                                </option>

                                <option value="open">
                                    @lang('rma::app.admin.configuration.index.sales.rma.open')
                                </option>

                                <option value="packed">
                                    @lang('rma::app.admin.configuration.index.sales.rma.packed')
                                </option>
                            </x-shop::form.control-group.control>

                            <x-shop::form.control-group.error name="package_condition" class="flex"/>
                        </x-shop::form.control-group>

                        <!-- Return Pickup Address -->
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label class="required text-sm mt-4 flex">
                                @lang('rma::app.admin.configuration.index.sales.rma.return-pickup-address')
                            </x-shop::form.control-group.label>

                            <x-shop::form.control-group.control
                                type="text"
                                name="return_pickup_address"
                                rules="required"
                                :value="old('return_pickup_address')"
                                :label="trans('rma::app.admin.configuration.index.sales.rma.return-pickup-address')"
                                :placeholder="trans('rma::app.admin.configuration.index.sales.rma.return-pickup-address')"
                                aria-label="@lang('rma::app.admin.configuration.index.sales.rma.return-pickup-address')"
                            />

                            <x-shop::form.control-group.error name="return_pickup_address" class="flex"/>
                        </x-shop::form.control-group>

                        <!-- Return Pickup Time -->
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label class="required text-sm mt-4 flex">
                                @lang('rma::app.admin.configuration.index.sales.rma.return-pickup-time')
                            </x-shop::form.control-group.label>

                            <x-shop::form.control-group.control
                                type="select"
                                name="return_pickup_time" 
                                rules="required"
                                v-model="returnPickupTime"
                                :label="trans('rma::app.admin.configuration.index.sales.rma.return-pickup-time')"
                            >
                                <option value="">
                                    @lang('admin::app.catalog.products.edit.types.bundle.update-create.select')
                                </option>

                                <option value="morning">
                                    @lang('rma::app.admin.configuration.index.sales.rma.morning')
                                </option>

                                <option value="afternoon">
                                    @lang('rma::app.admin.configuration.index.sales.rma.afternoon')
                                </option>

                                <option value="evening">
                                    @lang('rma::app.admin.configuration.index.sales.rma.evening')
                                </option>
                            </x-shop::form.control-group.control>

                            <x-shop::form.control-group.error name="return_pickup_time" class="flex"/>
                        </x-shop::form.control-group>

                        <!-- Additionally -->
                        @foreach ($customAttributes as $attribute)
                            <x-shop::form.control-group>
                                <x-shop::form.control-group.label class="flex text-sm mt-4">
                                    {!! $attribute->label . ($attribute->is_required == '1' ? '<span class="required"></span>' : '') !!}
                                </x-shop::form.control-group.label>

                                @if ($attribute->is_required == '1')
                                   @php 
                                    $attribute->is_required = 'required'; 
                                   @endphp
                                @elseif ($attribute->is_required == '0')
                                    @php 
                                    $attribute->is_required = ''; 
                                   @endphp
                                @endif

                                @switch($attribute->type)
                                    @case('text')
                                        <x-shop::form.control-group.control
                                            type="text"
                                            name="{{ $attribute->code }}"
                                            rules="{{ $attribute->is_required }}"
                                            :value="old($attribute->code)"
                                            label="{{ $attribute->label }}"
                                            placeholder="{{ $attribute->label }}"
                                        />

                                        <x-shop::form.control-group.error class="flex" control-name="{{ $attribute->code }}" />
                                        @break

                                    @case('textarea')
                                        <x-shop::form.control-group.control
                                            type="textarea"
                                            name="{{ $attribute->code }}"
                                            rules="{{ $attribute->is_required }}"
                                            :value="old($attribute->code)"
                                            label="{{ $attribute->label }}"
                                            placeholder="{{ $attribute->label }}"
                                            rows="12"
                                        />
        
                                        <x-shop::form.control-group.error class="flex" control-name="{{ $attribute->code }}" />
                                        @break

                                    @case('date')
                                        <x-shop::form.control-group.control
                                            type="date"
                                            name="{{ $attribute->code }}"
                                            rules="{{ $attribute->is_required }}"
                                            :value="old($attribute->code)"
                                            label="{{ $attribute->label }}"
                                            placeholder="{{ $attribute->label }}"
                                        />

                                        <x-shop::form.control-group.error class="flex" control-name="{{ $attribute->code }}" />

                                    @break

                                    @case('select')
                                        <x-admin::form.control-group.control
                                            type="select"
                                            id="{{ $attribute->code }}"
                                            class="cursor-pointer"
                                            name="{{ $attribute->code }}"
                                            rules="{{ $attribute->is_required }}"
                                            :value="old($attribute->code)"
                                            label="{{ $attribute->label }}"
                                        >
                                            <!-- Here! All Needed types are defined -->
                                            @foreach($attribute->options ?? [] as $option)
                                                <option
                                                    value="{{ $option->option_value }}"
                                                >
                                                    {{ $option->option_name }}
                                                </option>
                                            @endforeach
                                        </x-admin::form.control-group.control>

                                        <x-shop::form.control-group.error class="flex" control-name="{{ $attribute->code }}" />

                                    @break

                                    @case('multiselect')
                                        <x-admin::form.control-group.control
                                            type="multiselect"
                                            id="{{ $attribute->code }}"
                                            class="cursor-pointer"
                                            name="{{ $attribute->code }}[]"
                                            rules="{{ $attribute->is_required }}"
                                            :value="old($attribute->code)"
                                            label="{{ $attribute->label }}"
                                        >
                                            <!-- Here! All Needed types are defined -->
                                            @foreach($attribute->options ?? [] as $option)
                                                <option
                                                    value="{{ $option->option_value }}"
                                                >
                                                    {{ $option->option_name }}
                                                </option>
                                            @endforeach
                                        </x-admin::form.control-group.control>

                                        <x-shop::form.control-group.error class="flex" control-name="{{ $attribute->code }}" />

                                    @break

                                    @case('checkbox')
                                        @foreach($attribute->options ?? [] as $option)
                                            <label class="relative mb-2 flex cursor-pointer items-start">
                                                <v-field
                                                    type="checkbox" 
                                                    class="flex"
                                                    name="{{ $attribute->code }}" 
                                                    rules="{{ $attribute->is_required }}"
                                                    v-slot="{ field }" 
                                                    value='1'
                                                >
                                                    <input 
                                                        type="checkbox" 
                                                        class="peer sr-only" 
                                                        id="{{ $attribute->code }}" 
                                                        rules="required"
                                                        name="{{ $attribute->code }}" 
                                                        value='1'
                                                        v-bind="field" 
                                                    />
                                                </v-field>
                                
                                                <label 
                                                    class="icon-uncheck peer-checked:icon-check-box cursor-pointer text-base peer-checked:text-navyBlue"
                                                    for="{{ $attribute->code }}"
                                                >
                                                    {{ $option->option_name }}
                                                </label>
                                            </label>
                                
                                            <x-admin::form.control-group.error control-name="{{ $attribute->code }}" class="flex"/>
                                        @endforeach
                                        
                                    @break

                                    @case('radio')
                                        @foreach($attribute->options ?? [] as $option)
                                            <label class="relative mb-2 flex cursor-pointer items-start">
                                                <v-field
                                                    type="radio"
                                                    class="flex"
                                                    name="attribute_{{ $attribute->id }}"
                                                    rules="{{ $attribute->is_required }}"
                                                    v-slot="{ field }"
                                                    value="{{ $option->option_name }}"
                                                >
                                                    <input
                                                        type="radio"
                                                        class="sr-only peer"
                                                        id="option_{{ $loop->index }}"
                                                        rules="{{ $attribute->is_required }}"
                                                        name="attribute_{{ $attribute->id }}"
                                                        value="{{ $option->option_name }}"
                                                        v-bind="field"
                                                    />
                                                </v-field>
                                        
                                                <label
                                                    class="icon-radio-unselect text-base peer-checked:icon-radio-select peer-checked:text-navyBlue cursor-pointer"
                                                    for="option_{{ $loop->index }}"
                                                >
                                                    {{ $option->option_name }}
                                                </label>
                                            </label>
                                        @endforeach
                                
                                        <x-admin::form.control-group.error control-name="{{ $option->option_name }}" class="flex"/>
                                        
                                    @break

                                @endswitch
                            </x-shop::form.control-group>
                        @endforeach
                    </div>

                    <!-- Additional information -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="text-sm flex">
                            @lang('rma::app.shop.customer.create.information')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="textarea"
                            name="information"
                            id="information"
                            :label="trans('rma::app.shop.customer.create.information')"
                            :placeholder="trans('rma::app.shop.customer.create.information')"
                            rows="4"
                            maxlength="250"
                        />

                        <x-shop::form.control-group.error control-name="information" class="flex"/>
                    </x-shop::form.control-group>

                    <!-- Images -->
                    <x-shop::form.control-group class="mt-4">
                        <x-shop::form.control-group.label class="text-sm flex">
                            @lang('admin::app.catalog.products.edit.images.title')
                        </x-shop::form.control-group.label>
                        
                        <x-shop::form.control-group.control
                            type="image"
                            class="!p-0 rounded-xl text-gray-700 mb-0"
                            name="images[]"
                            :label="trans('admin::app.catalog.products.edit.images.title')"
                            :is-multiple="false"
                            accepted-types="image/*"
                        />

                        <x-shop::form.control-group.error control-name="images[]" class="flex"/>
                    </x-shop::form.control-group>

                    @include('rma::shop.customer.rma.terms')
                </div>
            </div>

            <div v-else>
                @lang('rma::app.shop.customer.create.rma-not-available-quotes')
            </div>
        </script>

        <script type="module">
            app.component('rma-request-wrapper', {
                template: '#rma-request-template',

                data() {
                    return {
                        isSelect: 0,
                        refreshComponent: 1,
                        rmaFormButton: false,
                        rmaFormSubmit: true,
                    }
                },

                mounted() {
                    // adding eventBus listener
                    this.$emitter.on('valid-rma', (data) => {
                        if(data.isValid) {
                            this.rmaFormButton = true;
                        }
                    })
                },

                methods: {
                    productAvail(record) {
                        this.isSelect = record.id;

                        ++this.refreshComponent;

                        this.$refs.rmaModel.toggle();
                    },

                    rmaSubmit(params, { resetForm, setErrors  }) {
                        let formData = new FormData(this.$refs.rmaSubmit);

                        this.rmaFormSubmit = false;
                        
                        this.$axios.post("{{ route('rma.guest.store') }}", formData)
                            .then((response) => {

                                this.$emitter.emit('add-flash', { type: 'success', message: response.data.messages });

                                setTimeout(() => {
                                    window.location.reload();
                                }, 3000);
                            });
                    },
                }
            });

            app.component('v-order-items-list', {
                template: '#v-order-items-list-template',

                props: ['orderId'],

                data() {
                    return {
                        isLoading: true,

                        isChecked: [],

                        orderStatus: '',

                        resolutionReason: [],

                        rma: [],

                        rma_qty: [],

                        rma_reason_id: [],

                        products: '',

                        resolutionType: [],

                        baseImageUrl: '{{ Storage::url('') }}',

                        returnWindowDays: parseInt('{{ core()->getConfigData('sales.rma.setting.default_allow_days') }}'),
                    }
                },

                updated() {
                    let isValid = this.isChecked.length == this.rma_reason_id.length && this.rma_reason_id.length && this.rma_qty.length;

                    this.$emitter.emit('valid-rma', {
                        isValid: isValid,
                    });
                },

                mounted() {
                    this.getOrderItems(this.orderId);
                },

                methods: {
                    formatPrice(price) {
                            return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(price);
                    },

                    getOrderItems(orderId) {
                        let url = '{{route("rma.guest.getOrderProduct", ":orderId")}}';
                    
                        url = url.replace(':orderId', this.orderId);

                        if (this.orderId){
                            this.$axios.get(url)
                                .then(response => {
                                    this.isLoading = false;

                                    this.products = response.data;
                                }).catch(error => {
                                    console.log(error);
                                });
                        }
                    },

                    calculateReturnWindow(createdAt) {
                        const createdDate = new Date(createdAt);
                        const returnDate = new Date(createdDate);
                        returnDate.setDate(createdDate.getDate() + this.returnWindowDays);

                        const currentDate = new Date();

                        if (returnDate < currentDate) {
                            return 'Not Allowed';
                        }

                        return new Intl.DateTimeFormat('en-GB', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        }).format(returnDate);
                    },
                    
                    calculateDeliveredReturnWindow(created_At, rulesDays) {
                        const createdAt = new Date(created_At);
                        const returnDate = new Date(
                            createdAt.getTime() + rulesDays * 24 * 60 * 60 * 1000
                        );

                        returnDate.setUTCDate(returnDate.getDate());

                        const currentDate = new Date();

                        if (returnDate < currentDate) {
                            return 'Not Allowed';
                        }

                        return new Intl.DateTimeFormat('en-GB', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric',
                        }).format(returnDate);
                    },

                    getResolutionReason(product_id) {
                        let resolutionType = this.resolutionType[product_id];

                        let url = '{{route("rma.guest.getResolutionReason", ":resolutionType")}}';

                        url = url.replace(':resolutionType', resolutionType);

                        if (resolutionType){
                            this.$axios.get(url)
                                .then(response => {
                                    if (response.data['0'] == null) {
                                        this.resolutionReason[product_id] = null;

                                        return;
                                    }

                                    this.resolutionReason[product_id] = response.data;

                                }).catch(error => {
                                    console.log(error);
                                });
                        }
                    },

                    formatTitle(title) {
                        console.log(title.length);
                        
                        if (title.length > 100) {
                            return title.slice(0, 100) + '...';
                        }

                        return title;
                    },
                },
            });
        </script>
    @endpushOnce
</x-shop::layouts>