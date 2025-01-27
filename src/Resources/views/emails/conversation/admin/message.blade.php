@component('shop::emails.layout')
    <!-- Title -->
    <div style="margin-bottom: 34px;">
        <span style="font-size: 22px;font-weight: 600;color: #121A26">
            @lang('rma::app.mail.seller-conversation.title')
        </span><br>

        <!-- Heading -->
        <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
            @lang('rma::app.mail.seller-conversation.heading', ['name' => $conversation['customerName']]),👋
        </p>

        <!-- conversation -->
        <p class="text-base text-gray-600">
            @lang('rma::app.mail.seller-conversation.quotes')
        </p>

        <div class="mb-20 mt-20 flex flex-row justify-between">
            <div class="line-height-25">
                <!-- message -->
                <div class="text-base font-bold text-gray-800">
                    @lang('rma::app.mail.seller-conversation.message')
                </div>

                <div>
                    {{ $conversation['message'] }}
                </div>
            </div>
        </div><br><br><br>
    </div>
@endcomponent