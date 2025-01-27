<p align="center">
    <img src="https://bagisto.com/wp-content/themes/bagisto/images/logo.png" />
    <h2 align="center">Bagisto RMA</h2>
</p>

<p align="center">
    <img alt="Packagist Downloads" src="https://img.shields.io/packagist/dt/bagisto/bagisto-rma"> <img alt="GitHub" src="https://img.shields.io/github/license/bagisto/bagisto-rma">
</p>

### 1. Introduction:

Bagisto RMA will help customers to request for return / cancel / exchange products during the stipulated time-period. If admin is satisfied with the RMA reason of the customer then admin could proceed the request of cancel, return or exchange.

* Customers can request RMA to cancel order.
* Customers can generate RMA for Return/Exchange.
* Customer will be able to send message over the request of RMA.
* Dynamic selection of items for an order for making RMA request.
* Admin will create the RMA reasons.
* Admin will be able to send message over the request of RMA.
* Admin can see the list of all the RMA.
* Admin can solve the Requested RMA for products.
* Guest user can request a RMA to cancel order.
* Guest user can generate RMA for Return/Exchange.
* Admin can set “Default Allowed Days” to create RMA by buyer.
* Supported product types are Bundle product, Grouped product, Configurable product, Simple product.
* The admin can manage RMA status as well as Reasons.
* The admin can select the allowed product types for RMA.
* The RMA reasons will be based on resolution types.
* Now create RMA Rules with resolution time.
* Print RMA details
* The admin can create the RMA on behalf of the customer.
* The admin can set the RMA YES/No on a particular product.
* The return/Exchange window will be visible on the “New RMA” page while creating a new RMA.
* RMA Custom Field has been added to the Create customizable fields for the RMA Request Form.
* Guest Customers can generate RMA too
* Return Policy has been added on RMA Configuration.
* "Allow File Extension" on RMA configuration that helps to added the particular type of the Extension image.
* Send and receive file attachments with the messages.
* Buyer and Admin can communicate using the RMA system.
* RMA History with Filters and Pagination.
* Show the Return Policy Page to customers.
* Using Return Quantity, the admin will return the RMA quantity to their store.
* The customer and the admin receive notification emails.

### 2. Requirements:

* **Bagisto**: v2.2.3
* **RMA**: v2.2.3

### 3. Installation:

#### Run the following command

```bash
    composer require bagisto/bagisto-rma
```

#### Goto config/app.php file and add following line under 'providers'

```php
Webkul\RMA\Providers\RMAServiceProvider::class,
```

#### Goto composer.json file and add following line under 'psr-4'

```json
"Webkul\\RMA\\": "packages/Webkul/RMA/src"
```

#### Run these commands below to complete the setup

```bash
composer dump-autoload

php artisan rma:install
```

> That's it, now just execute the project on your specified domain.