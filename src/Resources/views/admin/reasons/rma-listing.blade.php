<x-admin::layouts>
    <x-slot name="title">
        @lang('rma::app.admin.title.reason')
    </x-slot>

    <div class="flex gap-16 justify-between items-center max-sm:flex-wrap">
        <h1 class="text-20 text-gray-800 dark:text-white font-bold">
            @lang('rma::app.admin.reasons.heading')
        </h1>

        <div class="flex gap-x-10 items-center">
            @if (bouncer()->hasPermission('admin.rma.reason.create'))
                <a href="{{ route('admin.rma.reason.create') }}">
                    <div class="primary-button">
                        @lang('rma::app.admin.reasons.create-btn')
                    </div>
                </a>
            @endif
        </div>
    </div>
    
    {!! view_render_event('bagisto.admin.rma.reason.list.before') !!}
    
    <x-admin::datagrid src="{{ route('admin.rma.reason.index') }}"></x-admin::datagrid>
    
    {!! view_render_event('bagisto.admin.rma.reason.list.after') !!}
    
</x-admin::layouts>