<?php

return [
    [
        'key'   => 'rma',
        'name'  => 'rma::app.admin.components.layouts.sidebar.rma',
        'route' => 'admin.sales.rma.index',
        'sort'  => 6,
        'icon'  => 'rma-icon-icon',
    ], [
        'key'   => 'rma.index',
        'name'  => 'rma::app.admin.sales.rma.index.rma-title',
        'route' => 'admin.sales.rma.index',
        'sort'  => 1,
        'icon'  => '',
    ], [
        'key'   => 'rma.create',
        'name'  => 'rma::app.admin.sales.rma.index.create-rma-title',
        'route' => 'admin.sales.rma.create',
        'sort'  => 2,
        'icon'  => '',

    ], [
        'key'   => 'rma.reason',
        'name'  => 'rma::app.admin.sales.rma.index.reason-title',
        'route' => 'admin.sales.rma.reason.index',
        'sort'  => 3,
        'icon'  => '',
    ], [
        'key'   => 'rma.rules',
        'name'  => 'rma::app.admin.sales.rma.rules.index.title',
        'route' => 'admin.sales.rma.rules.index',
        'sort'  => 4,
        'icon'  => '',
    ], [
        'key'   => 'rma.rma-status',
        'name'  => 'rma::app.admin.sales.rma.rma-status.index.title',
        'route' => 'admin.sales.rma.rma-status.index',
        'sort'  => 5,
        'icon'  => '',
    ], [
        'key'   => 'rma.cutom-field',
        'name'  => 'rma::app.admin.sales.rma.custom-field.index.title',
        'route' => 'admin.sales.rma.custom-field.index',
        'sort'  => 6,
        'icon'  => '',
    ],
];