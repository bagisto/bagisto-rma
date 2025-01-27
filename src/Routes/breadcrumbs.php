<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

/**
 * Rma routes.
 */
Breadcrumbs::for('rma', function (BreadcrumbTrail $trail) {
    $trail->parent('account');

    $trail->push(trans('rma::app.shop.customer-rma-index.heading'), route('rma.customers.all-rma'));
});


Breadcrumbs::for('rma.create', function (BreadcrumbTrail $trail) {
    $trail->parent('rma');

    $trail->push(trans('rma::app.shop.customer-rma-index.create'), route('rma.customers.create'));
});

Breadcrumbs::for('rma.view', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('rma');

    $trail->push(trans('rma::app.shop.customer-rma-index.view'), route('rma.customers.all-rma'));
});