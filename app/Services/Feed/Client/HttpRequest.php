<?php

namespace App\Services\Feed\Client;

use Illuminate\Support\Facades\Http;
use Laminas\Feed\Reader\Http\HeaderAwareClientInterface;

class HttpRequest implements HeaderAwareClientInterface
{
    public function get($url, array $headers = [])
    {
        $response = Http::withHeaders($headers)->get($url);

        return new HttpResponse($response);
    }
}
