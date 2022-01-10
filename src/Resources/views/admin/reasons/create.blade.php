@extends('admin::layouts.content')

@section('page_title')
{{ __('rma::app.admin.title.create') }}
@stop

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.rma.reason.store') }}" @submit.prevent="onSubmit">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link"
                            onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/rma/reasons') }}';"></i>
                        {{ __('rma::app.admin.create-reasons.heading') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('rma::app.admin.create-reasons.save-btn') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                @csrf()

                <accordian :title="'{{ __('admin::app.catalog.products.general') }}'" :active="true">
                    <div slot="body">
                        <div class="control-group" :class="[errors.has('title') ? 'has-error' : '']">
                            <label for="title"
                                class="required">{{ __('rma::app.admin.create-reasons.reason') }}</label>
                            <input type="text" v-validate="'required'" class="control" id="reasons" name="title"
                                value="{{ old('title') }}"
                                data-vv-as="&quot;{{ __('rma::app.admin.create-reasons.reason') }}&quot;" />
                            <span class="control-error" v-if="errors.has('title')">@{{ errors.first('title') }}</span>
                        </div>


                        <div class="control-group" :class="[errors.has('status') ? 'has-error' : '']">
                            <label for="status"
                                class="required">{{ __('rma::app.admin.create-reasons.status') }}</label>

                            <select class="control" v-validate="'required'" id="status" name="status"
                                data-vv-as="&quot;{{ __('rma::app.admin.create-reasons.status') }}&quot;">

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
@stop

@push('scripts')
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
@endpush
