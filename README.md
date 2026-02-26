# Time ago bundle

![Latest Stable](https://img.shields.io/packagist/v/softspring/time-ago-bundle?label=stable&style=flat-square)
![Latest Unstable](https://img.shields.io/packagist/v/softspring/time-ago-bundle?label=unstable&style=flat-square&include_prereleases)
![License](https://img.shields.io/packagist/l/softspring/time-ago-bundle?style=flat-square)
![PHP Version](https://img.shields.io/packagist/dependency-v/softspring/time-ago-bundle/php?style=flat-square)
![Downloads](https://img.shields.io/packagist/dt/softspring/time-ago-bundle?style=flat-square)
[![CI](https://img.shields.io/github/actions/workflow/status/softspring/time-ago-bundle/ci.yml?branch=6.0&style=flat-square&label=CI)](https://github.com/softspring/time-ago-bundle/actions/workflows/ci.yml)

This bundle provides a simple twig extension to human readable date diff based on translations.

## Installation

### Applications that use Symfony Flex

Open a command console, enter your project directory and execute:

```console
$ composer require softspring/time-ago-bundle
```

### Applications that don't use Symfony Flex

#### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require softspring/time-ago-bundle
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

#### Step 2: Enable the Bundle

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

### Usage

```twig
{{ object.createdAt|time_ago }} {# for example, renders: 5 minutes ago #}
```

