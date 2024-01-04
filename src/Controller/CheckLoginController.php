<?php

namespace App\Controller;

use MorenoGeneralProbeFrameWork\http\Request;

class CheckLoginController
{
    public static function checkLogin(Request $request):void //checks if user is logged in if not redirects to login site
    {
        if(!isset($request->getSession()['user-name']) && $request->getPathInfo()!='/login'){
            header('Location: /login?message=not logged in, please log in');
            die(0);
        }
    }

}