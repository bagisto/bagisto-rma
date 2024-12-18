<x-admin::layouts>
    <!-- Title of the page -->
    <x-slot:title>
        @lang('rma::app.admin.sales.rma.custom-field.index.title')
    </x-slot>

    <div class="flex items-center justify-between gap-4 max-sm:flex-wrap">
        <!-- Title -->
        <p class="text-xl font-bold text-gray-800 dark:text-white">
            @lang('rma::app.admin.sales.rma.custom-field.index.title')
        </p>

        <!-- Create Button -->
        <div class="flex items-center gap-x-2.5">
            <a
                class="primary-button"
                href="{{ route('admin.sales.rma.custom-field.create') }}"
            >
                @lang('rma::app.admin.sales.rma.custom-field.index.create-btn')
            </a>
        </div>
    </div>

    {!! view_render_event('bagisto.admin.catalog.rma.custom-field.list.before') !!}

    <x-admin::datagrid :src="route('admin.sales.rma.custom-field.index')"/>

    {!! view_render_event('bagisto.admin.catalog.rma.custom-field.list.after') !!}

</x-admin::layouts>