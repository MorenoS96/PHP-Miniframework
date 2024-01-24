<?php

use App\Controller\CheckLoginController;
use App\Controller\NotFoundController;
use MorenoGeneralProbeFrameWork\dependencyInjection\Container;
use MorenoGeneralProbeFrameWork\http\Kernel;
use MorenoGeneralProbeFrameWork\http\Request;

define('BASE_PATH',dirname(__DIR__));

require_once BASE_PATH.'/vendor/autoload.php';
session_start();
$container=new Container();
$kernel=new Kernel(BASE_PATH.'/src/Routes/',[NotFoundController::class,'notFound'],$container);
$request = Request::createFromGlobals();
CheckLoginController::checkLogin($request);
$kernel->handle($request);