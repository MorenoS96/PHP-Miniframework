<?php

namespace MorenoGeneralProbeFrameWork\http;

class Kernel
{
    public function __construct(private string $pathToRoutes,private array $notFoundCallableArray)
    {
    }

    public function handle(Request $request): void
    {
        
        $router = new Router($this->pathToRoutes,$this->notFoundCallableArray);
        $router->route($request);

    }
}