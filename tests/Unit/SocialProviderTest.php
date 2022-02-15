<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Nitm\ConnectedAccounts\Models\SocialProvider;

class SocialProviderTest extends TestCase
{
    // use RefreshDatabase;

    public function testCreate()
    {
        $data = SocialProvider::factory()->make();
        $model = SocialProvider::factory()->create($data->getAttributes());

        $this->assertInstanceOf(SocialProvider::class, $model);
        $this->assertGreaterThan(0, $model->id);
    }

    public function testUpdate()
    {
        $model = SocialProvider::factory()->create();
        $data = $model->getAttributes();

        $updateData = SocialProvider::factory()->make();
        $model->fill($updateData->toArray());
        $keys = array_keys($updateData->toArray());

        $this->assertInstanceOf(SocialProvider::class, $model);
        $this->assertNotEquals(
            Arr::only($data, $keys),
            Arr::only($model->getAttributes(), $keys)
        );
    }

    public function testDelete()
    {
        $model = SocialProvider::factory()->create();

        $model->delete();

        $this->assertInstanceOf(SocialProvider::class, $model);
        $this->assertDatabaseMissing($model->getTable(), ['id' => $model->id]);
    }
}