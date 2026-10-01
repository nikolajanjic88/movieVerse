<?php

namespace Core;

class Route
{
    private string $method;
    private string $path;
    private $callback;
    private ?string $middleware = null;

    public function __construct($method, $path, $callback)
    {
        $this->method = $method;
        $this->path = $path;
        $this->callback = $callback;
    }

    public function middleware(string $name): self
    {
        $this->middleware = $name;
        return $this;
    }

    public function getMiddleware(): ?string
    {
        return $this->middleware;
    }

    public function getCallback()
    {
        return $this->callback;
    }
}
