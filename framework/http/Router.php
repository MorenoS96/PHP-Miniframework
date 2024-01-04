<?php
namespace MorenoGeneralProbeFrameWork\http;

use App\Controller\NotFoundController;

class Router
{
    private array $routes;
    private array $notFoundCallableArray; // [NotFoundController::class,'notFoundFunc']

    public function __construct(string $pathToRoutes,array $notFoundCallableArray)
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

        call_user_func([new $handler[0](), $handler[1]],...$request->getFunctionParameters());
    }
    private function mergeArraysFromFolder($path):array
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