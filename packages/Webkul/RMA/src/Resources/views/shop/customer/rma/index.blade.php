<x-shop::layouts.account>

    <!-- Page Title -->
    <x-slot:title>
        @lang('rma::app.shop.customer.title')
    </x-slot:title>

    <!-- Breadcrumbs -->
    @section('breadcrumbs')
        <x-shop::breadcrumbs name="rma"></x-shop::breadcrumbs>
    @endSection

    <div class="flex items-center justify-between">
        <div class="">
            <h2 class="text-[26px] font-medium">
                @lang('rma::app.shop.customer-rma-index.heading')
            </h2>
        </div>

        <a 
            href="{{ route('rma.customers.customer_create_rma') }}" 
            class="secondary-button flex items-center gap-x-[10px] border-[#E9E9E9] px-[20px] py-[12px] font-normal"
        >
            @lang('rma::app.shop.customer-rma-index.create')
        </a>
    </div>

    <!-- Datagrid -->
    <x-shop::datagrid :src="route('rma.customers.allrma')"></x-shop::datagrid>

</x-shop::layouts.account>