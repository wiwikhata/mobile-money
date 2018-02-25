# Pesa API

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Style CI][ico-style-ci]][link-style-ci]
[![Total Downloads][ico-downloads]][link-downloads]

**Kenya** Mobile Payments API

## Introduction

This is a *Laravel 5.5+* package for M-Pesa and Equity API. 
The API allows a merchant to initiate C2B,B2C and B2B transactions include balance query and reversals.

This package includes Controllers, Migrations and Routes which simplifies everything for you.
You only need to setup a few this in the published configuration file and you are good to go.

## Installation

Via Composer

``` bash
$ composer require dervisgroup/pesa
```

## Usage

This package does not require you to register any service providers or aliases.

First, publish configuration files
```bash
php artisan vendor:publish --provider="DervisGroup\Pesa\PesaServiceProvider"
```
This will publish the M-Pesa configuration file into the `config` directory as
`pesa.php`. 
This file contains all the configurations required to use the package. 

Go to [Safaricom Developer Portal](https://developer.safaricom.co.ke) to get app credentials.

### Register C2B Callback Url

> Note: Please use https. You will get weird errors if use non secure URL's for callback

If you have setup `env('APP_URL)` in your ``.env`` you can used predefined endpoints in your published config file.
There are routes already registered to handle the incoming request.
```bash
php artisan pesa:register_url
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

[ico-version]: https://img.shields.io/packagist/v/samueldervis/pesa.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/samueldervis/pesa/master.svg?style=flat-square
[ico-style-ci]: https://styleci.io/repos/122170477/shield?branch=master
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/samueldervis/pesa.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/samueldervis/pesa.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/samueldervis/pesa.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/samueldervis/pesa
[link-travis]: https://travis-ci.org/samueldervis/pesa
[link-scrutinizer]: https://scrutinizer-ci.com/g/samueldervis/pesa/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/samueldervis/pesa
[link-downloads]: https://packagist.org/packages/samueldervis/pesa
[link-style-ci]: https://styleci.io/repos/122170477
[link-author]: https://github.com/samueldervis
[link-contributors]: ../../contributors
