<?php

use App\Controller\HomeController;
use App\Controller\LoginController;
use App\Controller\PostsController;
use App\Controller\SignUpController;


$routes= [
    ['GET','/',[HomeController::class,'index']],
    ['GET','/posts',[PostsController::class,'view']],
    ['POST','/posts',[PostsController::class,'create']],
    ['GET','/sign-up',[SignUpController::class,'view']],
    ['POST','/sign-up',[SignUpController::class,'register']],
    ['GET','/login',[LoginController::class,'view']],
    ['POST','/login',[LoginController::class,'login']],
    ['GET','/logout',[LoginController::class,'logout']]
];
return $routes;