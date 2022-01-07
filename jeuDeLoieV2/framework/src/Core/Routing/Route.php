<?php

namespace Framework\Routing;

class Route
{
    public function __construct(
        protected string $method,
        protected string $uri,
        protected $handler,
    ) {
    }

    public function getMethod(): string
    {

        return $this->method;
    }

    public function setMethod(string $method): Route
    {
        $this->method = $method;

        return $this;
    }

    public function getUri(): string
    {

        return $this->uri;
    }

    public function setUri(string $uri): Route
    {
        $this->uri = $uri;

        return $this;
    }

    public function getHandler()
    {

        return $this->handler;
    }

    public function setHandler($handler)
    {
        $this->handler = $handler;

        return $this;
    }
}
