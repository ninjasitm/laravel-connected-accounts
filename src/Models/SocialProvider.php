<?php

namespace Nitm\ConnectedAccounts\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Nitm\Content\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nitm\ConnectedAccounts\Contracts\Models\SocialProvider as ModelsSocialProvider;
use Nitm\Content\Traits\CustomWith;
use Nitm\Content\Traits\Model as TraitsModel;
use Nitm\Content\Traits\Search;

/**
 * Social Provider
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
 *          property="label",
 *          description="label",
 *          type="string"
 *      ),
 * @SWG\Property(
 *          property="slug",
 *          description="slug",
 *          type="string"
 *      ),
 * @SWG\Property(
 *          property="scopes",
 *          description="scopes",
 *          type="string"
 *      ),
 * @SWG\Property(
 *          property="parameters",
 *          description="parameters",
 *          type="string"
 *      ),
 * @SWG\Property(
 *          property="override_scopes",
 *          description="override_scopes",
 *          type="boolean"
 *      ),
 * @SWG\Property(
 *          property="stateless",
 *          description="stateless",
 *          type="boolean"
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
class SocialProvider extends \MadWeb\SocialAuth\Models\SocialProvider implements ModelsSocialProvider
{
    use HasFactory, TraitsModel, Search, CustomWith;

    protected $fillable = ['label', 'slug', 'scopes', 'parameters', 'override_scopes', 'stateless'];

    public function resolveRouteBinding($value, $field = null)
    {
        $realField = $field ?? is_numeric($value) ? $this->getRouteKeyName() : 'slug';
        return $this->where($realField, $value)->first();
    }
}