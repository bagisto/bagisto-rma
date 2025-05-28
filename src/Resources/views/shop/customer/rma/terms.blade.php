{!! view_render_event('marketplace.seller.account.sign_up.form.agreement.before') !!}

<v-customer-rma-return-policy></v-customer-rma-return-policy>

{!! view_render_event('marketplace.seller.account.sign_up.form.agreement.after') !!}

@pushOnce('scripts')
    <script
        type="text/x-template"
        id="v-customer-rma-return-policy-template"
    >
        <div class="mb-4">
            <label class="relative inline-flex items-center mb-2 cursor-pointer">
                <v-field
                    type="checkbox" 
                    name="agreement" 
                    rules="required" 
                    v-slot="{ field }" 
                    value='1'
                >
                    <input 
                        type="checkbox" 
                        class="sr-only peer" 
                        id="agreement" 
                        rules="required"
                        name="agreement" 
                        value='1'
                        v-bind="field" 
                    />
                </v-field>

                <label 
                    class="text-2xl cursor-pointer icon-uncheck peer-checked:icon-check-box peer-checked:text-navyBlue"
                    for="agreement"
                >
                </label>

                <span class="flex max-md:hidden">
                    <span class="text-zinc-500">
                        @lang('rma::app.admin.configuration.index.sales.rma.setting.terms')
                    </span>
                    
                    <a 
                        href="#" 
                        class="mx-2 text-blue-500 max-md:mt-2"
                        @click="$refs.agreementModel.open()"
                    >
                        <span>
                            @lang('rma::app.admin.configuration.index.sales.rma.setting.read')
                        </span>
                    </a>
                </span>
            </label>

            <x-admin::form.control-group.error control-name="agreement" />
            <span class="hidden mx-2 text-blue-500 text-zinc-500 max-md:block">
                @lang('rma::app.admin.configuration.index.sales.rma.setting.terms')
            </span>
            <a
                href="#" 
                class="hidden mx-2 text-blue-500 max-md:block max-md:mt-2"
                @click="$refs.agreementModel.open()"
            >
                <span>
                    @lang('rma::app.admin.configuration.index.sales.rma.setting.read')
                </span>
            </a>
        </div>

        <!-- Agreement modal -->
        <x-shop::modal ref="agreementModel">
            <!-- Modal Header -->
            <x-slot:header>
                <h2 class="text-base font-medium max-md:text-base">
                    @lang('installer::app.seeders.cms.pages.terms-conditions.title')
                </h2>
            </x-slot>

            <!-- Modal Content -->
            <x-slot:content>
                <div 
                    class="overflow-auto" 
                    style="min-height: 500px; max-height: 500px;"
                >
                    {{ core()->getConfigData('sales.rma.setting.return-policy') }}
                </div>
            </x-slot>
        </x-shop::modal>

    </script>

    <script type="module">
        app.component('v-customer-rma-return-policy', {
            template: '#v-customer-rma-return-policy-template',
        })
    </script>
@endPushOnce