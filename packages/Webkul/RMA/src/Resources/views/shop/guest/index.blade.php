<x-shop::layouts
:has-feature="false"
>
    <!-- Title of the page -->
    <x-slot:title>
        @lang('rma::app.shop.customer.title')
    </x-slot:title>
    </br>

    <div class="flex flex-wrap">
        <div class="container mt-[50px] px-[60px] max-lg:px-[30px]">
            <div class="flex items-center justify-between">
                <!-- Heading -->
                <h2 class="text-[26px] font-medium">
                    @lang('rma::app.shop.guest.index.guest')
                </h2>

                <!-- button -->
                <a 
                    href="{{ route('shop.guest.create_rma') }}"
                    class="secondary-button border-[#E9E9E9] px-[20px] py-[12px] font-normal"
                >
                    @lang('rma::app.shop.guest.index.create')
                </a>
            </div>

            {!! view_render_event('customer.account.rma.list.before') !!}

            <x-shop::datagrid src="{{ route('shop.guest.allrma') }}"></x-shop::datagrid>

            {!! view_render_event('customer.account.rma.list.after') !!}
        </div> 
    </div> 
</x-shop::layouts>