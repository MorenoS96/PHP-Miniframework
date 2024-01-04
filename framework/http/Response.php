<?php

namespace MorenoGeneralProbeFrameWork\http;

class Response
{
    public function __construct(public string $content = '', public int $status = 200, public array $headers = [])
    {

    }
}