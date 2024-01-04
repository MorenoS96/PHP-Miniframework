<?php

namespace App\View;

use MorenoGeneralProbeFrameWork\View\BaseView;

class SimpleView extends BaseView
{
    public const PATH_TO_LAYOUT_FOLDER = BASE_PATH . '/src/Layout';
    public const PATH_TO_BASIC_LAYOUT = BASE_PATH . '/src/Layout' . '/BasicLayout.html';
    public const PATH_TO_SIGN_UP_LAYOUT = BASE_PATH . '/src/Layout' . '/SignUpLayout.html';
    public const PATH_TO_LOGIN_UP_LAYOUT = BASE_PATH . '/src/Layout' . '/LoginLayout.html';
}