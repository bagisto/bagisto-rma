<x-admin::layouts>

{{-- Title of the page --}}
<x-slot:title>
    @lang('rma::app.admin.title.create')
</x-slot>

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.rma.reason.store') }}" @submit.prevent="onSubmit">

                <div class="flex gap-4 justify-between items-center flex-wrap">
                    <div class="text-2xl text-gray-800 dark:text-white font-bold">
                        <h1>
                            <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/rma/reasons') }}';"></i>
                            @lang('rma::app.admin.create-reasons.heading')
                        </h1>
                    </div>
                    <!-- Save Button -->
                    <button
                        type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        >
                            @lang('rma::app.admin.create-reasons.save-btn')
                    </button>    
                </div>
            </div>
    
            <x-slot:content>
                @csrf()

                <accordian 
                        :title="'@lang('admin::app.catalog.products.general')'" 
                        :active="true"
                    >
                    <div slot="body">
                        <div class="control-group">
                            <label for="title"
                                class="required">@lang('rma::app.admin.create-reasons.reason')</label>
                            <input type="text" v-validate="'required'" class="control" id="reasons" name="title"
                                value="{{ old('title') }}"
                                data-vv-as="&quot;{{ __('rma::app.admin.create-reasons.reason') }}&quot;" />
                            <span class="control-error" v-if="errors.has('title')">@{{ errors.first('title') }}</span>
                        </div>


                        <div class="control-group" :class="[errors.has('status') ? 'has-error' : '']">
                            <label for="status"
                                class="required">@lang('rma::app.admin.create-reasons.status')</label>

                            <select class="control" v-validate="'required'" id="status" name="status"
                                data-vv-as="&quot;@lang('rma::app.admin.create-reasons.status')&quot;">

                                <option value="">Please Select Value</option>
                                <option value="1">Enabled</option>
                                <option value="0">Disabled</option>

                            </select>

                            <span class="control-error" v-if="errors.has('status')">@{{ errors.first('status') }}</span>
                        </div>

                    </div>
                </accordian>
            </div>
        </form>
    </div>
    </x-slot:content>
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
@endPushOnce