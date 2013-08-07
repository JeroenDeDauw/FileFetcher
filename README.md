# FileFetcher

Small library providing a simple FileFetcher interface.

[![Build Status](https://secure.travis-ci.org/JeroenDeDauw/FileFetcher.png?branch=master)](http://travis-ci.org/JeroenDeDauw/FileFetcher)
[![Coverage Status](https://coveralls.io/repos/JeroenDeDauw/FileFetcher/badge.png?branch=master)](https://coveralls.io/r/JeroenDeDauw/FileFetcher?branch=master)
[![Dependency Status](https://www.versioneye.com/package/php--jeroen-de-dauw--file-fetcher/badge.png)](https://www.versioneye.com/package/php--jeroen-de-dauw--file-fetcher)

[![Latest Stable Version](https://poser.pugx.org/jeroen-de-dauw/file-fetcher/version.png)](https://packagist.org/packages/jeroen-de-dauw/file-fetcher)
[![Download count](https://poser.pugx.org/jeroen-de-dauw/file-fetcher/d/total.png)](https://packagist.org/packages/jeroen-de-dauw/file-fetcher)

## Installation

You can use [Composer](http://getcomposer.org/) to download and install
this package as well as its dependencies. Alternatively you can simply clone
the git repository and take care of loading yourself.

### Composer

To add this package as a local, per-project dependency to your project, simply add a
dependency on `jeroen-de-dauw/file-fetcher` to your project's `composer.json` file.
Here is a minimal example of a `composer.json` file that just defines a dependency on
FileFetcher 1.0:

    {
        "require": {
            "jeroen-de-dauw/file-fetcher": "1.0.*"
        }
    }

### Manual

Get the FileFetcher code, either via git, or some other means. Also get all dependencies.
You can find a list of the dependencies in the "require" section of the composer.json file.
Load all dependencies and the load the FileFetcher library by including its entry point:
FileFetcher.php.

## Release notes

### 1.0.1

* Added SimpleFileFetcher implementation

### 1.0

* Initial release with FileFetcher interface and CachingFileFetcher implementation

## Links

* [FileFetcher on Packagist](https://packagist.org/packages/jeroen-de-dauw/file-fetcher)
* [Latest version of the readme file](https://github.com/JeroenDeDauw/FileFetcher/blob/master/README.md)
