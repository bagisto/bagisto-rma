<x-shop::layouts.account>

{{-- Title of the page --}}
<x-slot:title>
    @lang('rma::app.shop.customer.title')
</x-slot>

@section('content-wrapper')
    <div class="account-content">
        @if (auth()->guard('customer')->user())
            <!-- @include('shop::customers.account.partials.sidemenu') -->
        @endif

        <div class="account-layout" @if(!auth()->guard('customer')->user())@endif>
            
            <div class="flex justify-between items-center">
                <h2 class="text-[26px] font-medium">
                    @lang('rma::app.shop.customer-rma-index.heading')
                </h2>
                <div class="account-action">
                    <a
                        @if(!auth()->guard('customer')->user())
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

            {!! view_render_event('bagisto.rma.customers.allrma.list.before') !!}

            <x-shop::datagrid src="{{ route('rma.customers.allrma') }}"></x-shop::datagrid>

            {!! view_render_event('bagisto.rma.customers.allrma.list.after') !!}

        </div>
    </div>

</x-shop::layouts.account>