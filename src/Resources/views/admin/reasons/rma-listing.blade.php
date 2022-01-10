@extends('rma::admin.layouts.content')

@section('page_title')
{{ __('rma::app.admin.title.reason-title') }}
@stop

@section('content')

<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h1>{{ __('rma::app.admin.reasons.heading') }}</h1>
        </div>
        <div class="page-action">
            <a href="{{ route('admin.rma.reason.create') }}" class="btn btn-lg btn-primary">
                {{ __('rma::app.admin.reasons.create-btn') }}
            </a>
        </div>
    </div>

    <div class="page-content">

        {!! app('Webkul\RMA\DataGrids\Admin\Reasons')->render() !!}

    </div>
</div>

@stop