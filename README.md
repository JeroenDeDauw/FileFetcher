# FileFetcher

Small library providing a simple FileFetcher interface.

[![Build Status](https://secure.travis-ci.org/JeroenDeDauw/FileFetcher.png?branch=master)](http://travis-ci.org/JeroenDeDauw/FileFetcher)
[![Coverage Status](https://coveralls.io/repos/JeroenDeDauw/FileFetcher/badge.png?branch=master)](https://coveralls.io/r/JeroenDeDauw/FileFetcher?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/JeroenDeDauw/FileFetcher/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/JeroenDeDauw/FileFetcher/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/jeroen/file-fetcher/version.png)](https://packagist.org/packages/jeroen/file-fetcher)
[![Download count](https://poser.pugx.org/jeroen/file-fetcher/d/total.png)](https://packagist.org/packages/jeroen/file-fetcher)

## Installation

You can use [Composer](http://getcomposer.org/) to download and install
this package as well as its dependencies. Alternatively you can simply clone
the git repository and take care of loading yourself.

### Composer

To add this package as a local, per-project dependency to your project, simply add a
dependency on `jeroen/file-fetcher` to your project's `composer.json` file.
Here is a minimal example of a `composer.json` file that just defines a dependency on
FileFetcher 2.0:

    {
        "require": {
            "jeroen/file-fetcher": "~2.0.0"
        }
    }

### Manual

Get the FileFetcher code, either via git, or some other means. Also get all dependencies.
You can find a list of the dependencies in the "require" section of the composer.json file.
Load all dependencies and the load the FileFetcher library by including its entry point:
FileFetcher.php.

## Release notes

### 2.0.0 (2014-08-19)

* Removed `FileFetcher.php` entry point. Autoloading is now done via Composers PSR-4 support.

### 1.0.1

* Added SimpleFileFetcher implementation

### 1.0

* Initial release with FileFetcher interface and CachingFileFetcher implementation

## Links

* [FileFetcher on Packagist](https://packagist.org/packages/jeroen/file-fetcher)
* [Latest version of the readme file](https://github.com/JeroenDeDauw/FileFetcher/blob/master/README.md)
