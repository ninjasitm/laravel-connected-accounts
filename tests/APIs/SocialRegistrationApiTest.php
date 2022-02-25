<?php

namespace Tests\APIs;

use Tests\TestCase;
use Nitm\Testing\ApiTestTrait;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SocialRegistrationApiTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function test_start()
    {
        foreach (['web', 'mobile'] as $type) {
            // $response = $this->get(route('connected-accounts.start', ['type' => $type, 'provider' => 'google']));
            // $response->assertStatus(302);
        }
    }

    /**
     * @test
     */
    public function test_store()
    {
        foreach (['web', 'mobile'] as $type) {
            // $response = $this->get(route("connected-accounts.{$type}", ['provider' => 'google', 'offline_token' => 'offline_token']));
            // $response->assertStatus(200);
        }
    }
}