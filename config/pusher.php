<?php

/*
 * This file is part of Laravel Pusher.
 *
 * (c) Pusher, Ltd (https://pusher.com)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Pusher Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'auth_key' => '',
            'secret' => '',
            'app_id' => '',
            'options' => [
                'cluster'=> 'us2',
                'encrypted' => true
            ],
            'host' => null,
            'port' => null,
            'timeout' => null,
        ],

        'alternative' => [
            'auth_key' => 'your-auth-key',
            'secret' => 'your-secret',
            'app_id' => 'your-app-id',
            'options' => [],
            'host' => null,
            'port' => null,
            'timeout' => null,
        ],

    ],

];
