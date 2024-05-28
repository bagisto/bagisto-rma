<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

/**
 * Rma routes.
 */
Breadcrumbs::for('rma', function (BreadcrumbTrail $trail) {
    $trail->push(trans('rma::app.shop.customer-rma-index.heading'), route('rma.customers.allrma'));
});
