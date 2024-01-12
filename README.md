# Serato User Profile PHP SDK[![Build Status](https://img.shields.io/travis/serato/web-sup-php-sdk.svg)](https://travis-ci.org/serato/web-sup-php-sdk)

[![Latest Stable Version](https://img.shields.io/packagist/v/serato/sup-sdk-php.svg)](https://packagist.org/packages/serato/sup-sdk-php)

A PHP library for sending user profile attributes and events to the Serato
User Profile application.

## Adding to a project via composer.json

To include this library in a PHP project add the following line to the project's
`composer.json` file in the `require` section:

```json
{
	"require": {
		"serato/sup-sdk-php": "dev-master"
	}
}
```
See [Packagist](https://packagist.org/packages/serato/sup-sdk-php) for a list of all 
available versions.

## Requirements

This library requires PHP 7.1 or greater.

## Style guide

Please ensure code adheres to the [PHP-FIG PSR-2 Coding Style Guide](http://www.php-fig.org/psr/psr-2/)

Use [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer/wiki) to validate your code against coding standards:

```bash
$ ./vendor/bin/phpcs
```

## PHPStan

Use PHPStan for static code analysis:

```bash
$ vendor/bin/phpstan analyse
```

## Unit tests

Configuration for PHPUnit is defined within [phpunit.xml](phpunit.xml).

To run tests:

```bash
$ php vendor/bin/phpunit
```

## Integration tests

Integration tests with AWS services can be run via phpinit:

```bash
$ php vendor/bin/phpunit --group aws-integration
```

## Generate PHP API documentation

The [Sami PHP API documentation generator](https://github.com/FriendsOfPHP/sami)
can be used to generate PHP API documentation.

To generate documentation:

```bash
$ vendor/bin/sami.php update phpdoc.php
```

Documentation is generated into the `docs\php` directory.

Configuration for Sami is contained within [phpdoc.php](phpdoc.php).

## Generate code coverage report

If you have [phpdbg](http://phpdbg.com/) installed you can generate a code coverage report with phpunit:

```bash
$ phpdbg -qrr ./vendor/bin/phpunit --coverage-html reports/coverage
```

Reports are generated in the `reports` directory.
