# google-api-bundle
Google API Bundle

## Installation

### Step 1: Download the Bundle

``` jinja
composer require alitvinenko/google-api-bundle dev-master
```

### Step 2: Enable the Bundle

Then, enable the bundle by adding the following line in the app/AppKernel.php file of your project:

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

            new Alitvinenko\GoogleApiBundle\GoogleApiBundle(),
        );

        // ...
    }

    // ...
}
```

Congratulations!

## Configuration

``` yaml
# app/config/config.yml

alitvinenko_google_api:
    key: <your google api key>
    
    
```
    
## Basic Usage

``` php
$this->getContainer()->get('alitvinenko_google_api')->getLanguage()->translate($words);
```