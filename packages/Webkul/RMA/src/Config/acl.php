<?php

return [
    [
        'key'   => 'rma.reason.edit',
        'name'  => 'rma::app.acl.edit',
        'route' => 'admin.sales.rma.reason.edit',
        'sort'  => 1,
    ], [
        'key'   => 'rma.reason.delete',
        'name'  => 'rma::app.acl.delete',
        'route' => 'admin.sales.rma.reason.delete',
        'sort'  => 2,
    ], [
        'key'   => 'rma.reason.mass-delete',
        'name'  => 'rma::app.acl.mass-delete',
        'route' => 'admin.sales.rma.mass_delete',
        'sort'  => 2,
    ], [
        'key'   => 'rma.reason.mass-update',
        'name'  => 'rma::app.acl.mass-update',
        'route' => 'admin.sales.rma.reason.mass_update',
        'sort'  => 2,
    ],
];
