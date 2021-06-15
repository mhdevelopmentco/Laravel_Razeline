<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => 'mg.razeline.com',
        'secret' => 'key-afaf53671e6211ffbed940d50424e993',
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'paypal' => [
        'client_id' => 'AdP3gV_8dRUx1gjcoLFwl1QuQ-EVvt15g6g2wZfQC1wJ7xZjrR1bf0BOlf1efgKOOljGfokjW9_tKdsk',
        'secret' => 'EBuRjSH0tJzTLo6eZ9WPbUels1ulhbu29HYmRFZC0AFPlIs8n8-G5c-sXYvWJBUdw7p47gx9lPKm_rY5'
    ],

];
