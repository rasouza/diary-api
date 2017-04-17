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

    'github' => [
        'client_id' => '29e23ecfc4eec0814fc0',
        'client_secret' => env('GITHUB_SECRET'),
        'redirect' => env('APP_URL') . '/api/oauth/github/callback',
    ],

    'twitter' => [
        'client_id' => env('TWITTER_CONSUMER_KEY'),
        'client_secret' => env('TWITTER_CONSUMER_SECRET'),
        'redirect' => env('APP_URL') . '/oauth/twitter/callback',
    ],

];
