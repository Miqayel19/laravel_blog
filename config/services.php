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
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
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
    'facebook' => [
    'client_id' => '2005316506422119',
    'client_secret' => '096f98a050dcbd78a568ffa3c4e75f09',
    'redirect' => 'http://blog.dev/login/facebook/callback',
],
    'google' => [
    'client_id' => '887064889631-28bri1qbaentnrbf7o7nmbno2d17c5q1.apps.googleusercontent.com',
    'client_secret' => 'YM03LBDDhEEcjUWWN85VZNDV',
    'redirect' => 'http://blog.dev/login/google/callback',
],
];
