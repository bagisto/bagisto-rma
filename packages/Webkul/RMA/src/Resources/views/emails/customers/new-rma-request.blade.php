@component('shop::emails.layout')
<!-- heading --> 
<div style="margin-bottom: 34px;">
    <span style="font-size: 22px;font-weight: 600;color: #121A26">
        @lang('rma::app.mail.customer-rma-create.heading') !
    </span> <br>

    <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
        @lang('rma::app.mail.customer-rma-create.hello', ['name' => $customerRmaData['name']]),👋
    </p>

    <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
        @lang('rma::app.mail.customer-rma-create.greeting', [
        'order_id' => '<a href="' . route('customer.orders.view', $customerRmaData['order_id']) . '"
            class="font-bold text-blue-600">#' . $customerRmaData['order_id'] . '</a>',
        ])
    </p>

    <!-- summary --> 
    <div class="mb-10 text-lg font-bold text-gray-800">
        @lang('rma::app.mail.customer-rma-create.summary')
    </div>

    <!-- RMA id --> 
    <div class="mb-20 mt-20 flex flex-row justify-between">
        <div class="line-height-25">
            <div class="text-base font-bold text-gray-800">
                @lang('rma::app.mail.customer-rma-create.rma-id')
            </div>

            <div>
                {{ $customerRmaData['rma_id'] }}
            </div>

            <!-- order status --> 
            <div class="text-base font-bold text-gray-800">
                @lang('rma::app.mail.customer-rma-create.order-status')
            </div>

            <div>
                {{ $customerRmaData['order_status'] }}
            </div>
        </div>

        <!-- order Id --> 
        <div class="line-height-25">
            <div class="text-base font-bold text-gray-800">
                @lang('rma::app.mail.customer-rma-create.order-id')
            </div>
            <div>
                {{ '#'.$customerRmaData['order_id'] }}
            </div>

            <!-- Resolution Type --> 
            <div class="text-base font-bold text-gray-800">
                @lang('rma::app.mail.customer-rma-create.resolution-type')
            </div>

            <div class="text-base text-gray-800">
                {{ $customerRmaData['resolution'] }}
            </div>

        </div>
    </div>

    <!-- Additional Information --> 
    <div class="mb-5 text-base font-bold text-gray-800">
        @lang('rma::app.mail.customer-rma-create.additional-information')
    </div>

    <div>
        {!! $customerRmaData['information'] !!}
    </div>

    <div class="mt-10 text-base font-bold text-gray-800">
        @lang('rma::app.mail.customer-rma-create.requested-rma-product')
    </div>
    
    <div class="w-full overflow-x-auto">

        <table class="mt-2 w-full border-collapse text-left">
            <thead>
                <tr>
                    @php($lang = Lang::get('rma::app.mail.customer-data-table-heading'))
                    @foreach($lang as $tableHeading)
                    <th class="bg-gray-100 px-4 py-3 font-semibold text-gray-700">
                        {{ $tableHeading }}
                    </th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
                @foreach($customerRmaData['order_items'] as $key => $ordered_item)
                    <tr>
                        <td class="border-b border-gray-200 px-4 py-3 text-gray-700">
                            {!! $ordered_item->name !!}
                        </td>
                        
                        <td class="border-b border-gray-200 px-4 py-3 text-gray-700">
                            @if ($ordered_item->type == 'configurable')
                                @foreach ($skus as $k => $sku)
                                    @if ($sku['parent_id'] == $ordered_item->id)
                                        {!! $sku['sku'] !!}
                                    @endif
                                @endforeach
                            @else
                                {!! $ordered_item->sku !!}
                            @endif
                        </td>
                        
                        <td class="border-b border-gray-200 px-4 py-3 text-gray-700">
                            {!! $customerRmaData['quantity'][$ordered_item->id] !!}
                        </td>

                        <td class="border-b border-gray-200 px-4 py-3 text-gray-700">
                            @if (count( $customerRmaData['reasons']) > 1)
                                {!! $customerRmaData['reasons'][$key] !!}
                            @else
                                {!! $customerRmaData['reasons'][0] !!}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br><br><br>
</div>
@endcomponent