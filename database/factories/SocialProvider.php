<?php

namespace Database\Factories\Nitm\ConnectedAccounts\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Nitm\ConnectedAccounts\Models\SocialProvider;

class SocialProviderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SocialProvider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'label' => $this->faker->sentence,
            'slug'  => $this->faker->slug,
        ];
    }
}