@guest('customer')
    @if (empty(session()->get('guestEmail')))
        <!-- Account Profile Hero Section -->
        <div class="grid grid-cols-[auto_1fr] gap-4 items-center mb-4 p-2.5 border border-[#E9E9E9] rounded-xl">
            <div class="">
                <img
                    src="{{ auth()->user()?->image_url ??  bagisto_asset('images/user-placeholder.png') }}"
                    class="w-[60px] h-[60px] rounded-full"
                >
            </div>

            <a
                href="{{ route('rma.guest.login') }}"
                class="flex text-base font-medium"
            >
                @lang('rma::app.shop.customer.title')

                <i class="icon-double-arrow text-2xl ltr:ml-2.5 rtl:mr-2.5"></i>
            </a>
        </div>
    @else
        <!-- Account Profile Hero Section -->
        <div class="grid grid-cols-[auto_1fr] gap-4 items-center mb-4 p-2.5 border border-[#E9E9E9] rounded-xl">
            <div class="">
                <img
                    src="{{ auth()->user()?->image_url ??  bagisto_asset('images/user-placeholder.png') }}"
                    class="w-[60px] h-[60px] rounded-full"
                >
            </div>

            <a
                href="{{ route('rma.guest.logout') }}"
                class="flex text-base font-medium"
            >
                @lang('rma::app.shop.guest-users.logout')

                <i class="icon-double-arrow text-2xl ltr:ml-2.5 rtl:mr-2.5"></i>
            </a>
        </div>
    @endif
@endguest
