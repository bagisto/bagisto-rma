<x-admin::layouts>
    <!-- Title of the page -->
    <x-slot:title>
        @lang('rma::app.admin.sales.rma.rma-status.index.title')
    </x-slot>

    {!! view_render_event('bagisto.admin.catalog.rma.rma-status.list.before') !!}

    <v-rma-status>
        <!-- DataGrid Shimmer -->
        <x-admin::shimmer.datagrid />
    </v-rma-status>
    {!! view_render_event('bagisto.admin.catalog.rma.rma-status.list.after') !!}

    @pushOnce('scripts')
        <script
            type="text/x-template"
            id="v-rma-status-template"
        >
            <div>
                <div class="flex items-center justify-between gap-4 max-sm:flex-wrap">
                    <!-- Title -->
                    <p class="text-xl font-bold text-gray-800 dark:text-white">
                        @lang('rma::app.admin.sales.rma.rma-status.index.title')
                    </p>

                    <!-- Create Button -->
                    <div class="flex items-center gap-x-2.5">
                        <button
                            class="primary-button"
                            @click="selectedLocales=0; resetForm(); $refs.rulesModal.toggle()"
                        >
                            @lang('rma::app.admin.sales.rma.rma-status.index.create-btn')
                        </button>
                    </div>
                </div>

                <x-admin::datagrid
                    :src="route('admin.sales.rma.rma-status.index')"
                    ref="datagrid"
                >
                    @php
                        $hasPermission = bouncer()->hasPermission('rma.reason.edit') || bouncer()->hasPermission('rma.reason.delete');
                    @endphp

                    <!-- DataGrid Body -->
                    <template #body="{ columns, records, performAction, setCurrentSelectionMode, applied }">
                        <div
                            v-for="record in records"
                            class="row grid items-center gap-2.5 border-b px-4 py-4 text-gray-600 transition-all hover:bg-gray-50 dark:border-gray-800 dark:text-gray-300 dark:hover:bg-gray-950"
                            :style="'grid-template-columns: repeat(' + (record.actions.length ? 6 : 5) + ', 1fr);'"
                        >
                            @if ($hasPermission)
                                <input
                                    type="checkbox"
                                    :name="`mass_action_select_record_${record.id}`"
                                    :id="`mass_action_select_record_${record.id}`"
                                    :value="record.id"
                                    class="peer hidden"
                                    v-model="applied.massActions.indices"
                                    @change="setCurrentSelectionMode"
                                >

                                <label
                                    class="icon-uncheckbox peer-checked:icon-checked cursor-pointer rounded-md text-2xl peer-checked:text-blue-600"
                                    :for="`mass_action_select_record_${record.id}`"
                                >
                                </label>
                            @endif
                            <!-- Id -->
                            <p v-text="record.id"></p>

                            <!-- Code -->
                            <p v-text="record.title"></p>

                            <!-- Color -->
                            <p v-html="record.color"></p>

                            <!-- Status -->
                            <p v-html="record.status"></p>

                            <!-- Actions -->
                            <div class="flex justify-end">
                                <a @click="selectedLocales=1; editModal(record.actions.find(action => action.method === 'GET').url)">
                                    <span
                                        :class="record.actions.find(action => action.title === 'Edit')?.icon"
                                        class="cursor-pointer rounded-md p-1 text-2xl transition-all hover:bg-gray-200 dark:hover:bg-gray-800 max-sm:place-self-center"
                                        :title="record.actions.find(action => action.title === 'Edit')?.title"
                                    >
                                    </span>
                                </a>

                                <a @click="performAction(record.actions.find(action => action.method === 'DELETE'))">
                                    <span
                                        :class="record.actions.find(action => action.method === 'DELETE')?.icon"
                                        class="icon-delete cursor-pointer rounded-md p-2 text-2xl transition-all hover:bg-gray-200 dark:hover:bg-gray-800 max-sm:place-self-center"
                                        :title="record.actions.find(action => action.method === 'DELETE')?.title"
                                    >
                                    </span>
                                </a>
                            </div>
                        </div>
                    </template>
                </x-admin::datagrid>

                <!-- Modal Component -->
                <x-admin::form
                    v-slot="{ meta, errors, handleSubmit }"
                    as="div"
                    ref="modalForm"
                >
                    <form
                        @submit="handleSubmit($event, updateOrCreate)"
                        ref="createRmaStatusForm"
                    >
                        {!! view_render_event('bagisto.admin.catalog.rma.rma-status.create_form_controls.before') !!}

                            <x-admin::modal ref="rulesModal">
                                <!-- Modal Header -->
                                <x-slot:header>
                                    <p v-if="! selectedLocales" class="text-lg font-bold text-gray-800 dark:text-white">
                                        @lang('rma::app.admin.sales.rma.rma-status.create.create-title')
                                    </p>

                                    <p v-else class="text-lg font-bold text-gray-800 dark:text-white">
                                        @lang('rma::app.admin.sales.rma.rma-status.edit.edit-title')
                                    </p>
                                </x-slot>

                                <!-- Modal Content -->
                                <x-slot:content>
                                    {!! view_render_event('bagisto.admin.catalog.rma.rma-status.create.before') !!}
                                    <x-admin::form.control-group.control
                                        type="hidden"
                                        name="id"
                                        v-model="rules.id"
                                    />

                                    <!-- Rules Title -->
                                    <x-admin::form.control-group>
                                        <x-admin::form.control-group.label class="required">
                                            @lang('admin::app.customers.reviews.index.datagrid.title')
                                        </x-admin::form.control-group.label>

                                        <x-admin::form.control-group.control
                                            type="text"
                                            name="title"
                                            rules="required"
                                            :value="old('title')"
                                            v-model="rules.title"
                                            :label="trans('admin::app.customers.reviews.index.datagrid.title')"
                                            :placeholder="trans('admin::app.customers.reviews.index.datagrid.title')"
                                        />

                                        <x-admin::form.control-group.error control-name="title" />
                                    </x-admin::form.control-group>

                                    <!-- Status -->
                                    <x-admin::form.control-group>
                                        <x-admin::form.control-group.label>
                                            @lang('rma::app.admin.sales.rma.reasons.create.status')
                                        </x-admin::form.control-group.label>

                                        <input
                                            type="hidden"
                                            name="status"
                                            value="0"
                                        />

                                        <x-admin::form.control-group.control
                                            type="switch"
                                            name="status"
                                            value="1"
                                            :label="trans('rma::app.admin.sales.rma.rules.create.status')"
                                            ::checked="(rules.status == 1) ? 1 : 0"
                                        />
                                    </x-admin::form.control-group>

                                     <!-- Color -->
                                    <x-admin::form.control-group class="w-2/6">
                                        <x-admin::form.control-group.label>
                                            @lang('admin::app.catalog.attributes.create.color')
                                        </x-admin::form.control-group.label>

                                        <x-admin::form.control-group.control
                                            type="color"
                                            name="color"
                                            rules="required"
                                            v-model="rules.color"
                                            :placeholder="trans('admin::app.catalog.attributes.create.color')"
                                        />

                                        <x-admin::form.control-group.error control-name="color" />
                                    </x-admin::form.control-group>

                                    {!! view_render_event('bagisto.admin.catalog.rma.rma-status.create.after') !!}
                                </x-slot>

                                <!-- Modal Footer -->
                                <x-slot:footer>
                                    <div class="flex items-center gap-x-2.5">
                                        <!-- Save Button -->
                                        <button
                                            type="submit"
                                            class="primary-button"
                                        >
                                            @lang('rma::app.admin.sales.rma.rma-status.create.save-btn')
                                        </button>
                                    </div>
                                </x-slot>
                            </x-admin::modal>

                        {!! view_render_event('bagisto.admin.catalog.rma.rma-status.create_form_controls.after') !!}
                    </form>
                </x-admin::form>
            </div>
        </script>

        <script type="module">
            app.component('v-rma-status', {
                template: '#v-rma-status-template',

                data() {
                    return {
                        rules: {},

                        selectedLocales: 0,
                    }
                },

                methods: {
                    updateOrCreate(params, {
                        resetForm,
                        setErrors
                    }) {
                        let formData = new FormData(this.$refs.createRmaStatusForm);
                        let url;

                        if (params.id) {
                            url = `{{ route('admin.sales.rma.rma-status.update', '') }}/${params.id}`;
                            formData.append('_method', 'put');
                        } else {
                            url = `{{ route('admin.sales.rma.rma-status.store') }}`;
                        }

                        this.$axios.post(url, formData, {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            })
                            .then((response) => {
                                this.$refs.rulesModal.close();

                                this.$emitter.emit('add-flash', {
                                    type: 'success',
                                    message: response.data.message
                                });

                                this.$refs.datagrid.get();

                                resetForm();
                            });
                    },

                    editModal(url) {
                        this.$axios.get(url)
                            .then((response) => {
                                this.rules = response.data;

                                this.$refs.rulesModal.toggle();
                            });
                    },

                    resetForm() {
                        this.reason = {};
                        this.reasonResolutions = [];
                    },
                },
            });
        </script>
    @endPushOnce
</x-admin::layouts>