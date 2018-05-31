# FileFetcher

[![Build Status](https://secure.travis-ci.org/JeroenDeDauw/FileFetcher.png?branch=master)](http://travis-ci.org/JeroenDeDauw/FileFetcher)
[![Code Coverage](https://scrutinizer-ci.com/g/JeroenDeDauw/FileFetcher/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/JeroenDeDauw/FileFetcher/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/JeroenDeDauw/FileFetcher/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/JeroenDeDauw/FileFetcher/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/jeroen/file-fetcher/version.png)](https://packagist.org/packages/jeroen/file-fetcher)
[![Download count](https://poser.pugx.org/jeroen/file-fetcher/d/total.png)](https://packagist.org/packages/jeroen/file-fetcher)

The philosophy behind this library is to provide a very basic interface
([`FileFetcher`](https://github.com/JeroenDeDauw/FileFetcher/blob/master/src/FileFetcher.php)) that while insufficient for
plenty of use cases, is ideal for a great many, in particular replacing procedural `file_get_contents` calls.
The provided implementations are to facilitate testing and common generic tasks around the actual file
fetching. You are encouraged to create your own core file fetching implementation in your codebase,
presumably an adapter to a library that focuses on this task such as [Guzzle](http://docs.guzzlephp.org/en/latest/).

## Usage

The library provides some trivial implementations of the `FileFetcher` interface at its heart:

* `SimpleFileFetcher`: [Adapter](https://en.wikipedia.org/wiki/Adapter_pattern) around `file_get_contents`
* `InMemoryFileFetcher`: Adapter around an array provided to its constructor
* `ThrowingFileFetcher`: Throws a `FileFetchingException` for all calls
* `NullFileFetcher`: Returns an empty string for all calls
* `StubFileFetcher`: Returns a stub value for all calls
* `CallbackFileFetcher`: Adapter around a callback
* `LazyStubFileFetcher`: Return a lazily retrieved stub value for all calls

It also provides a number of generic [decorators](https://en.wikipedia.org/wiki/Decorator_pattern):

* `ErrorLoggingFileFetcher`: Logs errors via the [PSR-3 LoggerInterface](http://www.php-fig.org/psr/psr-3/)
* `CachingFileFetcher`: Adds caching capabilities using the [SimpleCache library](https://github.com/JeroenDeDauw/SimpleCache)
* `SpyingFileFetcher`: A [spy (test double)](https://www.entropywins.wtf/blog/2016/05/13/5-ways-to-write-better-mocks/)

## Installation

You can use [Composer](http://getcomposer.org/) to download and install
this package as well as its dependencies.

To add this package as a local, per-project dependency to your project, simply add a
dependency on `jeroen/file-fetcher` to your project's `composer.json` file.
Here is a minimal example of a `composer.json` file that just defines a dependency on
FileFetcher 4.x:

    {
        "require": {
            "jeroen/file-fetcher": "^4.0.0"
        }
    }

## Development

For development you need to have Docker and Docker-compose installed. Local PHP and Composer are not needed.

    sudo apt-get install docker docker-compose

### Running Composer

To pull in the project dependencies via Composer, run:

    make composer install

You can run other Composer commands via `make run`, but at present this does not support argument flags.
If you need to execute such a command, you can do so in this format:

    docker run --rm --interactive --tty --volume $PWD:/app -w /app\
     --volume ~/.composer:/composer --user $(id -u):$(id -g) composer composer install --no-scripts

Where `composer install --no-scripts` is the command being run.

### Running the CI checks

To run all CI checks, which includes PHPUnit tests, PHPCS style checks and coverage tag validation, run:

    make
    
### Running the tests

To run just the PHPUnit tests run

    make test

To run only a subset of PHPUnit tests or otherwise pass flags to PHPUnit, run

    docker-compose run --rm app ./vendor/bin/phpunit --filter SomeClassNameOrFilter

## Release notes

### 4.4.0 (2018-05-31)

* Dropped support for PHP 7.0
* Added `CallbackFileFetcher`
* Added `LazyStubFileFetcher`

### 4.3.0 (2017-06-10)

* Added `getFirstFetchedUrl` to `SpyingFileFetcher`
* Added `$defaultContent` constructor parameter to `InMemoryFileFetcher`

### 4.2.0 (2017-06-07)

* Added `StubFileFetcher`

### 4.1.0 (2017-05-11)

* Added `ThrowingFileFetcher`
* Added `NullFileFetcher`

### 4.0.0 (2017-05-09)

Breaking changes:

* Added scalar type hints to the `FileFetcher` interface and its implementations
* Added scalar type hints to `FileFetchingException`

Other changes:

* Dropped support for PHP 5.x
* Added `ErrorLoggingFileFetcher`
* Added `SpyingFileFetcher`

### 3.1.0 (2016-01-07)

* Added `InMemoryFileFetcher`

### 3.0.0 (2015-08-21)

* Added `FileFetchingException`, which should now be thrown by implementations of `FileFetcher` on error
* The non-public fields and methods of `CachingFileFetcher` are now private rather than protected
* Added PHPCS and PHPMD integration

### 2.0.0 (2014-08-19)

* Removed `FileFetcher.php` entry point. Autoloading is now done via Composers PSR-4 support.

### 1.0.1 (2013-07-06)

* Added `SimpleFileFetcher` implementation

### 1.0.0 (2013-07-06)

* Initial release with `FileFetcher` interface and `CachingFileFetcher` implementation

## Links

* [FileFetcher on Packagist](https://packagist.org/packages/jeroen/file-fetcher)
* [Latest version of the readme file](https://github.com/JeroenDeDauw/FileFetcher/blob/master/README.md)
