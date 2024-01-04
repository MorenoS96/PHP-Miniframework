<?php

declare(strict_types=1);

namespace MorenoGeneralProbeFrameWork\http;

class Request
{
    public static function createFromGlobals(): static
    {
        return new static($_GET, $_POST, $_SERVER,$_SESSION);
    }

    private function __construct(
        private readonly array $getParams,
        private readonly array $postParams,
        private readonly array $server,
        private readonly array $session
    ) {
    }

    public function getSession(): array
    {
        return $this->session;
    }

    public function getMethod()
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function getPathInfo(): string
    {
        return strtok($this->server['REQUEST_URI'], "?");
    }

    public function getFunctionParameters(): array
    {
        $requestMethod =  $this->getMethod();
        if ($requestMethod == 'GET') {
            return $this->getParams;
        }
        if ($requestMethod == 'POST') {
            return $this->postParams;
        }
        return [];
    }

}