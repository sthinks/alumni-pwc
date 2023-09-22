<?php
return [
    'url' => env('REST_API_CLIENT_BASE_URL', ''),
    'username' => env('REST_API_CLIENT_USER', ''),
    'password' => env('REST_API_CLIENT_PASS', ''),
    'update' => [
        'endpoint' => 'https://www.alumni-api.pwc.com.tr/api/crm/UpdateRecord',
        'perm_endpoint' => 'https://www.alumni-api.pwc.com.tr/api/crm/UpdateRecord',
    ],
    // timeout as a second
    'timeout' => 15,
];
