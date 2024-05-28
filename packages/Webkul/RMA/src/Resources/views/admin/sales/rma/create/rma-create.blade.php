<x-admin::layouts>
    <!-- Title of the page --> 
    <x-slot:title>
        @lang('rma::app.admin.sales.rma.create-rma.create-title')
    </x-slot:title>

    <rma></rma>

    @pushOnce('scripts')
        <script 
            type="text/x-template"
            id="rma-template"
        >
            @if (! $show)
            <!-- Form --> 
            <x-admin::form
                :action="route('admin.sales.rma.validate')"
                enctype="multipart/form-data"
            >
                
                <div class="flex items-center justify-between gap-4 max-sm:flex-wrap">
                    <!-- Heading -->         
                    <h1 class="text-xl font-bold text-gray-800 dark:text-white">
                        @lang('rma::app.admin.sales.rma.create-rma.create-title')
                    </h1>
                    
                    <div class="flex items-center gap-x-2.5">
                        <button 
                            type="submit" 
                            class="primary-button"
                        >                                
                            @lang('rma::app.admin.sales.rma.create-rma.validate')
                        </button>
                    </div>
                </div>
                <br>
                
                <div class="mt-3.5 flex gap-2.5 max-xl:flex-wrap">
                    <div class="box-shadow w-full rounded bg-white p-4 dark:bg-gray-900">
                        
                        <!-- Order Id -->
                        <x-admin::form.control-group class="mb-2.5 w-full">
                            <x-admin::form.control-group.label class="required">
                                @lang('rma::app.admin.sales.rma.create-rma.order-id')
                            </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                    type="text"
                                    name="orderId"
                                    id="OrderId"
                                    :value="old('orderId')"
                                    rules="required"
                                    :label="trans('rma::app.admin.sales.rma.create-rma.order-id')"
                                    :placeholder="trans('rma::app.admin.sales.rma.create-rma.order-id')"
                                >
                                </x-admin::form.control-group.control>

                                <x-admin::form.control-group.error
                                    control-name="OrderId"
                                >
                                </x-admin::form.control-group.error>
                            </x-admin::form.control-group>
                            
                            <!--Email-->
                            <x-admin::form.control-group class="mb-2.5 w-full">
                                <x-admin::form.control-group.label class="required">
                                    @lang('rma::app.admin.sales.rma.create-rma.email')
                                </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="email"
                                name="email"
                                id="email"
                                :value="old('email')"
                                rules="required|email"
                                :label="trans('rma::app.admin.sales.rma.create-rma.email')"
                                :placeholder="trans('rma::app.admin.sales.rma.create-rma.email')"
                            >
                            </x-admin::form.control-group.control>

                            <x-admin::form.control-group.error
                                control-name="email"
                            >
                            </x-admin::form.control-group.error>
                        </x-admin::form.control-group>
                    </div>
                </div>
            </x-admin::form>
            @endif
                
            @if ($show)
                <div class="flex items-center justify-between gap-4 max-sm:flex-wrap">
                    <h1 class="text-xl font-bold text-gray-800 dark:text-white">
                        @lang('rma::app.admin.sales.rma.create-rma.create-title')
                    </h1>
                </div>
                <br>

                <div class="mt-3.5 flex gap-2.5 max-xl:flex-wrap">
                    <div class="box-shadow w-full rounded bg-white p-4 dark:bg-gray-900">
                        
                        <x-admin::form 
                            id="check-form"
                            :action="route('admin.sales.rma.store')"
                            enctype="multipart/form-data"
                        >
                            <input 
                                type="hidden" 
                                name="order_id" 
                                value="{{$rmaData['orderId']}}"
                            >
                            
                            <input 
                                type="hidden" 
                                name="email" 
                                value="{{$rmaData['email']}}"
                            >
                            
                            <input 
                                type="hidden" 
                                name="is_guest" 
                                value="{{$rmaData['isGuest']}}"
                            >
       
                            <!-- Order table -->
                            <div class="relative mb-2.5 overflow-x-auto">
                                <table class="w-full min-w-[800px] text-left text-sm">
                                    <thead class="border-b-[1px] border-gray-200 bg-gray-50 text-[14px] text-gray-600 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                                        <tr class="px-6 py-[16px] font-medium text-black">
                                            <th class="checkbox">
                                                <input 
                                                    type="checkbox" 
                                                    id="select-all"
                                                    v-model="selectAllChecked"
                                                    @change="selectAllItems"
                                                >
                                            </th>

                                            <th scope="col" class="px-6 py-[16px] font-semibold">
                                                @lang('admin::app.catalog.products.index.datagrid.sku')
                                            </th>
                                            
                                            <th scope="col" class="px-6 py-[16px] font-semibold">
                                                @lang('admin::app.catalog.products.index.datagrid.name')
                                            </th>
                                            
                                            <th scope="col" class="px-6 py-[16px] font-semibold">
                                                @lang('admin::app.catalog.products.index.datagrid.price')
                                            </th>

                                            <th scope="col" class="px-6 py-[16px] font-semibold">
                                                @lang('rma::app.admin.sales.rma.create-rma.quantity')
                                            </th>
                                            
                                            <th scope="col" class="px-6 py-[16px] font-semibold">
                                                @lang('rma::app.admin.sales.rma.create-rma.reason')
                                            </th>
                                        </tr>
                                    </thead>
    
                                    @foreach ($order as $key => $item)
                                        <tbody>
                                            <!-- Order Details -->
                                            <tr class="border-b bg-white transition-all hover:bg-gray-50 dark:border-gray-800 dark:bg-gray-900 dark:hover:bg-gray-950">
                                                <td class="checkbox">
                                                    <input 
                                                        type="checkbox" 
                                                        id="checkboxSingle"
                                                        v-model="selectedItems" 
                                                        :checked="selectAllChecked" 
                                                        class='select' 
                                                        name="order_item_id[]" 
                                                        value="{{$item->id}}"
                                                    >
                                                </td>
    
                                                <td class="whitespace-nowrap px-6 py-[16px] text-gray-600 dark:text-gray-300">
                                                    {{ $item->getTypeInstance()->getOrderedItem($item)->sku }}
                                                </td>
    
                                                <td scope="row" class="px-6 py-[16px] text-gray-600 dark:text-gray-300">
                                                    {{ $item->name }}

                                                    @if (isset($item->additional['attributes']))
                                                        <div class="item-options">
        
                                                        @foreach ($item->additional['attributes'] as $attribute)
                                                            <b>
                                                                {{ $attribute['attribute_name'] }} : 
                                                            </b>
                                                                {{ $attribute['option_label'] }}
                                                            </br>
                                                        @endforeach
        
                                                        </div>
                                                    @endif
                                                </td>
                                                
                                                <td class="px-6 py-[16px] text-gray-600 dark:text-gray-300">
                                                    {{ core()->formatBasePrice($item->base_price) }}
                                                </td>
                                                
                                                <td class="px-6 py-[16px] text-gray-600 dark:text-gray-300">
                                                    @php $getQty = $orderQty[$key] @endphp
                                                    
                                                    <x-admin::form.control-group class="mb-2.5 w-full">
                                                        <x-admin::form.control-group.control
                                                            type="select"
                                                            name='qty[{{$key}}]'
                                                            rules="required"
                                                            :label="trans('rma::app.admin.sales.rma.create-rma.quantity')"
                                                        >
                                                        
                                                            <option value="">
                                                                @lang('rma::app.admin.sales.rma.create-rma.quantity')
                                                            </option>
                                                            
                                                            @for ($i = 1; $i <= $getQty; $i++)
                                                                <option value="{{ $i }}">
                                                                    {{ $i }}
                                                                </option>
                                                            @endfor
                                                        
                                                        </x-admin::form.control-group.control>
                                                        
                                                        <x-admin::form.control-group.error
                                                            control-name="qty[{{$key}}]"
                                                        >
                                                        </x-admin::form.control-group.error>
                                                    </x-admin::form.control-group> 
                                                </td>
    
                                                <!-- select reason -->
                                                <td class="px-6 py-[16px] text-gray-600 dark:text-gray-300">
                                                    <x-admin::form.control-group class="mb-2.5 w-full">
                                                        <x-admin::form.control-group.control
                                                            type="select"
                                                            name="reason[{{ $item->id }}]"
                                                            rules="required"
                                                            label="{{trans('rma::app.admin.sales.rma.create-rma.reason')}}"
                                                        >
                                                        
                                                            <option value="">
                                                                @lang('rma::app.admin.sales.rma.create-rma.reason')
                                                            </option>
                                                            
                                                            @foreach($reason as $reasons)
                                                                <option value="{{ $reasons->id }}">
                                                                    {{ $reasons->title }}
                                                                </option>
                                                            @endforeach
                                                        </x-admin::form.control-group.control>
                                                        
                                                        <x-admin::form.control-group.error
                                                            control-name="reason[{{ $item->id }}]"
                                                        >
                                                        </x-admin::form.control-group.error>
                                                    </x-admin::form.control-group> 
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                            <br>
                        
                            @if (count($order) <= 0)                                                                         
                                <div style="text-align: center;">
                                    <p>
                                        @lang('rma::app.admin.sales.rma.create-rma.rma-not-available-quotes')
                                    </p>
                                </div>
                            @endif

                            <div class="box-shadow mb-2.5 rounded bg-white p-4 dark:bg-gray-800">
                                <div class="mb-2.5 w-full">
                                    <x-admin::form.control-group>
                                        <x-admin::form.control-group.label>
                                            @lang('rma::app.admin.sales.rma.create-rma.image')
                                        </x-admin::form.control-group.label>

                                        <x-admin::media.images
                                            name="images"
                                            allow-multiple="true"
                                            show-placeholders="true"
                                        >
                                        </x-admin::media.images>
                                    </x-admin::form.control-group>
                                </div>
                            </div>
                            <br>  
                              
                            <!-- additional information -->
                            <div class="box-shadow mb-2.5 rounded bg-white p-4 dark:bg-gray-800">
                                <x-admin::form.control-group class="mb-2.5">
                                    <x-admin::form.control-group.label>
                                        @lang('rma::app.shop.customer.create.information')
                                    </x-admin::form.control-group.label>

                                    <x-admin::form.control-group.control
                                        type="textarea"
                                        name="information"
                                        :value="old('information')"
                                        id="information"
                                        :label="trans('rma::app.shop.customer.create.information')"
                                        :placeholder="trans('rma::app.shop.customer.create.information')"
                                        rows="3"
                                    >
                                    </x-admin::form.control-group.control>
                                </x-admin::form.control-group>
                            </div>
                            <br>
                            
                            <!-- button -->
                            <button 
                                type="submit" 
                                class="primary-button" 
                            >
                                @lang('rma::app.admin.sales.rma.create-rma.save-btn')
                            </button>
                        </x-admin::form>
                    </div>
                </div>
            @endif
        </script>

        <script type="module">
            var rmaData = @json($rmaData);

            app.component('rma', {
                template: '#rma-template',

                data: function() {
                    return {
                        rmaData: rmaData,
                        email: '',
                        OrderId: '',
                        validated: false,
                        error: false,
                        selectAllChecked: false,
                        selectedItems: [],
                        order: []
                    };
                },

                methods: {
                    clearRmaFromSession() {
                        this.$axios.post("{{ route('admin.sales.rma.session') }}")
                            .then(response => {
                                if (response) {
                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 700);
                                }
                            }).catch (error => {
                                this.errorMessage = error.response.data.message;
                            });
                    },

                    selectAllItems() {
                        if (this.selectAllChecked) {
                            // Check if order is not empty before mapping
                            if (this.order.length > 0) {
                                this.selectedItems = this.order.map(item => item.id);
                            }
                        } else {
                            this.selectedItems = [];
                        }
                    },

                    // formValidation() {
                    //     if (this.selectedItems.length === 0) {
                    //         alert('Please select an item');
                    //         event.preventDefault();
                    //         return false;
                    //     }
                    // },

                    // validateForm(scope) {
                    //     if (this.validated) {
                    //         document.getElementById('check-form').submit();
                    //     }

                    //     if (! this.validated) {
                    //         alert('Please select item');
                    //     }
                    // },
                }
            });
        </script>
    @endPushOnce
</x-admin::layouts>