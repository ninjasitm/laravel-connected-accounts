<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Nitm\ConnectedAccounts\Models\ConnectedAccount;

class ConnectedAccountTest extends TestCase
{
    // use RefreshDatabase;

    public function testCreate()
    {
        $data = ConnectedAccount::factory()->make();
        $model = ConnectedAccount::factory()->create($data->getAttributes());

        $this->assertInstanceOf(ConnectedAccount::class, $model);
        $this->assertGreaterThan(0, $model->id);
    }

    public function testDelete()
    {
        $model = ConnectedAccount::factory()->create();

        $model->delete();

        $this->assertInstanceOf(ConnectedAccount::class, $model);
        $this->assertDatabaseMissing($model->getTable(), ['id' => $model->id]);
    }
}