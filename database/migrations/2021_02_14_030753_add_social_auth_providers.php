<?php

use Nitm\ConnectedAccounts\Models\SocialProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialAuthProviders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        SocialProvider::create(['slug' => 'google', 'label' => 'Google']);
        SocialProvider::create(['slug' => 'facebook', 'label' => 'Facebook']);
        SocialProvider::create(['slug' => 'instagram', 'label' => 'Instagram']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        SocialProvider::whereIn('slug', ['google', 'facebook', 'instagram'])->delete();
    }
}
