This bundle provides a simple twig extension to human readable date diff based on translations.

[![Latest Stable Version](https://poser.pugx.org/softspring/time-ago-bundle/v/stable.svg)](https://packagist.org/packages/softspring/time-ago-bundle)
[![Latest Unstable Version](https://poser.pugx.org/softspring/time-ago-bundle/v/unstable.svg)](https://packagist.org/packages/softspring/time-ago-bundle)
[![License](https://poser.pugx.org/softspring/time-ago-bundle/license.svg)](https://packagist.org/packages/softspring/time-ago-bundle)
[![Total Downloads](https://poser.pugx.org/softspring/time-ago-bundle/downloads)](https://packagist.org/packages/softspring/time-ago-bundle)
[![Build status](https://github.com/softspring/time-ago-bundle/actions/workflows/php.yml/badge.svg?branch=5.2)](https://github.com/softspring/time-ago-bundle/actions/workflows/php.yml)

# Installation

## Applications that use Symfony Flex

Open a command console, enter your project directory and execute:

```console
$ composer require softspring/time-ago-bundle
```

## Applications that don't use Symfony Flex

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require softspring/time-ago-bundle
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Softspring\TimeAgoBundle\SfsTimeAgoBundle(),
        );

        // ...
    }

    // ...
}
```

## Usage

```twig
{{ object.createdAt|time_ago }} {# for example, renders: 5 minutes ago #}
```

