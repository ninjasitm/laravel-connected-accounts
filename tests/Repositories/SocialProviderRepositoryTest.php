<?php

namespace Tests\Repositories;

use Nitm\ConnectedAccounts\Models\SocialProvider;
use Nitm\ConnectedAccounts\Repositories\SocialProviderRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SocialProviderRepositoryTest extends TestCase
{
    /**
     * @var SocialProviderRepository
     */
    protected $socialProviderRepo;

    public function setUp(): void
    {
        parent::setUp();
        $this->socialProviderRepo = \App::make(SocialProviderRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_social_provider()
    {
        $socialProvider = SocialProvider::factory()->make()->toArray();

        $createdSocialProvider = $this->socialProviderRepo->create($socialProvider);

        $createdSocialProvider = $createdSocialProvider->toArray();
        $this->assertArrayHasKey('id', $createdSocialProvider);
        $this->assertNotNull($createdSocialProvider['id'], 'Created SocialProvider must have id specified');
        $this->assertNotNull(SocialProvider::find($createdSocialProvider['id']), 'SocialProvider with given id must be in DB');
        $this->assertModelData($socialProvider, $createdSocialProvider);
    }

    /**
     * @test read
     */
    public function test_read_social_provider()
    {
        $socialProvider = SocialProvider::factory()->create();

        $dbSocialProvider = $this->socialProviderRepo->find($socialProvider->id);

        $dbSocialProvider = $dbSocialProvider->toArray();
        $this->assertModelData($socialProvider->toArray(), $dbSocialProvider);
    }

    /**
     * @test update
     */
    public function test_update_social_provider()
    {
        $socialProvider = SocialProvider::factory()->create();
        $fakeSocialProvider = SocialProvider::factory()->make()->toArray();

        unset($fakeSocialProvider['token']);

        $updatedSocialProvider = $this->socialProviderRepo->update($fakeSocialProvider, $socialProvider->id);

        $this->assertModelData($fakeSocialProvider, $updatedSocialProvider->toArray());
        $dbSocialProvider = $this->socialProviderRepo->find($socialProvider->id);
        $this->assertModelData($fakeSocialProvider, $dbSocialProvider->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_social_provider()
    {
        $socialProvider = SocialProvider::factory()->create();

        $resp = $this->socialProviderRepo->delete($socialProvider->id);

        $this->assertTrue($resp);
        $this->assertNull(SocialProvider::find($socialProvider->id), 'SocialProvider should not exist in DB');
    }
}