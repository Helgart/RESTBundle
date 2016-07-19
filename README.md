# RESTBundle

Fast REST API implementation for symfony 2 / 3.

## Why another RESTBundle for Symfony ?

Simply because when you want to make a REST API with Symfony you have to either :
 
 * Use a boilerplate already configured with a lot of modification.
 * Use a set of bundle and spend a lot of time configuring and mastering all of these.

This bundle is here to offer another solution, an already configured set of bundle.
You use your platform with your configuration and add an already working API part.
It's up to you then to change all the configurations you want.

## How to install ?

### Install FriendsOfSymfony RESTBundle

`composer require friendsofsymfony/rest-bundle '^2.0'`

And add it to your `app/AppKernel.php` :

```    
    <?php
    $bundles = [
        ...
        new FOS\RestBundle\FOSRestBundle(),
    ]
```

### Install Nelmio CORSBundle

`composer require friendsofsymfony/rest-bundle '^1.4'`

And add it to your `app/AppKernel.php` :

```
    <?php
    $bundles = [
        ...
        new Nelmio\CorsBundle\NelmioCorsBundle(),
    ]
```

### Install this bundle

`composer require helgart/rest-bundle '^0.1'`

And add it to your `app/AppKernel.php` :

``` 
    <?php
    $bundles = [
        ...
        new helgart\RESTBundle\helgartRESTBundle(),
    ]
```

And that's all ... All configurations are done for you.

If you want to know more about default behavior, or change it, please refer to documentation bellow :
