<?php

namespace App\Controller;

use App\View\SimpleView;
use MorenoGeneralProbeFrameWork\http\Response;

class HomeController extends AbstractController
{
    public function index(?string $msg = null): void
    {
        $response = new Response("hello From Index ".$msg);
        $this->view->renderFromResponse($response, $this->view::PATH_TO_BASIC_LAYOUT);
    }

}