# Serato User Profile PHP SDK

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


## Using Docker to develop this library.

```bash
# Run the `php` service using the default PHP version (8.1)
# By default this run `.docker/setup.sh` which will install composer
# and open a bash shell.
docker-compose run --rm  php

# Provide an alternative PHP version via the PHP_VERSION environment variable.
PHP_VERSION=7.1 docker-compose run --rm  php
```

### Test and build steps in a running container with an interactive shell

```bash
$ php vendor/bin/phpcs
$ php vendor/bin/phpstan analyse
$ php vendor/bin/phpunit
```
