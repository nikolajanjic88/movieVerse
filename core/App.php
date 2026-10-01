<?php

namespace Core;

class App
{
    private Request $request;
    private Response $response;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();

        Router::init($this->request, $this->response);
    }

    public function run()
    {
        echo Router::resolve();
    }
}
