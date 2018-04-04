## Installation

Via Composer

``` bash
$ composer require dervisgroup/mobile-money
```

This package does not require you to register any service providers or aliases.

First, publish configuration files
```bash
php artisan vendor:publish --provider="DervisGroup\Pesa\PesaServiceProvider"
```
This will publish the M-mobile-money configuration file into the `config` directory as
`pesa.php`. 
This file contains all the configurations required to use the package. 

Go to [Safaricom Developer Portal](https://developer.safaricom.co.ke) to get app credentials.