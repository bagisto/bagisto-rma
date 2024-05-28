<x-admin::layouts>
    <!-- Title of the page -->
    <x-slot:title>
        @lang('rma::app.admin.sales.rma.reasons.index.title')
    </x-slot:title>

    {!! view_render_event('bagisto.admin.rma.reason.list.before') !!}

    <v-create-rna-reason></v-create-rna-reason>

    {!! view_render_event('bagisto.admin.rma.reason.list.after') !!}

    @pushOnce('scripts')
        <script type="text/x-template" id="v-create-rma-reason-template">
            <div>
                <div class="flex items-center justify-between">
                    <p class="text-[20px] font-bold text-gray-800 dark:text-white">
                        @lang('rma::app.admin.sales.rma.reasons.index.title')
                    </p>
            
                    <div class="flex items-center gap-x-[10px]">
                        <div class="flex items-center gap-x-[10px]">
                            <!-- Create a new Group -->
                            @if (bouncer()->hasPermission('admin.sales.rma.reason.create'))
                                <button 
                                    type="button"
                                    class="primary-button"
                                    @click="id=0; $refs.groupUpdateOrCreateModal.open()"
                                >
                                    @lang('rma::app.admin.sales.rma.reasons.create.create-title')
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                {!! view_render_event('bagisto.admin.rma.reason.list.before') !!}

                <!-- DataGrid -->
                <x-admin::datagrid src="{{ route('admin.sales.rma.reason.index') }}" ref="datagrid">
                    @php
                        $hasPermission = bouncer()->hasPermission('rma.reason.edit') || bouncer()->hasPermission('rma.reason.delete');
                    @endphp

                    <!-- DataGrid Header -->
                    <template #header="{ columns, records, sortPage, selectAllRecords, applied}">
                        <div class="row grid grid-cols-{{ $hasPermission ? '6' : '5' }} grid-rows-1 gap-[10px] items-center px-[16px] py-[10px] border-b-[1px] dark:border-gray-800 text-gray-600 dark:text-gray-300 bg-gray-50 dark:bg-gray-900 font-semibold"
                            :style="'grid-template-columns: repeat({{ $hasPermission ? '6' : '5' }} , 1fr);'"  
                        >
                            <div
                                class="flex cursor-pointer gap-[10px]"
                                v-for="(columnGroup, index) in ['checkbox', 'id', 'title', 'status', 'created_at']"
                            >
                                @if ($hasPermission)
                                    <label
                                        class="flex w-max cursor-pointer select-none items-center gap-[4px]"
                                        for="mass_action_select_all_records"
                                        v-if="! index"
                                    >
                                        <input
                                            type="checkbox"
                                            name="mass_action_select_all_records"
                                            id="mass_action_select_all_records"
                                            class="peer hidden"
                                            :checked="['all', 'partial'].includes(applied.massActions.meta.mode)"
                                            @change="selectAllRecords"
                                        >

                                        <span
                                            class="icon-uncheckbox cursor-pointer rounded-[6px] text-[24px]"
                                            :class="[
                                                applied.massActions.meta.mode === 'all' ? 'peer-checked:icon-checked peer-checked:text-blue-600' : (
                                                    applied.massActions.meta.mode === 'partial' ? 'peer-checked:icon-checkbox-partial peer-checked:text-blue-600' : ''
                                                ),
                                            ]"
                                        >
                                        </span>
                                    </label>
                                @endif
                                <p class="text-gray-600 dark:text-gray-300">
                                    <span class="[&>*]:after:content-['_/_']">
                                        <span
                                            class="after:content-['/'] last:after:content-['']"
                                            :class="{
                                                'text-gray-800 dark:text-white font-medium': applied.sort.column == columnGroup,
                                                'cursor-pointer hover:text-gray-800 dark:hover:text-white': columns.find(columnTemp => columnTemp.index === columnGroup)?.sortable,
                                            }"
                                            @click="
                                                columns.find(columnTemp => columnTemp.index === columnGroup)?.sortable ? sortPage(columns.find(columnTemp => columnTemp.index === columnGroup)): {}
                                            "
                                        >
                                            @{{ columns.find(columnTemp => columnTemp.index === columnGroup)?.label }}
                                        </span>
                                    </span>

                                    <!-- Filter Arrow Icon -->
                                    <i
                                        class="align-text-bottom text-[16px] text-gray-800 ltr:ml-[5px] rtl:mr-[5px] dark:text-white"
                                        :class="[applied.sort.order === 'asc' ? 'icon-down-stat': 'icon-up-stat']"
                                        v-if="columnGroup.includes(applied.sort.column)"
                                    >
                                    </i>
                                </p>
                            </div>
                            <!-- Actions -->
                            @if ($hasPermission)
                                <p class="flex justify-end gap-[10px]">
                                    @lang('admin::app.components.datagrid.table.actions')
                                </p>
                            @endif
                        </div>
                    </template>

                    <!-- DataGrid Body -->
                    <template #body="{ columns, records, performAction, setCurrentSelectionMode, applied}">
                        <div
                            v-for="record in records"
                            class="row grid items-center gap-[10px] border-b-[1px] px-[16px] py-[16px] text-gray-600 transition-all hover:bg-gray-50 dark:border-gray-800 dark:text-gray-300 dark:hover:bg-gray-950"
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
                                    class="icon-uncheckbox peer-checked:icon-checked cursor-pointer rounded-[6px] text-[24px] peer-checked:text-blue-600"
                                    :for="`mass_action_select_record_${record.id}`"
                                >
                                </label>
                            @endif
                            <!-- Id -->
                            <p v-text="record.id"></p>

                            <!-- Code -->
                            <p v-text="record.title"></p>

                            <!-- Status -->
                            <p :class="[record.status ? 'label-active': 'label-info']">
                                @{{ record.status ? "@lang('rma::app.admin.sales.rma.reasons.index.datagrid.enabled')" : "@lang('rma::app.admin.sales.rma.reasons.index.datagrid.disabled')" }}
                            </p>

                             <!-- created At -->
                             <p v-text="record.created_at"></p>

                            <!-- Actions -->
                            <div class="flex justify-end">
                                <a @click="id=1; editModal(record)">
                                    <span
                                        :class="record.actions.find(action => action.title === 'Edit')?.icon"
                                        class="cursor-pointer rounded-[6px] p-[6px] text-[24px] transition-all hover:bg-gray-200 dark:hover:bg-gray-800 max-sm:place-self-center"
                                        :title="record.actions.find(action => action.title === 'Edit')?.title"
                                    >
                                    </span>
                                </a>

                                <a @click="performAction(record.actions.find(action => action.method === 'POST'))">
                                    <span
                                        :class="record.actions.find(action => action.method === 'POST')?.icon"
                                        class="icon-delete cursor-pointer rounded-[6px] p-[6px] text-[24px] transition-all hover:bg-gray-200 dark:hover:bg-gray-800 max-sm:place-self-center"
                                        :title="record.actions.find(action => action.method === 'POST')?.title"
                                    >
                                    </span>
                                </a>
                            </div>
                        </div>
                    </template>
                </x-admin::datagrid>

                {!! view_render_event('bagisto.admin.rma.reason.list.after') !!}

                <!-- Modal Form -->
                <x-admin::form
                    v-slot="{ meta, errors, handleSubmit }"
                    as="div"
                    ref="modalForm"
                >
                    <form
                        @submit="handleSubmit($event, updateOrCreate)"
                        ref="groupCreateForm"
                    >
                        <!-- Create Group Modal -->
                        <x-admin::modal ref="groupUpdateOrCreateModal">          
                            <x-slot:header>
                                <!-- Modal Header -->
                                <p class="text-[18px] font-bold text-gray-800 dark:text-white">
                                    <span v-if="id">
                                        @lang('rma::app.admin.sales.rma.reasons.edit.edit-title')
                                    </span>
                                    
                                    <span v-else>
                                        @lang('rma::app.admin.sales.rma.reasons.create.create-title')
                                    </span>   
                                </p>    
                            </x-slot:header>
            
                            <x-slot:content>
                                <!-- Modal Content -->
                                <div class="border-b-[1px] px-[16px] py-[10px] dark:border-gray-800">
                                    <x-admin::form.control-group class="mb-[10px]">
                                        <x-admin::form.control-group.label class="required">
                                            @lang('rma::app.admin.sales.rma.reasons.create.reason')
                                        </x-admin::form.control-group.label>

                                        <x-admin::form.control-group.control
                                            type="text"
                                            name="title"
                                            id="title"
                                            rules="required"
                                            :label="trans('rma::app.admin.sales.rma.reasons.create.reason')"
                                            :placeholder="trans('rma::app.admin.sales.rma.reasons.create.reason')"
                                        >
                                        </x-admin::form.control-group.control>
            
                                        <x-admin::form.control-group.error
                                            control-name="title"
                                        >
                                        </x-admin::form.control-group.error>
                                    </x-admin::form.control-group>

                                    <x-admin::form.control-group class="w-full">
                                        <x-admin::form.control-group.label class="required">
                                            @lang('rma::app.admin.sales.rma.reasons.create.status')
                                        </x-admin::form.control-group.label>

                                        <x-admin::form.control-group.control
                                            type="select"
                                            name="status"
                                            rules="required"
                                            :label="trans('rma::app.admin.sales.rma.reasons.create.status')"
                                        >
                                            <option value="1">
                                                @lang('rma::app.admin.sales.rma.reasons.index.datagrid.enabled')
                                            </option>

                                            <option value="0">
                                                @lang('rma::app.admin.sales.rma.reasons.index.datagrid.disabled')
                                            </option>
                                        </x-admin::form.control-group.control>

                                        <x-admin::form.control-group.error
                                            control-name="status"
                                        >
                                        </x-admin::form.control-group.error>
                                    </x-admin::form.control-group>
                                </div>
                            </x-slot:content>
            
                            <x-slot:footer>
                                <!-- Modal Submission -->
                                <div class="flex items-center gap-x-[10px]">
                                    <button 
                                        type="submit"
                                        class="primary-button"
                                    >
                                        @lang('rma::app.admin.sales.rma.reasons.create.save-btn')
                                    </button>
                                </div>
                            </x-slot:footer>
                        </x-admin::modal>
                    </form>
                </x-admin::form>
            </div>
        </script>

        <script type="module">
            app.component('v-create-rna-reason', {
                template: '#v-create-rma-reason-template',

                data() {
                    return {
                        id: 0, // Initialize id property
                        records: [],
                    }
                },

                methods: {
                    // Fetch records data from backend
                    fetchData() {
                        axios.get("{{ route('admin.sales.rma.reason.index') }}")
                            .then(response => {
                                this.records = response.data;
                            })
                            .catch(error => {
                                console.error("Error fetching data:", error);
                            });
                    },

                    updateOrCreate(params, { resetForm, setErrors }) {
                        let formData = new FormData(this.$refs.groupCreateForm);

                        // Append the 'id' field to the form data
                        formData.append('id', params.id);

                        if (params.id) {
                            formData.append('_method', 'post');
                        }

                        axios.post(params.id ? "{{ route('admin.sales.rma.reason.update') }}" : "{{ route('admin.sales.rma.reason.store') }}", formData)
                            .then(response => {
                                this.$refs.groupUpdateOrCreateModal.close();
                                
                                this.$refs.datagrid.get();
                                
                                this.$emitter.emit('add-flash', { type: 'success', message: response.data.message });
                                
                                resetForm();
                            })
                            .catch(error => {
                                if (error.response.status == 422) {
                                    setErrors(error.response.data.errors);
                                }
                            });
                    },

                    // Function to open edit modal
                    editModal(value) {
                        this.$refs.groupUpdateOrCreateModal.toggle();
                        this.$refs.modalForm.setValues(value);
                    },
                }
            })
        </script>
    @endPushOnce
</x-admin::layouts>