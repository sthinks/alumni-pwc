<?php

namespace App\Services\Crm;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

abstract class RestClient
{
    /**
     * Send an http request with basic auth
     *
     * @param string $endpoint
     * @param array $params
     *
     * @return Response
     */
    protected function send(string $endpoint, array $params): Response
    {
        $username = config('crm-client.username');
        $password = config('crm-client.password');
        $timeout = config('crm-client.timeout');
        return Http::timeout($timeout)
            ->withoutVerifying()
            ->withBasicAuth($username, $password)
            ->post($endpoint, $params);
    }
}
