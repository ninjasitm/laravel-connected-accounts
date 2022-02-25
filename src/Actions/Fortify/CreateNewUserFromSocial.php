<?php

namespace Nitm\ConnectedAccounts\Actions\Fortify;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Nitm\Content\Repositories\UserRepository;

class CreateNewUserFromSocial
{
    /**
     * Create a newly registered user.
     *
     * @param  array $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make(
            $input,
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]
        )->validate();

        DB::beginTransaction();
        $user = app(UserRepository::class)->create(
            [
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make(uniqid()),
            ]
        );
        $user->assignRole('Web User');
        DB::commit();
        return $user;
    }
}