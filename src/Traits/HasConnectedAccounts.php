<?php

namespace Nitm\ConnectedAccounts\Traits;

use Nitm\ConnectedAccounts\Models\SocialProvider;

trait HasConnectedAccounts
{
    /**
     * Laravel uses this method to allow you to initialize traits
     *
     * @return void
     */
    // public function initializeHasConnectedAccounts()
    // {
    // }

    /**
     * User socials relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function socials()
    {
        $foreignKeys = config('nitm-connected-accounts.foreign_keys');
        $class = config('nitm-connected-accounts.user_model');
        return $this->belongsToMany($class, 'user_has_social_provider')
            ->as('token')
            ->withPivot('token', 'expires_in', 'offline_token', $foreignKeys['users']);
    }
}