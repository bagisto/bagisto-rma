
<v-create-shipment>
    <div
        class="inline-flex w-full max-w-max cursor-pointer items-center justify-between gap-x-[8px] px-[4px] py-[6px] text-center font-semibold text-gray-600 transition-all hover:rounded-[6px] hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-800"
    >
        <span class="icon-ship text-[24px]"></span> 

        @lang('admin::app.sales.orders.view.ship')     
    </div>
</v-create-shipment>

@pushOnce('scripts')
    <script type="text/x-template" id="v-create-shipment-template">
        <div>
            <div
                class="inline-flex w-full max-w-max cursor-pointer items-center justify-between gap-x-[8px] px-[4px] py-[6px] text-center font-semibold text-gray-600 transition-all hover:rounded-[6px] hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-800"
                @click="$refs.shipment.open()"
            >
                <span class="icon-ship text-[24px]"></span> 

                @lang('admin::app.sales.orders.view.ship')     
            </div>

            <!-- Shipment Create Drawer -->
            <x-admin::form  
                method="POST"
                :action="route('admin.sales.shipments.store', $order->id)"
            >
                <x-admin::drawer ref="shipment">
                    <!-- Drawer Header -->
                    <x-slot:header>
                        <div class="grid gap-[12px]">
                            <div class="flex items-center justify-between">
                                <p class="text-[20px] font-medium dark:text-white">
                                    @lang('admin::app.sales.shipments.create.title')
                                </p>

                                <button
                                    type="submit"
                                    class="primary-button mr-[45px]"
                                >
                                    @lang('admin::app.sales.shipments.create.create-btn')
                                </button>
                            </div>
                        </div>
                    </x-slot:header>

                    <!-- Drawer Content -->
                    <x-slot:content class="!p-0">
                        <div class="grid">
                            <div class="p-[16px] pt-2">
                                <div class="grid grid-cols-2 gap-x-[20px]">
                                    <!-- Carrier Name -->
                                    <x-admin::form.control-group>
                                        <x-admin::form.control-group.label>
                                            @lang('admin::app.sales.shipments.create.carrier-name')
                                        </x-admin::form.control-group.label>

                                        <x-admin::form.control-group.control
                                            type="text"
                                            name="shipment[carrier_title]" 
                                            id="shipment[carrier_title]" 
                                            :label="trans('admin::app.sales.shipments.create.carrier-name')"
                                            :placeholder="trans('admin::app.sales.shipments.create.carrier-name')"
                                        >
                                        </x-admin::form.control-group.control>

                                        <x-admin::form.control-group.error
                                            control-name="carrier_name"
                                        >
                                        </x-admin::form.control-group.error>
                                    </x-admin::form.control-group>

                                    <!-- Tracking Number -->
                                    <x-admin::form.control-group>
                                        <x-admin::form.control-group.label>
                                            @lang('admin::app.sales.shipments.create.tracking-number')
                                        </x-admin::form.control-group.label>

                                        <x-admin::form.control-group.control
                                            type="text"
                                            name="shipment[track_number]"
                                            id="shipment[track_number]"
                                            :label="trans('admin::app.sales.shipments.create.tracking-number')"
                                            :placeholder="trans('admin::app.sales.shipments.create.tracking-number')"
                                        >
                                        </x-admin::form.control-group.control>

                                        <x-admin::form.control-group.error
                                            control-name="shipment[track_number]"
                                        >
                                        </x-admin::form.control-group.error>
                                    </x-admin::form.control-group>
                                </div>
                                
                                <!-- Resource -->
                                <x-admin::form.control-group>
                                    <x-admin::form.control-group.label class="required">
                                        @lang('admin::app.sales.shipments.create.source')
                                    </x-admin::form.control-group.label>

                                    <x-admin::form.control-group.control
                                        type="select"
                                        name="shipment[source]" 
                                        id="shipment[source]" 
                                        rules="required"
                                        :label="trans('admin::app.sales.shipments.create.source')"
                                        :placeholder="trans('admin::app.sales.shipments.create.source')"
                                        v-model="source"
                                        @change="onSourceChange"
                                    >
                                        @foreach ($order->channel->inventory_sources as $inventorySource)
                                            <option value="{{ $inventorySource->id }}">
                                                {{ $inventorySource->name }}
                                            </option>
                                        @endforeach
                                    </x-admin::form.control-group.control>

                                    <x-admin::form.control-group.error
                                        control-name="shipment[source]"
                                    >
                                    </x-admin::form.control-group.error>
                                </x-admin::form.control-group>

                                <div class="grid">
                                    <!-- Item Listing -->
                                    @foreach ($order->items as $item)
                                        <div class="flex justify-between gap-[10px] py-[16px]">
                                            <div class="flex gap-[10px]">
                                                @if ($item->product?->base_image_url)
                                                    <img
                                                        class="relative h-[60px] max-h-[60px] w-full max-w-[60px] rounded-[4px]"
                                                        src="{{ $item->product?->base_image_url }}"
                                                    >
                                                @else
                                                    <div class="relative h-[60px] max-h-[60px] w-full max-w-[60px] rounded-[4px] border border-dashed border-gray-300 dark:border-gray-800 dark:mix-blend-exclusion dark:invert">
                                                        <img src="{{ bagisto_asset('images/product-placeholders/front.svg') }}">
                                                        
                                                        <p class="absolute bottom-[5px] w-full text-center text-[6px] font-semibold text-gray-400"> 
                                                            @lang('admin::app.sales.invoices.view.product-image') 
                                                        </p>
                                                    </div>
                                                @endif
                
                                                <div class="grid place-content-start gap-[6px]">
                                                    <!-- Item Name -->
                                                    <p class="font-semibold text-[16x] text-gray-800 dark:text-white">
                                                        {{ $item->name }}
                                                    </p>
                
                                                    <div class="flex flex-col place-items-start gap-[6px]">
                                                        <p class="text-gray-600 dark:text-gray-300">
                                                            @lang('admin::app.sales.shipments.create.amount-per-unit', [
                                                                'amount' => core()->formatBasePrice($item->base_price),
                                                                'qty'    => $item->qty_ordered,
                                                            ])
                                                        </p>
                
                                                        <!--Additional Attributes -->
                                                        @if (isset($item->additional['attributes']))
                                                            <p class="text-gray-600 dark:text-gray-300">
                                                                @foreach ($item->additional['attributes'] as $attribute)
                                                                    {{ $attribute['attribute_name'] }} : {{ $attribute['option_label'] }}
                                                                @endforeach
                                                            </p>
                                                        @endif

                                                        <!-- Item SKU -->
                                                        <p class="text-gray-600 dark:text-gray-300">
                                                            @lang('admin::app.sales.shipments.create.sku', ['sku' => $item->sku])
                                                        </p>

                                                        <!--Item Status -->
                                                        <p class="text-gray-600 dark:text-gray-300">
                                                            {{ $item->qty_ordered ? trans('admin::app.sales.shipments.create.item-ordered', ['qty_ordered' => $item->qty_ordered]) : '' }}

                                                            {{ $item->qty_invoiced ? trans('admin::app.sales.shipments.create.item-invoice', ['qty_invoiced' => $item->qty_invoiced]) : '' }}

                                                            {{ $item->qty_shipped ? trans('admin::app.sales.shipments.create.item-shipped', ['qty_shipped' => $item->qty_shipped]) : '' }}

                                                            {{ $item->qty_refunded ? trans('admin::app.sales.shipments.create.item-refunded', ['qty_refunded' => $item->qty_refunded]) : '' }}

                                                            {{ $item->qty_canceled ? trans('admin::app.sales.shipments.create.item-canceled', ['qty_canceled' => $item->qty_canceled]) : '' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Information -->
                                        @foreach ($order->channel->inventory_sources as $inventorySource)
                                            <div class="mt-[10px] flex justify-between gap-[10px] border-b-[1px] border-slate-300 pb-[10px] dark:border-gray-800">
                                                <div class="grid gap-[10px]">
                                                    <!--Inventory Source -->
                                                    <p class="font-semibold text-[16x] text-gray-800 dark:text-white">
                                                        {{ $inventorySource->name }}
                                                    </p>

                                                    <!-- Available Quantity -->
                                                    <p class="text-gray-600 dark:text-gray-300">
                                                        @lang('admin::app.sales.shipments.create.qty-available') :                  

                                                        @php
                                                            $product = $item->getTypeInstance()->getOrderedItem($item)->product;

                                                            $sourceQty = $product?->type == 'bundle' ? $item->qty_ordered : $product?->inventory_source_qty($inventorySource->id);
                                                        @endphp

                                                        {{ $sourceQty }}
                                                    </p>
                                                </div>

                                                <div class="flex items-center gap-[10px]">
                                                    @php
                                                        $inputName = "shipment[items][$item->id][$inventorySource->id]";
                                                    @endphp

                                                    <!-- Quantity  To Ship -->
                                                    <x-admin::form.control-group.label class="required">
                                                        @lang('admin::app.sales.shipments.create.qty-to-ship')
                                                    </x-admin::form.control-group.label>

                                                    <x-admin::form.control-group class="!mb-0">
                                                        <x-admin::form.control-group.control
                                                            type="text"
                                                            :name="$inputName" 
                                                            :id="$inputName" 
                                                            :value="$item->qty_to_ship"
                                                            :rules="'required|numeric|min_value:0|max_value:' . $item->qty_ordered"
                                                            class="!w-[100px]"
                                                            :label="trans('admin::app.sales.shipments.create.qty-to-ship')"
                                                            data-original-quantity="{{ $item->qty_to_ship }}"
                                                            ::disabled="'{{ empty($sourceQty) }}' || source != '{{ $inventorySource->id }}'"
                                                            :ref="$inputName"
                                                        >
                                                        </x-admin::form.control-group.control>
                            
                                                        <x-admin::form.control-group.error
                                                            :control-name="$inputName"
                                                        >
                                                        </x-admin::form.control-group.error>
                                                    </x-admin::form.control-group>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </x-slot:content>
                </x-admin::drawer>
            </x-admin::form>
        </div>
    </script>

    <script type="module">
    app.component('v-create-shipment', {
        template: '#v-create-shipment-template',

        data() {
            return {
                source: "",
            };
        },

        methods: {
            onSourceChange() {
                this.setOriginalQuantityToAllShipmentInputElements();
            },

            getAllShipmentInputElements() {
                let allRefs = this.$refs;

                let allInputElements = [];

                Object.keys(allRefs).forEach((key) => {
                    if (key.startsWith('shipment')) {
                        allInputElements.push(allRefs[key]);
                    }
                });

                return allInputElements;
            },

            setOriginalQuantityToAllShipmentInputElements() {
                this.getAllShipmentInputElements().forEach((element) => {
                    element.value = element.dataset.originalQuantity;
                });
            }
        },
    });
    </script>
@endPushOnce