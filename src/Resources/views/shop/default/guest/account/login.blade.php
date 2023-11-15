<x-shop::layouts>

{{-- Title of the page --}}
<x-slot:title>
    @lang('rma::app.shop.guest-users.title')
</x-slot>

    <div class="auth-content">

        <x-shop::form
            :action="route('rma.guest.logincreate')"
            method="POST"
            enctype="multipart/form-data"
        >

        <div class="flex gap-[16px] justify-between items-center max-sm:flex-wrap">
            <h2 class="text-[25px] font-medium">
                @lang('rma::app.shop.guest-users.heading')
            </h2>
        </div>
            <div class="flex gap-[16px] justify-between items-center max-sm:flex-wrap">
                <div class="p-[10px]">
                    <x-shop::form.control-group class="mb-4">
                        <x-shop::form.control-group.label class="required">
                            @lang('rma::app.shop.guest-users.order-id')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="text"
                            name="order_id"
                            value="{{ old('order_id') }}"
                            rules="required|integer"
                            :label="trans('rma::app.shop.guest-users.order-id')"
                            :placeholder="trans('rma::app.shop.guest-users.order-id')"
                        >
                        </x-shop::form.control-group.control>

                        <x-shop::form.control-group.error
                            control-name="order_id"
                        >
                        </x-shop::form.control-group.error>
                    </x-shop::form.control-group>

                    <x-shop::form.control-group class="mb-4">
                        <x-shop::form.control-group.label class="required">
                            @lang('rma::app.shop.guest-users.email')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            rules="required|email"
                            :label="trans('rma::app.shop.guest-users.email')"
                            placeholder="email@example.com"
                        >
                        </x-shop::form.control-group.control>

                        <x-shop::form.control-group.error
                            control-name="email"
                        >
                        </x-shop::form.control-group.error>
                    </x-shop::form.control-group>

            
                    <button
                        type="submit"
                        class="primary-button"
                    >
                        @lang('rma::app.shop.guest-users.button-text')
                    </button>
                </div>
            </div>
        </x-shop::form>
    </div>
</x-shop::layouts>
