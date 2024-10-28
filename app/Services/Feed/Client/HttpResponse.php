<?php

namespace App\Services\Feed\Client;

use Illuminate\Http\Client\Response;
use Laminas\Feed\Reader\Http\HeaderAwareResponseInterface;

class HttpResponse implements HeaderAwareResponseInterface
{
    public function __construct(public Response $response)
    {
    }

    public function getHeaderLine($name, $default = null)
    {
        return $this->response->header($name);
    }

    public function getBody()
    {
        return $this->response->body();
    }

    public function getStatusCode()
    {
        return $this->response->status();
    }
}
