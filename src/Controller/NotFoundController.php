<?php

namespace App\Controller;

use App\View\SimpleView;
use MorenoGeneralProbeFrameWork\http\Response;

class NotFoundController
{
    public function notFound(): void
    {
        $response=new Response("404 not Found",404);
        $view=new SimpleView();
        $view->renderFromResponse($response,$view::PATH_TO_BASIC_LAYOUT);
    }
}