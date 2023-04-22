<p align="center">
    <img src="https://bagisto.com/wp-content/themes/bagisto/images/logo.png" />
    <h2 align="center">Bagisto RMA</h2>
</p>

<p align="center">
    <img alt="Packagist Downloads" src="https://img.shields.io/packagist/dt/bagisto/bagisto-rma"> <img alt="GitHub" src="https://img.shields.io/github/license/bagisto/bagisto-rma">
</p>

# Introduction

Bagisto RMA will help customers to request for return / cancel / exchange products during the stipulated time-period. If admin is satisfied with the RMA reason of the customer then admin could proceed the request of cancel, return or exchange.

- Customers can request RMA to cancel order.
- Customers can generate RMA for Return/Exchange.
- Customer will be able to send message over the request of RMA.
- Dynamic selection of items for an order for making RMA request.
- Admin will create the RMA reasons.
- Admin will be able to send message over the request of RMA.
- Admin can see the list of all the RMA.
- Admin can solve the Requested RMA for products.
- Guest user can request a RMA to cancel order.
- Guest user can generate RMA for Return/Exchange.
- Admin can set “Default Allowed Days” to create RMA by buyer.
- Supported product types are Bundle product, Grouped product, Configurable product, Simple product.


## Requirements:

- **Bagisto**: v1.3.3

## Installation :
- Run the following command
```
composer require bagisto/bagisto-rma
```

- Goto config/concord.php file and add following line under 'modules'
```php
\Webkul\RMA\Providers\RepositoryServiceProvider::class
```

- Run the following command to complete the setup
```
php artisan rma:install
```

## Configuartion:
- Enable the Guest user RMA from the Admin Panel:

    - For Default theme place this url in 

    ```
    Admin->Settings->Channels->Edit Channel->Footer Content->goto Code view->Add this line of url as you want
    ```

    ```
    <li><a href="{!! url('guest/login') !!}">RMA Returns</a></li>
    ```

    - For Velocity theme place this url in 

    ```
    Admin->Velocity->Meta Data->Footer->Footer Middle Content->goto Code view->Add this line of url as you want
    ```

    ```
    <li><a href="{!! url('guest/login') !!}">RMA Returns</a></li>
    ```

> That's it, now just execute the project on your specified domain.
