@component('shop::emails.layout')
    <!-- Title -->
    <div style="margin-bottom: 34px;">
        <span style="font-size: 22px;font-weight: 600;color: #121A26">
            @lang('rma::app.mail.status.title')
        </span><br>

        <!-- Customer name -->
        <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
            @lang('rma::app.mail.status.heading', ['name' => $rmaStatus['name']]),👋
        </p>

        <!-- RMA Id -->
        <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
            @lang('rma::app.mail.status.your-rma-id')
            @lang('rma::app.mail.status.status-change', [
                'id' => '<a href="' . route('rma.customer.view', $rmaStatus['rma_id']) . '"style="color: #0041FF; font-weight: bold;">#' . $rmaStatus['rma_id'] . '</a>',
            ])
            @lang('rma::app.mail.status.status-change', [
                'id' => $rmaStatus['rma_id'],
            ])
        </p>

        <!-- status -->
        <div class="mb-20 mt-20 flex flex-row justify-between">
            <div style="line-height: 25px;">
                <div class="text-base font-bold" style="color: #242424;">
                    @lang('rma::app.mail.status.status') : {{ $rmaStatus['rma_status'] }}
                </div>
            </div>
        </div><br><br><br>
    </div>
@endcomponent