# Extend catalog search results
[![Build Status](https://travis-ci.org/fond-of/spryker-category.svg?branch=master)](https://travis-ci.org/fond-of-spryker/category-page-search-category-id)
[![PHP from Travis config](https://img.shields.io/travis/php-v/symfony/symfony.svg)](https://php.net/)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-spryker/category-page-search-category-id)

Plugin expand catalog search results with category id

## Installation

```
composer require fond-of-spryker/category-page-search-category-id
```

Register the new Plugin into your CategoryPageSearchPlugableDependencyProvider (dependency package)

```
protected function createCategoryPageMapExpanderPlugin(): array
{
    return [
        new CategoryIdPageMapExpanderPlugin(),
    ];
}
```