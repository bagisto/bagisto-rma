<div class="flex w-full items-center justify-between border border-b-[1px] border-l-0 border-r-0 border-t-0 px-16 py-[11px]">
    
    <!-- Currency Switcher -->
    <x-shop::dropdown>
        <!-- Dropdown Toggler -->
        <x-slot:toggle>
            <div class="flex cursor-pointer gap-[10px]">
                <span>
                    {{ core()->getCurrentCurrency()->symbol . ' ' . core()->getCurrentCurrencyCode() }}
                </span>

                <span class="icon-arrow-down text-[24px]"></span>
            </div>
        </x-slot:toggle>

        <!-- Dropdown Content -->
        <x-slot:content class="!p-[0px]">
            <v-currency-switcher></v-currency-switcher>
        </x-slot:content>
    </x-shop::dropdown>

    <p class="text-xs font-medium">
        @lang('rma::app.shop.customer.offer')
        <a href="#" class="underline">
            @lang('rma::app.shop.customer.shop-now')
        </a>
    </p>

    <div class="flex items-center px-16 py-[11px]">
    @if(core()->getConfigData('sales.rma.setting.enable_rma'))
        @guest('customer')
            <div class="flex gap-[10px]">
                <span class="icon-compare inline-block cursor-pointer text-[24px]"></span>
                
                <span>
                    <a  href="{{ route('rma.guest.login') }}">
                        @lang('rma::app.shop.customer.header-title')
                    </a>
                </span>
            </div>
        @endguest
    @endif

    {{-- Locales Switcher --}}
    <x-shop::dropdown position="bottom-right">
        <x-slot:toggle>
            {{-- Dropdown Toggler --}}
            <div class="flex cursor-pointer items-center gap-[10px]">
                <img 
                    src="{{ 
                        ! empty(core()->getCurrentLocale()->logo_url) 
                        ? core()->getCurrentLocale()->logo_url 
                        : bagisto_asset('images/default-language.svg') 
                    }}"
                    class="h-full"
                    alt="Default locale"
                    width="24"
                    height="16"
                />
                
                <span>
                    {{ core()->getCurrentChannel()->locales()->orderBy('name')->where('code', app()->getLocale())->value('name') }}
                </span>

                <span class="icon-arrow-down text-[24px]"></span>
            </div>
        </x-slot:toggle>

        <!-- Dropdown Content -->
        <x-slot:content class="!p-[0px]">
            <v-locale-switcher></v-locale-switcher>
        </x-slot:content>
    </x-shop::dropdown>
    </div>
</div>

@pushOnce('scripts')
    <script type="text/x-template" id="v-currency-switcher-template">
        <div class="mt-[10px] grid gap-[4px] pb-[10px]">
            <span
                class="cursor-pointer px-5 py-2 text-[16px] hover:bg-gray-100"
                v-for="currency in currencies"
                :class="{'bg-gray-100': currency.code == '{{ core()->getCurrentCurrencyCode() }}'}"
                @click="change(currency)"
            >
                @{{ currency.symbol + ' ' + currency.code }}
            </span>
        </div>
    </script>

    <script type="text/x-template" id="v-locale-switcher-template">
        <div class="mt-[10px] grid gap-[4px] pb-[10px]">
            <span
                class="flex cursor-pointer items-center gap-[10px] px-5 py-2 text-[16px] hover:bg-gray-100"
                v-for="locale in locales"
                :class="{'bg-gray-100': locale.code == '{{ app()->getLocale() }}'}"
                @click="change(locale)"                  
            >
                <img
                    :src="locale.logo_url 
                    || '{{ bagisto_asset('images/default-language.svg') }}'"
                    width="24"
                    height="16"
                />

                @{{ locale.name }}
            </span>
        </div>
    </script>

    <script type="module">
        app.component('v-currency-switcher', {
            template: '#v-currency-switcher-template',

            data() {
                return {
                    currencies: @json(core()->getCurrentChannel()->currencies),
                };
            },

            methods: {
                change(currency) {
                    let url = new URL(window.location.href);

                    url.searchParams.set('currency', currency.code);

                    window.location.href = url.href;
                }
            }
        });

        app.component('v-locale-switcher', {
            template: '#v-locale-switcher-template',

            data() {
                return {
                    locales: @json(core()->getCurrentChannel()->locales()->orderBy('name')->get()),
                };
            },

            methods: {
                change(locale) {
                    let url = new URL(window.location.href);

                    url.searchParams.set('locale', locale.code);

                    window.location.href = url.href;
                }
            }
        });
    </script>
@endPushOnce