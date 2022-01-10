<?php

return [
    [
        'key'       => 'rma',
        'name'      => 'rma::app.admin.admin-name.rma',
        'sort'      => 2
    ],  [
        'key'       => 'rma.settings',
        'name'      => 'rma::app.admin.setting.settings',
        'sort'      => 1,
    ],  [
        'key'       => 'rma.settings.general',
        'name'      => 'rma::app.admin.setting.general',
        'sort'      => 1,
        'fields'    => [
            [
                'name'          => 'enable_rma',
                'title'         => 'rma::app.admin.setting.fields.enable',
                'type'          => 'boolean',
                'channel_based' => true,
                'locale_based'  => false
            ],
            [
                'name'          => 'default_allow_days',
                'title'         => 'rma::app.admin.setting.fields.default-allow-days',
                'type'          =>  'depends',
                'depend'        => 'enable_rma:1',
                'validation'    => 'required_if:enable_rma,1',
                'channel_based' => true,
                'locale_based'  => false
            ],
            [
                'name'          => 'enable_rma_for_pending_order',
                'title'         => 'rma::app.admin.setting.fields.allow_new_request_for_pending_order',
                'type'          =>  'boolean',
                'channel_based' => true,
                'locale_based'  => false
            ],
        ],
    ],
];
