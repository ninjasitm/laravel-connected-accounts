<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Nitm\ConnectedAccounts\ConnectedAccountServiceProvider;
use Nitm\Content\Models\User;
use Nitm\Content\NitmContent;
use Nitm\Content\NitmContentServiceProvider;
use Nitm\Testing\ApiTestTrait;
use Nitm\Testing\PackageTestCase as BaseTestCase;
use Orchestra\Testbench\Concerns\CreatesApplication;

abstract class TestCase extends BaseTestCase
{
    use ApiTestTrait, RefreshDatabase;

    protected function getPackageProviders($app)
    {
        return [
            NitmContentServiceProvider::class,
            ConnectedAccountServiceProvider::class,
        ];
    }
    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function defineEnvironment($app)
    {
        NitmContent::useUserModel(User::class);
    }
}