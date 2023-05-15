<p align="center">
  <img src="https://info.mollie.com/hubfs/github/magento-2/logo.png" width="128" height="128"/>
</p>

# Mollie Analytics Addon for Magento 2.3.x and higher

This plugin is an **addon** on the [Mollie Magento 2 payment module](https://github.com/mollie/magento2/) and can't be installed seperatly without the Mollie Payment plugin installed.

## Installation
We recommend that you make a backup of your webshop files, as well as the database.

Step-by-step to install the Magento® 2 extension through Composer:

1.	Make sure the [Mollie Magento 2 payment module](https://github.com/mollie/magento2/) is installed.
2.	Connect to your server running Magento® 2 using SSH or other method (make sure you have access to the command line).
3.	Locate your Magento® 2 project root.
4.	Install the Magento® 2 extension through composer and wait till it's completed:
```
composer require mollie/magento2-analytics
```
4.	Once completed run the Magento® module enable command:
```
bin/magento module:enable Mollie_Analytics
```
5.	After that run the Magento® upgrade and clean the caches:
```
php bin/magento setup:upgrade
php bin/magento cache:flush
```
6.  If Magento® is running in production mode you also need to redeploy the static content:
```
php bin/magento setup:static-content:deploy
```

## Usage

When enabled, this module will extract the client ID from the Google Analytics cookie and save it. When the user finishes the transaction this will get appended to the success URL: `&clientId=<value>`. You can retrieve this by using javascript:

```javascript
const urlParams = new URLSearchParams(window.location.search);
const clientId = urlParams.get('clientId');

console.log('Receive client id:', clientId);
```

Another way to retrieve the ID is by using the repository:

```php
class DoSomeStuff {
    /**
     * @var \Mollie\Analytics\Api\AnalyticsRepositoryInterface
     */
    private $repository;

    public function __construct(
        \Mollie\Analytics\Api\AnalyticsRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function getClientId(int $cartId): ?string
    {
        return $this->repository->getByCartId($cartId)->getClientId();
    }
}
```

## License ##
[BSD (Berkeley Software Distribution) License](http://www.opensource.org/licenses/bsd-license.php).
Copyright (c) 2011-2021, Mollie B.V.
