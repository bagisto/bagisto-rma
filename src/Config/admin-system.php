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
                'info'          => 'rma::app.admin.configuration.index.sales.rma.days-info',
            ], [
                'name'          => 'return-policy',
                'title'         => 'rma::app.admin.configuration.index.sales.rma.return-policy',
                'type'          => 'textarea',
                'validation'    => 'required',
                'channel_based' => true,
                'locale_based'  => true
            ], [
                'name'          => 'allowed-file-extension',
                'title'         => 'rma::app.admin.configuration.index.sales.rma.allowed-file-extension',
                'type'          => 'text',
                'validation'    => 'required',
                'channel_based' => true,
                'locale_based'  => true,
                'info'          => 'rma::app.admin.configuration.index.sales.rma.allowed-info',
            ], [
                'name'          => 'new-rma-message-to-customer',
                'title'         => 'rma::app.admin.configuration.index.sales.rma.new-rma-message-to-customer',
                'type'          => 'textarea',
                'validation'    => 'required',
                'channel_based' => true,
                'locale_based'  => true
            ], [
                'name'          => 'allowed-new-rma-request-for-cancelled-request',
                'title'         => 'rma::app.admin.configuration.index.sales.rma.allowed-request-cancelled-request',
                'type'          => 'select',
                'validation'    => 'required',
                'default'       => 'yes',
                'options'       => [
                    [
                        'title' => 'rma::app.admin.configuration.index.sales.rma.yes',
                        'value' => 'yes',
                    ], [
                        'title' => 'rma::app.admin.configuration.index.sales.rma.no',
                        'value' => 'no',
                    ],
                ],
                'channel_based' => true,
            ], [
                'name'          => 'allowed-new-rma-request-for-declined-request',
                'title'         => 'rma::app.admin.configuration.index.sales.rma.allowed-request-declined-request',
                'type'          => 'select',
                'validation'    => 'required',
                'default'       => 'yes',
                'options'       => [
                    [
                        'title' => 'rma::app.admin.configuration.index.sales.rma.yes',
                        'value' => 'yes',
                    ], [
                        'title' => 'rma::app.admin.configuration.index.sales.rma.no',
                        'value' => 'no',
                    ],
                ],
                'channel_based' => true,
            ], [
                'name'          => 'allowed-rma-for-product',
                'title'         => 'rma::app.admin.configuration.index.sales.rma.allowed-rma-for-product',
                'type'          => 'select',
                'validation'    => 'required',
                'default'       => 'all',
                'options'       => [
                    [
                        'title' => 'rma::app.admin.configuration.index.sales.rma.all-products',
                        'value' => 'all',
                    ], [
                        'title' => 'rma::app.admin.configuration.index.sales.rma.specific-products',
                        'value' => 'specific',
                    ],
                ],
                'channel_based' => true,
            ], [
                'name'          => 'select-allowed-order-status',
                'title'         => 'rma::app.admin.configuration.index.sales.rma.select-allowed-order-status',
                'type'          => 'select',
                'validation'    => 'required',
                'default'       => 'complete',
                'options'       => [
                    [
                        'title' => 'rma::app.admin.configuration.index.sales.rma.complete',
                        'value' => 'complete',
                    ], [
                        'title' => 'rma::app.admin.configuration.index.sales.rma.all-status',
                        'value' => 'all',
                    ],
                ],
                'channel_based' => true,
            ], [
                'name'          => 'select-allowed-product-type',
                'title'         => 'Allow Product Type For RMA',
                'type'          => 'multiselect',
                'options'       => [
                    [
                        'title' => 'product::app.type.simple',
                        'value' => 'simple',
                    ], [
                        'title' => 'product::app.type.configurable',
                        'value' => 'configurable',
                    ], [
                        'title' => 'product::app.type.downloadable',
                        'value' => 'downloadable',
                    ], [
                        'title' => 'product::app.type.virtual',
                        'value' => 'virtual',
                    ], [
                        'title' => 'product::app.type.bundle',
                        'value' => 'bundle',
                    ], [
                        'title' => 'product::app.type.grouped',
                        'value' => 'grouped',
                    ],
                ],

                'channel_based' => true,
            ],
        ],
    ],
];