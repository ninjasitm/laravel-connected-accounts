<?php

namespace Tests;

use Nitm\ConnectedAccounts\Models\User;
use Nitm\ConnectedAccounts\Models\TeamUser;
use Tests\CreatesApplication;
use Nitm\Testing\ApiTestTrait;
use Nitm\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, ApiTestTrait, RefreshDatabase;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        ini_set('memory_limit', '2G');
        // Cashier::ignoreMigrations();
        parent::__construct($name, $data, $dataName);
    }

    protected function useAs($role, $team = null)
    {
        $team = $team ?: $this->team;
        $user = User::factory()->create();
        $teamUser = TeamUser::firstOrCreate(['team_id' => $team->id, 'role' => $role, 'user_id' => $user->id, 'is_approved' => true]);
        auth()->login($user);
        return $user;
    }

    protected function useAsUser($team = null)
    {
        return $this->useAs(User::ROLE_USER, $team);
    }

    protected function useAsMentor($team = null)
    {
        return $this->useAs(User::ROLE_SUPER_ADMIN, $team);
    }

    protected function useAsAdmin($team = null)
    {
        return $this->useAs(User::ROLE_ADMIN, $team);
    }



    public function setUpTraits(): void
    {
        parent::setUpTraits();

        unset($this->app['middleware.disable']);
        $this->withoutMiddleware([
            \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
            \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
            \App\Http\Middleware\TrimStrings::class,
            \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
            \App\Http\Middleware\TrustProxies::class,
            // \Fruitcake\Cors\HandleCors::class,
            \App\Http\Middleware\FrameHeadersMiddleware::class,
            // 'auth',
            'auth.basic',
            'cache.headers',
            'can',
            'dev',
            'guest',
            'hasTeam',
            'throttle',
            'signed',
            'fw-only-whitelisted',
            'fw-block-blacklisted',
            'fw-block-attacks'
        ]);
    }
}
