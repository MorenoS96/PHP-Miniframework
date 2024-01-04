<?php

namespace MorenoGeneralProbeFrameWork\View;

use MorenoGeneralProbeFrameWork\http\Response;


abstract class BaseView
{

    public function renderFromResponse(Response $response,?string $pathToLayout=null): void
    {
        http_response_code($response->status);

        if( is_null($pathToLayout) || !file_exists($pathToLayout)){

            echo $response->content;
            return;
        }
        ob_start();
        $content=include $pathToLayout;
        $content=ob_get_clean();
        $content= str_replace('{{content}}',$response->content,$content);

        echo $content;
    }


}