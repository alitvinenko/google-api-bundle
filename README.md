# Alitvinenko Google API Bundle

Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the following command to download the latest version of this bundle:

``` jinja
$ composer require alitvinenko/google-api-bundle dev-master
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

``` php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new Alitvinenko\GoogleApiBundle\AlitvinenkoGoogleApiBundle(),
        );

        // ...
    }

    // ...
}
```

Usage
=====

Configure the Alitvinenko Google Api Bundle in your `config.yml`:

``` yaml
# app/config/config.yml

alitvinenko_google_api:
    key: <your google api key>
    
    
```
    
Code example
------------

``` php
$this->getContainer()->get('alitvinenko_google_api')->getLanguage()->translate($words);
```