<x-shop::layouts>
    <!-- Title of the page -->
    <x-slot:title>
        @lang('rma::app.shop.guest.view.title')
    </x-slot>
    <br>

    @php 
        $show = true;

        if (
            is_null($rmaData['rma_status'])
            || $rmaData['rma_status'] == 'Received Package'
        ) {
            if ($rmaData['status'] == 1) {
                $show = false;
            }
        } else if (
            $rmaData['rma_status'] == 'Item Canceled'
            || $rmaData['rma_status'] == 'Declined'
        ) {
            $show = false;
        } else if ($rmaData['status'] == 1 && $rmaData['rma_status'] != 'Declined') {
            $show = false;
        }

        $currentDate = \Carbon\Carbon::now();
                
        $expiredays = intval(core()->getConfigData('sales.rma.setting.default_allow_days'));

        $newDateTime = \Carbon\Carbon::parse($rmaData->created_at);

        $DeferenceInDays = $currentDate->diffInDays($newDateTime);

        $checkDateExpires = false;

        if (
            $DeferenceInDays > $expiredays 
            && $DeferenceInDays != 0
        ) {
            $checkDateExpires = true;
        }
    @endphp 

    <div class="container px-[60px] max-lg:px-[30px]">
        <div class="flex items-center justify-between">
            <h2 class="text-[20px] font-medium">
                @lang('rma::app.shop.view-guest-rma.rma') {{ '#'.$rmaData['id'] }}
            </h2>
        </div>
        <br>
               
        <!-- Rma information -->
        <div class="overflow-x-auto">
            <x-table>
                <!-- Request On --> 
                <div class="grid w-full grid-cols-[2fr_3fr] px-[30px] py-[12px]">
                    <p class="text-[14px] font-medium">
                        @lang('rma::app.shop.view-guest-rma-content.request-on')
                    </p>
        
                    <p class="text-[14px] font-medium text-[#6E6E6E]">
                        {{ date("F j, Y, h:i:s A" ,strtotime($rmaData['created_at'])) }}
                    </p>
                </div>

                <!-- Order Id --> 
                <div class="grid w-full grid-cols-[2fr_3fr] px-[30px] py-[12px]">
                    <p class="text-[14px] font-medium">
                        @lang('rma::app.shop.view-guest-rma.order-id')
                    </p>
        
                    <p class="text-[14px] font-medium text-[#6E6E6E]">
                        @if (!session()->get('guestEmail'))
                            <a 
                                href="{{ route('rma.customers.allrma', $rmaData['order_id']) }}"
                                target="_blank"
                            >
                                {{ '#'.$rmaData['order_id'] }}
                            </a>
                        @endif
                        
                        @if (session()->get('guestEmail'))
                            {{ '#'.$rmaData['order_id'] }}
                        @endif
                    </p>
                </div>
            
                <!-- Resolution Type -->  
                <div class="grid w-full grid-cols-[2fr_3fr] px-[30px] py-[12px]">
                    <p class="text-[14px] font-medium">
                        @lang('rma::app.shop.view-guest-rma.resolution-type')
                    </p>
        
                    <p class="text-[14px] font-medium text-[#6E6E6E]">
                        {{ $rmaData['resolution'] }}
                    </p>
                </div>

                <!-- Additional Information --> 
                @if (! empty($rmaData['information']))
                    <div class="grid w-full grid-cols-[2fr_3fr] px-[30px] py-[12px]">
                        <p class="text-[14px] font-medium">
                            @lang('rma::app.shop.view-guest-rma.additional-information')
                        </p>
            
                        <p class="text-[14px] font-medium text-[#6E6E6E]">
                            {{ $rmaData['information'] }}
                        </p>
                    </div>
                @endif
            </x-table>
        </div><br>

        <span class="mb-[16px] block w-full border-b-[1px] dark:border-gray-800"></span>

        <div class="flex items-center justify-between">
            <h2 class="text-[20px] font-medium">
                @lang('rma::app.shop.view-guest-rma.items-request')
            </h2>
        </div>

        <!-- Order information -->
        <div>
            <div class="mt-[15px] overflow-x-auto">
                <x-table>
                    <x-table.thead>
                        @php($lang = Lang::get('rma::app.shop.table-heading'))

                        <x-table.tr>
                            @foreach($lang as $languageFile)
                                <x-table.th>
                                    {{ $languageFile }}
                                </x-table.th>
                            @endforeach
                        </x-table.tr>
                    </x-table.thead>

                    <x-table.tbody>
                        @foreach($productDetails as $key=>$prodDetail)
                            @foreach($prodDetail->getOrderItem as $key => $orderItem)
                                <x-table.tr>
                                    <!-- Product Name -->
                                    <x-table.td>
                                        {!! $orderItem['name'] !!}
                                        {!! app('Webkul\RMA\Helpers\Helper')->getOptionDetailHtml($orderItem->additional['attributes'] ?? []) !!}
                                    </x-table.td>

                                    <!-- SKU -->
                                    <x-table.td>
                                        @if ($orderItem['type'] == 'configurable')
                                            @foreach ($skus as $k => $sku)
                                                @if (isset($sku['parent_id']) && $sku['parent_id'] == $orderItem['id'])
                                                    {!! $sku['sku'] !!}
                                                @endif
                                            @endforeach
                                        @else
                                            {!! $orderItem['sku'] !!}
                                        @endif
                                    </x-table.td>

                                    <!-- Price -->
                                    <x-table.td>
                                        {!! $orderItem['price'] !!}
                                    </x-table.td>
                                    
                                    <!-- Quantity -->
                                    <x-table.td>
                                        {!! $prodDetail['quantity'] !!}
                                    </x-table.td>
                                    
                                    <!-- Reason -->
                                    <x-table.td>
                                        {!! wordwrap($reasons[$key]->getReasons->title,15,"<br>\n") !!}
                                    </x-table.td>
                                </x-table.tr>
                            @endforeach
                        @endforeach
                    </x-table.tbody>
                </x-table>
            </div>
        </div>
        <br>

        <!-- Images shown which is uploaded -->
        <span class="mb-[16px] block w-full border-b-[1px] dark:border-gray-800"> </span>

        <!-- Status detail of rma -->
        <div class="flex items-center justify-between">
            <p class="text-[20px] font-medium">
                @lang('rma::app.shop.view-guest-rma.status-details')
            </p>
        </div>
        <br>
        
        <!-- RMA status -->
        <div class="grid grid-cols-1">
            
            <div class="grid grid-cols-[2fr_3fr] px-[30px] py-[12px]">
                @if (
                        ! empty($rmaImages)
                        || count($rmaImages) > 0
                    )
                    <p class="p-[10px] font-bold text-gray-800 dark:text-white">
                        @lang('rma::app.shop.view-customer-rma.images')
                    </p>
                
                    <p class="flex">
                        @foreach ($rmaImages as $images)
                            <img class="box-shadow m-[2px] h-[60px] w-[60px] rounded dark:bg-gray-800" @if (isset($rmaImages)) src="{{ asset('../storage/app/public/' . $images['path']) }}" @else src="" @endif>            
                        @endforeach
                    </p>
                @endif
            </div>
        
            <div class="grid grid-cols-[2fr_3fr] px-[30px] py-[12px]">
                <p class="p-[10px] text-[15px] font-bold text-gray-800 dark:text-white">
                    @lang('rma::app.shop.guest.view.rma-status')
                </p>

                @if (
                    empty($rmaData['rma_status'])
                    || $rmaData['rma_status'] == 'Pending'
                )
                    
                <span id="tag" style="background-color:#FBC02D; border-radius: 10px; padding: 10px; width: fit-content;">
                    @lang('rma::app.status.status-name.pending')
                </span>

                @elseif ($rmaData['rma_status'] == 'Received Package')
                    @if ($rmaData['status'] != 1)
                        <span style="background-color:#1976D2; border-radius: 10px; padding: 10px; width: fit-content;">
                            @lang('rma::app.status.status-name.received-package')
                        </span>
                    @else
                        <span style="background-color:#00796B; border-radius: 10px; padding: 10px; width: fit-content;">
                            @lang('rma::app.status.status-name.solved')
                        </span>
                    @endif

                @elseif ($rmaData['rma_status'] == 'Item Canceled')
                    <span style="background-color:#00796B; border-radius: 10px; padding: 10px; width: fit-content;">
                        @lang('rma::app.status.status-name.item-canceled')
                    </span>

                @elseif ($rmaData['rma_status'] == 'Declined')
                    <span style="background-color:#616161; border-radius: 10px; padding: 10px; width: fit-content;">
                        {{  $rmaData['rma_status'] }}
                    </span>

                @elseif ($rmaData['rma_status'] == 'Not Receive Package yet')
                    <span style="background-color:#FBC02D; border-radius: 10px; padding: 10px; width: fit-content;">
                        @lang('rma::app.status.status-name.not-received-package-yet')
                    </span>

                @elseif ($rmaData['rma_status'] == 'Dispatched Package')
                    <span style="background-color:#FBC02D; border-radius: 10px; padding: 10px; width: fit-content;">
                        @lang('rma::app.status.status-name.dispatched-package')
                    </span>

                @elseif ($rmaData['rma_status'] == 'Accept')
                    <span style="background-color:#FBC02D; border-radius: 10px; padding: 10px; width: fit-content;">
                        @lang('rma::app.status.status-name.accept')
                    </span>
                @else
                    <span style="background-color:#00796B; border-radius: 10px; padding: 10px; width: fit-content;">
                        @lang('rma::app.status.status-name.solved')
                    </span>
                @endif
            </div><br>

            <!-- order status -->
            <div class="grid grid-cols-[2fr_3fr] px-[30px] py-[12px]">
                <p class="p-[10px] text-[15px] font-bold text-gray-800 dark:text-white">
                    @lang('rma::app.shop.guest.view.order-status')
                </p>
            
                <p @if ($rmaData['order_status'] == 'Delivered') style="background-color:#FBC02D; border-radius: 10px; padding: 10px; width: fit-content;" @else style="background-color: red; border-radius: 10px; padding: 10px; width: fit-content;" @endif>
                    {{ $rmaData['order_status'] }}
                </p>
            </div>
            <br>

            @if (! $checkDateExpires)
                @if ($rmaData['rma_status'] == 'Declined')
                    <a href="{{ route('rma.customer.reopen.rma_status', ['id' => $rmaData['id']]) }}">
                        <button
                            type="submit"
                            class="primary-button"
                            onClick="formValidation()"
                        >
                            @lang('rma::app.shop.guest.create.reopen-request')
                        </button>
                    </a>
                @endif

                @if ($rmaData['status'] == 1
                    && $rmaData['rma_status'] != 'Declined')
                    <!-- Close RMA -->
                    <div class="grid grid-cols-[2fr_3fr] px-[30px] py-[12px]">
                        <p class="p-[10px] text-[15px] font-bold text-gray-800 dark:text-white">
                            @lang('rma::app.shop.guest.view.close-rma')
                        </p>
                         <!-- RMA solved -->
                        <p class="w-max p-[10px] text-gray-600">
                            @lang('rma::app.status.status-quotes.solved')
                        </p>
                    </div>
                    <br>
                @endif
                
                <!-- RMA solved -->
                @if ($rmaData['rma_status'] == 'Item Canceled')
                    <div class="grid grid-cols-[2fr_3fr] px-[30px] py-[12px]">
                        <p class="p-[10px] text-[15px] font-bold text-gray-800 dark:text-white">
                            @lang('rma::app.shop.view-guest-rma.close-rma')
                        </p>
                        
                        <p class="w-max p-[10px]">
                            @lang('rma::app.status.status-quotes.solved-by-admin')
                        </p>
                    </div>
                @endif

                @if ($rmaData['rma_status'] == 'Declined')
                    <div class="grid grid-cols-[2fr_3fr] px-[30px] py-[12px]">
                        <p class="p-[10px] text-[15px] font-bold text-gray-800 dark:text-white">
                            @lang('rma::app.shop.view-guest-rma.close-rma')
                        </p>
                        
                        <p class="w-max p-[10px]">
                            @lang('rma::app.status.status-quotes.declined-admin')
                        </p>
                    </div>
                @endif
            @endif
        </div>
        <option-wrapper></option-wrapper>
    </div>
    
    @push('scripts')
        <script type="text/x-template" id="options-template">
            <span class="mb-[16px] block w-full border-b-[1px] dark:border-gray-800"></span>

            <div>
                @if (! $checkDateExpires)
                    @if ($show)

                        <!-- Close rma if solved -->
                        <div class="flex items-center justify-between">
                            <p class="text-[20px] font-medium">
                                @lang('rma::app.shop.view-guest-rma.close-rma')
                            </p>
                        </div>
                        <br>
                        
                        <div class="row">
                            <x-shop::form
                                @submit="validateForm('check-form')"
                                id="check-form"
                                enctype="multipart/form-data"
                                :action="route('rma.customer.save.rma_status')"
                            >
                                @csrf()
                                <div>
                                    <input
                                        type="hidden"
                                        name="rma_id"
                                        value="{{ $rmaData['id'] }}"
                                    >

                                    <input
                                        type="checkbox"
                                        id="close_rma"
                                        name="close_rma"
                                        v-validate="'required'"
                                        data-vv-as="&quot;{{ __('rma::app.shop.validation.close-rma') }}&quot;"
                                    >
                                        
                                    <label for="close_rma"></label>
                                        @lang('rma::app.shop.view-customer-rma.status-quotes')
                                    <span style="color:red;">*</span>
                                </div>
                                <br>
                                
                                <p v-if="error" style="color:red;">
                                    @lang('rma::app.shop.view-customer-rma.term')
                                </p>

                                <button
                                    type="submit"
                                    class="primary-button m-0 block w-max rounded-[18px] px-[43px] py-[11px] text-center text-base"
                                    name="form-1"
                                >
                                    @lang('rma::app.shop.view-guest-rma.save-btn')
                                </button>
                            </x-shop::form>
                        </div>
                        <br>
                    @endif
                @endif

                <span class="mb-[16px] block w-full border-b-[1px] dark:border-gray-800"> </span>

                @if (count($messages) > 0)
                <!-- View conversations -->
                <div class="flex items-center justify-between">
                    <p class="text-[20px] font-medium">
                        @lang('rma::app.shop.view-guest-rma.conversations') ({{ count($messages) }})
                    </p>
                </div>

                @foreach($messages as $key => $message)
                    <div class="message {{ $message->is_admin ? 'light' : 'darker' }}" style="padding: 10px; margin: 10px; background-color: {{ $message->is_admin ? '#F0F0F0' : '#EFEFEF' }}; border-radius: 10px;">
                        <div class="title" style="text-align:{{ $message->is_admin ? 'left' : 'right' }}">
                            @lang('rma::app.shop.conversation-texts.by')
                            <strong>
                                @if ($message->is_admin == 1)
                                    @lang('rma::app.shop.view-guest-rma.admin')
                                @elseif ($message->is_admin == 0)
                                    @lang('rma::app.shop.view-guest-rma.guest')
                                @endif
                            </strong>

                            <div>
                                @lang('rma::app.shop.conversation-texts.on')

                                {{ date("F j, Y, h:i:s A" ,strtotime($message->created_at)) }}
                            </div>
                        </div>

                        <div class="value" style="margin-top:10px;word-break: break-all;text-align:{{ $message->is_admin ? 'left' : 'right' }}">
                            {{ $message->message }}
                        </div>
                    </div>
                @endforeach

                <div class="mt-2">
                    {!! $messages->links('pagination::tailwind') !!}
                </div>
                <br>
                @endif

                <!-- Send message -->
                <div class="flex items-center justify-between">
                    <p class="text-[20px] font-medium">
                        @lang('rma::app.shop.view-guest-rma.send-message')
                    </p>
                </div>
                <br>
                
                <div class="required">
                    @lang('rma::app.admin.sales.rma.all-rma.view.enter-message')
                </div>

                <x-shop::form
                    id="form-2"
                    :action="route('rma.customer.send_message')"
                >
                    <input
                        type="hidden"
                        name="is_admin"
                        value="0"
                    />

                    <input
                        type="hidden"
                        name="rma_id"
                        value="{{ $rmaData['id'] }}"
                    />

                    <x-shop::form.control-group>
                        <div class="bg-white !pl-[0px] !pt-[10px]">
                            <x-shop::form.control-group.control
                                type="textarea"
                                name="message"
                                class="!mb-[5px] px-[20px] py-[20px]"
                                rules="required"
                                maxlength="250"
                            >
                            </x-shop::form.control-group.control>

                            <x-shop::form.control-group.error
                                class="flex"
                                control-name="message"
                            >
                            </x-shop::form.control-group.error>
                        </div>
                    </x-shop::form.control-group>

                    <button
                        type="submit"
                        class="primary-button m-0 block w-max rounded-[18px] px-[43px] py-[11px] text-center text-base"
                        name="form-2"
                    >
                        @lang('rma::app.shop.view-guest-rma.send-message-btn')
                    </button>
                </x-shop::form>
            </div>
        </script>

        <script type="module">
            app.component('option-wrapper', {
                template: '#options-template',

                inject: ['$validator'],

                methods: {
                    validateForm(scope) {
                        if (this.validated) {
                            document.getElementById('check-form').submit();
                        }

                        if (! this.validated) {
                            this.error = true;
                        }

                        var this_this = this;

                        this.$validator.validateAll(scope).then((result) => {
                            if (result) {
                                if (scope == 'form-1') {
                                    document.getElementById('form-1').submit();
                                } else if (scope == 'form-2') {
                                    document.getElementById('form-2').submit();
                                }
                            }
                        });
                    }
                }
            })
        </script>
    @endpush    
</x-shop::layouts>