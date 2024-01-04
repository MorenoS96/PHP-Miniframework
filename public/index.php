<?php

use App\Controller\CheckLoginController;
use App\Controller\NotFoundController;
use MorenoGeneralProbeFrameWork\http\Kernel;
use MorenoGeneralProbeFrameWork\http\Request;

define('BASE_PATH',dirname(__DIR__));

require_once BASE_PATH.'/vendor/autoload.php';
session_start();
$kernel=new Kernel(BASE_PATH.'/src/Routes/',[NotFoundController::class,'notFound']);
$request = Request::createFromGlobals();
CheckLoginController::checkLogin($request);
$kernel->handle($request);