# FileFetcher

[![Build Status](https://secure.travis-ci.org/JeroenDeDauw/FileFetcher.png?branch=master)](http://travis-ci.org/JeroenDeDauw/FileFetcher)
[![Code Coverage](https://scrutinizer-ci.com/g/JeroenDeDauw/FileFetcher/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/JeroenDeDauw/FileFetcher/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/JeroenDeDauw/FileFetcher/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/JeroenDeDauw/FileFetcher/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/jeroen/file-fetcher/version.png)](https://packagist.org/packages/jeroen/file-fetcher)
[![Download count](https://poser.pugx.org/jeroen/file-fetcher/d/total.png)](https://packagist.org/packages/jeroen/file-fetcher)

The philosophy behind this library is to provide a very basic interface
([`FileFetcher`](https://github.com/JeroenDeDauw/FileFetcher/blob/master/src/FileFetcher.php)) that is ideal for 95%
of network access cases, such as your typical `file_get_contents` call. It explicitly does not try to deal with the more complex cases.

Several basic implementations are provided. These include the test doubles you typically need to test services
that use the `FileFetcher` interface. You can easily create an adapter to a more heavy network access library
(such as [Guzzle](http://docs.guzzlephp.org/en/latest/)) in your own codebase.

## Usage

```php
$fileContent = $fileFetcher->fetchFile($fileLocation);
```

The library provides some trivial implementations of the `FileFetcher` interface at its heart:

* `SimpleFileFetcher`: [Adapter](https://en.wikipedia.org/wiki/Adapter_pattern) around `file_get_contents`
* `InMemoryFileFetcher`: Adapter around an array provided to its constructor
* `ThrowingFileFetcher`: Throws a `FileFetchingException` for all calls
* `NullFileFetcher`: Returns an empty string for all calls
* `StubFileFetcher`: Returns a stub value for all calls
* `CallbackFileFetcher`: Adapter around a callback
* `LazyStubFileFetcher`: Return a lazily retrieved stub value for all calls

It also provides a number of [decorators](https://en.wikipedia.org/wiki/Decorator_pattern):

* `ErrorLoggingFileFetcher`: Logs errors via the [PSR-3 LoggerInterface](https://www.php-fig.org/psr/psr-3/)
* `SpyingFileFetcher`: A [spy (test double)](https://www.entropywins.wtf/blog/2016/05/13/5-ways-to-write-better-mocks/)

Decorators provided by [jeroen/file-fetcher-cache](https://github.com/JeroenDeDauw/file-fetcher-cache):

* `PsrCacheFileFetcher`: Caches file contents via [PSR-16 SimpleCache](https://www.php-fig.org/psr/psr-16/)
* `CachingFileFetcher`: Caches file contents. Requires `jeroen/simple-cache` to be loaded

Decorators provided by [jeroen/file-fetcher-stopwatch](https://github.com/JeroenDeDauw/file-fetcher-stopwatch):

* `StopwatchFileFetcher`: Profiles calls using Symfony Stopwatch. Requires `symfony/stopwatch` to be loaded

## Installation

You can use [Composer](http://getcomposer.org/) to download and install
this package as well as its dependencies.

To add this package as a local, per-project dependency to your project, simply add a
dependency on `jeroen/file-fetcher` to your project's `composer.json` file.
Here is a minimal example of a `composer.json` file that just defines a dependency on
FileFetcher 6.x:

    {
        "require": {
            "jeroen/file-fetcher": "~6.0"
        }
    }

## Development

Start by installing the project dependencies by executing

    composer update

You can run the tests by executing

    make test
    
You can run the style checks by executing

    make cs
    
To run all CI checks, execute

    make ci
    
You can also invoke PHPUnit directly to pass it arguments, as follows

    vendor/bin/phpunit --filter SomeClassNameOrFilter

## Release notes

### 6.0.0 (2019-01-17)

Breaking changes to increase package stability and avoid the need for breaking changes in the future.

* Removed `PsrCacheFileFetcher`, now part of `jeroen/file-fetcher-cache`
* Removed `CachingFileFetcher`, now part of `jeroen/file-fetcher-cache`
* Removed `StopwatchFileFetcher`, now part of `jeroen/file-fetcher-stopwatch`

### 5.0.1 (2019-01-16)

* `PsrCacheFileFetcher` now ensures cache keys are valid

### 5.0.0 (2019-01-16)

* Added `PsrCacheFileFetcher`
* Added `StopwatchFileFetcher`
* `jeroen/simple-cache`, which is needed by `CachingFileFetcher` is no longer loaded by default

### 4.5.0 (2018-12-19)

* Switched License from GPL-2.0-or-later to BSD-3-Clause 

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
