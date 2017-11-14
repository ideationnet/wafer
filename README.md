# Wafer

Simple, very thin, no-framework PHP.

## Install

Via composer

    composer require ideationnet/wafer
    
## Usage

The simplest way to use this is to create an "invokable":

```php
<?php
use Zend\Diactoros\Response\HtmlResponse;
class Hello
{    
    public function __invoke()
    {
        return new HtmlResponse('Hello!');
    }
}
```

And then just **run** it by creating an `index.php`:

```php
<?php

use IdNet\Wafer\Application;
use Example\Hello;

require __DIR__.'/../vendor/autoload.php';

Application::run([

    'routes' => [
      ['GET', '/', Hello::class]
    ]

]);
```
