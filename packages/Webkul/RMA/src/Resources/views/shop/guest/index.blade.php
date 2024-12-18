    <x-shop::layouts :has-feature="false">
        <!-- Title of the page -->
        <x-slot:title>
            @lang('rma::app.shop.customer.title')
        </x-slot:title>

        <div class="flex flex-wrap">
            <div class="container mt-8 px-16 max-lg:px-8">
                <div class="flex items-center justify-between">
                    <!-- Heading -->
                    <h2 class="text-4xl max-lg:text-base font-medium">
                        @lang('rma::app.shop.guest.index.guest')
                    </h2>

                    <!-- button -->
                    <a
                        href="{{ route('shop.guest.create-rma') }}"
                        class="secondary-button border-[#E9E9E9] px-5 max-lg:px-2 max-lg:text-xs py-2 font-normal"
                    >
                        @lang('rma::app.shop.guest.index.create')
                    </a>
                </div>

                {!! view_render_event('guest.account.rma.list.before') !!}

                <v-guest-rma></v-guest-rma>

                {!! view_render_event('guest.account.rma.list.after') !!}

                @pushOnce('scripts')
                    <script
                        type="text/x-template"
                        id="v-guest-rma-template"
                    >
                        <div class="max-md:hidden">
                            <x-shop::datagrid :src="route('shop.guest.all-rma')" >
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
                                                v-for="(columnGroup, index) in [['id'], ['order_id'], ['rma_status'], ['total_quantity'], ['created_at']]"
                                            >
                                                <p class="text-gray-600 dark:text-gray-300 text-[15px]">
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
                                            <p class="flex justify-start text-gray-600 cursor-pointer">
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
                                            <div class="flex gap-x-4 justify-between items-center">
                                                <div class="flex flex-col gap-1.5">
                                                    <p
                                                        class="text-gray-600 dark:text-gray-300"
                                                        v-html="record.id ?? 'N/A'"
                                                    >
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            <div class="flex gap-x-4 justify-between items-center">
                                                <div class="flex flex-col gap-1.5">
                                                    <p
                                                        class="text-gray-600 dark:text-gray-300"
                                                        v-html="record.order_id"
                                                    >
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="flex gap-x-4 justify-between items-center">
                                                <div class="flex flex-col gap-1.5">
                                                    <p
                                                        class="text-gray-600 dark:text-gray-300"
                                                        v-html="record.rma_status"
                                                    >
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            <div class="flex gap-x-4 justify-between items-center">
                                                <div class="flex flex-col gap-1.5">

                                                    <p 
                                                        class="text-gray-600 "
                                                        v-html="record.total_quantity"
                                                    >
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            <div class="flex gap-x-4 justify-between items-center">
                                                <div class="flex flex-col gap-1.5">
                                                    <p class="text-gray-600 text-sm" v-html="record.created_at"></p>
                                                </div>
                                            </div>
                                            
                                            <div class="flex gap-x-4 justify-between items-center">
                                                <div class="flex flex-col gap-1.5">
                                                    @php
                                                        $routeName = request()->route()->getName();

                                                        if (
                                                            auth()->guard('customer')->user()
                                                            && $routeName == 'rma.customers.all-rma'
                                                        ) {
                                                            $route = 'rma.customer.view';

                                                            $cancelRoute = 'rma.customer.cancelRMAStatus';
                                                        } else {
                                                            $route = 'rma.customer.guest-view';

                                                            $cancelRoute = 'rma.guest.cancelRMAStatus';
                                                        }
                                                    @endphp
                                                    
                                                    <p class="flex justify-end">
                                                        <!-- Arrow -->
                                                        <a :href="`{{{ route($route, '') }}}/${record.id}`">
                                                            <span class="icon-eye text-2xl ltr:ml-1 rtl:mr-1 rounded-md cursor-pointer transition-all hover:bg-gray-200 dark:hover:bg-gray-800"></span>
                                                        </a>
                                                        
                                                        <span v-if="record.rmaStatus != 'canceled'">
                                                            <span v-if="record.rmaStatus != 'Item Canceled'">
                                                                <span v-if="record.rmaStatus != 'Declined'">
                                                                    <span v-if="record.rmaStatus != 'solved'">
                                                                        <span v-if="record.rmaStatus != 'Received Package'">
                                                                            <!-- Cancel Arrow -->
                                                                            <a @click="cancelStatus(record.id)">
                                                                                <span class="icon-cancel text-2xl ltr:ml-1 rtl:mr-1 rounded-md cursor-pointer transition-all hover:bg-gray-200 dark:hover:bg-gray-800"></span>
                                                                            </a>
                                                                        </span>
                                                                    </span>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </template>
                                </template>
                            </x-shop::datagrid>
                        </div>

                        <!-- For Mobile View -->
                        <div class="md:hidden">
                            <x-shop::datagrid :src="route('shop.guest.all-rma')" >
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
                                                v-for="(columnGroup, index) in [['id', 'order_id', 'rma_status'], ['total_quantity', 'created_at']]"
                                            >
                                                <p class="text-gray-600 dark:text-gray-300 text-[15px]">
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
                                                        v-html="record.id ?? 'N/A'"
                                                    >
                                                    </p>
                        
                                                    <p
                                                        class="text-gray-600 dark:text-gray-300"
                                                        v-html="record.order_id"
                                                    >
                                                    </p>
                        
                                                    <p
                                                        class="text-gray-600 dark:text-gray-300"
                                                        v-html="record.rma_status"
                                                    >
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            <div class="flex gap-x-4 justify-between items-center">
                                                <div class="flex flex-col gap-1.5">

                                                    <p 
                                                        class="text-gray-600 "
                                                        v-html="record.total_quantity"
                                                    >
                                                    </p>

                                                    <p class="text-gray-600 text-sm" v-html="record.created_at"></p>
                                                    
                                                    @php
                                                        $routeName = request()->route()->getName();

                                                        if (
                                                            auth()->guard('customer')->user()
                                                            && $routeName == 'rma.customers.all-rma'
                                                        ) {
                                                            $route = 'rma.customer.view';

                                                            $cancelRoute = 'rma.customer.cancelRMAStatus';
                                                        } else {
                                                            $route = 'rma.customer.guest-view';

                                                            $cancelRoute = 'rma.guest.cancelRMAStatus';
                                                        }
                                                    @endphp
                                                    
                                                    <p class="flex justify-center">
                                                        <!-- Arrow -->
                                                        <a :href="`{{{ route($route, '') }}}/${record.id}`">
                                                            <span class="icon-eye text-2xl ltr:ml-1 rtl:mr-1 rounded-md cursor-pointer transition-all hover:bg-gray-200 dark:hover:bg-gray-800"></span>
                                                        </a>

                                                        <span v-if="record.rmaStatus != 'canceled'">
                                                            <span v-if="record.rmaStatus != 'Item Canceled'">
                                                                <span v-if="record.rmaStatus != 'Declined'">
                                                                    <span v-if="record.rmaStatus != 'solved'">
                                                                        <span v-if="record.rmaStatus != 'Received Package'">
                                                                            <!-- Cancel Arrow -->
                                                                            <a @click="cancelStatus(record.id)">
                                                                                <span class="icon-cancel text-2xl ltr:ml-1 rtl:mr-1 rounded-md cursor-pointer transition-all hover:bg-gray-200 dark:hover:bg-gray-800"></span>
                                                                            </a>
                                                                        </span>
                                                                    </span>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </template>
                            </x-shop::datagrid>
                        </div>
                    </script>

                    <script type="module">
                        app.component('v-guest-rma', {
                            template: '#v-guest-rma-template',
            
                            data() {
                                return {
            
                                }
                            },
            
                            methods: {
                                cancelStatus(recordId) {
                                    this.$emitter.emit('open-confirm-modal', {
                                        agree: () => {
                                            this.$axios.get(`{{ route('rma.guest.cancelRMAStatus', '') }}/${recordId}`)
                                                .then(response => {
                                                    this.$emitter.emit('add-flash', { type: 'success', message: response.data.message });
            
                                                    setTimeout(() => {
                                                        window.location.reload();
                                                    }, 2000);

                                                }).catch(error => {
                                                    console.log(error);
                                                });
                                        }
                                    });
                                }
                            },
                        });
                    </script>
                @endPushOnce
            </div>
        </div>
    </x-shop::layouts>