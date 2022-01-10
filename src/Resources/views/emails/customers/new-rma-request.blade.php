@component('shop::emails.layouts.master')

<div style="text-align: center;">
    <a href="{{ config('app.url') }}">
        <img src="{{ bagisto_asset('images/logo.svg') }}">
    </a>
</div>


<div style="padding: 30px;">
    <div style="font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 34px;">
        <span style="font-weight: bold;">
            {{ __('rma::app.mail.customer-rma-create.heading') }} !
        </span> <br>

        <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
            {{ __('rma::app.mail.customer-rma-create.hello', ['name' => $customerRmaData['name']]) }},
        </p>

        <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
            {!! __('rma::app.mail.customer-rma-create.greeting', [
            'order_id' => '<a href="' . route('customer.orders.view', $customerRmaData['order_id']) . '"
                style="color: #0041FF; font-weight: bold;">#' . $customerRmaData['order_id'] . '</a>',
            ])
            !!}
        </p>

        <div style="font-weight: bold;font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 20px !important;">
            {{ __('rma::app.mail.customer-rma-create.summary') }}
        </div>
    </div>


    <div style="display: flex;flex-direction: row;margin-top: 20px;justify-content: space-between;margin-bottom: 20px;">
        <div style="line-height: 25px;">
            <div style="font-weight: bold;font-size: 16px;color: #242424;">
                {{ __('rma::app.mail.customer-rma-create.rma-id') }}
            </div>

            <div>
                {{ $customerRmaData['rma_id'] }}
            </div>

            <div style="font-weight: bold;font-size: 16px;color: #242424">
                {{ __('rma::app.mail.customer-rma-create.order-status') }}
            </div>

            <div>
                {{ $customerRmaData['order_status'] }}
            </div>
        </div>

        <div style="line-height: 25px;">
            <div style="font-weight: bold;font-size: 16px;color: #242424;">
                {{ __('rma::app.mail.customer-rma-create.order-id') }}
            </div>
            <div>
                {{ '#'.$customerRmaData['order_id'] }}
            </div>

            <div style="font-weight: bold;font-size: 16px;color: #242424;">
                {{ __('rma::app.mail.customer-rma-create.resolution-type') }}
            </div>

            <div style="font-size: 16px; color: #242424;">
                {{ $customerRmaData['resolution'] }}
            </div>

        </div>
    </div>

    <div style="font-weight: bold;font-size: 16px;color: #242424; margin-bottom:5px;">
        {{ __('rma::app.mail.customer-rma-create.additional-information') }}
    </div>

    <div>
        {!! $customerRmaData['information'] !!}
    </div>

    <div style="font-weight: bold;font-size: 16px;color: #242424; margin-top:30px;">
        {{ __('rma::app.mail.customer-rma-create.requested-rma-product') }}
    </div>
    <div style="width: 100%;overflow-x: auto;">

        <table style="width: 100%;border-collapse: collapse;text-align: left; margin-top: 10px;">
            <thead>
                <tr>
                    @php($lang = Lang::get('rma::app.mail.customer-data-table-heading'))
                    @foreach($lang as $tableHeading)
                    <th style="font-weight: 700;padding: 12px 10px;background: #f8f9fa;color: #3a3a3a;">
                        {{ $tableHeading }}
                    </th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
                @foreach($customerRmaData['order_items'] as $key => $ordered_item)
                    <tr>
                        <td style="padding: 10px;border-bottom: solid 1px #d3d3d3;color: #3a3a3a;vertical-align: top;">
                            {!! $ordered_item->name !!}
                        </td>
                        <td style="padding: 10px;border-bottom: solid 1px #d3d3d3;color: #3a3a3a;vertical-align: top;">
                            @if($ordered_item->type == 'configurable')
                                @foreach ($skus as $k => $sku)
                                    @if($sku['parent_id'] == $ordered_item->id)
                                        {!! $sku['sku'] !!}
                                    @endif
                                @endforeach
                            @else
                                {!! $ordered_item->sku !!}
                            @endif
                        </td>
                        <td style="padding: 10px;border-bottom: solid 1px #d3d3d3;color: #3a3a3a;vertical-align: top;">
                            {!! $customerRmaData['quantity'][$ordered_item->id] !!}
                        </td>

                        <td style="padding: 10px;border-bottom: solid 1px #d3d3d3;color: #3a3a3a;vertical-align: top;">
                            @if(count( $customerRmaData['reasons']) > 1)
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
    <div
        style="margin-top: 40px;font-size: 16px;color: #5E5E5E;line-height: 24px;display: block; width: 100%; float: left">

        <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
            {!! __('shop::app.mail.order.help', [
            'support_email' => '<a style="color:#0041FF" href="mailto:' . config('mail.from.address') . '">' .
                config('mail.from.address'). '</a>'
            ])
            !!}
        </p>

        <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
            {{ __('rma::app.mail.customer-rma-create.thank-you') }}
        </p>
    </div>

</div>

@endcomponent
