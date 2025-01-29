<?php

return [
    [
        'key'   => 'sales.rma-reason',
        'name'  => 'rma::app.admin.acl.title',
        'route' => 'admin.sales.rma.index',
        'sort'  => 2,
    ], [
        'key'   => 'sales.rma-reason.edit',
        'name'  => 'rma::app.admin.acl.edit',
        'route' => 'admin.sales.rma.reason.edit',
        'sort'  => 1,
    ], [
        'key'   => 'sales.rma-reason.delete',
        'name'  => 'rma::app.admin.acl.delete',
        'route' => 'admin.sales.rma.reason.delete',
        'sort'  => 2,
    ], [
        'key'   => 'sales.rma-reason.mass-delete',
        'name'  => 'rma::app.admin.acl.mass-delete',
        'route' => 'admin.sales.rma.mass_delete',
        'sort'  => 2,
    ], [
        'key'   => 'sales.rma-reason.mass-update',
        'name'  => 'rma::app.admin.acl.mass-update',
        'route' => 'admin.sales.rma.reason.mass_update',
        'sort'  => 2,
    ],
];