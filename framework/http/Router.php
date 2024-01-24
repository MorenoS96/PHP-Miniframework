<?php
declare(strict_types=1);
namespace MorenoGeneralProbeFrameWork\http;

use MorenoGeneralProbeFrameWork\dependencyInjection\Container;

class Router
{
// [NotFoundController::class,'notFoundFunc']

    private array $routes;

    public function __construct(private string $pathToRoutes, private array $notFoundCallableArray, private Container $container)
    {
        $routes=$this->mergeArraysFromFolder($pathToRoutes);
        $transformedRoutes=[];
        foreach ($routes as $route){
            [$method,$path,$handler]=$route;
            $transformedRoutes[$method][$path]=$handler;
        }
        $this->routes=$transformedRoutes;
        $this->notFoundCallableArray=$notFoundCallableArray;
    }

    public function route(Request $request): void
    {
        $method=$request->getMethod();
        $path=$request->getPathInfo();
        $handler=$this->notFoundCallableArray;
        if(isset($this->routes[$method][$path])){
            $handler=$this->routes[$method][$path];
        }
        $call_class=$this->container->get($handler[0]);
        call_user_func([$call_class, $handler[1]],...$request->getFunctionParameters());
    }
    private function mergeArraysFromFolder(string $path):array
    {
        $merged=[];
        $path=rtrim($path,'/').'/';
        $files=glob($path.'*.php');

        foreach ($files as $file){
            $fileArray=include $file;
            if(is_array($fileArray)){
                $merged=array_merge($merged,$fileArray);
            }
        }
        return $merged??[];
    }
}