<?php

return [
    [
        'key' => 'sales.rma',
        'name' => 'rma::app.admin.layouts.rma',
        'route' => 'admin.rma.index',
        'sort' => 6
    ],
    [
        'key' => 'sales.rma.index',
        'name' => 'rma::app.admin.rma-tab.heading',
        'route' => 'admin.rma.index',
        'sort' => 1,
        'icon-class' => '',
    ],
    [
        'key' => 'sales.rma.reason',
        'name' => 'rma::app.admin.tabs.reasons',
        'route' => 'admin.rma.reason.index',
        'sort' => 2,
        'icon-class' => '',
    ],
];
