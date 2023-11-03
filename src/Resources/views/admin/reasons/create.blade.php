<x-admin::layouts>

    {{-- Title of the page --}}
    <x-slot:title>
        @lang('rma::app.admin.title.create')
    </x-slot>
    
    {{-- Reason Edit Form --}}
    <x-admin::form 
        method="POST"
        :action="route('admin.rma.reason.store')"
        enctype="multipart/form-data"
    >
        @csrf
        <x-admin::form.control-group.control
            type="hidden"
            name="_method"
            value="POST"
        >

        </x-admin::form.control-group.control>

        <div class="flex gap-[16px] justify-between items-center max-sm:flex-wrap">
            <div class="flex gap-x-[10px] items-center">
                <h1 class="text-[20px] text-gray-800 dark:text-white font-bold">

                <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/rma/reasons') }}';"></i>
                @lang('rma::app.admin.create-reasons.heading')
                </h1>
            </div>

            <div class="flex gap-x-[10px] items-center">
               
               <!-- Update Button -->
               <button type="submit" class="primary-button">
                   @lang('rma::app.admin.create-reasons.save-btn')
               </button>
           </div>
       </div>
           @csrf()

           <div class="flex gap-[16px] max-sm:flex-wrap">
            <x-admin::form.control-group class="w-full mb-[10px]">
                <x-admin::form.control-group.label class="required">
                    @lang('rma::app.admin.create-reasons.reason')
                </x-admin::form.control-group.label>

                <x-admin::form.control-group.control
                    type="text"
                    name="title"
                    :value="old('title')"
                    rules="required"
                    :label="trans('rma::app.admin.create-reasons.reason')"
                    :placeholder="trans('rma::app.admin.create-reasons.reason')"
                >
                </x-admin::form.control-group.control>

                <x-admin::form.control-group.error
                    control-name="title"
                >
                </x-admin::form.control-group.error>
            </x-admin::form.control-group>
        </div>
            
        <div class="flex gap-[16px] max-sm:flex-wrap">
            <x-admin::form.control-group class="w-full mb-[10px]">
                <x-admin::form.control-group.label>
                    @lang('rma::app.admin.create-reasons.status')
                </x-admin::form.control-group.label>
                <x-admin::form.control-group.control
                    type="select"
                    name="status"
                    id="status"
                    rules="required"
                >
                 <!-- Default Option -->
                 <option value="">
                    @lang('rma::app.admin.create-reasons.status')
                </option>
                <option value="1">Enabled</option>
                <option value="0">Disabled</option>
                
            </x-admin::form.control-group.control>
            </x-admin::form.control-group>
        </div>
    </x-admin::form>
</x-admin::layouts>

@pushOnce('scripts')
    <script>
        $(document).ready(function () {
            $('.label .cross-icon').on('click', function(e) {
                $(e.target).parent().remove();
            })

            $('.actions .trash-icon').on('click', function(e) {
                $(e.target).parents('tr').remove();
            })
        });
    </script>
@endpushOnce