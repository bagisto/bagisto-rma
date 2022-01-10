@extends('rma::admin.layouts.content')

@section('page_title')
{{ __('rma::app.admin.title.index') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('rma::app.admin.rma-tab.heading') }}</h1>
            </div>

            <div class="page-action">
            </div>
        </div>

        <div class="page-content">

            {!! app('Webkul\RMA\DataGrids\RMAList')->render() !!}

        </div>
    </div>
@stop