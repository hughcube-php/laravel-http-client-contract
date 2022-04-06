<?php

use GuzzleHttp\RequestOptions;

return [
    'default' => 'default',

    'defaults' => [
        'http' => [
            RequestOptions::TIMEOUT         => 10.0,
            RequestOptions::CONNECT_TIMEOUT => 10.0,
            RequestOptions::READ_TIMEOUT    => 10.0,
            //RequestOptions::HTTP_ERRORS => false,
            RequestOptions::HEADERS => [
                'User-Agent' => null,
            ],
        ],
    ],

    'clients' => [
        'default' => [
            'http' => [
                'base_uri' => 'https://www.baidu.com',
            ],
        ],
    ],
];
