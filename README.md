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

### 2. Requirements:

* **Bagisto**: v2.0.0

### 3. Installation:

* Unzip the respective extension zip and then merge "packages" folder into project root directory.

* Goto config/app.php file and add following line under 'providers'

~~~
Webkul\RMA\Providers\RMAServiceProvider::class,
~~~

* Goto composer.json file and add following line under 'psr-4'

~~~
 "Webkul\\RMA\\": "packages/Webkul/RMA/src"
~~~

* Run these commands below to complete the setup

~~~
composer dump-autoload
~~~
~~~
php artisan optimize
~~~
~~~
php artisan migrate
~~~
~~~
php artisan route:clear
~~~
~~~
php artisan config:cache
~~~
~~~
php artisan db:seed --class=Webkul\\RMA\\Database\\Seeders\\DatabaseSeeder

If your are windows user then run the below command-

php artisan db:seed --class="Webkul\RMA\Database\Seeders\DatabaseSeeder"
~~~
~~~
-> php artisan vendor:publish --force --provider="Webkul\RMA\Providers\RMAServiceProvider"

-> php artisan vendor:publish --force --all
~~~
