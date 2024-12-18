<x-admin::layouts>
    <!-- Title of the page --> 
    <x-slot:title>
        @lang('rma::app.admin.sales.rma.all-rma.index.title')
    </x-slot:title>

    <div class="flex items-center justify-between gap-16 max-sm:flex-wrap">
        <h1 class="text-20 font-bold text-gray-800 dark:text-white">
            @lang('rma::app.admin.sales.rma.index.rma-title')
        </h1>  
    </div>
    
    {!! view_render_event('bagisto.admin.rma.list.before') !!}

    <x-admin::datagrid src="{{ route('admin.sales.rma.index') }}" />

    {!! view_render_event('bagisto.admin.rma.list.after') !!}
       
</x-admin::layouts>