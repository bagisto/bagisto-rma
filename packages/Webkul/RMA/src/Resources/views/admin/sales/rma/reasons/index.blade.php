<x-admin::layouts>
    <!-- Title of the page -->
    <x-slot:title>
        @lang('rma::app.admin.sales.rma.reasons.index.title')
    </x-slot>

    {!! view_render_event('bagisto.admin.catalog.rma.list.before') !!}

    <v-rma-reasons>
        <!-- DataGrid Shimmer -->
        <x-admin::shimmer.datagrid />
    </v-rma-reasons>
    {!! view_render_event('bagisto.admin.catalog.rma.list.after') !!}

    @pushOnce('scripts')
        <script
            type="text/x-template"
            id="v-rma-reasons-template"
        >
            <div>
                <div class="flex items-center justify-between gap-4 max-sm:flex-wrap">
                    <!-- Title -->
                    <p class="text-xl font-bold text-gray-800 dark:text-white">
                        @lang('rma::app.admin.sales.rma.reasons.index.title')
                    </p>

                    <!-- Create Button -->
                    <div class="flex items-center gap-x-2.5">
                        <button
                            class="primary-button"
                            @click="selectedLocales=0; resetForm(); $refs.reasonsModal.toggle()"
                        >
                            @lang('rma::app.admin.sales.rma.reasons.index.create-btn')
                        </button>
                    </div>
                </div>

                <x-admin::datagrid
                    :src="route('admin.sales.rma.reason.index')"
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
                            :style="'grid-template-columns: repeat(' + (record.actions.length ? 8 : 7) + ', 1fr);'"
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

                            <!-- Name -->
                            <p v-html="record.status"></p>

                            <!-- Direction -->
                            <p v-text="record.created_at"></p>

                            <!-- Resolution Type -->
                            <p v-text="record.resolution_types"></p>

                            <!-- Resolution Type -->
                            <p v-text="record.position"></p>

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
                        ref="createReasonsForm"
                    >
                        {!! view_render_event('bagisto.admin.catalog.rma.create_form_controls.before') !!}

                            <x-admin::modal ref="reasonsModal">
                                <!-- Modal Header -->
                                <x-slot:header>
                                    <p v-if="! selectedLocales" class="text-lg font-bold text-gray-800 dark:text-white">
                                        @lang('rma::app.admin.sales.rma.reasons.create.create-title')
                                    </p>

                                    <p v-else class="text-lg font-bold text-gray-800 dark:text-white">
                                        @lang('rma::app.admin.sales.rma.reasons.edit.edit-title')
                                    </p>
                                </x-slot>

                                <!-- Modal Content -->
                                <x-slot:content>
                                    {!! view_render_event('bagisto.admin.catalog.rma.create.before') !!}
                                    <x-admin::form.control-group.control
                                        type="hidden"
                                        name="id"
                                        v-model="reason.id"
                                    />

                                    <!-- Reason -->
                                    <x-admin::form.control-group>
                                        <x-admin::form.control-group.label class="required">
                                            @lang('rma::app.admin.sales.rma.reasons.create.reason')
                                        </x-admin::form.control-group.label>

                                        <x-admin::form.control-group.control
                                            type="text"
                                            name="title"
                                            rules="required"
                                            :value="old('title')"
                                            v-model="reason.title"
                                            :label="trans('rma::app.admin.sales.rma.reasons.create.reason')"
                                            :placeholder="trans('rma::app.admin.sales.rma.reasons.create.reason')"
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
                                            :label="trans('rma::app.admin.sales.rma.reasons.create.status')"
                                            ::checked="(reason.status == 1) ? 1 : 0"
                                        />
                                    </x-admin::form.control-group>

                                    <!-- Position -->
                                    <x-admin::form.control-group>
                                        <x-admin::form.control-group.label class="required">
                                            @lang('admin::app.catalog.categories.create.position')
                                        </x-admin::form.control-group.label>

                                        <x-admin::form.control-group.control
                                            type="number"
                                            name="position"
                                            rules="required|min_value:1"
                                            :value="old('position')"
                                            v-model="reason.position"
                                            :label="trans('admin::app.catalog.categories.create.position')"
                                            :placeholder="trans('admin::app.catalog.categories.create.enter-position')"
                                        />

                                        <x-admin::form.control-group.error control-name="position" />
                                    </x-admin::form.control-group>

                                    <!-- Reason -->
                                    <x-admin::form.control-group>
                                        <x-admin::form.control-group.label class="required">
                                            @lang('rma::app.admin.configuration.index.sales.rma.resolution-type')
                                        </x-admin::form.control-group.label>

                                        <v-field
                                            name="resolution_type[]"
                                            label="@lang('mpauction::app.shop.sellers.account.auction.option')"
                                            v-model="reason.reasonResolutions"
                                            multiple
                                        >
                                            <select
                                                name="resolution_type[]"
                                                class="flex w-full min-h-10 py-2 px-3 border rounded-md text-sm text-gray-600 dark:text-gray-300 transition-all hover:border-gray-400 dark:hover:border-gray-400 focus:border-gray-400 dark:focus:border-gray-400 dark:bg-gray-900 dark:border-gray-800"
                                                :class="[errors['resolution_type[]'] ? 'border border-red-600 hover:border-red-600' : '']"
                                                v-model="reason.reasonResolutions"
                                                multiple
                                            >
                                                <option value="return">
                                                    @lang('rma::app.admin.configuration.index.sales.rma.return')
                                                </option>
                                                <option value="exchange">
                                                    @lang('rma::app.admin.configuration.index.sales.rma.exchange')
                                                </option>
                                                <option value="cancel-items">
                                                    @lang('rma::app.admin.configuration.index.sales.rma.cancel-items')
                                                </option>
                                            </select>
                                        </v-field>
                                        
                                        <x-admin::form.control-group.error control-name="resolution_id" />
                                    </x-admin::form.control-group>

                                    {!! view_render_event('bagisto.admin.catalog.rma.create.after') !!}
                                </x-slot>

                                <!-- Modal Footer -->
                                <x-slot:footer>
                                    <div class="flex items-center gap-x-2.5">
                                        <!-- Save Button -->
                                        <button
                                            type="submit"
                                            class="primary-button"
                                        >
                                            @lang('rma::app.admin.sales.rma.reasons.create.save-btn')
                                        </button>
                                    </div>
                                </x-slot>
                            </x-admin::modal>

                        {!! view_render_event('bagisto.admin.catalog.rma.create_form_controls.after') !!}
                    </form>
                </x-admin::form>
            </div>
        </script>

        <script type="module">
            app.component('v-rma-reasons', {
                template: '#v-rma-reasons-template',

                data() {
                    return {
                        reason: {},

                        selectedLocales: 0,
                    }
                },

                methods: {
                    updateOrCreate(params, {
                        resetForm,
                        setErrors
                    }) {
                        let formData = new FormData(this.$refs.createReasonsForm);
                        let url;
                        
                        // Sanitize the message input
                        const messageInput = formData.get('title');
                        const sanitizedMessage = this.sanitizeInput(messageInput);
                        formData.set('title', sanitizedMessage);

                        if (params.id) {
                            url = `{{ route('admin.sales.rma.reason.update', '') }}/${params.id}`;
                            formData.append('_method', 'put');
                        } else {
                            url = `{{ route('admin.sales.rma.reason.store') }}`;
                        }

                        this.$axios.post(url, formData, {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            })
                            .then((response) => {
                                this.$refs.reasonsModal.close();

                                this.$emitter.emit('add-flash', {
                                    type: 'success',
                                    message: response.data.message
                                });

                                this.$refs.datagrid.get();

                                resetForm();
                            });
                    },

                    sanitizeInput(input) {
                        const tempDiv = document.createElement('div');

                        tempDiv.textContent = input;
                        
                        return tempDiv.innerHTML;
                    },

                    editModal(url) {
                        this.$axios.get(url)
                            .then((response) => {
                                this.reason = response.data;

                                this.$refs.reasonsModal.toggle();
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