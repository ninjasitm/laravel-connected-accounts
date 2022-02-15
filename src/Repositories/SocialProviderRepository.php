<?php

/**
 * SocialProvider Repository
 */

namespace Nitm\ConnectedAccounts\Repositories;

use Nitm\ConnectedAccounts\Models\SocialProvider;
use Nitm\Content\Repositories\BaseRepository;

/**
 * Class SocialProviderRepository
 * @package App\Repositories
 * @version February 3, 2021, 12:06 am UTC
 */

class SocialProviderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return SocialProvider::class;
    }
}