# Mobile Money Payments API

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Style CI][ico-style-ci]][link-style-ci]
[![Circle CI][ico-circle-ci]][link-circle-ci]
[![Total Downloads][ico-downloads]][link-downloads]

**Kenya** Mobile Payments API
## About Dervis Group Limited

[Dervis Group LLC](https://dervisgroup.com) is a consultation and software providing company in Kenya dedicated to provide robust and fully functional sophisticated software solutions. Our main area of expertise is software development. We have also brought many stakeholders in board to offer solutions for mobile, cloud, Business Intelligence and  Technology Infrastructure. We focus on delivering true, measurable business value to our clients. We have a passion for customer satisfaction and are dedicated to delivering dependable and reliable solutions that exceed client expectations.

## Introduction

This is a *Laravel 5.5+* package for mobile-money and Equity API. 
The API allows a merchant to initiate C2B,B2C and B2B transactions including balance query and reversals.

This package includes Controllers, Migrations and Routes which simplifies everything for you.
You only need to setup a few things in the published configuration file and you are good to go.
It comes with a admin section to monitor transactions, send money via b2c and reverse transactions.

## Installation

Via Composer

``` bash
$ composer require dervisgroup/mobile-money
```

## Usage

This package does not require you to register any service providers or aliases.

First, publish configuration files
```bash
php artisan vendor:publish --provider="DervisGroup\Pesa\PesaServiceProvider"
```
This will publish the M-mobile-money configuration file into the `config` directory as
`pesa.php`. 
This file contains all the configurations required to use the package. 

Go to [Safaricom Developer Portal](https://developer.safaricom.co.ke) to get app credentials.

More documentation is in progress.

Need help integrating?  Mpesa, Equitel, RTGS, SWIFT, VISA, MASTERRCARD? Contact support below

### Register C2B Callback Url

> Note: Please use https. You will get weird errors if use non secure URL's for callback

If you have setup `env('APP_URL)` in your ``.env`` you can used predefined endpoints in your published config file.
There are routes already registered to handle the incoming request.
```bash
php artisan mpesa:register_url
```
This will prompt you for the endpoints and send the for registration

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email sam@dervisgroup.com instead of using the issue tracker.

## Support

- [Samuel Dervis <sam@dervisgroup.com>][link-author]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/dervisgroup/mobile-money.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/dervisgroup/mobile-money/master.svg?style=flat-square
[ico-style-ci]: https://styleci.io/repos/122853134/shield?branch=master
[ico-circle-ci]: https://circleci.com/gh/dervisgroup/mobile-money.png?style=shield
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/dervisgroup/mobile-money.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/dervisgroup/mobile-money.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/dervisgroup/mobile-money.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/dervisgroup/mobile-money
[link-travis]: https://travis-ci.org/dervisgroup/mobile-money
[link-circle-ci]: https://circleci.com/gh/dervisgroup/mobile-money
[link-scrutinizer]: https://scrutinizer-ci.com/g/dervisgroup/mobile-money/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/dervisgroup/mobile-money
[link-downloads]: https://packagist.org/packages/dervisgroup/mobile-money
[link-style-ci]: https://styleci.io/repos/122853134
[link-author]: https://github.com/dervisgroup
[link-contributors]: ../../contributors
