<?php

namespace Nitm\ConnectedAccounts\Configuration;

use Nitm\ConnectedAccounts\Models\ConnectedAccount;
use Nitm\ConnectedAccounts\Models\SocialProvider;
use Nitm\Content\NitmContent;

trait ManagesModelOptions
{
    /**
     * The user model class name.
     *
     * @var string
     */
    public static $userModel = \Nitm\Content\Models\User::class;

    /**
     * The connected account model class name.
     *
     * @var string
     */
    public static $connectedAccountModel = \Nitm\ConnectedAccounts\Models\ConnectedAccount::class;

    /**
     * The connected account model class name.
     *
     * @var string
     */
    public static $socialProviderModel = \Nitm\ConnectedAccounts\Models\SocialProvider::class;

    /**
     * Set the user model class name.
     *
     * @param  string $userModel
     * @return void
     */
    public static function useUserModel($userModel)
    {
        static::$userModel = $userModel;
        config(['social_auth.user_model' => $userModel]);
    }

    /**
     * Get the user model class name.
     *
     * @return string
     */
    public static function userModel()
    {
        return config('social_auth.user_model') ?? static::$userModel ?? NitmContent::userModel();
    }

    /**
     * Get a new user model instance.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public static function user()
    {
        $userModel = static::userModel();
        return new $userModel;
    }

    /**
     * Set the connected account model class name.
     *
     * @param  string $connectedAccountModel
     * @return void
     */
    public static function useConnectedAccountModel($connectedAccountModel)
    {
        static::$connectedAccountModel = $connectedAccountModel;
        config(['social_auth.connected_account_model' => $connectedAccountModel]);
    }

    /**
     * Get the connected account model class name.
     *
     * @return string
     */
    public static function connectedAccountModel()
    {
        return config('social_auth.connected_account_model') ?? static::$connectedAccountModel ?? ConnectedAccount::class;
    }

    /**
     * Get a new connected account model instance.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public static function connectedAccount()
    {
        $connectedAccountModel = static::connectedAccountModel();
        return new $connectedAccountModel;
    }

    /**
     * Set the connected account model class name.
     *
     * @param  string $socialProviderModel
     * @return void
     */
    public static function useSocialProviderModel($socialProviderModel)
    {
        static::$socialProviderModel = $socialProviderModel;
        config(['social_auth.social_provider_model' => $socialProviderModel]);
    }

    /**
     * Get the connected account model class name.
     *
     * @return string
     */
    public static function socialProviderModel()
    {
        return config('social_auth.social_provider_model') ?? static::$socialProviderModel ?? SocialProvider::class;
    }

    /**
     * Get a new connected account model instance.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public static function socialProvider()
    {
        $socialProviderModel = static::socialProviderModel();
        return new $socialProviderModel;
    }
}