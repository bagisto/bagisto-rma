@extends('shop::layouts.master')

@section('page_title')
{{ __('rma::app.shop.guest-users.title') }}
@endsection

@section('content-wrapper')

<div class="auth-content">

    <form method="POST" action="{{ route('rma.guest.logincreate') }}" @submit.prevent="onSubmit">
        @csrf()
        <div class="login-form">
            <div class="login-text">{{ __('rma::app.shop.guest-users.heading') }}</div>

            <div class="control-group" :class="[errors.has('order_id') ? 'has-error' : '']">
                <label for="order_id" class="required">{{ __('rma::app.shop.guest-users.order-id') }}</label>
                <input type="text" class="control" name="order_id" v-validate="'required|integer'"
                    value="{{ old('order_id') }}"
                    data-vv-as="&quot;{{ __('rma::app.shop.guest-users.order-id') }}&quot;">
                <span class="control-error" v-if="errors.has('order_id')">@{{ errors.first('order_id') }}</span>
            </div>

            <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                <label for="email" class="required">{{ __('rma::app.shop.guest-users.email') }}</label>
                <input type="text" class="control" name="email" v-validate="'required'" value="{{ old('email') }}"
                    data-vv-as="&quot;{{ __('rma::app.shop.guest-users.email') }}&quot;">
                <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
            </div>

            <input class="btn btn-primary btn-lg" type="submit"
                value="{{ __('rma::app.shop.guest-users.button-text') }}">
        </div>
    </form>
</div>

@endsection
