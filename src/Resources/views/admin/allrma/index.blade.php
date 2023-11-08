<x-admin::layouts>
    <x-slot:title>
        @lang('rma::app.admin.title.index')
    </x-slot>

    <div class="flex gap-16 justify-between items-center max-sm:flex-wrap">
        <h1 class="text-20 text-gray-800 dark:text-white font-bold">
            @lang('rma::app.admin.rma-tab.heading')
        </h1>  
            </div>

            {!! view_render_event('bagisto.admin.rma.list.before') !!}

            <x-admin::datagrid src="{{ route('admin.rma.index') }}"></x-admin::datagrid>

            {!! view_render_event('bagisto.admin.rma.list.after') !!}
        </div>
    </div>
</x-admin::layouts>