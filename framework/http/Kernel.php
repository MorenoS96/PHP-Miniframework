<?php

namespace MorenoGeneralProbeFrameWork\http;

use MorenoGeneralProbeFrameWork\dependencyInjection\Container;

class Kernel
{
    public function __construct(private string $pathToRoutes,private array $notFoundCallableArray,private Container $container)
    {
    }

    public function handle(Request $request): void
    {
        
        $router = new Router($this->pathToRoutes,$this->notFoundCallableArray,$this->container);
        $router->route($request);

    }
}