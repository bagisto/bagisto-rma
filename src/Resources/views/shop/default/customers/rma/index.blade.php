<x-shop::layouts
:has-feature="false"
>

{{-- Title of the page --}}
    <x-slot:title>
        @lang('rma::app.shop.customer.title')
    </x-slot>
    <div class="flex flex-wrap">
        <div class="w-full flex justify-between px-[60px] border border-t-0 border-b-[1px] border-l-0 border-r-0 py-[17px] max-lg:px-[30px] max-sm:px-[15px]">
            <div class="container px-[60px] max-lg:px-[30px]">
                <div class="account-layout" @if(!auth()->guard('customer')->user())  style="width: 100%;" @endif>
        
                    <div class="flex justify-between items-center">
                        <h2 class="text-[26px] font-medium">
                            @lang('rma::app.shop.customer-rma-index.heading')
                        </h2>
                        <div class="account-action">
                            <a
                                @if(! auth()->guard('customer')->user())
                                    href="{{ route('rma.customers.guestcreaterma') }}"
                                @else
                                    href="{{ route('rma.customers.create') }}"
                                @endif
                                class="secondary-button py-[12px] px-[20px] border-[#E9E9E9] font-normal"
                                >
                                @lang('rma::app.shop.customer-rma-index.create')
                            </a>
                        </div>
                    </div>

                    {!! view_render_event('customer.account.rma.list.before') !!}

                    <x-shop::datagrid src="{{ route('rma.customers.allrma') }}"></x-shop::datagrid>

                    {!! view_render_event('customer.account.rma.list.after') !!}

                </div>
            </div> 
        </div> 
    </div> 
</x-shop::layouts>