<x-admin::layouts>
    <!-- Title of the page -->
    <x-slot:title>
        @lang('rma::app.admin.sales.rma.reasons.create.create-title')
    </x-slot:title>
    
    <!-- Reason create Form -->
    <x-admin::form 
        :action="route('admin.sales.rma.reason.store')" 
        enctype="multipart/form-data"
    >
        @csrf
        <x-admin::form.control-group.control
            type="hidden"
        >
        </x-admin::form.control-group.control>

        <div class="flex items-center justify-between gap-[16px] max-sm:flex-wrap">
            <div class="flex items-center gap-x-[10px]">
                <h1 class="text-[20px] font-bold text-gray-800 dark:text-white">
                    <i 
                        class="icon angle-left-icon back-link" 
                        onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/rma/reasons') }}';">
                    </i>
                    @lang('rma::app.admin.sales.rma.reasons.create.create-title')
                </h1>
            </div>

            <div class="flex items-center gap-x-[10px]">
               <!-- Save Button -->
                <button 
                    type="submit" 
                    class="primary-button"
                >
                   @lang('rma::app.admin.sales.rma.reasons.create.save-btn')
               </button>
           </div>
       </div>
       
        @csrf()
        <!-- Create Reason -->
        <div class="flex gap-[16px] max-sm:flex-wrap">
            <x-admin::form.control-group class="mb-[10px] w-full">
                <x-admin::form.control-group.label class="required">
                    @lang('rma::app.admin.sales.rma.reasons.create.reason')
                </x-admin::form.control-group.label>

                <x-admin::form.control-group.control
                    type="text"
                    name="title"
                    :value="old('title')"
                    rules="required"
                    :label="trans('rma::app.admin.sales.rma.reasons.create.reason')"
                    :placeholder="trans('rma::app.admin.sales.rma.reasons.create.reason')"
                >
                </x-admin::form.control-group.control>

                <x-admin::form.control-group.error
                    control-name="title"
                >
                </x-admin::form.control-group.error>
            </x-admin::form.control-group>
        </div>
            
        <!-- status -->
        <div class="flex gap-[16px] max-sm:flex-wrap">
            <x-admin::form.control-group class="mb-[10px] w-full">
                <x-admin::form.control-group.label>
                    @lang('rma::app.admin.sales.rma.reasons.create.status')
                </x-admin::form.control-group.label>

                <x-admin::form.control-group.control
                    type="switch"
                    name="status"
                    class="cursor-pointer"
                    value="1"
                >
                </x-admin::form.control-group.control>
            </x-admin::form.control-group>
        </div>
    </x-admin::form>
</x-admin::layouts>