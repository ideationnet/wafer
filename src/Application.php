<?php

namespace IdNet\Wafer;

use function DI\add;
use DI\ContainerBuilder;
use function DI\get;
use IdNet\InvokerRouterMiddleware\InvokerRouterMiddleware;
use IdNet\StackRunner\StackRunner;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;

class Application
{
    public static function run($config = []) {
        (new SapiEmitter)
          ->emit((new ContainerBuilder)
            ->addDefinitions(__DIR__.'/di-config.php')
            ->addDefinitions($config)
            ->addDefinitions([
                'middleware' => add([
                    get(InvokerRouterMiddleware::class)
                ])
            ])
            ->build()
            ->get(StackRunner::class)
            ->handle(ServerRequestFactory::fromGlobals()));
    }

}
