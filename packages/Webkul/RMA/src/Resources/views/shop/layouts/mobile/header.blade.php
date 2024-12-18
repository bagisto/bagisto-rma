@if (core()->getConfigData('sales.rma.setting.enable_rma'))
    @guest('customer')
        @if (empty(session()->get('guestEmail')))
            <div class="max-h-[30px]">
                <a  href="{{ route('rma.guest.login') }}">
                    <div class="relative flex items-center flex-nowrap">
                        <span class="icon-compare inline-block cursor-pointer text-[24px]"></span>
                        <span class="text-[6px] relative block mb-[24px] mr-2">
                            @lang('rma::app.shop.customer.title')
                        </span>
                    </div>
                </a>
            </div>
        @endif
    @endguest
@endif