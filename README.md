# mobile-money API

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Style CI][ico-style-ci]][link-style-ci]
[![Circle CI][ico-circle-ci]][link-circle-ci]
[![Total Downloads][ico-downloads]][link-downloads]

**Kenya** Mobile Payments API

## Introduction

This is a *Laravel 5.5+* package for M-mobile-money and Equity API. 
The API allows a merchant to initiate C2B,B2C and B2B transactions include balance query and reversals.

This package includes Controllers, Migrations and Routes which simplifies everything for you.
You only need to setup a few this in the published configuration file and you are good to go.

## Installation

Via Composer

``` bash
$ composer require dervisgroup/mobile-money
```

## Usage

This package does not require you to register any service providers or aliases.

First, publish configuration files
```bash
php artisan vendor:publish --provider="DervisGroup\mobile-money\mobile-moneyServiceProvider"
```
This will publish the M-mobile-money configuration file into the `config` directory as
`mobile-money.php`. 
This file contains all the configurations required to use the package. 

Go to [Safaricom Developer Portal](https://developer.safaricom.co.ke) to get app credentials.

### Register C2B Callback Url

> Note: Please use https. You will get weird errors if use non secure URL's for callback

If you have setup `env('APP_URL)` in your ``.env`` you can used predefined endpoints in your published config file.
There are routes already registered to handle the incoming request.
```bash
php artisan mobile-money:register_url
```
This will prompt you for the endpoints and send the for registration

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email sam@dervisgroup.com instead of using the issue tracker.

## Credits

- [Samuel Dervis][link-author]
- [All Contributors][link-contributors]

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
