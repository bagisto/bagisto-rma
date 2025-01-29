@if (core()->getConfigData('sales.rma.setting.enable_rma'))
    @if ($product->type != 'booking')

        @if (empty($product->parent_id))
            @php
                $rmaRule = app('Webkul\RMA\Repositories\RMARulesRepository')->where('status', 1)->get();
            @endphp

            {!! view_render_event('bagisto.admin.catalog.product.edit.form.allow-rma.before', ['product' => $product]) !!}

            <v-allow-rma-product></v-allow-rma-product>

            {!! view_render_event('bagisto.admin.catalog.product.edit.form.allow-rma.after', ['product' => $product]) !!}

            @pushOnce('scripts')
            <script type="text/x-template" id="v-allow-rma-product-template">
                <div class="relative p-4 bg-white dark:bg-gray-900 rounded box-shadow">
                    <div class="text-base text-gray-800 dark:text-white font-semibold mb-4">
                        @lang('rma::app.admin.configuration.index.sales.rma.title')
                    </div>

                    @if (core()->getConfigData('sales.rma.setting.allowed-rma-for-product') == 'specific')
                        <div class="mb-4 last:!mb-0">
                            <x-admin::form.control-group.label class="required">
                                @lang('rma::app.admin.sales.rma.all-rma.index.datagrid.rma-status')
                            </x-admin::form.control-group.label>
                            <v-field
                                as="select"
                                name="allow_rma"
                                class="custom-select flex min-h-10 w-full rounded-lg border bg-white px-3 py-2 text-sm font-normal text-gray-600 transition-all hover:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300"
                                label="{{ trans('rma::app.admin.sales.rma.all-rma.index.datagrid.rma-status') }}"
                                v-model="allowRma"
                                rules="required"
                            >
                                <option value="">
                                    @lang('admin::app.catalog.products.edit.types.bundle.update-create.select')
                                </option>
                            
                                <!-- Options -->
                                <option value="yes">
                                    @lang('rma::app.admin.configuration.index.sales.rma.yes')
                                </option>

                                <option value="no">
                                    @lang('rma::app.admin.configuration.index.sales.rma.no')
                                </option>
                            </v-field>

                            <v-error-message
                                name="allow_rma"
                                v-slot="{ message }"
                            >
                                <p
                                    class="mt-1 text-xs italic text-red-600"
                                    v-text="message"
                                >
                                </p>
                            </v-error-message>
                        </div>
                    @endif

                    @if (! empty($rmaRule))
                        <div class="mb-4 last:!mb-0">
                            <x-admin::form.control-group.label class="required">
                                @lang('rma::app.admin.sales.rma.rules.index.title')
                            </x-admin::form.control-group.label>

                            <v-field
                                as="select"
                                name="rma_rules"
                                class="custom-select flex min-h-10 w-full rounded-lg border bg-white px-3 py-2 text-sm font-normal text-gray-600 transition-all hover:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300"
                                label="{{ trans('rma::app.admin.sales.rma.all-rma.index.datagrid.rma-status') }}"
                                v-model="rmaRules"
                            >
                                <option value="">
                                    @lang('admin::app.catalog.products.edit.types.bundle.update-create.select')
                                </option>
                                
                                @foreach ($rmaRule as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->title }}
                                    </option>
                                @endforeach
                            </v-field>

                            <v-error-message
                                name="rma_rules"
                                v-slot="{ message }"
                            >
                                <p
                                    class="mt-1 text-xs italic text-red-600"
                                    v-text="message"
                                >
                                </p>
                            </v-error-message>
                        </div>
                    @endif
                </div>
            </script>

            <script type="module">
                app.component('v-allow-rma-product', {
                    template: '#v-allow-rma-product-template',

                    data() {
                        return {
                            allowRma: "{{ $product->allow_rma ?? old('allow_rma') }}",

                            rmaRules: "{{ $product->rma_rules ?? old('rma_rules') }}",
                        };
                    },
                })
            </script>
            @endPushOnce
        @endif
    @endif
@endif