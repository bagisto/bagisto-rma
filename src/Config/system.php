<?php

return [
    [
        'key'  => 'sales.rma',
        'name' => 'rma::app.admin.configuration.index.sales.rma.title',
        'info' => 'rma::app.admin.configuration.index.sales.rma.info',
        'icon' => 'settings/store-information.svg',
        'sort' => 6,
    ], [
        'key'    => 'sales.rma.setting',
        'name'   => 'rma::app.admin.configuration.index.sales.rma.setting.title',
        'info'   => 'rma::app.admin.configuration.index.sales.rma.setting.info',
        'fields' => [
            [
                'name'          => 'enable_rma',
                'title'         => 'rma::app.admin.configuration.index.sales.rma.enable',
                'type'          => 'boolean',
                'channel_based' => true,
                'locale_based'  => true,
            ], [
                'name'          => 'default_allow_days',
                'title'         => 'rma::app.admin.configuration.index.sales.rma.default-allow-days',
                'type'          => 'text',
                'validation'    => 'required|numeric',
                'channel_based' => true,
                'locale_based'  => true,
            ], [
                'name'          => 'enable_rma_for_pending_order',
                'title'         => 'rma::app.admin.configuration.index.sales.rma.allow-new-request-for-pending-order',
                'type'          => 'boolean',
                'channel_based' => true,
                'locale_based'  => true,
            ], [
                'name'          => 'enable_rma_for_digital_products',
                'title'         => 'rma::app.admin.configuration.index.sales.rma.allow-rma-for-digital-product',
                'type'          => 'boolean',
                'channel_based' => true,
                'locale_based'  => true
            ],
        ],
    ],
];