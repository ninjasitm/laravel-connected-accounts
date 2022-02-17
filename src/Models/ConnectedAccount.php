<?php

namespace Nitm\ConnectedAccounts\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Nitm\ConnectedAccounts\Contracts\Models\ConnectedAccount as ModelsConnectedAccount;

/**
 * Connected Account
 *
 * @inheritDoc
 */

/**
 * @SWG\Definition(
 *      definition="SocialProvider",
 *      required={"label", "override_scopes", "stateless"},
 * @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 * @SWG\Property(
 *          property="offline_token",
 *          description="offline_token",
 *          type="string"
 *      ),
 * @SWG\Property(
 *          property="token",
 *          description="token",
 *          type="boolean"
 *      ),
 * @SWG\Property(
 *          property="expires_in",
 *          description="expires_in",
 *          type="string",
 *          format="date-time"
 *      ),
 * @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 * @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class ConnectedAccount extends Model implements ModelsConnectedAccount
{
    use HasFactory;

    protected $dates = [];

    protected $attributes = ['token' => '{}'];

    /**
     * Resolve route binding
     *
     * @param  mixed $value
     * @param  mixed $field
     * @return void
     */
    public function resolveRouteBinding($value, $field = null)
    {
        $realField = $field ?? is_numeric($value) ? $this->getRouteKeyName() : 'slug';
        return $this->where($realField, $value)->first();
    }

    /**
     * Get Table
     *
     * @return void
     */
    public function getTable()
    {
        return config('social-auth.table_names.user_has_social_provider', 'user_has_social_provider');
    }
}