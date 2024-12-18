<!-- SEO Meta Content -->
@push('meta')
    <meta name="description" content="@lang('rma::app.shop.guest-users.title')"/>

    <meta name="keywords" content="@lang('rma::app.shop.guest-users.title')"/>
@endPush

<x-shop::layouts
    :has-header="false"
    :has-feature="false"
    :has-footer="false"
>
    <!-- Page Title -->
    <x-slot:title>
        @lang('rma::app.shop.guest-users.title')
    </x-slot>

    <div class="container mt-20 max-1180:px-5">
        {!! view_render_event('bagisto.shop.layout.rma.guest.login.logo.before') !!}

        <!-- Company Logo -->
        <div class="flex gap-x-14 items-center max-[1180px]:gap-x-9">
            <a
                href="{{ route('shop.home.index') }}"
                class="m-[0_auto_20px_auto]"
                aria-label="@lang('shop::app.customers.login-form.bagisto')"
            >
                <img
                    src="{{ core()->getCurrentChannel()->logo_url ?? bagisto_asset('images/logo.svg') }}"
                    alt="{{ config('app.name') }}"
                    width="131"
                    height="29"
                >
            </a>
        </div>

        {!! view_render_event('bagisto.shop.layout.rma.guest.login.logo.after') !!}

        <!-- Form Container -->
        <div
            class="w-full max-w-[870px] m-auto px-[90px] p-16 border border-[#E9E9E9] rounded-xl max-md:px-8 max-md:py-8"
        >
            <h1 class="text-4xl font-dmserif max-sm:text-2xl">
                @lang('rma::app.shop.guest-users.heading')
            </h1>

            <p class="mt-4 text-[#6E6E6E] text-xl max-sm:text-base">
                @lang('shop::app.customers.login-form.form-login-text')
            </p>

            {!! view_render_event('bagisto.shop.layout.rma.guest.login.before') !!}

            <div class="mt-14 rounded max-sm:mt-8">
                <x-shop::form :action="route('rma.guest.login-create')" method="POST">

                    {!! view_render_event('bagisto.shop.customers.login_form_controls.before') !!}

                    <!-- Email -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('rma::app.shop.guest-users.order-id')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="text"
                            class="!p-[20px_25px] rounded-lg"
                            name="order_id"
                            rules="required|integer"
                            value="{{ old('order_id') }}"
                            :label="trans('rma::app.shop.guest-users.order-id')"
                            :placeholder="trans('rma::app.shop.guest-users.order-id')"
                        />

                        <x-shop::form.control-group.error control-name="order_id" />
                    </x-shop::form.control-group>

                    <!-- Password -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('rma::app.shop.guest-users.email')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="email"
                            class="!p-[20px_25px] rounded-lg"
                            id="email"
                            name="email"
                            rules="required|email"
                            value=""
                            :label="trans('rma::app.shop.guest-users.email')"
                            :placeholder="trans('rma::app.shop.guest-users.email')"
                        />

                        <x-shop::form.control-group.error control-name="email" />
                    </x-shop::form.control-group>

                    <!-- Submit Button -->
                    <div class="flex gap-9 flex-wrap mt-8 items-center">
                        <button
                            class="primary-button block w-full max-w-[374px] py-4 px-11 m-0 ltr:ml-0 rtl:mr-0 mx-auto rounded-2xl text-base text-center"
                            type="submit"
                        >
                            @lang('rma::app.shop.guest-users.button-text')
                        </button>

                        {!! view_render_event('bagisto.shop.layout.rma.guest.login_form_controls.after') !!}
                    </div>
                </x-shop::form>
            </div>

            {!! view_render_event('bagisto.shop.layout.rma.guest.login.after') !!}

            <p class="mt-5 text-[#6E6E6E] font-medium">
                @lang('shop::app.customers.login-form.new-customer')

                <a
                    class="text-navyBlue"
                    href="{{ route('shop.customers.register.index') }}"
                >
                    @lang('shop::app.customers.login-form.create-your-account')
                </a>
            </p>
        </div>

        <p class="mt-8 mb-4 text-center text-[#6E6E6E] text-xs">
            @lang('shop::app.customers.login-form.footer', ['current_year'=> date('Y') ])
        </p>
    </div>
</x-shop::layouts>