<?php

namespace Database\Factories\Nitm\ConnectedAccounts\Models;

use Carbon\Carbon;
use Nitm\Content\Models\User;
use Nitm\ConnectedAccounts\Models\SocialProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Nitm\ConnectedAccounts\Models\ConnectedAccount;

class ConnectedAccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ConnectedAccount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'            => User::factory()->create()->id,
            'expires_in'         => Carbon::now()->add(1, 'day'),
            'social_provider_id' => SocialProvider::factory()->create()->id,
            'social_id'          => 1,
        ];
    }
}