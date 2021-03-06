<?php

namespace Nitm\ConnectedAccounts\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Nitm\Content\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Response;
use Laravel\Socialite\Two\User as SocialiteUser;
use Nitm\ConnectedAccounts\Models\SocialProvider;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Nitm\ConnectedAccounts\Auth\SocialProviderManager;
use MadWeb\SocialAuth\Exceptions\SocialUserAttachException;
use MadWeb\SocialAuth\Exceptions\SocialGetUserInfoException;
use Nitm\ConnectedAccounts\Http\Controllers\API\ApiController;
use Nitm\ConnectedAccounts\Repositories\SocialProviderRepository;
use Nitm\ConnectedAccounts\Actions\Fortify\CreateNewUserFromSocial;

/**
 * Class SocialProviderController
 *
 * Used for documentation only!
 *
 * @package App\Http\Controllers\API
 */

class SocialAuthAPIController extends ApiController
{
    public function __construct($auth = null, Socialite $socialite = null)
    {
        parent::__construct($auth);
        $this->auth       = $auth;
        $this->socialite  = $socialite;
        $this->redirectTo = config('social-auth.redirect');

        $className       = config('social-auth.models.user');
        $this->userModel = new $className;

        if (request()->provider) {
            $this->manager = new SocialProviderManager(SocialProvider::whereSlug(request()->provider)->first());
        }

        $this->middleware('web');
    }

    /**
     * Get the repository class
     *
     * @return string
     */
    public function repository()
    {
        return SocialProviderRepository::class;
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(SocialProvider $provider, $type = 'mobile')
    {
        $providerSlug = $provider instanceof SocialProvider ? $provider->slug : $provider;
        $url          = config("services.{$providerSlug}.redirect") . '/' . $type;
        return $this->socialite->driver($providerSlug)->redirectUrl($url)->redirect();
    }

    /**
     * Redirect callback for social network.
     *
     * @param  Request        $request
     * @param  SocialProvider $social
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws SocialGetUserInfoException
     * @throws SocialUserAttachException
     */
    public function storeForMobile(Request $request, SocialProvider $social)
    {
        $result = $this->store($request, $social);
        if ($request->wantsJson()) {
            return $this->printSuccess(
                $result
            );
        } else {
            return view(
                'auth.react_native_bridge',
                [
                    'result' => $result,
                ]
            );
        }
    }

    /**
     * Redirect callback for social network.
     *
     * @param  Request        $request
     * @param  SocialProvider $social
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws SocialGetUserInfoException
     * @throws SocialUserAttachException
     */
    public function storeForWeb(Request $request, SocialProvider $social)
    {
        $result = $this->store($request, $social);

        if ($request->expectsJson()) {
            return $this->printSuccess(
                $result
            );
        } else if ($request->prefers('application/javascript')) {
            return view(
                'auth.react_native_bridge',
                [
                    'result' => $result,
                ]
            );
        } else {
            return $this->redirect(config('social-auth.redirect'));
        }
    }

    /**
     * Redirect callback for social network.
     *
     * @param  Request        $request
     * @param  SocialProvider $social
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws SocialGetUserInfoException
     * @throws SocialUserAttachException
     */
    public function store(Request $request, SocialProvider $social, $type = 'mobile')
    {
        $url      = config("services.{$social->slug}.redirect") . '/' . $type;
        $provider = $this->socialite->driver($social->slug)->redirectUrl($url);

        $socialUser = null;

        // try to get user info from social network
        try {
            if (app()->environment('testing')) {
                $socialUser = (new SocialiteUser)->map([
                    'id'    => '12345',
                    'name'  => 'Test User',
                    'email' => 'email@email.com',
                    'token' => 'token',
                ]);
            } else {
                $socialUser = $social->stateless ? $provider->stateless()->user() : $provider->user();
            }
        } catch (\Exception $e) {
            throw new SocialGetUserInfoException($social, $e->getMessage());
        }

        // if we have no social info for some reason
        if (!$socialUser) {
            throw new SocialGetUserInfoException(
                $social,
                trans('nitm-connected-accounts::messages.no_user_data', ['social' => $social->label])
            );
        }

        // Create the user now

        $user = User::where(['email' => $socialUser->getEmail()])->first();
        if (!$user) {
            $creator = new CreateNewUserFromSocial();
            event(
                new Registered(
                    $user = $creator->create(
                        [
                            'name'               => $socialUser->getName(),
                            'email'              => $socialUser->getEmail(),
                            'photo_url'          => $socialUser->getAvatar(),
                            'profile_photo_path' => $socialUser->getAvatar(),
                        ]
                    )
                )
            );
        }
        $this->guard->login($user);

        //If someone already attached current socialProvider account
        if (!$this->manager->socialUserQuery($socialUser->getId())->exists()) {
            $this->manager->attachUser($user, $socialUser, $request->input('offline_token'));
        }

        $result = [
            'token' => $user->createToken($social->slug)->plainTextToken,
            'user'  => $user,
        ];

        return $result;
    }
}