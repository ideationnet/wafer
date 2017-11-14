<?php

use function DI\factory;
use function DI\get;
use function DI\object;
use FastRoute\Dispatcher;
use IdNet\InvokerRouterMiddleware\InvokerRouterMiddleware;
use IdNet\StackRunner\StackRunner;
use Interop\Http\Factory\ResponseFactoryInterface;
use Interop\Http\Factory\StreamFactoryInterface;
use Invoker\InvokerInterface;
use Middlewares\Utils\Factory\ResponseFactory;
use Middlewares\Utils\Factory\StreamFactory;

return [

    'middleware' => [],
    'routes' => [],

    Dispatcher::class =>
        factory([InvokerRouterMiddleware::class, 'createDispatcherFromRouteArray'])
            ->parameter('routes', get('routes')),

    StackRunner::class => object()
        ->constructorParameter('stack', get('middleware')),

    InvokerInterface::class => get(\DI\InvokerInterface::class),
    ResponseFactoryInterface::class => get(ResponseFactory::class),
    StreamFactoryInterface::class => get(StreamFactory::class),
];
