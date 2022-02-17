<?php

return [
    /**
     * User model
     */
    'user_model' => env('NITM_CONNECTED_ACCOUNTS_USER_MODEL', 'Nitm\Content\Models\User'),

    /**
     * Connected Account model
     */
    'connected_account_model' => env('NITM_CONNECTED_ACCOUNTS_CONNECTED_ACCOUNT_MODEL', 'Nitm\ConnectedAccounts\Models\ConnectedAccount'),

    /**
     * Connected Account model
     */
    'social_provider_model' => env('NITM_CONNECTED_ACCOUNTS_SOCIAL_PROVIDER_MODEL', 'Nitm\ConnectedAccounts\Models\SocialProvider'),

    /**
     * Routes configuration
     */
    'routes' => [
        'prefix' => env('NITM_CONNECTED_ACCOUNTS_ROUTES_PREFIX', 'auth/connected-accounts'),
        'middleware' => env('NITM_CONNECTED_ACCOUNTS_ROUTES_MIDDLEWARE', ['api']),
    ],

    /**
     * Nova configuration support
     */
    'nova' => [
        'connected-account' => Nitm\ConnectedAccounts\Nova\ConnectedAccount::class,
    ],/*
    |--------------------------------------------------------------------------
    | Additional service providers
    |--------------------------------------------------------------------------
    |
    | The social providers listed here will enable support for additional social
    | providers which provided by https://socialiteproviders.github.io/ just
    | add new event listener from the installation guide
    |
    */
    'providers' => [
        //
    ],

    'models' => [
        /*
         * When using the "UserSocialite" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your available social providers. Of course, it
         * is often just the "SocialProvider" model but you may use whatever you like.
         */
        'social' => \MadWeb\SocialAuth\Models\SocialProvider::class,

        /*
         * User model which you will use as "SocialAuthenticatable"
         */
        'user' => \Nitm\Content\Models\User::class,
    ],

    'table_names' => [

        /*
       |--------------------------------------------------------------------------
       | Users Table
       |--------------------------------------------------------------------------
       |
       | The table for storing relation between users and social providers. Also there is
       | a place for saving "user social network id", "token", "expiresIn" if it exist
       |
       */
        'user_has_social_provider' => 'user_has_social_provider',

        /*
        |--------------------------------------------------------------------------
        | Social Providers Table
        |--------------------------------------------------------------------------
        |
        | The table that contains all social network providers which your application use.
        |
        */
        'social_providers' => 'social_providers',
    ],

    'foreign_keys' => [

        /*
         * The name of the foreign key to the users table.
         */
        'users' => 'user_id',

        /*
         * The name of the foreign key to the socials table
         */
        'socials' => 'social_id',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication redirection
    |--------------------------------------------------------------------------
    |
    | Redirect path after success/error login via social network
    |
    */
    'redirect' => '/home',
];