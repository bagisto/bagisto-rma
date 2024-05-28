<?php

return [
    [
        'key'   => 'sales.rma',
        'name'  => 'rma::app.admin.components.layouts.sidebar.rma',
        'route' => 'admin.sales.rma.index',
        'sort'  => 6,
    ], [
        'key'   => 'sales.rma.index',
        'name'  => 'rma::app.admin.sales.rma.index.rma-title',
        'route' => 'admin.sales.rma.index',
        'sort'  => 1,
    ], [
        'key'   => 'sales.rma.reason',
        'name'  => 'rma::app.admin.sales.rma.index.reason-title',
        'route' => 'admin.sales.rma.reason.index',
        'sort'  => 2,
    ], [
        'key'   => 'sales.rma.create',
        'name'  => 'rma::app.admin.sales.rma.index.create-rma-title',
        'route' => 'admin.sales.rma.create',
        'sort'  => 3,
    ],
];
