<?php

return [
    /**
     * User model
     */
    'user_model' => env('NITM_CONNECTED_ACCOUNTS_USER_MODEL', 'Nitm\Content\Models\User'),

    /**
     * Routes configuration
     */
    'routes' => [
        'prefix' => env('NITM_CONNECTED_ACCOUNTS_ROUTES_PREFIX', 'connected-accounts'),
        'middleware' => env('NITM_CONNECTED_ACCOUNTS_ROUTES_MIDDLEWARE', ['api']),
    ],

    /**
     * Nova configuration support
     */
    'nova' => [
        'connected-account' => Nitm\ConnectedAccounts\Nova\ConnectedAccount::class,
    ]
];