@extends('admin::layouts.content')

@section('page_title')
{{ __('rma::app.admin.title.edit') }}
@stop

@section('content')
<div class="content">
    <form method="POST" action="{{ route('admin.rma.reason.update') }}" @submit.prevent="onSubmit">
        <input type="hidden" name="id" value="{{ $data['id'] }}">
        <div class="page-header">
            <div class="page-title">
                <h1>
                    <i class="icon angle-left-icon back-link"
                        onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/rma/reasons') }}';">
                    </i>
                    {{ __('rma::app.admin.create-reasons.edit-heading') }}
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

                    {!! view_render_event('bagisto.admin.catalog.product.create_form_accordian.general.controls.before')
                    !!}

                    <div class="control-group" :class="[errors.has('reasons') ? 'has-error' : '']">
                        <label for="title"
                            class="required">{{ __('rma::app.admin.create-reasons.reason') }}</label>
                        <input type="text" v-validate="'required'" class="control" id="title" name="title"
                            value="{{ $data['title'] }}"
                            data-vv-as="&quot;{{ __('rma::app.admin.create-reasons.reason') }}&quot;" />
                        <span class="control-error" v-if="errors.has('title')">@{{ errors.first('title') }}</span>
                    </div>


                    <div class="control-group" :class="[errors.has('status') ? 'has-error' : '']">
                        <label for="status"
                            class="required">{{ __('rma::app.admin.create-reasons.status') }}</label>

                        <select class="control" v-validate="'required'" id="status" name="status"
                            data-vv-as="&quot;{{ __('rma::app.admin.create-reasons.status') }}&quot;">
                            @php($status = ['0','1'])
                            @foreach($status as $status_val)
                            @if($status_val == 0)
                            @php($options = 'Disabled')
                            @else
                            @php($options = 'Enabled')
                            @endif
                            <option value="{{ $status_val }}" @if($status_val==$data['status']) selected @endif>
                                {{ $options }}
                            </option>
                            @endforeach
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