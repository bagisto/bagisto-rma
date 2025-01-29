@if (core()->getConfigData('sales.rma.setting.enable_rma'))
    @guest('customer')
        @if (empty(session()->get('guestEmail')))
            <div>
                <a href="{{ route('rma.guest.login') }}" class="flex">
                    <span class="rma-icon-guest-login inline-block cursor-pointer text-2xl"></span>
                    <span>
                        @lang('rma::app.shop.customer.title')
                    </span>
                </a>
            </div>
        @else
            <div>
                <a href="{{ route('rma.guest.logout') }}" class="flex">
                    <span class="rma-icon-guest-login inline-block cursor-pointer text-2xl"></span>
                    <span class="text-[8px]">
                        @lang('rma::app.shop.guest-users.logout')
                    </span>
                </a>
            </div>
        @endif
    @endguest
@endif