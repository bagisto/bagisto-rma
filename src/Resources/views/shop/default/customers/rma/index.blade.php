<x-shop::layouts.account>

{{-- Title of the page --}}
    <x-slot:title>
        @lang('rma::app.shop.customer.title')
    </x-slot>

    {{-- Heading of the page --}}
    <div class="account-layout" @if(!auth()->guard('customer')->user())@endif>      
        <div class="flex justify-between items-center">
            <h2 class="text-[26px] font-medium">
                @lang('rma::app.shop.customer-rma-index.heading')
            </h2>
            <div class="account-action">
                <a
                    @if(auth()->guard('customer')->user())
                
                        href="{{ route('rma.customers.create') }}"
                    @endif
                    
                    class="secondary-button py-[12px] px-[20px] border-[#E9E9E9] font-normal"
                    >
                    @lang('rma::app.shop.customer-rma-index.create')
                </a>
            </div>
        </div>

        {!! view_render_event('customer.account.rma.list.before') !!}

        <div class="account-items-list">

        <x-shop::datagrid src="{{ route('rma.customers.allrma') }}"></x-shop::datagrid>
        
        </div>

        {!! view_render_event('customer.account.rma.list.after') !!}

    </div>
</x-shop::layouts.account>