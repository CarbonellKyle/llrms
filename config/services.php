<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    //Google API Credentials
    'google' => [
        //Localhost Google API credentials
        // 'client_id'     => '449502118135-a03i490cc593s03idun47doq2ep9a1ol.apps.googleusercontent.com',
        // 'client_secret' => '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',
        // 'redirect'      => 'http://127.0.0.1:8000/callback/google',

        // Hosted or Production Google API credentials
        'client_id'     => '449502118135-tb8oa3fdrrfi6dkevfc3jfo896mdqkbm.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect'      => 'https://depedgin-llrms.herokuapp.com/callback/google',
    ],

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
