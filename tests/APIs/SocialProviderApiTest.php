<?php

namespace Tests\APIs;

use Tests\TestCase;
use Nitm\Testing\ApiTestTrait;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SocialProviderApiTest extends TestCase
{

    protected $apiBase = '';

    /**
     * @test
     */
    // public function test_create_social_provider()
    // {
    //     $socialProvider = factory(SocialProvider::class)->make()->toArray();

    //     $this->response = $this->json(
    //         'POST',
    //         '/auth/connected-accounts', $socialProvider
    //     );

    //     $this->assertApiResponse($socialProvider);
    // }

    /**
     * @test
     */
    // public function test_read_social_provider()
    // {
    //     $socialProvider = factory(SocialProvider::class)->create();

    //     $this->response = $this->json(
    //         'GET',
    //         '/auth/connected-accounts/'.$socialProvider->id
    //     );

    //     $this->assertApiResponse($socialProvider->toArray());
    // }

    /**
     * @test
     */
    // public function test_update_social_provider()
    // {
    //     $socialProvider = factory(SocialProvider::class)->create();
    //     $editedSocialProvider = factory(SocialProvider::class)->make()->toArray();

    //     $this->response = $this->json(
    //         'PUT',
    //         '/auth/connected-accounts/'.$socialProvider->id,
    //         $editedSocialProvider
    //     );

    //     $this->assertApiResponse($editedSocialProvider);
    // }

    /**
     * @test
     */
    //     public function test_delete_social_provider()
    //     {
    //         $socialProvider = factory(SocialProvider::class)->create();

    //         $this->response = $this->json(
    //             'DELETE',
    //             '/auth/connected-accounts/'.$socialProvider->id
    //         );

    //         $this->assertApiSuccess();
    //         $this->response = $this->json(
    //             'GET',
    //             '/auth/connected-accounts/'.$socialProvider->id
    //         );

    //         $this->response->assertStatus(404);
    //     }
}