@extends('shop::layouts.master')

@section('page_title')
    {{ __('rma::app.shop.customer.title') }}
@endsection

@section('content-wrapper')
    <div class="account-content">
        @if (auth()->guard('customer')->user())
            @include('shop::customers.account.partials.sidemenu')
        @endif

        <div class="account-layout" @if(!auth()->guard('customer')->user())  style="width: 100%;" @endif>

            <div class="account-head mb-20">
                <span class="account-heading">
                    {{ __('rma::app.shop.customer-rma-index.heading') }}
                </span>

                <div class="account-action">
                    <a
                        @if(!auth()->guard('customer')->user())
                            href="{{ route('rma.customers.guestcreaterma') }}"
                        @else
                            href="{{ route('rma.customers.create') }}"
                        @endif
                        class="btn btn-primary btn-md">
                        {{ __('rma::app.shop.customer-rma-index.create') }}
                    </a>
                </div>

                <div class="horizontal-rule" style="margin-top:25px;"></div>
            </div>

            {!! view_render_event('customer.account.rma.list.before') !!}

            <div class="account-items-list">

                {!! app('Webkul\RMA\DataGrids\RMAList')->render() !!}

            </div>

            {!! view_render_event('customer.account.rma.list.after') !!}

        </div>
    </div>

@endsection
