TmsLikeBundle
==================

Symfony2's TMS Like Bundle.


Installation
------------

Add dependencies in your `composer.json` file:

```json
"repositories": [
    ...,
    {
        "type": "vcs",
        "url": "https://github.com/Tessi-Tms/TmsLikeBundle.git"
    }
],
"require": {
    ...,
    "tms/like-bundle": "dev-master"
},
```

Install these new dependencies of your application:
```sh
$ composer update
```

Enable the bundles in your application kernel :

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        ...,
        new Tms\Bundle\LikeBundle\TmsLikeBundle(),
    );
}
```

Now import the bundle configuration in your `app/config.yml`

```yml
# app/config/config.yml

imports:
    ...
    - { resource: @TmsLikeBundle/Resources/config/config.yml }
```

Documentation
-------------

[Read the Documentation](Resources/doc/index.md)


Tests
-----

Install bundle dependencies:
```sh
$ php composer.phar update
```

To execute unit tests:
```sh
$ phpunit --coverage-text
```
