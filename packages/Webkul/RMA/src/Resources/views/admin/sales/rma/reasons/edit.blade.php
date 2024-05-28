<x-admin::layouts>
    <!-- Title of the page -->
    <x-slot:title>
        @lang('rma::app.admin.sales.rma.reasons.edit.edit-title')
    </x-slot:title>

    <!-- Reason Edit Form -->
    <x-admin::form 
        :action="route('admin.sales.rma.reason.update', $reasonData->id)"
        enctype="multipart/form-data"
    >
        <div class="flex items-center justify-between gap-[16px] max-sm:flex-wrap">
            <div class="flex items-center gap-x-[10px]">
                <h1 class="text-[20px] font-bold text-gray-800 dark:text-white">
                    <i 
                        class="icon angle-left-icon back-link" 
                        onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/rma/reasons') }}';">
                    </i>
                    @lang('rma::app.admin.sales.rma.reasons.edit.edit-title')
                </h1>
            </div>

            <div class="flex items-center gap-x-[10px]">
                <!-- Update Button -->
                <button 
                    type="submit" 
                    class="primary-button"
                >
                    @lang('rma::app.admin.sales.rma.reasons.edit.save-btn')
                </button>
            </div>
        </div>
        @csrf()

        <x-admin::form.control-group class="mb-[10px] w-full">
            <x-admin::form.control-group.control
                type="hidden"
                name="id"
                :value="old('id') ?: $reasonData->id"
            >
            </x-admin::form.control-group.control>
        </x-admin::form.control-group> 

        <!-- Edit Reason -->
        <div class="flex gap-[16px] max-sm:flex-wrap">
            <x-admin::form.control-group class="mb-[10px] w-full">
                <x-admin::form.control-group.label class="required">
                    @lang('rma::app.admin.sales.rma.reasons.edit.reason')
                </x-admin::form.control-group.label>

                <x-admin::form.control-group.control
                    type="text"
                    name="title"
                    :value="old('title') ?: $reasonData->title"
                    rules="required"
                    :label="trans('rma::app.admin.sales.rma.reasons.edit.reason')"
                    :placeholder="trans('rma::app.admin.sales.rma.reasons.edit.reason')"
                >
                </x-admin::form.control-group.control>

                <x-admin::form.control-group.error
                    control-name="title"
                >
                </x-admin::form.control-group.error>
            </x-admin::form.control-group>
        </div>

        <!-- Edit status -->
        <div class="flex gap-[16px] max-sm:flex-wrap">
            <x-admin::form.control-group class="mb-[10px] w-full">
                <x-admin::form.control-group.label>
                    @lang('rma::app.admin.sales.rma.reasons.edit.status')
                </x-admin::form.control-group.label>

                @php 
                    $selectedValue = old('status') ?: $reasonData->status 
                @endphp

                <x-admin::form.control-group.control
                    type="hidden"
                    class="cursor-pointer"
                    name="status"
                    :checked="(boolean) $selectedValue"
                />

                <x-admin::form.control-group.control
                    type="switch"
                    class="cursor-pointer"
                    name="status"
                    value="1"
                    :checked="(boolean) $selectedValue"
                />
            </x-admin::form.control-group>
        </div>
    </x-admin::form>
</x-admin::layouts>